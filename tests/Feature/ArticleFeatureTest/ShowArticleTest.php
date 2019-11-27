<?php


namespace tests\Feature\ArticleFeatureTest;


use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Article;
use App\User;

class ShowArticleTest extends \TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testInvalidArticleId()
    {
        $this->get('/api/articles/string')->assertResponseStatus(404);
    }

    public function testArticleNotFound()
    {
        $this->get('/api/articles/5')->assertResponseStatus(404);
    }

    public function testArticleFound()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $this->get('/api/articles/' . $article->id)->assertResponseStatus(200);
    }

}
