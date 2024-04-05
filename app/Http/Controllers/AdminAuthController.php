<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_admin) {
                // 管理者として認証成功した場合の処理
                return redirect()->intended('admin');
            } else {
                // 管理者ではない場合の処理
                Auth::logout();
                return redirect('/')->with('error', '管理者のみアクセス可能です。');   //->withErrors(['msg' => '管理者のみアクセス可能です。']);
            }
        } else {
            // 認証失敗の処理
            return back()->withErrors([
                'email' => '提供された資格情報に一致するレコードがありません。',
            ]);
        }
    }
}

