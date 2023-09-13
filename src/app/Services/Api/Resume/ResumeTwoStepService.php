<?php

namespace App\Services\Api\Resume;

use App\Models\Category;
use App\Models\ResumeCurrency;
use Illuminate\Http\Request;

use App\Traits\HttpResponse;

use Exception;

class ResumeTwoStepService
{

    use HttpResponse;

    protected Request $request;

    function __construct()
    {
        $this->request = Request();
    }

    function check_currency_id()
    {
        if (!$this->request->input('currency_id'))
            return '1';
        $currency = ResumeCurrency::find($this->request->input('currency_id'));
        if(!$currency) {
            return false;
        }
        return $this->request->input('currency_id');
    }

    function check_title_category()
    {
        $title_category = Category::where('id', $this->request->input('title_category'))->where('parent_id', null)->first();
        if($title_category === null) {
            return false;
        }
        return true;
    }

    function check_specializations()
    {
        $spec_value = false;
        if(is_array($this->request->input('specialization'))) {
            $post_data = [];
            foreach ($this->request->input('specialization') as $specializ) {
                if (Category::where('id', $specializ)->where('parent_id', $this->request->input('title_category'))->first() === null ) {
                    return false;
                }
                $post_data[] = $specializ;
                $spec_value = true;
            }
            if ($spec_value !== true) {
                return false;
            }
            return $post_data;
        } return false;
    }

}