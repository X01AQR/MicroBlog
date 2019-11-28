<?php


namespace tests\Feature\ArticleCategoryFeatureTest;


use App\Article;
use App\ArticleCategory;
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
        $user = factory(User::class)->create();
        $article = Article::create([
           'user_id' => $user->id,
           'title' => 'title',
           'body' => 'body'
        ]);

        $this->actingAs($user)->post('/api/articles/' . $article->id . '/categories/5/store')->assertResponseStatus(404);
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

        $this->actingAs($user)->post('/api/articles/' . $article->id . '/categories/' . $category->id .'/store')->assertResponseStatus(201);
    }

}
