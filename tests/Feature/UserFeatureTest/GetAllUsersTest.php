<?php


namespace tests\Feature\UserFeatureTest;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class GetAllUsersTest extends \TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        $this->runDatabaseMigrations();
    }

    public function testUsersNotNotFound()
    {
        $this->artisan('migrate:fresh');
        $this->get('/api/users')->assertResponseStatus(404);
    }


    public function testUsersFound()
    {
        $this->artisan('db:seed');

        $this->get('/api/users')->assertResponseStatus(200);
    }

}
