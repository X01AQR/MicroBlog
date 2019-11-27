<?php

namespace tests\Feature\CategoryFeatureTest;

use App\Category;
use Laravel\Lumen\Testing\DatabaseMigrations;

class StoreCategoryTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
    }

    public function testStoreCategoryWithoutParent()
    {
        $attributes = [
            'parent_id' => null,
            'name' => 'Category name'
        ];

        $this->post('/api/categories/store', $attributes)->assertResponseStatus(201);
    }

    public function testStoreNonStringCategoryName()
    {
        $attributes = [
            'parent_id' => null,
            'name' => 345
        ];

        $this->post('/api/categories/store', $attributes)->assertResponseStatus(422);
    }

    public function testStoreNonPositiveIntegerCategoryParent()
    {
        $attributes = [
            'parent_id' => 'string',
            'name' => 'Category name'
        ];

        $this->post('/api/categories/store', $attributes)->assertResponseStatus(422);
    }

    public function testStoreCategoryWithoutName()
    {
        $attributes = [
            'parent_id' => 'string',
            'name' => null
        ];

        $this->post('/api/categories/store', $attributes)->assertResponseStatus(422);
    }

    public function testStoreCategoryWithNonExistParent()
    {
        $attributes = [
            'parent_id' => 55,
            'name' => 'Category name'
        ];

        $this->post('/api/categories/store', $attributes)->assertResponseStatus(422);
    }

    public function testStoreCategorySuccessfully()
    {
        $category = Category::create([
           'parent_id' => null,
           'name' => 'Super category'
        ]);

        $attributes = [
            'parent_id' => $category->id,
            'name' => 'Category name'
        ];

        $this->post('/api/categories/store', $attributes)->assertResponseStatus(201);
    }

}
