<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LogControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_should_be_abre_to_create_a_log()
    {
        $response = $this->post('/api/logs', ['function' => 'test']);

        $response->assertStatus(200)->assertJson(['function' => 'test']);
    }
}
