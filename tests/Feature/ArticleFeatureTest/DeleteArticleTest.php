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

    public function testAttemptToDeleteArticleWithoutAuthorize()
    {

        $this->delete('/api/articles/5/delete')->assertResponseStatus(401);
    }

    public function testSuccessfulDeleting()
    {
        $user = factory(User::class)->create();

        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article Body'
        ]);

        $this->actingAs($user)->json('delete', '/api/articles/' . $article->id . '/delete')->assertResponseStatus(201);
    }
}
