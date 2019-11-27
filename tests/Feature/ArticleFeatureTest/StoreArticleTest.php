<?php


namespace tests\Feature\ArticleFeatureTest;


use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Article;
use App\User;

class StoreArticleTest extends \TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testAddArticleToNotExistUser()
    {
        $user = factory(User::class)->create();
        $userId = $user->id;
        $user->delete();
        $attributes = [
            'user_id' => $userId,
            'title' => 'Article Title',
            'body'  => 'Article Body Article Body Article Body '
        ];

        $this->post('/api/articles/store', $attributes)->assertResponseStatus(422);

    }

    public function testRequestWithoutTitle()
    {
        $user = factory(User::class)->create();
        $userId = $user->id;
        $attributes = [
            'user_id' => $userId,
            'body'  => 'Article Body Article Body Article Body '
        ];

        $this->post('/api/articles/store', $attributes)->assertResponseStatus(422);
    }

    public function testRequestWithoutBody()
    {
        $user = factory(User::class)->create();
        $userId = $user->id;
        $attributes = [
            'user_id' => $userId,
            'title' => 'Article Title',
        ];

        $this->post('/api/articles/store', $attributes)->assertResponseStatus(422);
    }

    public function testSuccessfullyAddArticle()
    {
        $user = factory(User::class)->create();
        $userId = $user->id;
        $attributes = [
            'user_id' => $userId,
            'title' => 'Article Title',
            'body'  => 'Article Body Article Body Article Body '
        ];

        $this->post('/api/articles/store', $attributes)->assertResponseStatus(201);
    }

}
