<?php


namespace tests\Feature\ArticleCategoryFeatureTest;


use App\Article;
use App\Category;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class StoreArticleCategoryTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testCategoryNotFound()
    {
        $category = Category::create([
            'parent_id' => null,
            'name' => 'Category name'
        ]);

        $this->post('/api/articles/5/categories/' . $category->id, [])->assertResponseStatus(404);
    }

    public function testArticleNotFound()
    {
        $user = factory(User::class)->create();

        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article body'
        ]);

        $this->post('/api/articles/' . $article->id . '/categories/5', [])->assertResponseStatus(404);
    }

    public function testInvalidArticleId()
    {
        $category = Article::create([
            'parent_id' => null,
            'name' => 'Article body'
        ]);

        $this->post('/api/articles/string/categories/' . $category->id, [])->assertResponseStatus(404);
    }

    public function testInvalidCategoryId()
    {
        $user = factory(User::class)->create();

        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article body'
        ]);

        $this->post('/api/articles/' . $article->id . '/categories/string', [])->assertResponseStatus(404);
    }

    public function testStoringArticleCategorySuccessfully()
    {
        $user = factory(User::class)->create();

        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article body'
        ]);

        $category = Category::create([
            'parent_id' => null,
            'name' => 'Name',
        ]);

        $this->post('/api/articles/' . $article->id . '/categories/' . $category->id, [])->assertResponseStatus(201);
    }

}
