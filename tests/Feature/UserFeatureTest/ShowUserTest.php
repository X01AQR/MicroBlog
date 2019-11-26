<?php


namespace tests\Feature\UserFeatureTest;


use Laravel\Lumen\Testing\DatabaseMigrations;
use App\User;

class ShowUserTest extends \TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testStringInput()
    {
       $this->get('/api/users/string')->assertResponseStatus(404);
    }

    public function testNonIntegerInput()
    {
        $this->get('/api/users/23.4')->assertResponseStatus(404);
    }

    public function testNegativeIntegerInput()
    {
        $this->get('/api/users/-4')->assertResponseStatus(404);
    }

    public function testUserNotFound()
    {
        $user = factory(User::class)->create();
        $userId = $user->id;

        $user->delete();

        $this->get('/api/users/' . $userId)->assertResponseStatus(404);
    }

    public function testUserFound()
    {
        $user = factory(User::class)->create();

        $this->get('/api/users/' . $user->id)->assertResponseStatus(200);
    }

}
