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

    public function testUserIdInvalid()
    {
        $this->get('/api/users/string')->assertResponseStatus(404);
    }

    public function testUserNotFound()
    {
        $this->get('/api/users/10')->assertResponseStatus(404);
    }

    public function testUserFound()
    {
        $user = factory(User::class)->create();

        $this->get('/api/users/' . $user->id)->assertResponseStatus(200);
    }

}
