<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthBoundaryTest extends TestCase
{
    use RefreshDatabase;

    // Login boundary tests (Unit Test)
    public function test_login_with_empty_credentials()
    {
        $response = $this->post(route('login'), [
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    //unit test
    public function test_login_with_maximum_email_length()
    {
        $email = str_repeat('a', 243) . '@example.com'; // Max length = 255
        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/flights');
        $this->assertAuthenticatedAs($user);
    }
    

    //unit test
    public function test_login_with_invalid_email_format()
    {
        $response = $this->post(route('login'), [
            'email' => 'invalidemail',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    // Register boundary tests unit test
    public function test_register_with_empty_fields()
    {
        $response = $this->post(route('register'), [
            'name' => '',
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }
    

    //unit test
    public function test_register_with_invalid_password_length()
    {
        $response = $this->post(route('register'), [
            'name' => 'Valid User',
            'email' => 'valid@example.com',
            'password' => 'short',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    //(Integration Testing)
    public function test_register_with_maximum_name_length()
    {
        $name = str_repeat('a', 255); // Max length = 255
        $response = $this->post(route('register'), [
            'name' => $name,
            'email' => 'valid@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', ['name' => $name]);
    }

    
}
