<?php

namespace App\Services\Api\RecommendationLetter;

use Illuminate\Http\Request;

interface RecommendationLetterServiceInterface
{
    public function createRecommendationLetter(array $data);

    public function editRecommendationLetter(int $id, array $data);

    public function getRecommendationLetters();

    public function getRecommendationLetter(int $id): array;

    public function removeRecommendationLetters(Request $request);
}
