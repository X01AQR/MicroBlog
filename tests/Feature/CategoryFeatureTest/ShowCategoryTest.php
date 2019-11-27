<?php


namespace tests\Feature\CategoryFeatureTest;


use App\Article;
use App\Category;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ShowCategoryTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testCategoryIdNotPositiveInteger()
    {
        $this->get('/api/categories/string')->assertResponseStatus(404);
    }

    public function testCategoryNotFound()
    {
        $this->get('/api/categories/5')->assertResponseStatus(404);
    }

    public function testCategoryFound()
    {
        $category = Category::create([
            'parent_id' => null,
            'name' => 'Test Category'
        ]);

        $this->get('/api/categories/' . $category->id)->assertResponseStatus(200);
    }

}
