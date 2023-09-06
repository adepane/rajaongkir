<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class RajaOnkirController extends Controller
{

    public function getProvinces(Request $request)
    {
        $provinceId = $request->id;

        $province = Province::when(!empty($provinceId), function ($q) use ($provinceId) {
            $q->where('province_id', $provinceId);
        })
            ->orderByRaw('CONVERT(province_id, SIGNED) ASC')
            ->get();

        $res = [
            'rajaongkir' => [
                'query' => !empty($provinceId) ? ['id' => $provinceId] : (object) [],
                'status' => [
                    'code' => 200,
                    'description' => 'OK',
                ],
                'results' => !empty($provinceId) ? $province->first() : $province,
            ],
        ];

        return response()->json($res);
    }

    

    public function getCities(Request $request)
    {
        $cityId = $request->id;

        $city = City::when(!empty($cityId), function ($q) use ($cityId) {
            $q->where('city_id', $cityId);
        })
            ->orderByRaw('CONVERT(city_id, SIGNED) ASC')
            ->get();

        $res = [
            'rajaongkir' => [
                'query' => !empty($cityId) ? ['id' => $cityId] : (object) [],
                'status' => [
                    'code' => 200,
                    'description' => 'OK',
                ],
                'results' => !empty($cityId) ? $city->first() : $city,
            ],
        ];

        return response()->json($res);
    }

}
