<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class AnalyzerController extends Controller
{
    public function analyzer()
    {
        return view('analyzer');
    }
}
