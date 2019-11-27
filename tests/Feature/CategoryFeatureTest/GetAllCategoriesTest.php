<?php


namespace tests\Feature\CategoryFeatureTest;


use Laravel\Lumen\Testing\DatabaseMigrations;

class GetAllCategoriesTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();

    }

    public function testCategoriesNotFound()
    {
        $this->artisan('migrate:fresh');
        $this->get('/api/categories')->assertResponseStatus(404);
    }

    public function testCategoriesFound()
    {
        $this->artisan('db:seed');

        $this->get('/api/categories')->assertResponseStatus(200);
    }

}
