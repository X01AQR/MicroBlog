<?php


namespace tests\Feature\ArticleFeatureTest;


use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Article;

class DeleteArticleTest extends \TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testIfArticleNotFound()
    {
        $user = factory(User::class)->create();
        $article = Article::create([
           'user_id' => $user->id,
           'title' => 'Article title',
           'body' => 'Article Body'
        ]);

        $articleId = $article->id;
        $article->delete();

        $this->delete('/api/articles/' . $articleId . '/delete')->assertResponseStatus(404);
    }

    public function testSuccessfulDeleting()
    {
        $user = factory(User::class)->create();
        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article Body'
        ]);

        $this->json('delete', '/api/articles/' . $article->id . '/delete')->assertResponseStatus(201);
    }
}
