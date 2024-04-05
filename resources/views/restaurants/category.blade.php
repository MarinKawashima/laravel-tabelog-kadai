@extends('layouts.app')

@section('content')
    <span class="mb-5">
        <a href="{{ url('/') }}">ホーム</a> >  店舗一覧
    </span>

    <h1>{{ $category->name }}の店舗</h1>

    @if($restaurants->count() > 0)
        <div class="restaurant-list">
            @foreach($restaurants as $key => $restaurant)
                @if($key % 3 == 0)
                    <div class="row">
                @endif
                <div class="col-md-4 mb-5 restaurant">
                    <h2 class="mb-0 restaurant-name"><a class="text-decoration-none" href="{{ route('restaurants.show', ['restaurant' => $restaurant->id]) }}" style="color: black;">{{ $restaurant->name }}</a></h2>
                    <p class="mb-0">予算: {{ $restaurant->budget }}円</p>
                    @if($restaurant->image)
                        <a href="{{ route('restaurants.show', ['restaurant' => $restaurant->id]) }}">
                            <img src="{{ asset($restaurant->image) }}" alt="{{ $restaurant->name }}" style="width: 300px; height: 200px;" class="mb-2">
                        </a>
                    @else
                        <p>写真はありません。</p>
                    @endif
                </div>
                @if(($key + 1) % 3 == 0 || ($key + 1) == $restaurants->count())
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <p>このカテゴリではお店は見つかりませんでした。</p>
    @endif
@endsection
