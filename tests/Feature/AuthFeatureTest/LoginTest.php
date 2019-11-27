<?php


namespace tests\Feature\AuthFeatureTest;


use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class LoginTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testLoginWithInvalidEmail()
    {
        $user = User::create([
           'full_name' => 'User name',
           'email' => 'test@email.com',
            'password' => app('hash')->make('password'),

        ]);
        $attributes = [
          'email' => 'invalid email',
          'password' => 'password'
        ];

        $this->post('/api/auth/login', $attributes)->assertResponseStatus(422);
    }

    public function testLoginWithoutPassword()
    {
        $user = User::create([
            'full_name' => 'User name',
            'email' => 'test@email.com',
            'password' => app('hash')->make('password'),

        ]);
        $attributes = [
            'email' => 'test@email.com',
            'password' => null
        ];

        $this->post('/api/auth/login', $attributes)->assertResponseStatus(422);
    }

    public function testLoginWithUnauthorizedData()
    {
        $user = User::create([
            'full_name' => 'User name',
            'email' => 'test@email.com',
            'password' => app('hash')->make('password'),

        ]);
        $attributes = [
            'email' => 'test@email.com',
            'password' => 'anotherPassword'
        ];

        $this->post('/api/auth/login', $attributes)->assertResponseStatus(401);
    }

    public function testLoginWithAuthorizedData()
    {
        $user = User::create([
            'full_name' => 'User name',
            'email' => 'test@email.com',
            'password' => app('hash')->make('password'),

        ]);

        $attributes = [
            'email' => 'test@email.com',
            'password' => 'password',
        ];

        $this->post('/api/auth/login', $attributes)->assertResponseStatus(201);
    }
}

