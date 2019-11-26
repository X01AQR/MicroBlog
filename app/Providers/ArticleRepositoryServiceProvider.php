<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ArticleRepository;
use App\Interfaces\ArticleRepositoryInterface;

class ArticleRepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
    }

}
