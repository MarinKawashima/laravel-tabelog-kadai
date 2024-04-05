@extends('layouts.app')

@section('content')
    <span style="margin-left: 100px;">
        <a href="{{ route('mypage') }}">マイページ</a> > <a href="{{ route('reservations.index')}}">予約一覧ページ</a> > 予約詳細ページ
    </span>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="reservation ">
                    <h1>予約が完了しました</h1>
                    <div class="reservation-header">予約内容</div>
                    <hr style="margin-top: 10px; margin-bottom: 10px; margin: 0 auto; width: 50%;">
                    <div class="reservation-body">
                        <p><strong>お名前:</strong> {{ $reservation->user->name }}</p>
                        <p><strong>店舗名:</strong> {{ $reservation->restaurant->name }}</p>
                        <p><strong>予約日:</strong> {{ $reservation->reservation_date }}</p>
                        <p><strong>時間:</strong> {{ $reservation->start_time }}</p>
                        <p><strong>人数:</strong> {{ $reservation->num_of_guests }}</p>

                        <!-- キャンセルボタン -->
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn nagoyameshi-delete-submit-button">予約をキャンセルする</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

