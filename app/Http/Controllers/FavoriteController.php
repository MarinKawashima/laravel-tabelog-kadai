<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\User;

class FavoriteController extends Controller
{
    public function store($restaurant_id)
     {
         Auth::user()->favorite_restaurants()->attach($restaurant_id);
 
         return back();
     }
 
     public function destroy($restaurant_id)
     {
         Auth::user()->favorite_restaurants()->detach($restaurant_id);
 
         return back();
     }
}
