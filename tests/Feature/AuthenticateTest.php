<?php

namespace Tests\Feature;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Str;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_authenticate_with_correct_credentials(): void
    {
        $password = 'password';

        $user = User::factory()->create([
            'email_address' => 'email@gmail.com',
            'password' => Hash::make($password),
        ]);

        $response = $this->postJson('/api/authenticate', [
            'email_address' => $user->email_address,
            'password' => $password, // plain password
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Login successful',
            ]);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_failed_to_authenticate_with_wrong_credentials(): void
    {
        $password = 'password';

        $user = User::factory()->create([
            'email_address' => 'email@gmail.com',
            'password' => Hash::make($password),
        ]);

        $response = $this->postJson('/api/authenticate', [
            'email_address' => $user->email_address,
            'password' => "wrongpassword", // plain password
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);

        $this->assertGuest();
    }

    /** @test */
    public function user_failed_to_authenticate_with_empty_credentials(): void
    {
        $password = 'password';

        $user = User::factory()->create([
            'email_address' => 'email@gmail.com',
            'password' => Hash::make($password),
        ]);

        $response = $this->postJson('/api/authenticate', [
            'email_address' => $user->email_address,
            'password' => "", // plain password
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Validation failed',
                'errors' => "Please enter your password"
            ]);

        $this->assertGuest();
    }
}
