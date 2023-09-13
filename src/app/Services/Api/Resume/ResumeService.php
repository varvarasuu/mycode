<?php

namespace App\Services\Api\Resume;

use App\Models\Category;
use App\Models\CategoryName;
use App\Models\Country;
use App\Models\Languages;
use App\Models\ResumeBusinessTrips;
use App\Models\ResumeBusyness;
use App\Models\ResumeCurrency;
use App\Models\ResumeSchedule;
use App\Models\ResumeSkills;
use App\Models\ResumeWorkFormats;
use App\Models\Region;
use App\Models\Metro;
use App\Models\Portfolio;
use App\Models\Resume;
use App\Models\ResumeAdditionalEducation;
use App\Models\ResumeBusinessTripsValues;
use App\Models\ResumeBusynessValue;
use App\Models\ResumeCitizenship;
use App\Models\ResumeDriverLicenseLevel;
use App\Models\ResumeDrivingCategory;
use App\Models\ResumeEducation;
use App\Models\ResumeLanguageLevel;
use App\Models\ResumeLanguages;
use App\Models\ResumeLevelEducation;
use App\Models\ResumeMovingValues;
use App\Models\ResumePortfolio;
use App\Models\ResumeScheduleValue;
use App\Models\ResumeSpecialization;
use App\Models\ResumeWorkExperience;
use App\Models\ResumeWorkFormatValue;
use App\Models\ResumeWorkPermit;
use App\Models\User;
use Illuminate\Http\Request;

use App\Services\Api\Resume\ResumeFirstStepService;
use App\Services\Api\Resume\ResumeTwoStepService;
use App\Services\Api\Resume\ResumeThirdStepService;
use App\Services\Api\Resume\ResumeFourStepService;
use App\Services\Api\Resume\ResumeFifthStepService;
use App\Services\Api\Resume\ResumeSevenStepService;

use App\Services\Api\MediaFile\MediaFileService;

use App\Models\CasePortfolio;
use App\Models\DocumentPortfolio;


use App\Traits\HttpResponse;
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\Auth;

use Owenoj\LaravelGetId3\GetId3;

use Exception;
use GrahamCampbell\ResultType\Success;

class ResumeService
{

    use HttpResponse, NotificationTrait;

    protected Request $request;
    public $account_id;
    private $post_data = [];
    private $error_string;
    private $edit_id = false;

    private MediaFileService $md_service;

    public function __construct()
    {
        $this->md_service = new MediaFileService();
    }

    public function getDeclined()
    {
        $all = Resume::join('categories', 'resumes.category_specialization', '=', 'categories.id')
            ->join('category_names', 'categories.category_names_id', '=', 'category_names.id')
            ->join('regions', 'regions.id', '=', 'resumes.city_id')
            ->select('resumes.id', 'resumes.power_up', 'resumes.updated_at', 'resumes.created_at',
                'resumes.job_title', 'resumes.category_specialization',
                'resumes.views', 'resumes.new_views', 'resumes.invites', 'resumes.new_invites',
                'resumes.responses', 'resumes.new_responses',
                'resumes.is_draft', 'resumes.active', 'resumes.archived', 'resumes.moderation',
                'category_names.name as cat_name', 'regions.name as region_name')
            ->where('account_id', auth()->id())
            ->where('deleted', 0)
            ->where('decline', 1)
            ->orderBy('updated_at', 'desc')
            ->get();
        if (!count($all))
            return $this->success('Resumes not found');

        $return = [];
        foreach ($all as $a) {
            $a['job_title'] = htmlspecialchars($a['job_title']);
            $return[] = $a;
        }
        return $this->success($return);
    }

    public function getArchive()
    {
        $all = Resume::join('categories', 'resumes.category_specialization', '=', 'categories.id')
            ->join('category_names', 'categories.category_names_id', '=', 'category_names.id')
            ->join('regions', 'regions.id', '=', 'resumes.city_id')
            ->select('resumes.id', 'resumes.power_up', 'resumes.updated_at', 'resumes.created_at',
                'resumes.job_title', 'resumes.category_specialization',
                'resumes.views', 'resumes.new_views', 'resumes.invites', 'resumes.new_invites',
                'resumes.responses', 'resumes.new_responses',
                'resumes.is_draft', 'resumes.active', 'resumes.archived', 'resumes.moderation',
                'category_names.name as cat_name', 'regions.name as region_name')
            ->where('account_id', auth()->id())
            ->where('deleted', 0)
            ->where('archived', 1)
            ->orderBy('updated_at', 'desc')
            ->get();
        if (!count($all))
            return $this->success('Resumes not found');

        $return = [];
        foreach ($all as $a) {
            $a['job_title'] = htmlspecialchars($a['job_title']);
            $return[] = $a;
        }
        return $this->success($return);
    }

    public function allResume()
    {
        $all = Resume::join('categories', 'resumes.category_specialization', '=', 'categories.id')
            ->join('category_names', 'categories.category_names_id', '=', 'category_names.id')
            ->join('regions', 'regions.id', '=', 'resumes.city_id')
            ->select('resumes.id', 'resumes.power_up', 'resumes.updated_at', 'resumes.created_at',
                        'resumes.job_title', 'resumes.category_specialization',
                        'resumes.views', 'resumes.new_views', 'resumes.invites', 'resumes.new_invites',
                        'resumes.responses', 'resumes.new_responses',
                        'resumes.is_draft', 'resumes.active', 'resumes.archived', 'resumes.moderation', 'resumes.decline',
                        'category_names.name as cat_name', 'regions.name as region_name')
            ->where('account_id', auth()->id())
            ->where('deleted', 0)
            ->where('archived', 0)
            ->orderBy('updated_at', 'desc')
            ->get();
        if (!count($all))
            return $this->success('Resumes not found');

        $return = [];
        foreach ($all as $a) {
            $a['job_title'] = htmlspecialchars($a['job_title']);

            if ($a['decline'] == 1) {
                $a['status'] = "Отклонено";
            } elseif ($a['active'] == 1)
                $a['status'] = "Обновлено";
            elseif ($a['is_draft'] == 1)
                $a['status'] = "Черновик";
            elseif ($a['moderation'] == 1)
                $a['status'] = "На модерации";
            else $a['status'] = "Ошибка";
            $return[] = $a;
        }
        return $this->success($return);
    }

    public function viewResume($resume_id)
    {

        $resume = Resume::
          where('resumes.id', $resume_id)
        ->where('resumes.deleted', 0)
        ->first();
        if (!$resume) {
            return $this->error('Not found', 'error', 404);
        }

        $user = User::where('account_id', $resume['account_id'])->first();

        $return['account_id'] = $resume['account_id'];
        $return['firstname'] = $user['name'];
        $return['lastname'] = $user['lastname'];
        $return['birthday'] = $user['birthday'];
        $return['power_up'] = $resume['power_up'];

        $return['city_id'] = $resume['city_id'];
        $return['relocation'] = $resume['relocation'];
        $return['text_work_experience'] = htmlspecialchars($resume['text_work_experience']);
        $return['have_car'] = $resume['have_car'];
        $return['about'] = htmlspecialchars($resume['about']);
        $return['video_resume_url'] = $resume['video_resume_url'];
        $return['avatar'] = $resume['avatar'];
        $return['job_title'] = $resume['job_title'];
        $return['salary'] = $resume['salary'];

        $return['city_name'] = Region::where('id', $resume['city_id'])->first()['name'];

        $return['metro_id'] = $resume['metro_id'];
        if ($resume['metro_id']) {
            $array_metro = Metro::where('id', $resume['metro_id'])->first();
            $return['metro_name'] = $array_metro['station_name'];
            $return['metro_line'] = $array_metro['line_name'];
        }

        $cat_spec = Category::where('id', $resume['category_specialization'])->first()['category_names_id'];
        $return['category_specialization_id'] = $resume['category_specialization'];
        $return['category_specialization'] = CategoryName::where('id', $cat_spec)->first()['name'];

        $return['moderation'] = $resume['moderation'];
        $return['active'] = $resume['active'];
        $return['archived'] = $resume['archived'];
        $return['decline'] = $resume['decline'];
        $return['is_draft'] = $resume['is_draft'];

        foreach (ResumeSpecialization::where("resume_id", $resume_id)->get() as $specializ) {
            $cat_spec = Category::where('id', $specializ['cpec_id'])->first()['category_names_id'];
            $return['specializations'][] = [
                    "id" => $specializ['cpec_id'],
                    "name" => CategoryName::where('id', $cat_spec)->first()['name']
                ];
        }
        if ($resume['currency']) {
            $return['currency'] = ResumeCurrency::where('id', $resume['currency'])->first()['name'];
            $return['currency_id'] = $resume['currency'];
        }
        foreach (ResumeCitizenship::where("resume_id", $resume_id)->get() as $ship) {
            $return['citizenship'][] = [
                    "name" => Country::where('id', $ship['country_id'])->first()['name'],
                    "id" => $ship['country_id']
                ];
        }
        foreach (ResumeWorkPermit::where("resume_id", $resume_id)->get() as $ship) {
            $return['permit'][] = [
                        "name" => Country::where('id', $ship['country_id'])->first()['name'],
                        "id" => $ship['country_id']
                    ];
        }
        foreach (ResumeWorkFormatValue::where("resume_id", $resume_id)->get() as $format) {
            $return['work_formats'][] = [
                    "name" => ResumeWorkFormats::where('id', $format['work_format_id'])->first()['name'],
                    "id" => $format['work_format_id']
                ];
        }

        foreach (ResumeBusynessValue::where("resume_id", $resume_id)->get() as $eml) {
            $return['busyness'][] = [
                    "id" => $eml['busy_id'],
                    "name" => ResumeBusyness::where('id', $eml['busy_id'])->first()['name']
                ];
        }

        foreach (ResumeScheduleValue::where("resume_id", $resume_id)->get() as $eml) {
            $return['schedule'][] = [
                    "id" => $eml['schedule_id'],
                    "name" => ResumeSchedule::where('id', $eml['schedule_id'])->first()['name']
                ];
        }

        foreach (ResumeBusinessTripsValues::where("resume_id", $resume_id)->get() as $eml) {
            $return['businessTrips'][] = [
                    "id" => $eml['bt_id'],
                    "name" => ResumeBusinessTrips::where('id', $eml['bt_id'])->first()['name']
                ];
        }

        foreach (ResumeMovingValues::where("resume_id", $resume_id)->get() as $ship) {
            $return['relocationCities'][] = [
                    "id" => $ship['city_id'],
                    "name" => Region::where('id', $ship['city_id'])->first()['name']
                ];
        }

        foreach (ResumeSkills::where("resume_id", $resume_id)->get() as $ship) {
            $return['skills'][] = $ship['skill'];
        }

        foreach (ResumeWorkExperience::where("resume_id", $resume_id)->get() as $ship) {
            $return['work_experience'][] = [
                'start_date' => $ship['start_date'],
                'end_date' => $ship['end_date'],
                'until_now' => $ship['until_now'],
                'company_name' => htmlspecialchars($ship['company_name']),
                'job_title' => htmlspecialchars($ship['job_title']),
                'responsibilities' => htmlspecialchars($ship['responsibilities']),
                'achievements' => htmlspecialchars($ship['achievements']),
                'reasons_leaving' => htmlspecialchars($ship['reasons_leaving'])
            ];
        }

        foreach (ResumeEducation::where("resume_id", $resume_id)->get() as $ship) {
            $return['education'][] = [
                'level_id' => $ship['level_id'],
                'level' => ResumeLevelEducation::where('id', $ship['level_id'])->first()['level_name'],
                'name' => htmlspecialchars($ship['name']),
                'speciality' => htmlspecialchars($ship['speciality']),
                'faculty' => htmlspecialchars($ship['faculty']),
                'finish_year' => $ship['finish_year']
            ];
        }

        foreach (ResumeAdditionalEducation::where("resume_id", $resume_id)->get() as $ship) {
            $return['addEducation'][] = [
                "name" => htmlspecialchars($ship['name']),
                "organization" => htmlspecialchars($ship['organization']),
                "speciality" => htmlspecialchars($ship['speciality']),
                "finish_year" => $ship['finish_year']
            ];
        }

        foreach (ResumeLanguages::where("resume_id", $resume_id)->get() as $ship) {
            $return['languages'][] = [
                "lang_name_id" => $ship['lang_id'],
                "lang_name" => Languages::where("id", $ship['lang_id'])->first()['name'],
                "lang_level_id" => $ship['lang_level'],
                "lang_level" => ResumeLanguageLevel::where("id", $ship['lang_level'])->first()['level_name']
            ];
        }

        foreach (ResumeDrivingCategory::where("resume_id", $resume_id)->get()  as $_dlicence) {
            $return['drivingCategory'][] = [
                "id" => $_dlicence['category'],
                "category" => ResumeDriverLicenseLevel::where('id', $_dlicence['category'])->first()['name']
            ];
        }

        foreach (ResumePortfolio::where("resume_id", $resume_id)->get() as $portfolio) {
            $return['portfolio'] = $this->getPortfolio($portfolio['portfolio_id']);
            break;
        }

        return $this->success($return);
    }

    private function getPortfolio($id) {
        $portfolio = Portfolio::find($id);

        if (!$portfolio) {
            return $this->error('Portfolio with this id is not found', 'error', 404);
        }

        $cases = CasePortfolio::where('portfolio_id', $id)->get();

        foreach ($cases as $case) {
            $case->file_path_1 = isset($case->file_path_1) ? $this->md_service->getImagePathAndFileName($case->file_path_1) : '';
            $case->file_path_2 = isset($case->file_path_2) ? $this->md_service->getImagePathAndFileName($case->file_path_2) : '';
            $case->file_path_3 = isset($case->file_path_3) ? $this->md_service->getImagePathAndFileName($case->file_path_3) : '';
            $extension = pathinfo($case->file_path_1, PATHINFO_EXTENSION);
            $extensio2 = pathinfo($case->file_path_2, PATHINFO_EXTENSION);
            $extensio3 = pathinfo($case->file_path_3, PATHINFO_EXTENSION);
            if (!in_array($extension, array('jpg', 'png', 'jpeg', 'gif'))) {
                $case->file_path_1 = "";
            }
            if (!in_array($extensio2, array('jpg', 'png', 'jpeg', 'gif'))) {
                $case->file_path_2 = "";
            }
            if (!in_array($extensio3, array('jpg', 'png', 'jpeg', 'gif'))) {
                $case->file_path_3 = "";
            }
        }
        $documents = DocumentPortfolio::where('portfolio_id', $id)->get();
        foreach ($documents as $document) {
            $document->file_path_1 = isset($document->file_path_1) ? $this->md_service->getImagePathAndFileName($document->file_path_1) : '';
            $document->file_path_2 = isset($document->file_path_2) ? $this->md_service->getImagePathAndFileName($document->file_path_2) : '';
            $document->file_path_3 = isset($document->file_path_3) ? $this->md_service->getImagePathAndFileName($document->file_path_3) : '';
            $extension = pathinfo($document->file_path_1, PATHINFO_EXTENSION);
            $extensio2 = pathinfo($document->file_path_2, PATHINFO_EXTENSION);
            $extensio3 = pathinfo($document->file_path_3, PATHINFO_EXTENSION);
            if (!in_array($extension, array('jpg', 'png', 'jpeg', 'gif'))) {
                $document->file_path_1 = "";
            }
            if (!in_array($extensio2, array('jpg', 'png', 'jpeg', 'gif'))) {
                $document->file_path_2 = "";
            }
            if (!in_array($extensio3, array('jpg', 'png', 'jpeg', 'gif'))) {
                $document->file_path_3 = "";
            }
        }
        return ["portfolio" => $portfolio, "cases" => $cases, "documents" => $documents];
    }

    public function setStatus($id, $status)
    {
        $resume = Resume::where('id', $id)->where('account_id', auth()->id())->where('deleted', 0);
        if (!$resume->first()) {
            return $this->error('Not found', 'error', 404);
        }

        if ($status == 'unarchive') {
            $resume = Resume::where('id', $id)->where('account_id', auth()->id())->where('deleted', 0);
            $resume->where('active', 1);
            $resume->where('archived', 1);
            if (!$resume->first()) {
                return $this->error('Not found', 'error', 404);
            }
            $resume->update([
                //"active" => 1,
                "archived" => 0,
                "is_draft" => 0
            ]);
            return $this->success('ok');
        }
        if ($status == 'archive') {
            $resume = Resume::where('id', $id)->where('account_id', auth()->id())->where('deleted', 0);
            $resume->where('active', 1);
            $resume->where('archived', 0);
            if (!$resume->first()) {
                return $this->error('Not found', 'error', 404);
            }
            $resume->update([
                //"active" => 1,
                "archived" => 1,
                "is_draft" => 0
            ]);
            return $this->success('ok');
        }
        if ($status == 'delete') {
            $resume->update([
                "moderation" => 0,
                "active" => 0,
                "deleted" => 1,
                "archived" => 0,
                "is_draft" => 0
            ]);
            return $this->success('ok');
        }
        return $this->error('Not found', 'error', 404);
    }

    public function createResume($request)
    {
        if ($request->input('resume_id')) {
            $this->edit_id = $request->input('resume_id');
            $check_ids = Resume::where('id', $request->input('resume_id'))->where('account_id', auth()->id())->where("deleted", 0)->first();
            if (!$check_ids) {
                return $this->error('Not found', 'error', 404);
            }
        }
        $this->request = $request;
        if ($this->create_resume_step1() === false) {
            return $this->error($this->error_string, 'error', 422);
        }
        if ($this->create_resume_step2() === false) {
            return $this->error($this->error_string, 'error', 422);
        }
        if ($this->create_resume_step3() === false) {
            return $this->error($this->error_string, 'error', 422);
        }
        if ($this->create_resume_step4() === false) {
            return $this->error($this->error_string, 'error', 422);
        }
        if ($this->create_resume_step5() === false) {
            return $this->error($this->error_string, 'error', 422);
        }
        if ($this->create_resume_step7() === false) {
            return $this->error($this->error_string, 'error', 422);
        }

        $status = $this->add_resume();
        if ($request->input('resume_id')) {
            if ($status) {
                $this->notifyUser("default", auth()->id());
                return $this->success(['status'=> 'ok', "id" => $status]);
            } else {
                return $this->error($this->error_string, 'error', 422);
            }
        } else {
            if ($status) {
                $this->notifyUser("default", auth()->id());
                return $this->success(['status' => 'ok', "id" => $status]);
            } else {
                return $this->error($this->error_string, 'error', 422);
            }
        }
    }

    private function create_resume_step1()
    {
        $first_step_service = new ResumeFirstStepService;
        if ($first_step_service->check_city() === false) {
            $this->error_string = 'City not found';
            return false;
        }
        $this->post_data['city_id'] = $this->request->input('city_id');
        $check_metro = $first_step_service->check_metro();
        if ($check_metro === false) {
            $this->error_string = 'Metro not found';
            return false;
        } elseif ($check_metro === true) {
            $this->post_data['metro_id'] = $this->request->input('metro_id');
        }
        $check_citizenship = $first_step_service->check_citizenship();
        if ($check_citizenship === false) {
            $this->error_string = 'Country (citizenship) not found';
            return false;
        }
        $this->post_data['citizenship'] = $check_citizenship;
        $check_work_permit = $first_step_service->check_work_permit();
        if ($check_work_permit === false) {
            $this->error_string = 'Country (work permit) not found';
            return false;
        }
        $this->post_data['work_permit'] = $check_work_permit;
        return true;
    }

    private function create_resume_step2()
    {
        $twoStepService = new ResumeTwoStepService;
        $this->post_data['job_title'] = $this->request->input('job_title');
        if ($this->request->input('job_salary')) {
            $this->post_data['job_salary'] = $this->request->input('job_salary');

            $check_currency_id = $twoStepService->check_currency_id();
            if ($check_currency_id === false) {
                $this->error_string = 'Currency not found';
                return false;
            }
            $this->post_data['currency_id'] = $check_currency_id;
        }
        $check_title_category = $twoStepService->check_title_category();
        if ($check_title_category === false) {
            $this->error_string = 'Category not found';
            return false;
        }
        $this->post_data['title_category'] = $check_title_category;
        $check_specializations = $twoStepService->check_specializations();
        if ($check_specializations === false) {
            $this->error_string = 'Specialization not found';
            return false;
        }
        $this->post_data['specialization'] = $check_specializations;
    }

    private function create_resume_step3()
    {
        $thirdStepService = new ResumeThirdStepService();
        $check_business_trip = $thirdStepService->check_business_trip();
        if ($check_business_trip === false) {
            $this->error_string = 'Trips not found';
            return false;
        } elseif ($check_business_trip !== null) {
            $this->post_data['business_trip'] = $check_business_trip;
        }

        $check_work_format = $thirdStepService->check_work_format();
        if ($check_work_format === false) {
            $this->error_string = 'Work format not found';
            return false;
        } elseif ($check_work_format !== null) {
            $this->post_data['work_format'] = $check_work_format;
        }

        //Занятость
        $check_busyness = $thirdStepService->check_busyness();
        if ($check_busyness === false) {
            $this->error_string = 'Employment not found';
            return false;
        } elseif ($check_busyness !== null) {
            $this->post_data['employment'] = $check_busyness;
        }

        $check_schedules = $thirdStepService->check_schedules();
        if ($check_schedules === false) {
            $this->error_string = 'Schedule not found';
            return false;
        } elseif ($check_schedules !== null) {
            $this->post_data['schedule'] = $check_schedules;
        }

        $check_relocation = $thirdStepService->check_relocation();
        if ($check_relocation === false) {
            $this->error_string = 'Region relocation not found';
            return false;
        } elseif ($check_relocation !== null) {
            $this->post_data['relocation_regions'] = $check_relocation;
        }

    }

    private function create_resume_step4()
    {
        $service = new ResumeFourStepService();
        $check_work_experience = $service->check_work_experience();
        if ($check_work_experience === false) {
            $this->error_string = 'Check work experience error';
            return false;
        } elseif ($check_work_experience !== null) {
            $this->post_data['work_array'] = 'true';
        }
    }

    private function create_resume_step5()
    {
        $service = new ResumeFifthStepService();
        $check_education = $service->check_education();
        if ($check_education === false) {
            $this->error_string = 'Check education error';
            return false;
        } elseif ($check_education !== null) {
            $this->post_data['education_array'] = 'true';
        }

        $check_add_education = $service->check_add_education();
        if ($check_add_education === false) {
            $this->error_string = 'Check additional education error';
            return false;
        } elseif ($check_add_education !== null) {
            $this->post_data['add_education_array'] = 'true';
        }

        $check_languages = $service->check_languages();
        if ($check_languages === false) {
            $this->error_string = 'Language not found';
            return false;
        } elseif ($check_languages !== null) {
            $this->post_data['languages_array'] = 'true';
        }

        $check_drive_license = $service->check_drive_license();
        if ($check_drive_license === false) {
            $this->error_string = 'Driver license not found';
            return false;
        } elseif ($check_drive_license !== null) {
            $this->post_data['drive_license_array'] = 'true';
        }
    }

    private function create_resume_step7()
    {
        $service = new ResumeSevenStepService();
        $check_portfolio = $service->check_portfolio();
        if ($check_portfolio === false) {
            $this->error_string = 'Portfolio not found';
            return false;
        } elseif ($check_portfolio === true) {
            $this->post_data['portfolio_ids'] = 'true';
        }
    }

    private function add_resume()
    {
        $new_resume['avatar'] = null;
        $new_resume['video_resume_url'] = null;
        $new_resume['account_id'] = auth()->id();

        $new_resume['city_id'] = $this->request->input('city_id');
        $new_resume['job_title'] = $this->request->input('job_title');
        $new_resume['category_specialization'] = $this->request->input('title_category');

        if($this->request->hasFile('new_avatar')) {
            $file = $this->request->file('new_avatar');
            $extension = $file->extension();
            $path = $this->request->file('new_avatar')->storeAs(
                'uploads/avatars/resume', auth()->id().time().mt_rand(10,99999).'.'.$extension, 'public'
            );
            $new_resume['avatar'] = '/storage/'.$path;
        }

        if($this->request->hasFile('video_resume')) {
            $track = new GetId3(request()->file('video_resume')); //video_resume_url
            if (isset($track->extractInfo()["playtime_seconds"]) AND
                        $track->extractInfo()["playtime_seconds"] > 10 AND
                            $track->extractInfo()["playtime_seconds"] < 300) {
                $file = $this->request->file('video_resume');
                $extension = $file->extension();
                $path = $this->request->file('video_resume')->storeAs(
                    'uploads/video/resume', auth()->id().time().mt_rand(10,99999).'.'.$extension, 'public'
                );
                $new_resume['video_resume_url'] = '/storage/'.$path;
            } else {
                $this->error_string = 'Invalid video';
                return false;
            }
        }

        if ($this->request->input('metro_id')) {
            $new_resume['metro_id'] = $this->request->input('metro_id');
        }

        if ($this->request->input('job_salary')) {
            $new_resume['salary'] = $this->request->input('job_salary');
        }
        if ($this->request->input('currency_id')) {
            $new_resume['currency'] = $this->request->input('currency_id');
        }

        if ($this->request->input('relocation')) {
            $new_resume['relocation'] = $this->request->input('relocation');
        }

        if ($this->request->input('work_experience')) {
            $new_resume['work_experience'] = $this->request->input('work_experience');
        }

        if ($this->request->input('text_work_experience')) {
            $new_resume['text_work_experience'] = $this->request->input('text_work_experience');
        }
        if ($this->request->input('experience_reason')) {
            $new_resume['text_work_experience'] = $this->request->input('experience_reason');
        }

        if ($this->request->input('have_car')) {
            $new_resume['have_car'] = $this->request->input('have_car');
        }

        if ($this->request->input('about')) {
            $new_resume['about'] = $this->request->input('about');
        }

        $resume_id = false;
        if ($this->edit_id) {
            ResumeCitizenship::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeWorkPermit::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeSpecialization::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeWorkFormatValue::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeBusynessValue::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeScheduleValue::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeBusinessTripsValues::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeMovingValues::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeWorkExperience::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeEducation::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeAdditionalEducation::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeLanguages::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeDrivingCategory::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumePortfolio::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            ResumeSkills::where("account_id", auth()->id())->where("resume_id", $this->edit_id)->delete();
            if ($this->request->input('active')) {
                $new_resume['active'] = 0;
                $new_resume['is_draft'] = 0;
                $new_resume['moderation'] = 1;
            }
            Resume::where("id", $this->edit_id)
                    ->where("account_id", auth()->id())
                    ->update($new_resume);
            $resume_id = $this->edit_id;
        } else {
            $resume_id = Resume::create($new_resume)->id;
        }

        if ($this->request->input('skills') AND is_array($this->request->input('skills'))) {
            foreach ($this->request->input('skills') as $ship) {
                ResumeSkills::create([
                    "account_id" => auth()->id(),
                    "resume_id" => $resume_id,
                    "skill" => $ship
                ]);
            }
        }
        //

        foreach ($this->request->input('citizenship') as $ship) {
            ResumeCitizenship::create(
                [
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "country_id" => $ship
                ]
            );
        }
        foreach ($this->request->input('work_permit') as $ship) {
            ResumeWorkPermit::create(
                [
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "country_id" => $ship
                ]
            );
        }
        foreach ($this->request->input('specialization') as $specializ) {
            ResumeSpecialization::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "cpec_id"    => $specializ
            ]);
        }
        if ($this->request->input('work_format') AND is_array($this->request->input('work_format'))) {
            $post_data = [];
            foreach ($this->request->input('work_format') as $format) {
                ResumeWorkFormatValue::create([
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "work_format_id"    => $format
                ]);
            }
        }
        if ($this->request->input('employment') AND is_array($this->request->input('employment'))) {
            foreach ($this->request->input('employment') as $eml) {
                ResumeBusynessValue::create([
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "busy_id"    => $eml
                ]);
            }
        }
        if ($this->request->input('schedule') AND is_array($this->request->input('schedule'))) {
            foreach ($this->request->input('schedule') as $eml) {
                ResumeScheduleValue::create([
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "schedule_id"    => $eml
                ]);
            }
        }
        if ($this->request->input('business_trip')) {
            //bt_id
            ResumeBusinessTripsValues::create([
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "bt_id"      => $this->request->input('business_trip')
            ]);
        }
        if ($this->request->input('relocation') AND is_array($this->request->input('relocation_region'))) {
            foreach ($this->request->input('relocation_region') as $ship) {
                ResumeMovingValues::create([
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "city_id"      => $ship
                ]);
            }
        }
        if (isset($this->post_data['work_array'])) {
            for ($i = 0; $i < count($this->request->input('work_experience_name')); $i++) {
                $responsibilities = null;
                $achievements = null;
                $reasons_leaving = null;
                if (isset($this->request->input('responsibilities')[$i])) {
                    $responsibilities = $this->request->input('responsibilities')[$i];
                }
                if (isset($this->request->input('achievements')[$i])) {
                    $achievements = $this->request->input('achievements')[$i];
                }
                if (isset($this->request->input('reasons_leaving')[$i])) {
                    $reasons_leaving = $this->request->input('reasons_leaving')[$i];
                }
                if (!isset($this->request->input('until_now')[$i]))
                    ResumeWorkExperience::create([
                        "account_id" => auth()->id(),
                        "resume_id"  => $resume_id,
                        "start_date" => $this->request->input('work_experience_start_year')[$i].'-'.$this->request->input('work_experience_start_month')[$i].'-01',
                        "end_date" => $this->request->input('work_experience_end_year')[$i].'-'.$this->request->input('work_experience_end_month')[$i].'-01',
                        "until_now" => 0,
                        "company_name" => $this->request->input('work_experience_name')[$i],
                        "job_title"    => $this->request->input('work_experience_job_title')[$i],
                        "responsibilities" => $responsibilities, //обязаности
                        "achievements" => $achievements, //достижения
                        "reasons_leaving" => $reasons_leaving
                    ]);
                else
                    ResumeWorkExperience::create([
                        "account_id" => auth()->id(),
                        "resume_id"  => $resume_id,
                        "start_date" => $this->request->input('work_experience_start_year')[$i].'-'.$this->request->input('work_experience_start_month')[$i].'-01',
                        "end_date" => null,
                        "until_now" => 1,
                        "company_name" => $this->request->input('work_experience_name')[$i],
                        "job_title"    => $this->request->input('work_experience_job_title')[$i],
                        "responsibilities" => $responsibilities, //обязаности
                        "achievements" => $achievements, //достижения
                        "reasons_leaving" => null
                    ]);
            }
        }

        if (isset($this->post_data['education_array'])) {
            for ($i = 0; $i < count($this->request->input('education_level')); $i++) {
                $education_speciality = null;
                $faculty = null;
                if (isset($this->request->input('education_speciality')[$i]))
                    $education_speciality = $this->request->input('education_speciality')[$i];
                if (isset($this->request->input('education_faculty')[$i]))
                    $faculty = $this->request->input('education_faculty')[$i];
                ResumeEducation::create([
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "level_id" => $this->request->input('education_level')[$i],
                    "name" => $this->request->input('education_name')[$i],
                    "speciality" => $education_speciality,
                    "faculty" => $faculty,
                    "finish_year" => $this->request->input('education_year_end')[$i]
                ]);
            }
        }
        if (isset($this->post_data['add_education_array'])) {
            for ($i = 0; $i < count($this->request->input('add_education_name')); $i++) {
                $add_education_specialization = null;
                if (isset($this->request->input('add_education_specialization')[$i]))
                    $add_education_specialization = $this->request->input('add_education_specialization')[$i];
                ResumeAdditionalEducation::create([
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "name" => $this->request->input('add_education_name')[$i],
                    "organization" => $this->request->input('add_education_org')[$i],
                    "speciality" => $add_education_specialization,
                    "finish_year" => $this->request->input('add_education_year_end')[$i]
                ]);
            }
        }
        if (isset($this->post_data['languages_array'])) {
            $lang = $this->request->input('languages');
            $lang_lvl = $this->request->input('language_level');
            for ($i = 0; $i < count($lang); $i++) {
                ResumeLanguages::create([
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "lang_id"    => $lang[$i],
                    "lang_level" => $lang_lvl[$i]
                ]);
            }
        }
        if (isset($this->post_data['drive_license_array'])) {
            foreach ($this->request->input('driver_license') as $_dlicence) {
                ResumeDrivingCategory::create([
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "category"    => $_dlicence
                ]);
            }
        }
        if (isset($this->post_data['portfolio_ids'])) {
            ResumePortfolio::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "portfolio_id"    => $this->request->input('portfolio_id')
            ]);
        }
        return $resume_id;
    }

    public function duplicate($id)
    {
        $this->edit_id = $id;
        $resume = Resume::where('id', $id)->where('account_id', auth()->id())->where('deleted', 0);
        if (!$resume->first()) {
            return $this->error('Not found', 'error', 404);
        }

        $resume = $resume->first();

        $new_resume['account_id'] = auth()->id();
        $new_resume['city_id'] = $resume['city_id'];
        $new_resume['job_title'] = $resume['job_title'];
        $new_resume['category_specialization'] = $resume['category_specialization'];
        $new_resume['avatar'] = $resume['avatar'];
        $new_resume['video_resume_url'] = $resume['video_resume_url'];
        $new_resume['metro_id'] = $resume['metro_id'];
        $new_resume['salary'] = $resume['salary'];
        $new_resume['currency'] = $resume['currency'];
        $new_resume['relocation'] = $resume['relocation'];
        $new_resume['work_experience'] = $resume['relocation'];
        $new_resume['text_work_experience'] = $resume['text_work_experience'];
        $new_resume['have_car'] = $resume['have_car'];
        $new_resume['about'] = $resume['about'];

        $new_resume['active'] = 0;
        $new_resume['moderation'] = 0;
        $new_resume['is_draft'] = 1;

        $resume_id = Resume::create($new_resume)->id;
        //$resume_id = $this->edit_id;


        foreach (ResumeCitizenship::where("resume_id", $this->edit_id)->get() as $ship) {
            ResumeCitizenship::create(
                [
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "country_id" => $ship['country_id']
                ]
            );
        }
        foreach (ResumeSkills::where("resume_id", $this->edit_id)->get() as $ship) {
            ResumeSkills::create(
                [
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "skill" => $ship['skill']
                ]
            );
        }
        foreach (ResumeWorkPermit::where("resume_id", $this->edit_id)->get() as $ship) {
            ResumeWorkPermit::create(
                [
                    "account_id" => auth()->id(),
                    "resume_id"  => $resume_id,
                    "country_id" => $ship['country_id']
                ]
            );
        }
        foreach (ResumeSpecialization::where("resume_id", $this->edit_id)->get() as $specializ) {
            ResumeSpecialization::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "cpec_id"    => $specializ['cpec_id']
            ]);
        }
        foreach (ResumeWorkFormatValue::where("resume_id", $this->edit_id)->get() as $format) {
            ResumeWorkFormatValue::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "work_format_id"    => $format['work_format_id']
            ]);
        }
        foreach (ResumeBusynessValue::where("resume_id", $this->edit_id)->get() as $eml) {
            ResumeBusynessValue::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "busy_id"    => $eml['busy_id']
            ]);
        }
        foreach (ResumeScheduleValue::where("resume_id", $this->edit_id)->get() as $eml) {
            ResumeScheduleValue::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "schedule_id"    => $eml['schedule_id']
            ]);
        }
        foreach (ResumeBusinessTripsValues::where("resume_id", $this->edit_id)->get() as $eml) {
            ResumeBusinessTripsValues::create([
                "account_id" => auth()->id(),
                "resume_id" => $resume_id,
                "bt_id" => $eml['bt_id']
            ]);
        }
        foreach (ResumeMovingValues::where("resume_id", $this->edit_id)->get() as $ship) {
            ResumeMovingValues::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "city_id"    => $ship['city_id']
            ]);
        }
        foreach (ResumeWorkExperience::where("resume_id", $this->edit_id)->get() as $ship) {
            ResumeWorkExperience::create([
                "account_id" => auth()->id(),
                "resume_id" => $resume_id,
                "start_date" => $ship['start_date'],
                "end_date" => $ship['end_date'],
                "until_now" => $ship['until_now'],
                "company_name" => $ship['company_name'],
                "job_title" => $ship['job_title'],
                "responsibilities" => $ship['responsibilities'], //обязаности
                "achievements" => $ship['achievements'], //достижения
                "reasons_leaving" => $ship['reasons_leaving']
            ]);
        }
        foreach (ResumeEducation::where("resume_id", $this->edit_id)->get() as $ship) {
            ResumeEducation::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "level_id" => $ship['level_id'],
                "name" => $ship['name'],
                "speciality" => $ship['speciality'],
                "faculty" => $ship['faculty'],
                "finish_year" => $ship['finish_year']
            ]);
        }
        foreach (ResumeAdditionalEducation::where("resume_id", $this->edit_id)->get() as $ship) {
            ResumeAdditionalEducation::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "name" => $ship['name'],
                "organization" => $ship['organization'],
                "speciality" => $ship['speciality'],
                "finish_year" => $ship['finish_year']
            ]);
        }

        foreach (ResumeLanguages::where("resume_id", $this->edit_id)->get() as $ship) {
            ResumeLanguages::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "lang_id"    => $ship['lang_id'],
                "lang_level" => $ship['lang_level']
            ]);
        }
        foreach (ResumeDrivingCategory::where("resume_id", $this->edit_id)->get()  as $_dlicence) {
            ResumeDrivingCategory::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "category"    => $_dlicence['category']
            ]);
        }
        foreach (ResumePortfolio::where("resume_id", $this->edit_id)->get() as $portfolio) {
            ResumePortfolio::create([
                "account_id" => auth()->id(),
                "resume_id"  => $resume_id,
                "portfolio_id"    => $portfolio['portfolio_id']
            ]);
            break;
        }
        return $this->success([
                    'old_id' => $this->edit_id,
                    'new_id' => $resume_id
                ]);
    }

    public function defaultValues()
    {
        $values['currency'] = [
            "id" => 1,
            "name" => "RUB"
        ];
        $values['country'] = [
            "id" => 113,
            "name" => "Россия"
        ];
        $values['region'] = [
            "id" => 1,
            "name" => "Москва"
        ];
        return $this->success($values);
    }

    public function getEducations()
    {
        return $this->success(ResumeLevelEducation::all());
    }

    public function getDiverLicenses()
    {
        return $this->success(ResumeDriverLicenseLevel::all());
    }

    public function getSchedules()
    {
        return $this->success(ResumeSchedule::all());
    }

    public function getBusyness()
    {
        return $this->success(ResumeBusyness::all());
    }

    public function getBusinessTrips()
    {
        return $this->success(ResumeBusinessTrips::all());
    }

    public function getCurrency()
    {
        return $this->success(ResumeCurrency::all());
    }

    public function getSpecialties($param)
    {
        if ($param)
             $specs = Category::join('category_names', 'categories.category_names_id', '=', 'category_names.id')
                 ->select("categories.*", "category_names.name")
                 ->where('categories.parent_id', $param)->get();
        else
            $specs = Category::join('category_names', 'categories.category_names_id', '=', 'category_names.id')
                ->join('section_for_categories', 'categories.section_for_categories_id', '=', 'section_for_categories.id')
                ->select('categories.parent_id', 'categories.img', 'category_names.name', 'category_names.id', 'section_for_categories.title')
                ->whereNull('categories.parent_id')
                ->where('section_for_categories.title', "Я соискатель")
                ->get();
        return $this->success($specs);
    }

    public function getCountries($search)
    {
        if (mb_strlen($search)) {
            $search = str_replace('%','', $search);
            $search = str_replace('_','', $search);
            $search = str_replace('\\','', $search);
            return Country::where('name', 'like', '%' . $search . '%')->get();
        }
        return $this->success(Country::all());
    }

    public function getWorkFormats()
    {
        $all = ResumeWorkFormats::all();
        return $this->success($all);
    }

}
