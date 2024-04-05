@extends('layouts.app')
 

@section('content')
<div class="d-flex justify-content-center" >
     <!-- 検索フォーム -->
    <form action="{{ route('restaurants.search') }}" method="GET" class="row g-1">
        <div class="col-auto">
            <input type="text" name="keyword" class="form-control nagoyameshi-search-input" placeholder="店舗名">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn nagoyameshi-search-button"><i class="fas fa-search nagoyameshi-search-icon"></i></button>
        </div>
    </form>
</div>

<div class="mt-5 d-flex justify-content-center">
         <!-- カテゴリの表示 -->
        <div class="row row-cols-5 g-2" style="max-width: 1200px;">
            @foreach ($categories as $category)
                <div class="col d-flex justify-content-center">
                    <a href="{{ route('restaurants.category', $category->id) }}" class="text-decoration-none text-dark text-center">
                        <img src="{{ $category->image }}" alt="{{ $category->name }}" class="img-fluid category-image">
                        <p class="text-center">{{ $category->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
</div>
@endsection