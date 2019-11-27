<?php


namespace tests\Feature\ArticleFeatureTest;


use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Article;
use App\User;

class GetUserArticlesTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testGetArticlesForNotExistUser()
    {
        $user = factory(User::class)->create();
        $userId = $user->id;
        $user->delete();

        $this->get('/api/users/' . $userId .'/articles')->assertResponseStatus(404);
    }

    public function testUserHasNotArticles()
    {
        $user = factory(User::class)->create();

        $this->get('/api/users/' . $user->id .'/articles')->assertResponseStatus(404);
    }

    public function testInvalidUserId()
    {
        $this->get('/api/users/string/articles')->assertResponseStatus(404);
    }

    public function testUserHasArticles()
    {
        $user = factory(User::class)->create();
        Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body'  => 'Article body Article body Article body '
        ]);

        $this->get('/api/users/' . $user->id . ' /articles')->assertResponseStatus(200);
    }
}
