<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class WebController extends Controller
{
    public function index()
     {
         $categories = Category::all()->sortBy('category_name');
  
         return view('web.index', compact('categories'));
     }
}
