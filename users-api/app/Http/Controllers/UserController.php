<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    function create(Request $request)
    {
        // Verificação da cidade e estado na API de cidades.

        $city = Http::post(env('CITY_API_URL', 'http://localhost:8080/api') . '/cities/verify', [
            'state' => $request->state,
            'name' => $request->city
        ])->json();

        if (!$city['exists']) return response()->json(['error' => 'city does not exists'], 404);

        $user = User::create([
            'name' => $request->name,
            'cpf' => $request->cpf,
            'state' => $request->state,
            'city' => $request->city
        ]);

        // Criando log na API de logs.

        Http::post(env('LOG_API_URL', 'http://localhost:3333/api' . '/logs'), ['function' => 'create users'])->json();

        return response()->json($user);
    }
}
