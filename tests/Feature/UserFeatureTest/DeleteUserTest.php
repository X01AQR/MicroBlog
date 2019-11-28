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

    public function testDeleteAnotherUser()
    {
        $user = factory(User::class)->create();

        $this->delete('/api/users/' . $user->id . '/delete')->assertResponseStatus(401);
    }

    public function testSuccessfulDeleting()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->json('delete', '/api/users/' . $user->id . '/delete')->assertResponseStatus(201);
    }

}
