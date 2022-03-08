<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
    function list(Request $request)
    {
        $cities = City::with(['State'])->paginate($request->query('paginate', 10));

        Http::post(env('LOG_API_URL', 'http://localhost:3333/api' . '/logs'), ['function' => 'list cities'])->json();

        return $cities;
    }

    function create(Request $request, $state_id)
    {
        $state = State::find($state_id);

        if (!$state) return response()->json(['error' => 'state not found'], 404);

        $city = City::where('name', $request->name)->where('state_id', $state_id)->first();

        if ($city) return response()->json(['error' => 'city already exists'], 409);

        $city = City::create(['name' => $request->name, 'state_id' => $state_id]);

        Http::post(env('LOG_API_URL', 'http://localhost:3333/api' . '/logs'), ['function' => 'create city'])->json();

        return response()->json($city);
    }

    function update(Request $request, $city_id)
    {
        $city = City::find($city_id);

        if (!$city) return response()->json(['error' => 'city not found'], 404);

        $city->update(['name' => $request->name]);

        Http::post(env('LOG_API_URL', 'http://localhost:3333/api' . '/logs'), ['function' => 'update city'])->json();

        return response()->json($city);
    }

    function city_exists(Request $request)
    {
        $city = City::with(['State'])->where('name', $request->name)->first();

        // Verifica se o estado da cidade encontrada é o mesmo que o usuário passou no body.

        if ($city)
            $city = $city->state->name == $request->state ? $city : null;

        Http::post(env('LOG_API_URL', 'http://localhost:3333/api' . '/logs'), ['function' => 'verify city'])->json();

        return response()->json(['exists' => !is_null($city)]);
    }
}
