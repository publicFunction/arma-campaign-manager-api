<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['prefix' => '/v1/', 'middleware' => 'cors', 'namespace' => '\ARMACMan\Http\Controllers'], function ($api) {
    
    $api->get('/', function() {
        return response()->json(['message' => 'Not Found'], 404);
    });

    /**
     * Auth Requests
     */
    $api->get('auth', 'Auth\AuthController@me'); // Gets the current logged in user
    $api->post('auth', 'Auth\AuthController@auth'); //Logs in a current registered user into Laravel and JWT Auth
    $api->delete('auth', 'Auth\AuthController@logout'); //Logs in a current registered user into Laravel and JWT Auth

    $api->group(['middleware' => 'jwt.auth'], function ($api) {
        $api->get('test', function() {
            $users = \ARMACMan\Models\Roles::with('users')->get();
            return response()->json($users, 200);
        });


    });


});