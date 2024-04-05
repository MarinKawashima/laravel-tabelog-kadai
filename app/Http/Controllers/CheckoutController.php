<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Checkout\Session;
use Stripe\Subscription;
use Stripe\Exception\CardException;

class CheckoutController extends Controller
{
    public function createSubscription(Request $request)
    {
        // // Stripeのシークレットキーを設定
        // Stripe::setApiKey(env('STRIPE_SECRET'));


        // ログインしているユーザーを取得
        $user = $request->user();
        // ユーザーの Setup Intent を作成し、ビューに渡す
        return view('users.membership', [
            'intent' => $user->createSetupIntent()
        ]);

        // try {
        //     // Stripe顧客を作成する
        //     $customer = \Stripe\Customer::create([
        //         'email' => $request->user()->email,//←有料会員のみに設定する？
        //         'source' => $request->stripeToken,←
        //     ]);

        //     // サブスクリプションを作成する
        //     $subscription = Subscription::create([
        //         'customer' => $customer->id,
        //         'items' => [['price' => config('services.stripe.price_id')]], // 月額課金の価格IDを指定
        //     ]);

        //     // サブスクリプションの作成に成功した場合の処理
        //     // ユーザーのデータベースにサブスクリプション情報を保存するなどの処理を行う

        //     return response()->json(['message' => 'Subscription created successfully']);
        // } catch (CardException $e) {
        //     // カードに関するエラー処理
        //     return response()->json(['error' => $e->getMessage()], 400);
        // } catch (\Exception $e) {
        //     // その他のエラー処理
        //     return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
        // }
    }




    // サブスクリプションのキャンセル
    public function cancelSubscription(Request $request)
    {
        try {
            // Stripeからサブスクリプションをキャンセル
            $subscription = Subscription::retrieve($request->subscription_id);
            $subscription->cancel();

            // サブスクリプションのキャンセルに成功した場合の処理
            // ユーザーのデータベースにサブスクリプションキャンセル情報を保存するなどの処理を行う

            return redirect()->route('web.index')->with('success', 'Subscription canceled successfully');
        } catch (\Exception $e) {
            // エラー処理
            return redirect()->route('web.index')->with('error', 'Something went wrong. Please try again later.');
        }
    }
    
}
