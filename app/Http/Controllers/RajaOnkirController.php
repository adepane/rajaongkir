<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOnkirController extends Controller
{
    public $swappable;

    public function __construct()
    {
        $this->swappable = config('services.rajaongkir.swappable');
    }

    public function getProvinces(Request $request)
    {
        $provinceId = $request->id;

        switch ($this->swappable) {
            case 'direct':
                $query = ! empty($provinceId) ? '?id='.$provinceId : '';

                return $this->fetchDirectProvince($query);

            default:
                return $this->fetchDbProvince($provinceId);
        }
    }

    private function fetchDirectProvince($query)
    {
        $headers = [
            'key' => config('services.rajaongkir.key'),
        ];
        $req = Http::withHeaders($headers)->get('https://api.rajaongkir.com/starter/province'.$query);
        $res = json_decode($req->getBody()->getContents());

        return $res;
    }

    private function fetchDbProvince($provinceId)
    {
        $province = Province::when(! empty($provinceId), function ($q) use ($provinceId) {
            $q->where('province_id', $provinceId);
        })
            ->orderByRaw('CONVERT(province_id, SIGNED) ASC')
            ->get();

        $res = [
            'rajaongkir' => [
                'query' => ! empty($provinceId) ? ['id' => $provinceId] : (object) [],
                'status' => [
                    'code' => 200,
                    'description' => 'OK',
                ],
                'results' => ! empty($provinceId) ? $province->first() : $province,
            ],
        ];

        return response()->json($res);
    }

    public function getCities(Request $request)
    {
        $cityId = $request->id;

        switch ($this->swappable) {
            case 'direct':
                $query = ! empty($cityId) ? '?id='.$cityId : '';

                return $this->fetchDirectCity($query);

            default:
                return $this->fetchDbCity($cityId);
        }
    }

    private function fetchDbCity($cityId)
    {
        $city = City::when(! empty($cityId), function ($q) use ($cityId) {
            $q->where('city_id', $cityId);
        })
            ->orderByRaw('CONVERT(city_id, SIGNED) ASC')
            ->get();

        $res = [
            'rajaongkir' => [
                'query' => ! empty($cityId) ? ['id' => $cityId] : (object) [],
                'status' => [
                    'code' => 200,
                    'description' => 'OK',
                ],
                'results' => ! empty($cityId) ? $city->first() : $city,
            ],
        ];

        return response()->json($res);
    }

    private function fetchDirectCity($query)
    {
        $req = Http::withHeaders([
            'key' => config('services.rajaongkir.key'),
        ])->get('https://api.rajaongkir.com/starter/city'.$query);
        $res = json_decode($req->getBody()->getContents());

        return $res;
    }
}
