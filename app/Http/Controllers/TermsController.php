<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;

class TermsController extends Controller
{
    public function show()
    {
        $terms = Term::all();
        return view('footerlinks.terms', compact('terms'));
    }
}
