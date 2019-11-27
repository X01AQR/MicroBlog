<?php


namespace tests\Feature\CategoryFeatureTest;


use App\Category;
use Laravel\Lumen\Testing\DatabaseMigrations;

class GetSubCategoriesTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testIfCategoryNotFound()
    {
        $this->get('/api/categories/5/sub-categories')->assertResponseStatus(404);
    }

    public function testIfNoSubCategoriesFound()
    {
        $category = Category::create([
            'parent_id' => null,
            'name' => 'Test Category'
        ]);

        $this->get('/api/categories/' . $category->id . '/sub-categories')->assertResponseStatus(404);
    }

    public function testIfCategoryIdInvalid()
    {
        $this->get('/api/categories/string/sub-categories')->assertResponseStatus(404);
    }

    public function testIfSubCategoriesFound()
    {
        $category = Category::create([
           'parent_id' => null,
           'name' => 'Super Category'
        ]);

        $subCategory1 = Category::create([
            'parent_id' => $category->id,
            'name' => 'Sub category 1'
        ]);

        $subCategory2 = Category::create([
            'parent_id' => $category->id,
            'name' => 'Sub category 2'
        ]);

        $this->get('/api/categories/' . $category->id .'/sub-categories')->assertResponseStatus(200);
    }

}
