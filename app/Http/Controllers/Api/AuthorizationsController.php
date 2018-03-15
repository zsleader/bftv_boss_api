<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AuthorizationRequest;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

class AuthorizationsController extends Controller
{
    use Helpers;

    public function socialStore(AuthorizationRequest $request)
    {
        $credentials['email'] = $request->vo_id;
        $credentials['password'] = $request->vo_secret;

        if (!$token = \Auth::guard('api')->attempt($credentials)) {

            return $this->response->errorUnauthorized('vo_id 或 vo_secret 错误');
        }

        return $this->respondWithToken($token)->setStatusCode(201);
    }

    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'status' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
    public function update()
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    public function destroy()
    {
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }

}
