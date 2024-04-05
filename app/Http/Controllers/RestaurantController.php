<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Fee;
use App\Http\Controllers\category_restaurantController;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $restaurants = Restaurant::all();

        return view('restaurants.index', compact('restaurants'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {

        $reviews = $restaurant->reviews()->get();
        $reservations = $restaurant->reservations()->get();
        $feePrice = Fee::find(1)->fee_price;

  
        return view('restaurants.show', compact('restaurant', 'reviews', 'reservations', 'feePrice'));
    }


    // 検索アクション
    public function search(Request $request)
    {
        // リクエストから検索キーワードを取得
        $keyword = $request->input('keyword');

        // キーワードを含むレストランを検索
        $restaurants = Restaurant::where('name', 'like', '%'.$keyword.'%')
                                ->orWhere('description', 'like', '%'.$keyword.'%')
                                ->get();

        // 検索結果をビューに渡して表示
        return view('restaurants.search', compact('restaurants','keyword'));
    }

    // カテゴリ別表示アクション
    public function category($category_id)
    {
        $category = Category::findOrFail($category_id);
        $restaurants = $category->restaurants;

        return view('restaurants.category', compact('category', 'restaurants'));
    }
}
