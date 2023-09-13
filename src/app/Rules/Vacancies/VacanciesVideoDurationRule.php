<?php

namespace App\Rules\Vacancies;

use Closure;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Owenoj\LaravelGetId3\GetId3;

class VacanciesVideoDurationRule implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        if (!$value instanceof UploadedFile) {
            return false;
        }

        $track = new GetId3($value->getPathname());
        if (isset($track->extractInfo()["playtime_seconds"]) &&
            $track->extractInfo()["playtime_seconds"] > 10 &&
            $track->extractInfo()["playtime_seconds"] < 300) {
            return true;
        } else {
            return false;
        }
    }

    public function message()
    {
        return 'The video must be between 10 and 300 seconds in duration.';
    }
}
