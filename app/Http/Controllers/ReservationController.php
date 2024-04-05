<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Fee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /** 予約の作成処理
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_time' => 'required',
            'num_of_guests' => 'required',
            'reservation_date' => 'required|date|after_or_equal:today'
        ]);

        $feePrice = Fee::findOrFail(1)->fee_price;

        $user_name = Auth::user()->name;

        $reservation = new Reservation();
        $reservation->user_id =  Auth::user()->id;
        $reservation->restaurant_id = $request->input('restaurant_id');
        $reservation->reservation_date = $request->input('reservation_date');
        $reservation->start_time = date('H:i:s', strtotime($request->input('start_time'))); // 適切な形式に変換
        $reservation->num_of_guests = $request->input('num_of_guests');
        $reservation->fee_price = $feePrice; // fee_price カラムに手数料を設定
        $reservation->save();
 
        // 予約が成功した後に、予約詳細ページにリダイレクト
        return redirect()->route('reservations.show', $reservation->id);
    }



    /** 予約の詳細表示
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }



    // 予約一覧の表示
    public function index(Request $request)
    {
        // ログインユーザーの予約一覧を取得
        $user_id = Auth::user()->id;
        $reservations = Reservation::where('user_id', $user_id)
                                    ->orderBy('reservation_date', 'asc')
                                    ->get();        
        return view('reservations.index', compact('reservations'));
    }



    /** 予約の削除処理
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $restaurant_id = $reservation->restaurant->id;
        $reservation->delete();

        // 削除後にリダイレクトし、削除の成功をユーザーに通知する
        return redirect()->route('restaurants.show',$restaurant_id)->with('success', '予約が削除されました');
    }
}
