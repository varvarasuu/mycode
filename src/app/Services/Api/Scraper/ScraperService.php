<?php

namespace App\Services\Api\Scraper;
use Carbon\Carbon;
use Goutte\Client;
use App\Models\Country;
use App\Models\Languages;
use App\Models\Region;
use App\Models\Metro;
use App\Models\ResumeLanguageLevel;
use App\Services\Api\Account\AccountService;
use Symfony\Component\HttpClient\HttpClient;

class ScraperService implements ScraperServiceInterface
{
    private $account_service;

    public function __construct(AccountService $account_service)
    {
        $this->account_service = $account_service;
    }
    public function index($request)
    {

        $httpClient = HttpClient::create();
        $goutteClient = new Client($httpClient);
        $crawler = $goutteClient->request('GET', $request->link);

        $full_name = $crawler->filter('[data-qa="resume-personal-name"]')->count() > 0  ? $crawler->filter('[data-qa="resume-personal-name"]')->text() : null;
        $gender = $crawler->filter('[data-qa="resume-personal-gender"]')->count() > 0  ? $crawler->filter('[data-qa="resume-personal-gender"]')->text() : null;
        $age = $crawler->filter('[data-qa="resume-personal-age"]')->count() > 0  ? $crawler->filter('[data-qa="resume-personal-age"]')->text() : null;
        $birthday = $crawler->filter('[data-qa="resume-personal-birthday"]')->count() > 0  ? $crawler->filter('[data-qa="resume-personal-birthday"]')->text() : null;
        //$birthday = $birthday ? $this->prepareBirthday($birthday) : null;
        $phone_number = $crawler->filter('[data-qa="resume-contacts-phone"]')->count() > 0  ? $crawler->filter('[data-qa="resume-contacts-phone"]')->text() : null;
        $phone_number = $phone_number ? $this->preparePhone($phone_number) : null;
        $email = $crawler->filter('[data-qa="resume-contact-email"]')->count() > 0  ? $crawler->filter('[data-qa="resume-contact-email"]')->text() : null;
        $email = $email ? $this->prepareEmail($email) : null;

        $city = $crawler->filter('[data-qa="resume-personal-address"]')->count() > 0  ? $crawler->filter('[data-qa="resume-personal-address"]')->text() : null;
        $city = $city ? $this->prepareCity($city) : null;


        $divElement = $crawler->filter('span[data-qa="resume-personal-address"]')->count() > 0  ? $crawler->filter('span[data-qa="resume-personal-address"]')->first() : null;
        $parentElement = $divElement ? $divElement->getNode(0)->parentNode : null;
        $parentText = $parentElement ? trim($parentElement->textContent) : null;
        $parentText = $parentText ? $this->prepareRelocatioAndTravell($parentText) : null;
        if(!empty($parentText)){
            if(isset($parentText[3])){
                $metro = $parentText[1];
                $relocation = $parentText[2];
                $travell = $parentText[3];
            } else {
                $metro = null;
                $relocation = $parentText[1];
                $travell = $parentText[2];
            }
        } else {
                $metro = null;
                $relocation = null;
                $travell = null;
        }
        if(!empty($metro) && !empty($city))
        {
            $metro = $this->prepareMetro($city[0], $metro);
        }
        if(!empty($travell)){
            $travell = $this->prepareTrip($travell);
        }
        if(!empty($relocation)) {
            $relocation = $this->prepareRelocation($relocation);
        }

        $imageElement = $crawler->filter('div[data-qa="resume-photo"] img');
        $avatar = $imageElement->count() > 0 ? $imageElement->attr('src') : null;
        $position = $crawler->filter('[data-qa="resume-block-title-position"]')->count() > 0 ? $crawler->filter('[data-qa="resume-block-title-position"]')->text() : null;
        $specializationElements = $crawler->filter('li[data-qa="resume-block-position-specialization"]');
        if($specializationElements->count() > 0) {
            $specializations = $this->getArrayFromList($specializationElements);
        }
        
        
        $before_employment = $crawler->filter('span[data-qa="resume-block-specialization-category"]');
        $parentElement2 = $before_employment->count() > 0 ? $before_employment->getNode(0)->parentNode->parentNode : null;
        $parentTextEmployment = $parentElement2 ? $parentElement2->getElementsByTagName('p')->item(0) : null;
        $employment = $parentTextEmployment ? trim($parentTextEmployment->textContent) : null;
        $employment = $employment ? $this->prepareBusyness($employment) : null;
        $parent_schedule = $parentElement2 ? $parentElement2->getElementsByTagName('p')->item(1) : null;
        $schedule = $parent_schedule ? trim($parent_schedule->textContent) : null;
        $schedule = $schedule ? $this->prepareSchedule($schedule) : null;

        $work_expirience = $crawler->filter('[data-qa="resume-block-experience"]');
        $work_time_element = $crawler->filter('[data-qa="resume-block-experience"] .bloko-column_l-2');
        $work_time = [];
        if($work_time_element->count() > 0){
            $work_time_element->each(function ($element) use (&$work_time) {
                $work_time[] =  trim($element->text());
            });
            $work_time = $this->prepareWorkTime($work_time);
        }
        

        $company_element = $crawler->filter('[data-qa="resume-block-experience"] .resume-block-item-gap .resume-block-item-gap .resume-block-container .bloko-text_strong');
        $companies = [];
        if($company_element->count() > 0){
            $company_element->each(function ($element) use (&$companies) {
                $companies[] =  trim($element->html());
            });
            $companies = $this->prepareJob($companies);
        }
        
        $position_element = $crawler->filter('[data-qa="resume-block-experience"] [data-qa="resume-block-experience-position"]');
        $position_exp = [];
        if($position_element->count() > 0){
            $position_element->each(function ($element) use (&$position_exp) {
                $position_exp[] =  trim($element->text());
            });
        }
        

        $position_description_element = $crawler->filter('[data-qa="resume-block-experience"] [data-qa="resume-block-experience-description"]');
        $position_description = [];
        if($position_description_element->count() > 0){
            $position_description_element->each(function ($element) use (&$position_description) {
                $position_description[] =  trim($element->text());
            });
        }
        

        $driving_lisence = ($crawler->filter('[data-qa="resume-block-driver-experience"]'))->count() > 0  ? $crawler->filter('[data-qa="resume-block-driver-experience"]')->text() : null;
        $driving_lisence = $driving_lisence ? $this->prepareDriving($driving_lisence) : null;

        $skills_elements = $crawler->filter('[data-qa="bloko-tag__text"]');
        $skills = [];
        //no 
        if($skills_elements->count() > 0){
            $skills_elements->each(function ($element) use (&$skills) {
                $shouldSkip = $element->filter('p[data-qa="resume-block-language-item"]')->count() > 0;
                if (!$shouldSkip) {
                $spanText = trim($element->filter('span')->text());
                $skills[] = $spanText;
            }
            });
        }
        

        //вуз школа
        $education_name_elements = $crawler->filter('[data-qa="resume-block-education"] [data-qa="resume-block-education-name"]');
        $education_organization = [];
        if($education_name_elements->count() > 0){
            $education_name_elements->each(function ($element) use (&$education_organization) {
                $education_organization[] =  trim($element->text());
            });
        }
        
        //название специальности
        $education_elements = $crawler->filter('[data-qa="resume-block-education"] [data-qa="resume-block-education-organization"]');
        $education_name = [];
        if($education_elements->count() > 0)
        {
            $education_elements->each(function ($element) use (&$education_name) {
                $education_name[] =  trim($element->text());
            });
        }
        

        //год оканчания
        $year_elements = $crawler->filter('[data-qa="resume-block-education"] .bloko-column_l-2');
        $year_edu = [];
        if($year_elements->count() > 0){
            $year_elements->each(function ($element) use (&$year_edu) {
                $year_edu[] =  trim($element->text());
            });
        }
        

        //вуз школа дополнительное
        $add_education_name_elements = $crawler->filter('[data-qa="resume-block-additional-education"] [data-qa="resume-block-education-name"]');
        $add_education_organization = [];
        if($add_education_name_elements->count() > 0)
        {
            $add_education_name_elements->each(function ($element) use (&$add_education_organization) {
            $add_education_organization[] =  trim($element->text());
        });

        }
        
        //название специальности дополнительное
        $add_education_elements = $crawler->filter('[data-qa="resume-block-additional-education"] [data-qa="resume-block-education-organization"]');
        $add_education_name = [];
        if($add_education_elements->count() > 0){
            $add_education_elements->each(function ($element) use (&$add_education_name) {
                $add_education_name[] =  trim($element->text());
            });
        }
        

        //год оканчания дополнительное
        $add_year_elements = $crawler->filter('[data-qa="resume-block-additional-education"] .bloko-column_l-2');
        $add_year_edu = [];
        if($add_year_elements->count() > 0){
            $add_year_elements->each(function ($element) use (&$add_year_edu) {
                $add_year_edu[] =  trim($element->text());
            });
        }
        
        
        $about_me = $crawler->filter('[data-qa="resume-block-skills-content"]')->count() > 0 ? $crawler->filter('[data-qa="resume-block-skills-content"]')->text() : null;

        $languages_elements = $crawler->filter('[data-qa="resume-block-language-item"]');
        $languages = [];
        if($languages_elements->count() > 0){
            $languages_elements->each(function ($element) use (&$languages) {
                $languages[] =  trim($element->text());
            });
            $languages = $this->prepareLang($languages);
        }
        

        $citizenship_element = $crawler->filter('[data-qa="resume-block-additional"]');
        $citizenship = $citizenship_element->count() > 0 ? $citizenship_element->getNode(0)->getElementsByTagName('p')->item(0) : null;
        $citizenship = $citizenship ? trim($citizenship->textContent) : null;
        $citizenship = $citizenship ? $this->prepareCitiz($citizenship) : null;
        $citizenship = $citizenship ? $this->prepareCountry($citizenship) : null;
        $work_premission = $citizenship_element->count() > 0 ? $citizenship_element->getNode(0)->getElementsByTagName('p')->item(1) : null;
        $work_premission = $work_premission ? trim($work_premission->textContent) : null;
        $work_premission = $work_premission ? $this->prepareCitiz($work_premission) : null;
        $work_premission = $work_premission ? $this->prepareCountry($work_premission) : null;
        $route = $citizenship_element->count() > 0 ? $citizenship_element->getNode(0)->getElementsByTagName('p')->item(2) : null;
        $route = $route ? trim($route->textContent) : null;
        $route = $route ? $this->prepareCitiz($route) : null;

        $salary = $crawler->filter('[data-qa="resume-block-salary"]')->count() > 0 ? $crawler->filter('[data-qa="resume-block-salary"]')->text() : null;
        $salary = $salary ? $this->prepareSalary($salary) : null;
        if(!empty($companies)){
            $work_expirience = $this->prepareWorkExpirience($work_time, $position_exp, $position_description, $companies);
        }
        if(!empty($education_name)){
            $educ = $this->prepareEdu($year_edu, $education_name, $education_organization);
        } else {
            $educ = null;
        }
        if(!empty($add_education_name)){
            $add_educ = $this->prepareAddEdu($add_year_edu, $add_education_name, $add_education_organization);
        } else {
            $add_educ = null;
        }
        // return [
        //     $full_name, $gender, $age, $birthday, $phone_number, $email, $city, $avatar, $position, $specializations, $relocation, $travell, $metro,
        //     $employment, $schedule, $skills,$education_name, $education_organization, $languages, $about_me, $citizenship, $work_premission, $route,
        //     $salary, $year_edu, $add_education_organization, $add_education_name, $add_year_edu, $position_exp, $position_description, $companies,
        //     $work_time, $driving_lisence, $work_expirience, $educ, $add_educ,

        // ];
        $account_id = $this->account_service->getAccountId();
        $account = $this->account_service->findById($account_id);
        $user = $this->account_service->responseInfo($account);
        return [
             "account_id" =>  $account_id ,
             "firstname" => $user["name"],
             "lastname" => $user["lastname"],
             "birthday" => $user["birthday"],
                     "power_up" => 0,
                     "city_id" => $city[0]  ?? null,
                     "relocation" => $relocation,
                     "text_work_experience" => "",
                     "have_car" => 0,
                     "about" => $about_me,
                     "video_resume_url" => null,
                     "avatar" => $avatar,
                     "job_title" => $position,
                     "salary" => $salary["salary"]  ?? null,
                     "city_name" => $city[1] ?? null,
                     "metro_id" => $metro[0]  ?? null,
                     "metro_name" => $metro[1]  ?? null,
                     "metro_line" => $metro[2]  ?? null,
                     "category_specialization_id" => null,
                     "category_specialization" =>  "",
                     "moderation" =>  0,
                     "active" =>  0,
                     "archived" =>  0,
                     "decline" =>  0,
                     "is_draft" =>  1,
                     "specializations" =>  [],
                     "currency" =>  $salary["currency"]  ?? null,
                     "currency_id" =>  $salary["currency_id"]  ?? null,
                     "citizenship"=> $citizenship,
                     "permit" => $work_premission,
                     "busyness" => $employment, 
                     "schedule" =>  $schedule,
                     "businessTrips" => [$travell],
                     "skills" => $skills,
                     "work_experience" => $work_expirience,
                     "education" => $educ, 
                     "addEducation" => $add_educ,
                     "languages" => $languages,
                     "drivingCategory" => [$driving_lisence],
        ];
    }

    public function getArrayFromList($list)
    {
        $result = [];
        $list->each(function ($element) use (&$result) {
                $result[] = trim($element->text());
            });

        return $result;
    }
    public function prepareBirthday($originalDate)
    {

        $monthMapping = [
            'января' => '01',
            'февраля' => '02',
            'марта' => '03',
            'апреля' => '04',
            'мая' => '05',
            'июня' => '06',
            'июля' => '07',
            'августа' => '08',
            'сентября' => '09',
            'октября' => '10',
            'ноября' => '11',
            'декабря' => '12',
        ];
        
        foreach ($monthMapping as $russianMonth => $numericMonth) {
            $originalDate = str_replace($russianMonth, $numericMonth, $originalDate);
        }
        $parsedDate = Carbon::createFromFormat('d m Y', $originalDate);
        $transformedDate = $parsedDate->format('Y.m.d');
        return $transformedDate;
    }

    public function preparePhone($originalPhoneNumber)
    {
        $cleanedPhoneNumber = preg_replace('/[^0-9+]/', '', $originalPhoneNumber);      
        return $cleanedPhoneNumber;
    }
    public function prepareEmail($email)
    {
        $em = explode(" — ", $email);
        return $em[0];
    }

    public function prepareRelocatioAndTravell($parentText)
    {
        $parentText = explode(", ", $parentText);
        return $parentText;
    }

    public function prepareLang($languages)
    {
        $result = [];
        foreach($languages as $lang)
        {
            $array =  explode(" — ", $lang);
            $result[] = ["language" => $array[0], "level" => $array[1]];
        }
        $result_2 = [];
        foreach($result as $lang){ 
            $lang_object = Languages::where("name", $lang["language"])->first();
            if(!empty($lang_object)){
                if($lang["level"] == "Родной"){
                    $lang["level"] = "native";
                }
                $level = ResumeLanguageLevel::where("level", $lang["level"])->first();
                
                $result_2[] = [
                    "lang_name_id" => $lang_object->id,
                    "lang_name" => $lang_object->name,
                    "lang_level_id" => $level ? $level->id : null,
                    "lang_level" => $level ? $level->level_name : null,
                ];
            }
        }

        return $result_2;

    }

    public function prepareCitiz($string)
    {
        $string = explode(": ", $string);
        return explode(", ", $string[1]);
    }

    public function prepareWorkTime($array)
    {
        $result = [];
        foreach($array as $string){
            $str = "Май 2019 — Июнь 20192 месяца";
            $string = explode(" — ", $string);
            $start = explode(" ", $string[0]);
            $months = [
                "Январь" => "01",
                "Февраль" => "02",
                "Март" => "03",
                "Апрель" => "04",
                "Май" => "05",
                "Июнь" => "06",
                "Июль" => "07",
                "Август" => "08",
                "Сентябрь" => "09",
                "Октябрь" => "10",
                "Ноябрь" => "11",
                "Декабрь" => "12"
            ];
            if (strpos($string[1], "время")){
                $endDate = null;
            } else {
                $end = explode(" ", $string[1]);
                $array_end = [ "month_end" => $end[0], "year_end" => substr($end[1], 0, 4)];
                $endMonth = $months[$array_end["month_end"]];
                $endDate = $array_end["year_end"] . '-' . $endMonth . '-01';
            }
            $array = ["month_start" => $start[0], "year_start" => $start[1]]; 
            $startMonth = $months[$array["month_start"]];
            $startDate = $array["year_start"] . '-' . $startMonth . '-01';
            
            
            $result[] = [
                "start" => $startDate,
                "end" => $endDate
            ];
        }
    return $result;
    }

    public function prepareDriving($string)
    {
        $string = explode("категории ", $string);
        
        $driving_hh = ["A", "B", "C", "D", "E", "BE", "CE", "DE", "TM", "TB"];
        $driving_us = ["A", "B", "C -", "D -", "E -", "BE -", "CE -", "DE -", "TM -", "TB -"];
        $index = array_search($string[1], $driving_hh);
        return ["id" => $index, "category" => $driving_us[$index]];

    }

    public function prepareJob($array)
    {
        $result = [];
        for ($i = 0; $i < count($array); $i++) 
        {
            if($i%2 == 0){
                $result[] = $array[$i];
            }
        }

        return $result;
    }

    public function prepareSalary($salary)
    {
        if(strpos($salary, "₽"))
        {
            $currency = "RUB";
            $currency_id = 1;
        } elseif(strpos($salary, "$"))
        {
            $currency = "USD";
            $currency_id = 2;
        } elseif(strpos($salary, "€"))
        {
            $currency = "EUR";
            $currency_id = 3;
        } else {
            $currency = null;
        }

        $salary = preg_replace('/[^0-9+]/', '', $salary); 
        return ["salary" => $salary, "currency" => $currency, "currency_id" => $currency_id];
    }
    public function getHH()
    {
        $gender = ["Мужской", "Женский"];
        $currency = ["₽", "$", "€"];
        $language_level = ["A1", "A2", "B1", "B2", "C1", "C2"];
        
        $schedule = ["Полный день", "Сменный график", "Гибкий график", "Удаленная работа", "Вахтовый метод"];
        
        
        

    }

    public function prepareCity($city)
    {
        $region = Region::where("name", $city)->first();
        if(!$region) {
            return null;
        }
        return [$region->id, $city];
    }

    public function prepareMetro($city_id, $metro)
    {
        $metro = explode("м. ", $metro);
        $metro = Metro::where('station_name', $metro[1])->where('city_id', $city_id)->first();            
        if(!empty($metro)){
            return [$metro->id, $metro->station_name, $metro->line_name];
        }
        return null;
    }

    public function prepareCountry($array)
    {
        $data = [];
            foreach ($array as $country) {
                $country_object = Country::where("name", $country)->first();
                if(!empty($country_object)){
                    $data[] = ["name" => $country_object->name, "id" => $country_object->id];
                }  
            }
        return $data; 
    }
    public function prepareTrip($travell)
    {
        $travell_fields = ["не готова к командировкам", "не готов к командировкам", 
        "готова к редким командировкам", "готов к редким командировкам",
        "готова к командировкам", "готов к командировкам"];
        $trip_fields = [["id" => 2, "name" => "Не готов(а)"], ["id" => 2, "name" => "Не готов(а)"],
         ["id" => 3, "name" => "Редко готов(а)"], ["id" =>3, "name" => "Редко готов(а)"], 
         ["id" => 1, "name" => "Готов(а)"], ["id" => 1, "name" => "Готов(а)"],];
        $result = null;
        for ($i = 0; $i < 6; $i++){
            if($travell == $travell_fields[$i]){
                $result = $trip_fields[$i];
            }
        }
        return $result;
    }

    public function prepareRelocation($relocation)
    {
        $result = 0;
        if($relocation == "не готов к переезду"){
            $result = 0;
        } else{
            $result = 1;
        }
        return $result;

    }

    public function prepareWorkExpirience($work_time, $position_exp, $position_description, $companies)
    {
        $result = [];
        for ($i = 0; $i < count($companies); $i++)
        {
            $result[] = [
                "start_date" => $work_time[$i]["start"] ?? null,
                "end_date" => $work_time[$i]["end"] ?? null,
                "until_now" => $work_time[$i]["end"] ? 0 : 1,
                "company_name" => $companies[$i] ?? null,
                "job_title" => $position_exp[$i] ?? null, 
                "responsibilities" => $position_description[$i],
                "achievements" => "",
                "reasons_leaving" => "",

            ];
        }

        return $result;
    }
    public function prepareEdu($year_edu, $education_name, $education_organization)
    {
        $result = [];
        for($i = 0; $i < count($education_name); $i++){
            $result[] = [
                "level_id" => null,
                "level" => null,
                "name" => $education_organization[$i] ?? null,
                "speciality" => $education_name[$i] ?? null, 
                "faculty" => "",
                "finish_year" => $year_edu[$i] ?? null,
            ];
        }

        return $result;
    }

    public function prepareAddEdu($year_edu, $education_name, $education_organization)
    {
        $result = [];
        for($i = 0; $i < count($education_name); $i++){
            $result[] = [
                "name" => $education_organization[$i] ?? null,
                "organization" => null,
                "speciality" => $education_name[$i] ?? null,
                "finish_year" => $year_edu[$i] ?? null,

            ];
        }

        return $result;
        
    }

    public function prepareBusyness($employment)
    {
        $employment = trim($employment);
        $employment = explode(": ", $employment);
        $employment = explode(", ", $employment[1]);
        
        $employment_fileds = ["полная занятость", "частичная занятость", "проектная работа", "волонтерство", "стажировка"];
        $busyness_fields = ["Полная занятость", "Частичная занятость", "Временная работа", "Волонтёрство", "Стажировка"];
        $result = [];
        foreach($employment as $empl)
        {
            $index = array_search($empl, $employment_fileds);
            if($index){
                $result[] = ["id" => $index, "name" => $busyness_fields[$index]];
            }  
        }

        return $result;
    }

    public function prepareSchedule($schedule)
    {
        $schedule = trim($schedule);
        $schedule = explode(": ", $schedule);
        $schedule = explode(", ", $schedule[1]);
        $schedule_filed_hh = ["полный день", "сменный график", "гибкий график", "вахтовый метод", "удаленная работа",];
        $schedule_us = ["Полный день", "Сменный график", "Гибкий график", "Вахтовый метод"];
        $result = [];
        foreach($schedule as $sched)
        {
            $index = array_search($sched, $schedule_filed_hh);
            if($index && $index < 4){
                $result[] = ["id" => $index, "name" => $schedule_us[$index]];
            }  
        }
        return $result;
    }

    
 
}