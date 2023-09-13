<?php

namespace App\Services\Api\VideoCall;

use App\Repositories\Api\VideoCall\VideoCallRepositoryInterface;
use App\Services\Api\Account\AccountService;
use App\Traits\HttpResponse;
use Exception;

class VideoCallService
{
    use HttpResponse;

    private AccountService $accountService;
    private VideoCallRepositoryInterface $videoCallRepository;

    private ?\DateTime $start_date = null;
    private ?\DateTime $end_date = null;

    /**
     * VideoCallService constructor.
     *
     * @param AccountService $accountService
     * @param VideoCallRepositoryInterface $videoCallRepository
     */
    public function __construct(AccountService $accountService, VideoCallRepositoryInterface $videoCallRepository)
    {
        $this->accountService = $accountService;
        $this->videoCallRepository = $videoCallRepository;
    }

    /**
     * Processes and formats the start and end dates.
     *
     * @param array $data Data containing the start and end dates.
     * @return array Formatted start and end dates.
     * @throws Exception If date data is missing or invalid.
     */
    private function processDates(array $data): array
    {
        if (!isset($data['start_date'], $data['end_date'])) {
            throw new Exception("Missing date data");
        }

        $startDateObj = \DateTime::createFromFormat('d-m-Y H:i', str_replace('.', '-', $data['start_date']));
        $endDateObj = \DateTime::createFromFormat('d-m-Y H:i', str_replace('.', '-', $data['end_date']));

        if (!$startDateObj || !$endDateObj) {
            throw new Exception("Invalid date format");
        }

        $this->start_date = $startDateObj;
        $this->end_date = $endDateObj;

        return [
            $startDateObj->format('Y-m-d H:i'),
            $endDateObj->format('Y-m-d H:i')
        ];
    }

    /**
     * Prepares data for video call creation.
     *
     * @param array $data Data to be prepared.
     * @return array Prepared data.
     */
    private function prepareData(array $data): array
    {
        $dates = $this->processDates($data);

        return [
            "name" => htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8'),
            "account_id" => $this->accountService->getAccountId(),
            "start_date" => $dates[0],
            "end_date" => $dates[1],
            "is_active" => 1,
            "is_delete" => 0,
            "url" => $this->createUrl(),
            "call_type" => (int)$data['call_type']
        ];
    }

    /**
     * Creates a video call.
     *
     * @param array $data Data for video call creation.
     * @return string URL for the created video call.
     */
    public function create_videocall(array $data)
    {
        if (!$data) {
            return $this->error("Invalid data");
        }

        $url = $this->createUrl();
        $prepareData = $this->prepareData($data);

        try {
            $this->videoCallRepository->create($prepareData);
        } catch (Exception $e) {
            return $this->error('Unknown Error');
        }

        return $url;
    }

    /**
     * Retrieves video calls by account ID.
     *
     * @return string Generated URL.
     */
    public function show()
    {
        $calls = $this->videoCallRepository->findByAccountId($this->accountService->getAccountId());
        return $this->success(['array' => $calls]);
    }

    /**
     * Removes a video call by its ID.
     *
     * @param int $id ID of the video call to be removed.
     */
    public function remove_call($id)
    {
        $call = $this->videoCallRepository->findByAccountIdAndId($this->accountService->getAccountId(), $id);

        if ($call) {
            $this->videoCallRepository->delete($call);
            return $this->success('delete');
        }

        return $this->error('Not found');
    }

    /**
     * Generates a unique URL for a video call.
     *
     */
    private function createUrl()
    {
        return "https://meet.at-work.pro/111videocall-" . md5(time() . mt_rand(0, 900000));
    }

    /**
     * Returns a generated URL for a video call.
     *
     * @return string Generated URL wrapped in an array.
     */
    public function returnUrl()
    {
        return $this->success($this->createUrl());
    }
}
