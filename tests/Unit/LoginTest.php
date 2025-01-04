<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful login.
     */
    public function test_user_can_login_successfully()
    {
        // Arrange: Create a user
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
        ]);

        // Act: Attempt to login
        $response = $this->post('/login', [
            'email' => 'testuser@example.com',
            'password' => 'password', // Matches the default factory password
        ]);

        // Assert: Ensure the user is authenticated
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test login failure with incorrect credentials.
     */
    public function test_user_cannot_login_with_invalid_credentials()
    {
        // Arrange: Create a user
        User::factory()->create([
            'email' => 'testuser@example.com',
        ]);

        // Act: Attempt to login with invalid credentials
        $response = $this->post('/login', [
            'email' => 'testuser@example.com',
            'password' => 'wrongpassword',
        ]);

        // Assert: Ensure the user is not authenticated
        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }
}
