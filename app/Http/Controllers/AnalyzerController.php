<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        $arrayUrl = json_decode(json_encode(DB::table('urls')
            ->where('name', $domain)->first()), true);

        if (is_null($arrayUrl)) {
            DB::insert(
                'insert into urls (name, created_at) values (?, ?)',
                [$domain, Carbon::now()]
            );

            $arrayDomain = json_decode(json_encode(DB::table('urls')
                ->where('name', $domain)->first()), true);

            $id = $arrayDomain['id'];

            flash('Страница успешно добавлена');

            return redirect()->route('urls', ['id' => $id]);
        }

        $id = $arrayUrl['id'];

        flash('Страница уже существует');

        return redirect()->route('urls', ['id' => $id]);
    }

    public function index()
    {
        $urls = DB::table('urls')->get();
        $arrayUrls = json_decode(json_encode($urls), true);
        return view('urls', ['urls' => $arrayUrls]);
    }

    public function domain($id)
    {
        $url = DB::table('urls')->where('id', $id)->first();
        $arrayUrl = json_decode(json_encode($url), true);
        return view('domain', ['url' => $arrayUrl]);
    }
}
