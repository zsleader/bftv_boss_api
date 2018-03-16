<?php

namespace App\Http\Controllers\Api;

use App\Transformers\UserTransformer;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    use Helpers;

    public function me()
    {
        return $this->response->item($this->user(), new UserTransformer());
    }
}
