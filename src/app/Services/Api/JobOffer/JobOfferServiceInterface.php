<?php

namespace App\Services\Api\JobOffer;

interface JobOfferServiceInterface
{
    public function createJobOffer(array $request): array;
    public function updateJobOffer(array $request);
}
