<?php

namespace App\Rules\Vacancies;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Owenoj\LaravelGetId3\GetId3;
use Illuminate\Http\UploadedFile;

class VideoRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value instanceof UploadedFile) {
            $fail('The video must be between 10 and 300 seconds in duration.');
        }

        $track = new GetId3($value->getPathname());
        if (isset($track->extractInfo()["playtime_seconds"]) &&
            $track->extractInfo()["playtime_seconds"] > 10 &&
            $track->extractInfo()["playtime_seconds"] < 300) {
        } else {
            $fail('The video must be between 10 and 300 seconds in duration.');
        }
    }
}
