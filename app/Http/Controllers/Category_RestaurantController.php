<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Restaurant;

class Category_RestaurantController extends Controller
{
    public function store(Request $request, $category_id, $restaurant_id)
    {
        $category = Category::findOrFail($category_id);
        $restaurant = Restaurant::findOrFail($restaurant_id);

        $category->restaurants()->attach($restaurant);

        return back();
    }

    public function destroy(Request $request, $category_id, $restaurant_id)
    {
        $category = Category::findOrFail($category_id);
        $restaurant = Restaurant::findOrFail($restaurant_id);

        $category->restaurants()->detach($restaurant);

        return back();
    }
}
