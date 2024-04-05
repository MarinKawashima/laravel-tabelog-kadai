<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{
    // ログアウト処理
    public function logout(){
        admin()->logout();

        return redirect('/');
    }

}
