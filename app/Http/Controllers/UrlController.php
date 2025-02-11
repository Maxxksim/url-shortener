<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UrlController extends Controller
{
    public function createShortUrl(): RedirectResponse
    {
        request()->validate(['original_url' => 'required|url']);

        Url::create([
            'original_url' => request('original_url'),
            'short_url' => Url::generateShortUrl(str_replace(' ', '', request('custom_short_url'))),
            'session_id' => session()->getId(),
        ]);

        return redirect('/');
    }

    public function index(): View
    {
        return view('index', ['urls' => Url::getUrls()]);
    }

    public function redirectToOriginalUrl(Request $request): RedirectResponse
    {
        $url = Url::getUrl();

        $url->increment('count_visits');

        return redirect()->away($url->original_url);
    }

    public function deleteShortUrl(Url $url): RedirectResponse
    {
        $url->delete();

        return redirect('/');
    }


}
