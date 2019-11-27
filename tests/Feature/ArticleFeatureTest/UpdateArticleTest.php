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

    public function testIfBodyNotString()
    {
        $user = factory(User::class)->create();

        $article = Article::create([
           'user_id' => $user->id,
           'title' => 'Article title',
           'body' => 'Article body'
        ]);

        $attributes = [
            'user_id' => $user->id,
            'title' => 'new title',
            'body' => 234
        ];

        $this->patch('/api/articles/' . $article->id . '/update', $attributes)->assertResponseStatus(422);
    }

    public function testIfTitleNotString()
    {
        $user = factory(User::class)->create();
        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article body'
        ]);

        $attributes = [
            'user_id' => $user->id,
            'title' => 4356,
            'body' => 'new body'
        ];

        $this->patch('/api/articles/' . $article->id . '/update', $attributes)->assertResponseStatus(422);
    }

    public function testIfRequestIsEmpty()
    {
        $user = factory(User::class)->create();
        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article body'
        ]);

        $attributes = [];

        $this->patch('/api/articles/' . $article->id . '/update', $attributes)->assertResponseStatus(422);
    }

    public function testUpdatingNotExistArticle()
    {
        $user = factory(User::class)->create();
        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article body'
        ]);
        $article->delete();

        $attributes = [
            'user_id' => $user->id,
            'title' => 'new title',
            'body' => 'new body'
        ];

        $this->patch('/api/articles/' . $article->id . '/update', $attributes)->assertResponseStatus(404);

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
            'user_id' => $user->id,
            'title' => 'new title',
            'body' => 'new body'
        ];

        $this->patch('/api/articles/' . $article->id . '/update', $attributes)->assertResponseStatus(201);
    }

}
