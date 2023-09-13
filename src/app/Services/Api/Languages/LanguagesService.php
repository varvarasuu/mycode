<?php

namespace App\Services\Api\Languages;

use App\Models\Languages;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;


use Exception;

class LanguagesService
{

    use HttpResponse;

    protected Request $request;

    function __construct()
    {
        $this->request = Request();
    }

    public function all()
    {
        $langs = Languages::all();
        $json = [];
        foreach ($langs as $ar) {
            $json[] = [
                    'id' => $ar['id'],
                    'lang_id' => $ar['lang_id'],
                    'lang' => $ar['name']
                ];
        }
        return $this->success($json);
    }
}
