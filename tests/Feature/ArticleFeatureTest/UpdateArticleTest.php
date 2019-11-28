<?php


namespace tests\Feature\ArticleFeatureTest;


use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Article;
use App\User;
class UpdateArticleTest extends \TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }


    public function testIfRequestIsWithoutTitle()
    {
        $user = factory(User::class)->create();
        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article body'
        ]);

        $attributes = [
            'body' => 'Article body'
        ];

        $this->actingAs($user)->patch('/api/articles/' . $article->id . '/update', $attributes)->assertResponseStatus(422);
    }

    public function testIfRequestIsWithoutBody()
    {
        $user = factory(User::class)->create();
        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article body'
        ]);

        $attributes = [
            'title' => 'Article title',
        ];

        $this->actingAs($user)->patch('/api/articles/' . $article->id . '/update', $attributes)->assertResponseStatus(422);
    }

    public function testUpdatingNotExistArticle()
    {
        $user = factory(User::class)->create();

        $attributes = [
            'title' => 'new title',
            'body' => 'new body'
        ];

        $this->actingAs($user)->patch('/api/articles/5/update', $attributes)->assertResponseStatus(401);

    }

    public function testSuccessfullyUpdateArticle()
    {
        $user = factory(User::class)->create();

        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article body'
        ]);

        $attributes = [
            'title' => 'new title',
            'body' => 'new body'
        ];

        $this->actingAs($user)->patch('/api/articles/' . $article->id . '/update', $attributes)->assertResponseStatus(201);
    }

}
