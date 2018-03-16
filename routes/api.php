<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',[
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => 'serializer:array'
], function($api){
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api){
        //通过id和secret获取access_token
        $api->post('socials/authorizations', 'AuthorizationsController@socialStore')
            ->name('api.socials.authorizations.store');
        //刷新token
        $api->put('socials/authorizations/current', 'AuthorizationsController@update')
            ->name('api.socials.authorizations.update');
        //删除token
        $api->delete('socials/authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.socials.authorizations.destroy');
        //需要token验证的接口
        $api->group(['middleware' => 'api.auth'], function($api){
            //获取当前接口访问人信息
            $api->get('socials/info', 'UsersController@me')
                ->name('api.user.show');
        });

    });
});
