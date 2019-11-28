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

    public function testAddArticleWithoutAuth()
    {
        $attributes = [
            'title' => 'Article Title',
            'body'  => 'Article Body Article Body Article Body '
        ];

        $this->post('/api/articles/store', $attributes)->assertResponseStatus(401);

    }

    public function testRequestWithoutTitle()
    {
        $user = factory(User::class)->create();
        $attributes = [
            'body'  => 'Article Body Article Body Article Body '
        ];

        $this->actingAs($user)->post('/api/articles/store', $attributes)->assertResponseStatus(422);
    }

    public function testRequestWithoutBody()
    {
        $user = factory(User::class)->create();
        $userId = $user->id;
        $attributes = [
            'title' => 'Article Title',
        ];

        $this->actingAs($user)->post('/api/articles/store', $attributes)->assertResponseStatus(422);
    }

    public function testSuccessfullyAddArticle()
    {
        $user = factory(User::class)->create();
        $attributes = [
            'title' => 'Article Title',
            'body'  => 'Article Body Article Body Article Body '
        ];

        $this->actingAs($user)->post('/api/articles/store', $attributes)->assertResponseStatus(201);
    }

}
