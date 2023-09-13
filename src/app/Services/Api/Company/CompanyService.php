<?php

namespace App\Services\Api\Company;

use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\ExternalSearchCompanyRequest;
use App\Http\Requests\Company\InternalSearchCompanyRequest;
use App\Http\Requests\Company\LoginAsCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Requests\Company\EmployeeCodeRequest;
use App\Models\Account;
use App\Models\Company;
use App\Models\CompanyMediaFile;
use App\Models\CompanySize;
use App\Models\DetailListOfEmployees;
use App\Models\ListOfEmployees;
use App\Models\Region;
use App\Models\RoleInCompany;
use App\Models\Section;
use App\Models\User;
use App\Models\Metro;
use App\Models\Office;
use App\Models\OfficeMetro;
use App\Models\EmployeePermission;
use App\Models\DefaultPermission;
use App\Models\EmployeeCode;
use App\Models\CompanyRekvisit;
use App\Traits\HttpResponse;
use App\Traits\NotificationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeConfirmation;
use Carbon\Carbon;
use App\Models\DefaultTemplate;
use App\Models\Template;
use App\Services\Api\Account\AccountService;
use App\Services\Api\MediaFile\MediaFileService;
use Ramsey\Uuid\Type\Integer;

use function PHPUnit\Framework\isEmpty;

class CompanyService
{
    use HttpResponse, NotificationTrait;
    protected Request $request;
    private $token = 'fe67ca89495827624aa08fa6ee0967a5fd4e5639';
    private MediaFileService $md_service;
    private $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->md_service = new MediaFileService();
        $this->accountService = $accountService;
    }

    private function request_dadata_suggestions_companies($query)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Token ' . $this->token
        ])->post('https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/party', [
            'query' => $query,
            'count' => 5
        ]);
        $jsonResponse = $response->json();

        return $jsonResponse;
    }

    private function request_egrul($inn)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Accept-encoding' => 'gzip'
        ])->get('https://egrul.itsoft.ru/' . $inn . '.json');
        $jsonResponse = $response->json();

        return $jsonResponse;
    }

    private function prepare_data_from_dadata_companies($query)
    {
        $data = $this->request_dadata_suggestions_companies($query);
        $suggested_companies = [];
        foreach ($data['suggestions'] as $suggestion) {

            $status_company = '';
            if ($suggestion['data']['state']['status']) {
                if ($suggestion['data']['state']['status'] == 'ACTIVE') {
                    $status_company = 'Действующая организация';
                } elseif ($suggestion['data']['state']['status'] == 'LIQUIDATED') {
                    $status_company = 'Организация ликвидирована';
                } elseif ($suggestion['data']['state']['status'] == 'LIQUIDATING') {
                    $status_company = 'Организация в процессе ликвидации';
                }
            }
            $suggested_company = [
                'type_short' => $suggestion['data']['opf']['short'] ?? 'Не найдено',
                'type_full' => $suggestion['data']['opf']['full'] ?? 'Не найдено',
                'name' => ($suggestion['data']['name']['short'] ?? ($suggestion['data']['name']['full'] ?? 'Не найдено')),
                'name_full' => $suggestion['data']['name']['full'] ?? 'Не найдено',
                'inn' => $suggestion['data']['inn'] ?? 'Не найдено',
                'kpp' => $suggestion['data']['kpp'] ?? 'Не найдено',
                'ogrn' => $suggestion['data']['ogrn'] ?? 'Не найдено',
                'ogrn_date' => $suggestion['data']['ogrn_date'] ?? 'Не найдено',
                'okved' => $suggestion['data']['okved'] ?? 'Не найдено',
                'address' => $suggestion['data']['address']['value'] ?? 'Не найдено',
                'address_city' => $suggestion['data']['address']['data']['city'] ?? 'Не найдено',
                'management_name' => $suggestion['data']['management']['name'] ?? 'Не найдено',
                'management_post' => $suggestion['data']['management']['post'] ?? 'Не найдено',
                'status' => $status_company,

            ];
            $suggested_companies[] = $suggested_company;
        }
        return $suggested_companies;
    }

    private function prepare_data_for_store($inn)
    {
        $data = $this->request_dadata_suggestions_companies($inn);
        $data1 = $this->request_egrul($inn);
        $suggested_companies = [];

        foreach ($data['suggestions'] as $suggestion) {
            $status_company = '';

            if (isset($suggestion['data']['state']['status'])) {
                switch ($suggestion['data']['state']['status']) {
                    case 'ACTIVE':
                        $status_company = 'Действующая организация';
                        break;
                    case 'LIQUIDATED':
                        $status_company = 'Организация ликвидирована';
                        break;
                    case 'LIQUIDATING':
                        $status_company = 'Организация в процессе ликвидации';
                        break;
                }
            }

            $suggested_company = [
                'type_short' => $suggestion['data']['opf']['short'] ?? 'Не найдено',
                'type_full' => $suggestion['data']['opf']['full'] ?? 'Не найдено',
                'name' => ($suggestion['data']['name']['short'] ?? ($suggestion['data']['name']['full'] ?? 'Не найдено')),
                'name_full' => $suggestion['data']['name']['full'] ?? 'Не найдено',
                'inn' => $suggestion['data']['inn'] ?? 'Не найдено',
                'kpp' => $suggestion['data']['kpp'] ?? 'Не найдено',
                'ogrn' => $suggestion['data']['ogrn'] ?? 'Не найдено',
                'ogrn_date' => $suggestion['data']['ogrn_date'] ?? 'Не найдено',
                'okved' => $suggestion['data']['okved'] ?? 'Не найдено',
                'okved_text' => $data1['СвЮЛ']['СвОКВЭД']['СвОКВЭДОсн']['@attributes']['НаимОКВЭД'] ?? 'Не найдено',
                'address' => $suggestion['data']['address']['value'] ?? 'Не найдено',
                'address_city' => $suggestion['data']['address']['data']['city'] ?? 'Не найдено',
                'manager_name' => $suggestion['data']['management']['name'] ?? 'Не найдено',
                'manager_position' => $suggestion['data']['management']['post'] ?? 'Не найдено',
                'okato' => $suggestion['data']['okato'] ?? 'Не найдено',
                'oktmo' => $suggestion['data']['oktmo'] ?? 'Не найдено',
                'okfs' => $suggestion['data']['okfs'] ?? 'Не найдено',
                'okogu' => $suggestion['data']['okogu'] ?? 'Не найдено',
                'okpo' => $suggestion['data']['okpo'] ?? 'Не найдено',
                'type_capital' => $data1['СвЮЛ']['СвУстКап']['@attributes']['НаимВидКап'] ?? 'Не найдено',
                'sum_capital' => $data1['СвЮЛ']['СвУстКап']['@attributes']['СумКап'] ?? 'Не найдено',
                'status' => $suggestion['data']['state']['status'] ?? 'Не найдено',
                'status_text' => $status_company ?? 'Не найдено',
                'tax_inspection' => $data1['СвЮЛ']['СвУчетНО']['СвНО']['attributes']['НаимНО'] ?? 'Не найдено',
            ];

            $suggested_companies[] = $suggested_company;
        }

        return $suggested_companies;
    }

    private function store_company($companies)
    {
        $company = $companies[0];
        $region = Region::where('name', $company['address_city'])->first();
        if ($region) {
            $region_id = $region->id;
        } else {
            $region_id = null;
        }
        $exist_account_inn = Account::where('email', $company['inn'] . '@at-work.pro')->first();
        if ($exist_account_inn) {
            return $this->error('The company already exist', 'error', 422);
        } else {
            if ($company['status'] == 'ACTIVE') {
                $account_for_company = Account::create([
                    'email' => $company['inn'] . '@at-work.pro',
                    'password' => Hash::make($company['inn'] . 'Atwrk##'),
                    'phone_number' => '+34' . $company['inn']
                ]);

                $created_company = Company::create([
                    'type_short' => $company['type_short'],
                    'type_full' => $company['type_full'],
                    'name' => $company['name'],
                    'name_full' => $company['name_full'],
                    'inn' => $company['inn'],
                    'kpp' => $company['kpp'],
                    'ogrn' => $company['ogrn'],
                    'ogrn_date' => $company['ogrn_date'],
                    'okved' => $company['okved'],
                    'okved_text' => $company['okved_text'],
                    'manager_name' => $company['manager_name'],
                    'manager_position' => $company['manager_position'],
                    'okato' => $company['okato'],
                    'oktmo' => $company['oktmo'],
                    'okfs' =>  $company['okfs'],
                    'okogu' => $company['okogu'],
                    'okpo' => $company['okpo'],
                    'type_capital' => $company['type_capital'],
                    'sum_capital' => $company['sum_capital'],
                    'status' => $company['status'],
                    'status_text' => $company['status_text'],
                    'address' => $company['address'],
                    'account_id' => $account_for_company->id,
                    'region_id' => $region_id,
                    'tax_inspection' => $company['tax_inspection']
                ]);


                $list_of_employees = ListOfEmployees::where('company_id', $created_company->id)->first();
                DetailListOfEmployees::create([
                    'employee_id' => Auth::id(),
                    'list_of_employees_id' => $list_of_employees->id,
                    'role_in_company_id' => RoleInCompany::where('name', 'Администратор')->first()->id
                ]);
                $all = DefaultTemplate::all();
                foreach($all as $default){
                Template::create(['company_id' => $created_company->id, "category" => $default->category, "name" => $default->name, "text" => $default->text]);
                }
                return $this->success($created_company, 'success', 201);
            } else {
                return $this->error('Company is Liquited or in process of Liquiding', 'error', 422);
            }
        }
    }

    public function create_company(CreateCompanyRequest $request)
    {
        $company = $this->prepare_data_for_store($request->input('inn'));
        return $this->store_company($company);
    }

    public function external_search_company(ExternalSearchCompanyRequest $request)
    {
        $response = $this->prepare_data_from_dadata_companies($request->input('query'));
        return $this->success($response);
    }

    public function internal_search_company(InternalSearchCompanyRequest $request)
    {
        $query = $request->input('query');

        if ($request->input('company_id')) {
            $companies = Company::select('companies.*', 'accounts.avatar as avatar')
                ->leftJoin('accounts', 'accounts.id', '=', 'companies.account_id')
                ->where('companies.id', '=', $request->input('company_id'))
                ->get();
        } else {
            $companies = Company::select('companies.*', 'accounts.avatar as avatar', 'company_sizes.size as company_size')
                ->leftJoin('accounts', 'accounts.id', '=', 'companies.account_id')
                ->leftJoin('company_sizes', 'company_sizes.id', '=', 'companies.company_size_id')
                ->where('companies.name', 'LIKE', '%' . $query . '%')
                ->orWhere('companies.name_full', 'LIKE', '%' . $query . '%')
                ->orWhere('companies.inn', 'LIKE', '%' . $query . '%')
                ->orWhere('companies.type_short', 'LIKE', '%' . $query . '%')
                ->orWhere('companies.type_full', 'LIKE', '%' . $query . '%')
                ->orWhere('companies.kpp', 'LIKE', '%' . $query . '%')
                ->get();
        }
        $final_companies = [];
        foreach ($companies as $company) {
            $company_id = $company->id;
            $company = Company::find($company_id);
            $offices = Office::where('company_id', $company_id)->get();
            $data = [];
            if(isset($offices)){
                foreach($offices as $office){
                    $metros_id = OfficeMetro::where('office_id', $office->id)->get();
                    $metros = [];
                    if(isset($metros_id)){
                        foreach($metros_id as $metro){
                            $metros[] = Metro::find($metro->metro_id);
                        }
                    }
                    $user = User::where('account_id', $office->account_id)->first();
                    $added_by = $user->lastname . ' ' . mb_substr($user->name, 0, 1, 'UTF-8') . '.';
                    $data[] = ['id' => $office->id, 'address' => $office->address, 'added_by' => $added_by, "metro" => $metros];
                }
            }
            $company['offices'] = $data;

            $company_files = CompanyMediaFile::where('company_id', '=', $company_id)->get();
            foreach ($company_files as $company_file) {
                $company_file->path = $this->md_service->getImagePathAndFileName($company_file->media_file_id);
            }

            $company['company_files'] = $company_files;
            if($company['cover_image_id'] != null){
                $company['cover_image_path'] = $this->md_service->getImagePathAndFileName($company['cover_image_id']);
            }

            if($company['logo_image_id'] != null){
                $company['logo_image_path'] = $this->md_service->getImagePathAndFileName($company['logo_image_id']);
            }

            if($company['region_id'] != null){
                $company['city_name'] =  Region::find($company['region_id'])->name;
            }

            $final_companies[] = $company;
        }
        return $this->success($final_companies);
    }

    public function get_my_companies()
    {
        $companies = Company::select('companies.id as company_id', 'companies.inn as inn', 'companies.type_short as type_company', 'companies.name as name_company', 'accounts.avatar as avatar')
            ->leftJoin('list_of_employees', 'companies.id', '=', 'list_of_employees.company_id')
            ->leftJoin('detail_list_of_employees', 'detail_list_of_employees.list_of_employees_id', '=', 'list_of_employees.id')
            ->leftJoin('accounts', 'accounts.id', '=', 'companies.account_id')
            ->where('detail_list_of_employees.employee_id', '=', auth()->id())
            ->get();
        return $this->success($companies);
    }

    public function login_as_company(LoginAsCompanyRequest $request)
    {
        $company_id = $request->input('company_id');
        $company_exist = Company::find($company_id);
        if ($company_exist) {
            $is_my_company = Company::select('companies.id as company_id', 'companies.inn as inn', 'companies.type_short as type_company', 'companies.name as name_company', 'accounts.avatar as avatar', 'companies.logo_image_id as logo_image_id')
                ->leftJoin('list_of_employees', 'companies.id', '=', 'list_of_employees.company_id')
                ->leftJoin('detail_list_of_employees', 'detail_list_of_employees.list_of_employees_id', '=', 'list_of_employees.id')
                ->leftJoin('accounts', 'accounts.id', '=', 'companies.account_id')
                ->where('detail_list_of_employees.employee_id', '=', auth()->id())
                ->where('companies.id', '=', $company_id)
                ->get();
            if ($is_my_company->isEmpty()) {
                return $this->error('You cant login as this company', 'error', 422);
            } else {
                $account = $this->accountService->getCurrentAccount();
                $this->accountService->setCurrentCompanyID($company_id);
                // $account = Account::find(Auth::id());
                // $account->logged_as = $company_id;
                // $account->save();
                // $user = User::where('account_id', $account->id)->first();
                // $account->name = $user->name;
                // $account->lastname = $user->lastname;
                // $account->birthday = $user->birthday;
                // $account->balance = $user->balance;
                // if ($account->current_section_id) {
                //     $account->current_section_name = Section::find($account->current_section_id)->title;
                // } else {
                //     $account->current_section_name = 'general';
                // }

                // if($is_my_company[0]['cover_image_id'] != null){
                //     $is_my_company[0]['cover_image_path'] = $this->md_service->getImagePathAndFileName($is_my_company[0]['cover_image_id']);
                // }

                if($is_my_company[0]['logo_image_id'] != null){
                    $is_my_company[0]->avatar = $this->md_service->getImagePathAndFileName($is_my_company[0]['logo_image_id']);
                }
                $is_my_company[0]->balance = 0.00;
                $account->referal_code = base64_encode($account->id);
                $company_files = CompanyMediaFile::where('company_id', '=', $company_id)->get();
                // return $this->success(['user' => $account, 'company' => $is_my_company[0], 'company_files' => $company_files]);
                return $this->success(['user'=> $this->accountService->responseInfo($this->accountService->getCurrentAccount()), 'company' => $is_my_company[0], 'company_files' => $company_files]);
            }
        } else {
            return $this->error('Company not found', 'error', 404);
        }
    }

    public function logout_is_company()
    {
        $this->accountService->setCurrentCompanyID(null);
        $account = Account::find(Auth::id());
        // $account->logged_as = null;
        // $account->current_section_id = null;
        $account->save();
        $user = User::where('account_id', $account->id)->first();
        $account->name = $user->name;
        $account->lastname = $user->lastname;
        $account->birthday = $user->birthday;
        $account->balance = $user->balance;
        $account->current_section_name = 'general';
        $account->referal_code = base64_encode($account->id);
        return $this->success(['user' => $account]);
    }

    public function update_company(UpdateCompanyRequest $request)
    {
        $company_id = Account::find(Auth::id())->logged_as;
        $company = Company::find($company_id);
        $folder_name_cover = 'uploads/company/cover/' . $company_id;
        $folder_name_logo = 'uploads/company/logo/' . $company_id;
        $folder_files = 'uploads/company/files/' . $company_id;

        if ($request->hasFile('cover')) {
            $path_cover = $this->md_service->update($company->cover_image_id, $request->file('cover'), $folder_name_cover);
            $company->cover_image_id = $path_cover->id;
        } else {
            if ($company->cover_image_id != null) {
                $this->md_service->delete($company->cover_image_id);
                $company->cover_image_id = null;
            }
        }

        if ($request->hasFile('logo')) {
            $path_logo = $this->md_service->update($company->logo_image_id, $request->file('logo'), $folder_name_logo);
            $company->logo_image_id = $path_logo->id;
        } else {
            if ($company->logo_image_id != null) {
                $this->md_service->delete($company->logo_image_id);
                $company->logo_image_id = null;
            }
        }

        if ($request->filled('short_description')) {
            $company->short_description = $request->input('short_description');
        }

        if ($request->filled('website')) {
            $company->website = $request->input('website');
        }

        if ($request->filled('description')) {
            $company->description = $request->input('description');
        }

        if ($request->filled('company_size_id')) {
            $company->company_size_id = $request->input('company_size_id');
        }
        $company_files = CompanyMediaFile::where('company_id', '=', $company->id)->get();
        $len_company_files = $company_files != null ? count($company_files) : 0;
        if ($request->hasFile('company_files')) {

            $files = $request->file('company_files');
            $len_files = $files != null ? count($files) : 0;


            if ($len_files >= $len_company_files) {
                $i = 0;
                while ($i < $len_company_files) {
                    $id_file = $this->md_service->update($company_files[$i]->media_file_id, $files[$i], $folder_files)->id;
                    $company_media_file = CompanyMediaFile::find($company_files[$i]->id);
                    $company_media_file->media_file_id = $id_file;
                    $company_media_file->save();
                    $i++;
                }
                if ($len_files > $len_company_files) {
                    while ($i < $len_files) {
                        $id_file = $this->md_service->storeOne($files[$i], $folder_files)->id;
                        CompanyMediaFile::create([
                            'media_file_id' => $id_file,
                            'company_id' => $company_id
                        ]);
                        $i++;
                    }
                }
            }

            if ($len_files < $len_company_files) {
                $i = 0;
                while ($i < $len_files) {
                    $id_file = $this->md_service->update($company_files[$i]->media_file_id, $files[$i], $folder_files);
                    $company_media_file = CompanyMediaFile::find($company_files[$i]->id);
                    $company_media_file->media_file_id = $id_file->id;
                    $company_media_file->save();
                    $i++;
                }
                while ($i < $len_company_files) {
                    $this->md_service->delete($company_files[$i]->media_file_id);
                    $company_media_file = CompanyMediaFile::find($company_files[$i]->id);
                    $company_media_file->delete();
                    $i++;
                }
            }
        } else {
            $i = 0;
            while ($i < $len_company_files) {
                $this->md_service->delete($company_files[$i]->media_file_id);
                $company_files[$i]->delete();
                $i++;
            }
        }

        $company->save();
        if($company['cover_image_id'] != null){
            $company['cover_image_path'] = $this->md_service->getImagePathAndFileName($company['cover_image_id']);
        }

        if($company['logo_image_id'] != null){
            $company['logo_image_path'] = $this->md_service->getImagePathAndFileName($company['logo_image_id']);
        }
        $company_files = CompanyMediaFile::where('company_id', '=', $company->id)->get();
        foreach ($company_files as $company_file) {
            $company_file->path = $this->md_service->getImagePathAndFileName($company_file->media_file_id);
        }
        return $this->success(['company' => $company, 'company_files' => $company_files]);
    }

    public function update_juridical_data()
    {
        if ($this->accountService->getCurrentCompanyID()) {
            $actual_company = Company::find($this->accountService->getCurrentCompanyID());
            $company = $this->prepare_data_for_store($actual_company->inn)[0];
            $actual_company->update([
                'type_short' => $company['type_short'],
                'type_full' => $company['type_full'],
                'name' => $company['name'],
                'name_full' => $company['name_full'],
                'inn' => $company['inn'],
                'kpp' => $company['kpp'],
                'ogrn' => $company['ogrn'],
                'ogrn_date' => $company['ogrn_date'],
                'okved' => $company['okved'],
                'okved_text' => $company['okved_text'],
                'manager_name' => $company['manager_name'],
                'manager_position' => $company['manager_position'],
                'okato' => $company['okato'],
                'oktmo' => $company['oktmo'],
                'okfs' => $company['okfs'],
                'okogu' => $company['okogu'],
                'okpo' => $company['okpo'],
                'type_capital' => $company['type_capital'],
                'sum_capital' => $company['sum_capital'],
                'status' => $company['status'],
                'status_text' => $company['status_text'],
                'address' => $company['address'],
                'tax_inspection' => $company['tax_inspection']
            ]);
            if(isset($company['cover_image_id'])){
                $company['cover_image_path'] = $this->md_service->getImagePathAndFileName($company['cover_image_id']);
            }

            if(isset($company['logo_image_id'])){
                $company['logo_image_path'] = $this->md_service->getImagePathAndFileName($company['logo_image_id']);
            }
            $company_files = CompanyMediaFile::where('company_id', '=', $actual_company->id)->get();
            return $this->success(['company' => $actual_company, 'company_files' => $company_files]);
        }
        else{
            return $this->error('You need to login in a company', 'error', 422);
        }
    }

    public function get_company_sizes()
    {
        $company_sizes = CompanySize::all();
        return $this->success($company_sizes);
    }

    public function sendLink($request)
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        $company = Company::find($company_id);
        $code = base64_encode($company_id);

        $old_code = EmployeeCode::where('email', $request->email)->where('code', $code)->first();
        if (isset($old_code)) {
            $old_code->role_in_company_id = $request->role;
            $old_code->save();
        } else {
            EmployeeCode::create([
                'email' => $request->email,
                'code' => $code,
                'role_in_company_id' => $request->role,
            ]);
        }
        $link = "{$request->start_link}{$code}";
        Mail::to($request->email)->send(new EmployeeConfirmation($link, $company->name));

        return $this->success(["message" => 'Email is send']);
    }

    public function useLink($code)
    {
        $account_id = auth()->id();
        $account = Account::find($account_id);
        $email = $account->email;

        $employees = EmployeeCode::where('email', $email)->get();
        foreach ($employees as $employee) {
            if ($employee->code == $code) {
                $employee->confirmed = 1;
                $employee->save();
                $role = $employee->role_in_company_id;
            }
        }

        $company_id = base64_decode($code);

        $list_of_employees = ListOfEmployees::where('company_id', $company_id)->first();
        $employee = DetailListOfEmployees::create([
            'employee_id' => $account_id,
            'list_of_employees_id' => $list_of_employees->id,
            'role_in_company_id' => $role,
        ]);

        $permissions = DefaultPermission::where('role_id', $role)->get();
        foreach($permissions as $permission){
            EmployeePermission::create(['employee_id' => $employee->id, 'permission_id' => $permission->permission_id, 'is_active' => $permission->is_active, 'is_disabled' => $permission->is_disabled]);
        }
        return $this->success('Employee is confirmed and added to the company');
    }
}
