<?php

namespace App\Services\Api\UserSettings;

use App\Http\Requests\Settings\UpdatePrivacyRequest;
use App\Models\Privacy;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class PrivacyService
{
    use HttpResponse;

    public function index()
    {
        try {
            $privacies = Privacy::where('account_id', Auth::id())->get();

            $sections = [];

            foreach ($privacies as $privacy) {
                foreach ($privacy->sections as $privacySection) {
                    $sections[] = [
                        'id' => $privacy['id'],
                        'who_can_see_id' => $privacy['who_can_see_id'],
                        'title_in_privacy' => $privacySection['title_in_privacy'],
                        'title_all_privacy' => $privacySection['title_all_privacy'],
                        'title_only_me' => $privacySection['title_only_me'],
                    ];
                }
            }

            return $this->success($sections);
        } catch (Exception $exception) {
            $this->error('Unknown error');
        }
    }

    public function update(UpdatePrivacyRequest $request)
    {
        try {
            $privacies = $request->input('privacies');

            foreach ($privacies as $privacyData) {
                $id = $privacyData['id'];
                $who_can_see_id = $privacyData['who_can_see_id'];

                $privacy = Privacy::where('account_id', Auth::id())
                    ->where('id', $id)
                    ->first();

                if (!$privacy) {
                    return $this->error('Privacy Not Found', 'error', 404);
                }

                $privacy->who_can_see_id = $who_can_see_id;
                $privacy->save();
            }

            return $this->success($privacies);
        } catch (\Exception $exception) {
            return $this->error('Unknown error');
        }
    }
}
