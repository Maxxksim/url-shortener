<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\View\View;

class UrlController extends Controller
{
    public function storeShortUrl(Request $request): RedirectResponse
    {
        $request->validate(['original_url' => 'required|url']);

        Url::create([
            'original_url' => request('original_url'),
            'short_url' => Url::generateShortUrl($request),
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
        return redirect()->away(Url::getOriginalUrl($request));
    }
}
