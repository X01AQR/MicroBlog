<?php

$router->group(['prefix' => 'api'], function () use ($router) {


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

        # POST /api/articles/store
        $router->post('/store', ['uses' => 'ArticleController@store']);

        # PATCH /api/articles/{article}/update
        $router->patch('/{article}/update', ['uses' => 'ArticleController@update']);

        # DELETE /api/articles/{article}/delete
        $router->delete('/{article}/delete', ['uses' => 'ArticleController@destroy']);


    });

    $router->group(['prefix' => 'categories'], function () use ($router) {

    });


});
