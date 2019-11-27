<?php


namespace tests\Feature\ArticleCategoryFeatureTest;


use App\Article;
use App\ArticleCategory;
use App\Category;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ShowArticleCategoryTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testInvalidArticleIdAndCategoryId()
    {

        $this->get('/api/articles/string/categories/string')->assertResponseStatus(404);
    }

    public function testArticleNotFound()
    {
        $user = factory(User::class)->create();
        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article Title',
            'body' => 'Article Body'
        ]);

        $category = Category::create([
           'parent_id' => null,
           'name' => 'Category name'
        ]);

        $articleCategory = ArticleCategory::create([
           'article_id' => $article->id,
           'category_id' => $category->id
        ]);

        $this->get('/api/articles/5/categories/' . $category->id)->assertResponseStatus(404);
    }

    public function testCategoryNotFound()
    {
        $user = factory(User::class)->create();

        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article Title',
            'body' => 'Article Body'
        ]);

        $category = Category::create([
            'parent_id' => null,
            'name' => 'Category name'
        ]);

        $articleCategory = ArticleCategory::create([
            'article_id' => $article->id,
            'category_id' => $category->id
        ]);

        $this->get('/api/articles/' . $article->id . '/categories/5')->assertResponseStatus(404);
    }

    public function testGetArticleCategorySuccessfully()
    {
        $user = factory(User::class)->create();
        $article = Article::create([
            'user_id' => $user->id,
            'title' => 'Article Title',
            'body' => 'Article Body'
        ]);

        $category = Category::create([
            'parent_id' => null,
            'name' => 'Category name'
        ]);

        $articleCategory = ArticleCategory::create([
            'article_id' => $article->id,
            'category_id' => $category->id
        ]);

        $this->get('/api/articles/' . $article->id . '/categories/' . $category->id)->assertResponseStatus(200);
    }

}
