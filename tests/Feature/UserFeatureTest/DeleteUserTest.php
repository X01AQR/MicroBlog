<?php


namespace tests\Feature\UserFeatureTest;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class DeleteUserTest extends \TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testIfUserNotFound()
    {
        $user = factory(User::class)->create();
        $userId = $user->id;
        $user->delete();

        $this->delete('/api/users/' . $userId . '/delete')->assertResponseStatus(404);
    }

    public function testSuccessfulDeleting()
    {
        $user = factory(User::class)->create();

        $this->json('delete', '/api/users/' . $user->id . '/delete')->assertResponseStatus(201);
    }

}
