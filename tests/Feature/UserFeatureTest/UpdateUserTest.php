<?php


namespace tests\Feature\UserFeatureTest;


use Laravel\Lumen\Testing\DatabaseMigrations;
use App\User;

class UpdateUserTest extends \TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testIfFullNameInputNumber()
    {
        $user = factory(User::class)->create();

        $attributes = [
            'full_name' => 123,
            'email'     => 'test@gmail.com',
        ];

        $this->patch('/api/users/' . $user->id . ' /update', $attributes)->assertResponseStatus(422);
    }

    public function testIfFullNameInputEmpty()
    {
        $user = factory(User::class)->create();

        $attributes = [
            'full_name' => null,
            'email'     => 'test@gmail.com',
        ];

        $this->patch('/api/users/' . $user->id . '/update', $attributes)->assertResponseStatus(422);
    }

    public function testIfEmailInputEmpty()
    {
        $user = factory(User::class)->create();

        $attributes = [
            'full_name' => 'Test name',
            'email'     => null,
        ];

        $this->patch('/api/users/' . $user->id . '/update', $attributes)->assertResponseStatus(422);
    }

    public function testIfEmailInputNotEmailAddress()
    {
        $user = factory(User::class)->create();

        $attributes = [
            'full_name' => 'Test name',
            'email'     => 'Some text',
        ];

        $this->patch('/api/users/' . $user->id . '/update', $attributes)->assertResponseStatus(422);
    }

    public function testIfRequestNull()
    {
        $user = factory(User::class)->create();

        $this->patch('/api/users/' . $user->id . '/update', [])->assertResponseStatus(422);
    }

    public function testIfUserNotFound()
    {
        $user = factory(User::class)->create();
        $userId = $user->id;
        $user->delete();

        $attributes = [
            'full_name' => 'Some text',
            'email'     => 'test@gmail.com',
            'password'  => 'new password'
        ];

        $this->patch('/api/users/' . $userId .'/update', $attributes)->assertResponseStatus(404);
    }

    public function testUpdateExistUserWithValidAttributes()
    {
        $user = factory(User::class)->create();

        $attributes = [
            'full_name' => 'Test Name',
            'email'     => 'test@gmail.com',
            'password'  => 'new password'
        ];

        $this->patch('/api/users/' . $user->id . '/update', $attributes)->assertResponseStatus(201);
    }


}
