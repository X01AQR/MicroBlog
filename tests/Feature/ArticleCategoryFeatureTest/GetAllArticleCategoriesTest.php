<?php

namespace tests\Feature\ArticleCategoryFeatureTest;

use App\Article;
use App\ArticleCategory;
use App\Category;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class GetAllArticleCategoriesTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testIfArticleNotFound()
    {
        $this->get('/api/articles/5/categories')->assertResponseStatus(404);
    }

    public function testIfArticleHasNotCategories()
    {
        $user = factory(User::class)->create();
        $article = Article::create([
           'user_id' => $user->id,
           'title' => 'Article title',
           'body' => 'Article body'
        ]);

        $this->get('/api/articles/' . $article->id . '/categories')->assertResponseStatus(404);
    }

    public function testIfArticleIdInvalid()
    {
        $this->get('/api/articles/string/categories')->assertResponseStatus(404);
    }

    public function testIfArticleHasCategories()
    {
        $user = factory(User::class)->create();
        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article title',
            'body' => 'Article body'
        ]);

        $category = Category::create([
            'parent_id' => null,
            'name' => 'Category name'
        ]);

        $articleCategory = ArticleCategory::create([
            'article_id' => $article->id,
            'category_id' => $category->id
        ]);

        $this->get('/api/articles/' . $article->id . '/categories')->assertResponseStatus(200);
    }


}
