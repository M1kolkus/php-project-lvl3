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

    public function urls(Request $request)
    {
        $valid = $request->validate([
            'url.name' => 'required|url|max:255'
        ]);

        $url = $request->post('url')['name'];
        $parseUrl = parse_url($url);
        $domain = $parseUrl['scheme'] . '://' . $parseUrl['host'];

        $arrayUrl = DB::table('urls')->where('name', $domain)->first();

        if (is_null($arrayUrl)) {
            DB::insert(
                'insert into urls (name, created_at) values (?, ?)',
                [$domain, Carbon::now()]
            );

            $arrayDomain = DB::table('urls')->where('name', $domain)->first();

            flash('Страница успешно добавлена');

            return redirect()->route('urls', ['id' => $arrayDomain->id]);
        }

        flash('Страница уже существует');

        return redirect()->route('urls', ['id' => $arrayUrl->id]);
    }

    public function index()
    {
        $lastChecks = DB::table('url_checks')
            ->orderBy('url_id')
            ->latest()
            ->distinct('url_id')
            ->get()
            ->keyBy('url_id');

        $urls = DB::table('urls')
            ->oldest()
            ->paginate(15);

        return view('urls', compact('lastChecks', 'urls'));
    }

    public function domain($id)
    {
        $url = DB::table('urls')->where('id', $id)->first();
        $checks = DB::table('url_checks')->where('url_id', $id)->get();

        return view('domain', compact('url', 'checks'));
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     */
    public function checks($id)
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

        return redirect()->route('urls', ['id' => $id]);
    }
}
