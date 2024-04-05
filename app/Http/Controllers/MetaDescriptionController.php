<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetaDescription;

class MetaDescriptionController extends Controller
{
    public function show()
    {
        $metaDescriptions = MetaDescription::first();
        return view('layouts.app' , compact('metaDescriptions'));
    }
}
