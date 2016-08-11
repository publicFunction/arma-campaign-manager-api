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
    $api->post('auth/refresh', 'Auth\AuthController@refresh'); // Refreshes the existing token

    $api->group(['middleware' => 'jwt.auth'], function ($api) {
        $api->get('test', function() {
            $users = \ARMACMan\Models\Roles::with('users')->get();
            return response()->json($users, 200);
        });

        // Community Routes
        $api->get('community', 'Community\CommunityController@index');
        $api->get('community/servers', 'Community\CommunityController@servers');
        $api->get('community/servers/{server_id}', 'Community\CommunityController@server');

        //Server Routes
        $api->get('servers/{server_id}/status', 'Community\ServersController@status');

    });


});