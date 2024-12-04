<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    //unit test
    public function test_can_access_login_page()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }


    public function test_can_access_register_page()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    //integration test
    public function test_can_logout_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('logout'));

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
