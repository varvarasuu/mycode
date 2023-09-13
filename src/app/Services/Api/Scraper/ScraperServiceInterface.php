<?php 

namespace App\Services\Api\Scraper;

interface ScraperServiceInterface
{
    public function index($request);
    public function prepareBirthday($originalDate);
    public function preparePhone($originalPhoneNumber);
    public function prepareRelocatioAndTravell($parentText);
    public function prepareLang($languages);
    public function prepareCitiz($string);
    public function prepareWorkTime($array);
    public function prepareDriving($string);
    public function prepareJob($array);
    public function prepareSalary($salary);
    public function prepareCity($city);
    public function prepareMetro($city_id, $metro);
    public function prepareCountry($array);
    public function prepareTrip($travell);
    public function prepareWorkExpirience($work_time, $position_exp, $position_description, $companies);
    public function prepareEdu($year_edu, $education_name, $education_organization);
    public function prepareAddEdu($year_edu, $education_name, $education_organization);
    public function prepareBusyness($employment);
    public function prepareSchedule($schedule);
    public function getHH();
    
}
