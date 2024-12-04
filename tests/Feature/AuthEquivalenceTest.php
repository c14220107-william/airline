<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthEquivalenceTest extends TestCase
{
    use RefreshDatabase;

    // Login tests

    //integration
    public function test_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'valid@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'valid@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/flights');
        $this->assertAuthenticatedAs($user);
    }


    //unit test
    public function test_login_with_invalid_email()
    {
        User::factory()->create([
            'email' => 'valid@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'invalid@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    //unit test
    public function test_login_with_invalid_password()
    {
        User::factory()->create([
            'email' => 'valid@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'valid@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    // Register tests

    //integration
    public function test_register_with_valid_data()
    {
        $response = $this->post(route('register'), [
            'name' => 'Valid User',
            'email' => 'valid@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', [
            'email' => 'valid@example.com',
            'role' => 'user',
        ]);
    }


    //unit test
    public function test_register_with_invalid_email()
    {
        $response = $this->post(route('register'), [
            'name' => 'Valid User',
            'email' => 'invalidemail',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    //unit test
    public function test_register_with_existing_email()
    {
        User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $response = $this->post(route('register'), [
            'name' => 'Valid User',
            'email' => 'existing@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}