<?php


namespace App\Providers;


use App\Interfaces\ArticleCategoryRepositoryInterface;
use App\Repositories\ArticleCategoryRepository;
use Illuminate\Support\ServiceProvider;

class ArticleCategoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app
            ->bind(ArticleCategoryRepositoryInterface::class, ArticleCategoryRepository::class);
    }

}
