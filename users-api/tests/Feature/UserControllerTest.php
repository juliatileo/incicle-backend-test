<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_should_be_able_to_create_an_user()
    {
        Http::fake([
            env('CITY_API_URL', 'http://localhost:8080/api') . '/*' => Http::response(['exists' => true], 200),
            env('LOG_API_URL', 'http://localhost:3333/api') . '/*' => Http::response([], 200)
        ]);

        $response = $this->post('/api/users', [
            'name' => 'Leonardo',
            'cpf' => '99999999999',
            'state' => 'SP',
            'city' => 'Garça'
        ]);

        $response->assertStatus(200)->assertJson([
            'name' => 'Leonardo',
            'cpf' => '99999999999',
            'state' => 'SP',
            'city' => 'Garça'
        ]);
    }

    public function test_should_not_be_able_to_create_an_user_if_city_does_not_exists()
    {
        Http::fake([
            env('CITY_API_URL', 'http://localhost:8080/api') . '/*' => Http::response(['exists' => false], 200)
        ]);

        $response = $this->post('/api/users', [
            'name' => 'Leonardo',
            'cpf' => '999.999.999-99',
            'state' => 'SP',
            'city' => 'Garça'
        ]);

        $response->assertStatus(404)->assertExactJson(['error' => 'city does not exists']);
    }
}
