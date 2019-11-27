<?php


namespace tests\Feature\CategoryFeatureTest;


use App\Category;
use Laravel\Lumen\Testing\DatabaseMigrations;

class DeleteCategoryTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testIfCategoryNotFound()
    {
        $this->delete('api/categories/5/delete')->assertResponseStatus(404);
    }

    public function testDeletingCategoryWithParent()
    {
        $parentCategory = Category::create([
            'parent_id' => null,
            'name' => 'Parent name'
        ]);

        $category = Category::create([
            'parent_id' => $parentCategory->id,
            'name' => 'Test name'
        ]);

        $this->delete('/api/categories/' . $category->id . '/delete')->assertResponseStatus(201);
    }

    public function testDeletingCategorySuccessfully()
    {
        $category = Category::create([
            'parent_id' => null,
            'name' => 'Test name'
        ]);

        $this->delete('/api/categories/' . $category->id . '/delete')->assertResponseStatus(201);
    }


}
