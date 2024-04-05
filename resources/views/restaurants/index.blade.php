@extends('layouts.app')
 
 @section('content')
 <div class="row">
     <div class="col-9">
         <div class="container mt-4">
             <div class="row w-100">
                 @foreach($restaurants as $restaurant)
                 <div class="col-3">
                     <a href="{{route('restaurants.show', $restaurant)}}">
                     @if ($restaurant->image !== "")
                         <img src="{{ asset($restaurant->image) }}" class="img-thumbnail">
                         @else
                         <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                     @endif
                     </a>
                     <div class="row">
                         <div class="col-12">
                             <p class="nagoyameshi-restaurant-label mt-2">
                                 {{$restaurant->name}}<br>
                                 {{$restaurant->category_id }}<br>
                                 <label>￥{{$restaurant->description}}</label>
                             </p>
                         </div>
                     </div>
                 </div>
                 @endforeach
             </div>
         </div>
     </div>
 </div>
 @endsection
