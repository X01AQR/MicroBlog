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

    public function testInvalidFullName()
    {
        $user = factory(User::class)->create();

        $attributes = [
            'full_name' => 123,
        ];

        $this->actingAs($user)->patch('/api/users/' . $user->id . ' /update', $attributes)->assertResponseStatus(422);
    }

    public function testIfFullNameInputEmpty()
    {
        $user = factory(User::class)->create();

        $attributes = [
            'full_name' => null,
        ];

        $this->actingAs($user)->patch('/api/users/' . $user->id . '/update', $attributes)->assertResponseStatus(422);
    }


    public function testUpdateAnotherUsername()
    {
        $attributes = [
            'full_name' => 'Some text',
        ];

        $this->patch('/api/users/5/update', $attributes)->assertResponseStatus(401);
    }

    public function testUpdateExistUserWithValidAttributes()
    {
        $user = factory(User::class)->create();

        $attributes = [
            'full_name' => 'Test Name',
        ];

        $this->actingAs($user)->patch('/api/users/' . $user->id . '/update', $attributes)->assertResponseStatus(201);
    }

}
