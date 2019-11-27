<?php


namespace tests\Feature\CategoryFeatureTest;


use App\Category;
use Laravel\Lumen\Testing\DatabaseMigrations;

class UpdateCategoryTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testUpdatedCategoryNotFound()
    {
        $attributes = [
          'parent_id' => null,
          'name' => 'Category name'
        ];

        $this->patch('/api/categories/5/update', $attributes)->assertResponseStatus(404);
    }

    public function testNonStringUpdatedCategoryName()
    {
        $category = Category::create([
            'parent_id' => null,
            'name' => 'Category name'
        ]);

        $attributes = [
            'parent_id' => null,
            'name' => 432
        ];

        $this->patch('/api/categories/' . $category->id . '/update', $attributes)->assertResponseStatus(422);
    }

    public function testUpdatedCategoryParentNotFound()
    {
        $category = Category::create([
            'parent_id' => null,
            'name' => 'Category name'
        ]);

        $attributes = [
            'parent_id' => 56,
            'name' => 'New name'
        ];

        $this->patch('/api/categories/' . $category->id . '/update', $attributes)->assertResponseStatus(422);
    }

    public function testUpdatedCategoryParentIdNotPositiveInteger()
    {
        $category = Category::create([
            'parent_id' => null,
            'name' => 'Category name'
        ]);

        $attributes = [
            'parent_id' => 'string',
            'name' => 'New name'
        ];

        $this->patch('/api/categories/' . $category->id . '/update', $attributes)->assertResponseStatus(422);
    }

    public function testNullCategoryParent()
    {
        $parentCategory = Category::create([
            'parent_id' => null,
            'name' => 'Parent Category'
        ]);

        $category = Category::create([
            'parent_id' => $parentCategory->id,
            'name' => 'Category name'
        ]);

        $attributes = [
            'parent_id' => null,
            'name' => 'New name'
        ];

        $this->patch('/api/categories/' . $category->id . '/update', $attributes)->assertResponseStatus(201);
    }
}
