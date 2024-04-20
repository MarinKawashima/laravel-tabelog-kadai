@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="row w-75">
        <span>
            <a href="{{ url('/') }}">ホーム</a> > <a href="javascript:history.back()">店舗一覧</a> >  店舗詳細
        </span>

        <div class="col-5 offset-1">
            @if ($restaurant->image)
            <img src="{{ asset($restaurant->image) }}" alt="{{ $restaurant->name }}" class="w-100 img-fluid">
            @else
            <img src="{{ asset('img/dummy.png')}}" alt="{{ $restaurant->name }}" class="w-100 img-fluid">
            @endif
        </div>

        <div class="col">
            <div class="d-flex flex-column">
                <h1 class="">
                    {{$restaurant->name}}
                </h1>
                <p class="">
                    {{$restaurant->category_id}}
                </p>
                <hr>
                <p class="">
                    {{$restaurant->description}}
                </p>
                <hr>
                <p class="d-flex align-items-end">
                    ￥{{$restaurant->budget}}
                </p>
                <hr>
            </div>
            
            <form method="POST" class="m-3 align-items-end">
                @csrf
                <input type="hidden" name="id" value="{{$restaurant->id}}">
                <input type="hidden" name="name" value="{{$restaurant->name}}">
                <input type="hidden" name="budget" value="{{$restaurant->budget}}">
                @if(Auth::user()->membership)
                <div class="row">
                    <div class="col-5">
                        @if(Auth::user()->favorite_restaurants()->where('restaurant_id', $restaurant->id)->exists())
                        <a href="{{ route('favorites.destroy', ['restaurant_id' => $restaurant->id ]) }}" class="btn nagoyameshi-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                            <i class="fa fa-heart"></i>
                            お気に入り解除
                        </a>
                        @else
                        <a href="{{ route('favorites.store', ['restaurant_id' => $restaurant->id ]) }}" class="btn nagoyameshi-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                            <i class="fa fa-heart"></i>
                            お気に入り
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </form>
            <form id="favorites-destroy-form" action="{{ route('favorites.destroy', ['restaurant_id' => $restaurant->id ]) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
            <form id="favorites-store-form" action="{{ route('favorites.store', ['restaurant_id' => $restaurant->id ]) }}" method="POST" class="d-none">
                @csrf
            </form>            
        </div>

        @if(Auth::user()->membership)
        <div class="offset-1 col-11">
            <hr class="w-100">
            <h3 class="float-left">予約フォーム</h3>
        </div>
        <div class="offset-2 col-8">
            <!-- 予約を実装する箇所 -->
            <form id="reservationForm" method="POST" action="{{ route('reservations.store') }}">
                @csrf
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                <input type="hidden" name="fee_price" value="{{ $feePrice }}"> <!-- 手数料 -->

                <div class="form-group row mb-3">
                    <label for="reservation_date" class="col-sm-4 col-form-label">予約日:</label>
                    <div class="col-sm-8">
                        <input type="date" id="reservation_date" name="reservation_date" class="form-control" required>
                        <div id="dateErrorMessage" class="text-danger" style="display: none;">過去の日は選択できません</div>
                    </div>
                </div>
                
                <div class="form-group row mb-3">
                    <label for="start_time" class="col-sm-4 col-form-label">時間:</label>
                    <div class="col-sm-8">
                        <select id="start_time" name="start_time" class="form-control" required>
                            <option value="">時間を選択してください</option>
                            @php
                                $start = strtotime('17:00');
                                $end = strtotime('22:00');
                            @endphp
                            @for ($time = $start; $time <= $end; $time += 30*60)
                                <option value="{{ date('H:i', $time) }}">{{ date('H:i', $time) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                
                <div class="form-group row mb-3">
                    <label for="num_of_guests" class="col-sm-4 col-form-label">人数:</label>
                    <div class="col-sm-8">
                        <input type="number" id="num_of_guests" name="num_of_guests" class="form-control" placeholder="人数を選択してください" required>
                    </div>
                </div>

                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn nagoyameshi-submit-button ">
                        予約
                    </button>
                </div>
            </form>
        </div>
        @endif

        <!-- レビューを実装する箇所になります -->
        <div class="offset-1 col-11">
            <hr class="w-100">
            <h3 class="float-left">カスタマーレビュー</h3>
        </div>
        <!-- レビューの表示 -->
        <div class="offset-1 col-10">
            <div class="row justify-content-center">
            <div class="col-md-10  mb-4">
                @foreach($reviews as $review)
                <div class="mb-3">
                    <h3 class="review-score-color mb-1">{{ str_repeat('★', $review->score) }}</h3>
                    <p class="h3 mb-1">{{$review->content}}</p>
                    <label>{{$review->created_at}} {{$review->user->name}}</label>
                </div>
                @endforeach
            </div><br />

            <!-- レビュー投稿フォーム -->
            @if(Auth::user()->membership)
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <h4>レビュー評価</h4>
                        <select name="score" class="form-control m-2 review-score-color">
                            <option value="5" class="review-score-color">★★★★★</option>
                            <option value="4" class="review-score-color">★★★★</option>
                            <option value="3" class="review-score-color">★★★</option>
                            <option value="2" class="review-score-color">★★</option>
                            <option value="1" class="review-score-color">★</option>
                        </select>

                        <h4>レビュー内容</h4>
                            @error('content')
                            <strong>レビュー内容を入力してください</strong>
                            @enderror
                        <textarea name="content" class="form-control m-2"></textarea>
                        <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn nagoyameshi-submit-button ml-2">レビューを追加</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- 予約フォーム関連のスクリプト -->
<script>
    // 予約フォームの送信前に日付の妥当性をチェックする
    document.getElementById('reservationForm').addEventListener('submit', function(event) {
        var selectedDate = new Date(document.getElementById('reservation_date').value + 'T' + document.getElementById('start_time').value);
        var currentDate = new Date();
        if (selectedDate < currentDate) {
            // 選択された日付が過去の日付である場合はフォームの送信をキャンセルし、エラーメッセージを表示する
            event.preventDefault();
            document.getElementById('dateErrorMessage').style.display = 'block';
        }
    });
</script>

@endsection