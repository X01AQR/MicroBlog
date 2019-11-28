<?php


namespace tests\Feature\ArticleCategoryFeatureTest;


use App\Article;
use App\ArticleCategory;
use App\Category;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class DeleteArticleCategoryTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testArticleCategoryNotFound()
    {
        $user = User::create([
            'full_name' => 'test',
            'email' => 'test@email.com',
            'password' => app('hash')->make('password')
        ]);


        $article = Article::create([
           'user_id' => $user->id,
           'title' => 'title',
           'body' => 'body'
        ]);

        $this->actingAs($user)->delete('/api/articles/' . $article->id . '/categories/2/delete')->assertResponseStatus(404);
    }



    public function testArticleCategoryFound()
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

        $this->actingAs($user)->delete('/api/articles/' . $article->id . '/categories/' . $category->id . '/delete')
            ->assertResponseStatus(201);
    }

}
