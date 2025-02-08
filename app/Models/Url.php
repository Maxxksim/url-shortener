<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Url extends Model
{

    protected $fillable = [
        'original_url',
        'short_url',
        'session_id',
    ];

    public static function generateShortUrl(): string
    {
        return url(Str::random(3));
    }


    public static function getUrls()
    {
        return self::all()->where('session_id', session()->getId())->sortByDesc('created_at');
    }

    public static function getOriginalUrl(Request $request): string
    {
        return self::where('short_url', request()->fullUrl())->first()->original_url;
    }


}
