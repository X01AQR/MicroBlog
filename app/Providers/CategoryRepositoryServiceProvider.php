<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\CategoryRepository;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

}
