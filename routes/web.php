<?php

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->group(['prefix' => 'auth'], function () use ($router) {

        # POST /api/auth/register
        $router->post('/register', [ 'uses' => 'Auth\RegisterController@register']);

        # POST /api/auth/login
        $router->post('/login', [ 'uses' => 'Auth\LoginController@login']);

        # POST /api/auth/logout
        $router->post('/logout', [ 'uses' => 'Auth\LoginController@logout', 'middleware' => 'auth']);
    });

    $router->group(['prefix' => 'users'], function () use ($router) {

        # GET /api/users
        $router->get('/', ['uses' => 'UserController@index']);

        # GET /api/users/{user}
        $router->get('{user}', ['uses' => 'UserController@show']);

        # GET /api/users/{user}/articles
        $router->get('{user}/articles', ['uses' => 'ArticleController@userArticles']);

        # PATCH /api/users/{user}/update
        $router->patch('{user}/update', ['uses' => 'UserController@update']);

        # DELETE /api/users/{user}/delete
        $router->delete('{user}/delete', ['uses' => 'UserController@destroy']);

    });

    $router->group(['prefix' => 'articles'], function () use ($router) {

        # GET /api/articles
        $router->get('/', ['uses' => 'ArticleController@index']);

        # GET /api/articles/{article}
        $router->get('/{article}', ['uses' => 'ArticleController@show']);

        # ArticleCategory

            # GET /api/articles/{article}/categories
            $router->get('/{article}/categories', ['uses' => 'ArticleCategoryController@index']);

            # GET /api/articles/{article}/categories/{category}
            $router->get('/{article}/categories/{category}', ['uses' => 'ArticleCategoryController@show']);

            # POST /api/articles/{article}/categories/{category}/store
            $router->post('/{article}/categories/{category}/store', ['uses' => 'ArticleCategoryController@store']);

            # DELETE /api/articles/{article}/categories/{category}/delete
            $router->delete('/{article}/categories/{category}/delete', ['uses' => 'ArticleCategoryController@destroy']);

        # POST /api/articles/store
        $router->post('/store', ['uses' => 'ArticleController@store']);

        # PATCH /api/articles/{article}/update
        $router->patch('/{article}/update', ['uses' => 'ArticleController@update']);

        # DELETE /api/articles/{article}/delete
        $router->delete('/{article}/delete', ['uses' => 'ArticleController@destroy']);


    });

    $router->group(['prefix' => 'categories'], function () use ($router) {
        # GET /api/categories
        $router->get('/', ['uses' => 'CategoryController@index']);

        # GET /api/categories/{category}
        $router->get('/{category}', ['uses' => 'CategoryController@show']);

        # GET /api/categories/{category}/sub-categories
        $router->get('/{category}/sub-categories', ['uses' => 'CategoryController@subCategories']);

        # POST /api/categories/store
        $router->post('/store', ['uses' => 'CategoryController@store']);

        # PATCH /api/categories/{category}/update
        $router->patch('/{category}/update', ['uses' => 'CategoryController@update']);

        # DELETE /api/categories/{category}/delete
        $router->delete('/{category}/delete', ['uses' => 'CategoryController@destroy']);
    });


});
