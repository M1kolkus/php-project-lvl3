<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    public function create(): object
    {
        return view('urls.create');
    }

    public function index(): object
    {
        $urls = DB::table('urls')
            ->oldest()
            ->paginate(15);

        $lastChecks = [];

        foreach($urls->items() as $url) {
            $lastChecks[$url->id] = DB::table('url_checks')
                ->orderBy('url_id')
                ->latest()
                ->distinct('url_id')
                ->where('url_id', $url->id)
                ->get()
                ->keyBy('url_id');
        }

        return view('urls.index', compact('lastChecks', 'urls'));
    }

    public function store(Request $request): object
    {
        $valid = $request->validate([
            'url.name' => 'required|url|max:255'
        ]);

        $url = $request->input('url');
        $parseUrl = parse_url($url['name']);
        $domain = $parseUrl['scheme'] . '://' . $parseUrl['host'];

        $urlObject = DB::table('urls')->where('name', $domain)->first();

        if ($urlObject !== null) {
            flash('Страница уже существует');

            return redirect()->route('urls.show', ['url' => $urlObject->id]);
        }

        $id = DB::table('urls')->insertGetId(
            ['name' => $domain, 'created_at' => Carbon::now()]
        );

        flash('Страница успешно добавлена');

        return redirect()->route('urls.show', ['url' => $id]);

    }

    public function show(int $id): object
    {
        $url = DB::table('urls')->where('id', $id)->first();

        if ($url === null) {
            abort('404');
        }
        $checks = DB::table('url_checks')->where('url_id', $id)->get();

        return view('urls.show', compact('url', 'checks'));
    }
}
