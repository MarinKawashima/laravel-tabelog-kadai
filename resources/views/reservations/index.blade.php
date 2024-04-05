@extends('layouts.app')

@section('content')
    <span style="margin-left: 100px;">
        <a href="{{ route('mypage') }}">マイページ</a> > 予約一覧ページ
    </span>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2>予約一覧</h2>
                @if ($reservations->isEmpty())
                    <p>現在、予約がありません。</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>店舗名</th>
                                <th>予約日</th>
                                <th>時間</th>
                                <th>人数</th>
                                <th>詳細</th>
                                <th>削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->restaurant->name }}</td>
                                    <td>{{ $reservation->reservation_date }}</td>
                                    <td>{{ $reservation->start_time }}</td>
                                    <td>{{ $reservation->num_of_guests }}</td>
                                    <td>
                                        <a href="{{ route('reservations.show', $reservation->id) }}">詳細</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
