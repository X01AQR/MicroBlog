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

    });

    $router->group(['prefix' => 'categories'], function () use ($router) {

    });


});
