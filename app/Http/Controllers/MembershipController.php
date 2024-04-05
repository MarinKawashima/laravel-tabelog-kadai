<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{

    public function create(Request $request)
    {
        // ログインしているユーザーを取得
        $user = $request->user();
        // ユーザーの Setup Intent を作成し、ビューに渡す
        return view('users.membership', [
            'intent' => $user->createSetupIntent()
        ]);
    }

    public function subscribe(Request $request)
    {
        $user = Auth::user();
        $user->newSubscription(
            'default', 'price_1OuFDWBrEd7MaVThoWRIKozo'
        )->create($request->paymentMethodId);


        // 有料会員フラグを更新
        $user->membership = '1';
        $user->save();

        return redirect('/')->with('success','有料会員の登録が完了しました。');
    }


    public function destroy(Request $request)
    {
        $user = Auth::user();
        // $user_subscription = DB::table('subscriptions')->get();
        // $price = 

        $user->membership = '0';
        $user->save();
        return redirect('/')->with('success','有料会員の退会が完了しました。');
    }
}