<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\State;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_should_be_able_to_list_all_cities()
    {
        $response = $this->get('/api/cities');

        $response->assertStatus(200);
    }

    public function test_should_be_able_to_create_a_city()
    {
        $state = State::create(['name' => 'TEST']);

        $response = $this->post('/api/cities/' . $state->id, ['name' => 'Garça']);

        $response->assertStatus(200)->assertJson(['name' => 'Garça']);
    }

    public function test_should_not_be_able_to_create_a_city_if_state_does_not_exists()
    {
        $response = $this->post('/api/cities/0', ['name' => 'Garça']);

        $response->assertStatus(404)->assertExactJson(['error' => 'state not found']);;
    }

    public function test_should_not_be_able_to_create_a_city_if_city_already_exists()
    {
        $state = State::create(['name' => 'TEST']);

        City::create(['name' => 'Garça', 'state_id' => $state->id]);

        $response = $this->post('/api/cities/' . $state->id, ['name' => 'Garça']);

        $response->assertStatus(409)->assertExactJson(['error' => 'city already exists']);
    }

    public function test_should_be_able_to_update_city()
    {
        $state = State::create(['name' => 'TEST']);

        $city = City::create(['name' => 'Garça', 'state_id' => $state->id]);

        $response = $this->put('/api/cities/' . $city->id, ['name' => 'Marília']);

        $response->assertStatus(200)->assertJson(['name' => 'Marília']);
    }

    public function test_should_not_be_able_to_update_a_city_if_does_not_exists()
    {
        $response = $this->put('/api/cities/0', ['name' => 'Garça']);

        $response->assertStatus(404)->assertExactJson(['error' => 'city not found']);
    }

    public function test_should_be_able_to_verify_and_return_true_if_a_city_exists()
    {
        $state = State::create(['name' => 'TEST']);

        $city = City::create(['name' => 'Garça', 'state_id' => $state->id]);

        $response = $this->post('api/cities/verify', ['name' => $city->name, 'state' => $state->name]);

        $response->assertStatus(200)->assertJson(['exists' => true]);
    }

    public function test_should_be_able_to_verify_and_return_false_if_a_city_does_not_exists()
    {
        $response = $this->post('api/cities/verify', ['name' => 'Garça']);

        $response->assertStatus(200)->assertJson(['exists' => false]);
    }
}
