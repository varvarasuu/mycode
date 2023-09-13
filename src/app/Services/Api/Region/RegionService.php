<?php

namespace App\Services\Api\Region;

use App\Traits\HttpResponse;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionService
{
    use HttpResponse;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get_region()
    {
        $location = $this->get_location();
        if ($location['location'] != null) {
            $location = $location['location']['data'];
            if ($location['country'] != 'Россия') {
                $region = Region::where('name', 'Санкт-Петербург')->first();
            } else {
                $region = Region::where('name', $location['city'])->first();

                if (!$region) {
                    $region = Region::where('name', 'Санкт-Петербург')->first();
                }
            }
        } else {
            $region = Region::where('name', 'Санкт-Петербург')->first();
        }
        
        return response()->json($region);
        
    }

    public function get_principal_cities()
    {
        $regions = Region::where("parent_id", null)
            ->where('country_id', 113)
            ->get();
        return $this->success($regions);
    }

    public function get_location()
    {
        $token = "fe67ca89495827624aa08fa6ee0967a5fd4e5639";
        // $ip = '';
        // if (empty($_SERVER['REMOTE_ADDR']) && empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        //     $ip = '62.16.112.219';
        // else
        $ip = $_SERVER['REMOTE_ADDR'] ? $_SERVER['REMOTE_ADDR'] : $_SERVER['HTTP_X_FORWARDED_FOR'];

        $options = array(
            CURLOPT_URL => "https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/address?ip=" . $ip,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Accept: application/json",
                "Authorization: Token " . $token
            )
        );

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public function search_regions()
    {
        $regions = Region::where('name', 'like', '%' . $this->request->query('name') . '%')->get();
        return $this->success($regions);
    }

    public function show($id)
    {
        $city = Region::find($id, ['id', 'name']);

        if (!$city) {
            return $this->error('City Not Found', 'error', 404);
        }

        return response()->json(['city' => $city]);
    }
}
