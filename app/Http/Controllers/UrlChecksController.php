<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DiDom\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UrlChecksController extends Controller
{
    public function store($id)
    {
        $url = DB::table('urls')->find($id);

        $response = Http::get($url->name);
        $document = new Document($response->body());
        $h1 = optional($document->first('h1'))->text();
        $title = $document->first('title')->text();
        $description = optional($document->first('meta[name=description]'))->getAttribute('content');

        DB::table('url_checks')->insert([
            'url_id' => $id,
            'created_at' => Carbon::now()->toString(),
            'status_code' => $response->status(),
            'h1' => $h1,
            'title' => $title,
            'description' => $description,
        ]);

        flash('Страница успешно проверена');

        return redirect()->route('urls.show', ['url' => $id]);
    }
}
