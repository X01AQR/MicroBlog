<?php

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('users', ['uses' => 'UserController@all']);
});
