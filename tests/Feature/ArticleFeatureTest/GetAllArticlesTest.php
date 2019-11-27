<?php


namespace tests\Feature\ArticleFeatureTest;
use App\Article;
use Laravel\Lumen\Testing\DatabaseMigrations;

class GetAllArticlesTest extends \TestCase
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();

        $this->runDatabaseMigrations();
    }

    public function testArticlesNotFound()
    {
        $this->artisan('migrate:fresh');
        $this->get('/api/articles')->assertResponseStatus(404);
    }

    public function testArticlesFound()
    {
        $this->artisan('db:seed');

        $this->get('/api/articles')->assertResponseStatus(200);
    }



}
