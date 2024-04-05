@extends('layouts.app')

@section('content')
<div class="container  d-flex justify-content-center mt-3">
    <div class="w-75">
        <h1>お気に入り</h1>

        <hr>

        <div class="row">
            @foreach ($favorite_restaurants as $favorite_restaurant)
                <div class="col-md-7 mt-2">
                    <div class="d-inline-flex">
                        <a href="{{ route('restaurants.show', $favorite_restaurant->id) }}" class="d-block mr-3">
                            <div class="image-container" style="width: 150px; height: 150px; overflow: hidden;">
                                <img src="{{ asset($favorite_restaurant->image) }}" class="img-fluid" style="width: 100%;" alt="{{ $favorite_restaurant->name }}">
                            </div>
                        </a>
                        <div class="container mt-3">
                            <h5 class="nagoyameshi-favorite-item-text">{{ $favorite_restaurant->name }}</h5>
                            <h6 class="nagoyameshi-favorite-item-text">&yen;{{ $favorite_restaurant->budget }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-center justify-content-end">
                    <a href="{{ route('favorites.destroy', $favorite_restaurant->id) }}" class="nagoyameshi-favorite-item-delete" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                        削除
                    </a>
                    <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $favorite_restaurant->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="col-md-3 d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn nagoyameshi-submit-button">予約</button>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
