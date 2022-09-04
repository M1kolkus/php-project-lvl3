<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DiDom\Document;

class AnalyzerController extends Controller
{
    public function analyzer()
    {
        return view('analyzer');
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     */

}
