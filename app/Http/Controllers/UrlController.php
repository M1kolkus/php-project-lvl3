<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
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

    public function store(Request $request)
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

            return redirect()->route('urls.show', ['url' => $arrayDomain->id]);
        }

        flash('Страница уже существует');

        return redirect()->route('urls.show', ['url' => $arrayUrl->id]);
    }

    public function show($id)
    {
        $url = DB::table('urls')->where('id', $id)->first();
        $checks = DB::table('url_checks')->where('url_id', $id)->get();

        return view('domain', compact('url', 'checks'));
    }
}
