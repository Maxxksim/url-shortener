<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Url extends Model
{

    protected $fillable = [
        'original_url',
        'short_url',
        'session_id',
        'count_visits',
    ];

    public static function generateShortUrl(?string $custom_short_url = null): string
    {
        if ($custom_short_url) {

            if (static::existsUrl($custom_short_url)) {
                throw ValidationException::withMessages(['custom_short_url' => 'The short URL already exists',]);
            }

            return url($custom_short_url);
        }

        if (static::existsUrl($short_url = Str::random(3))) {
            return static::generateShortUrl();
        }

        return url($short_url);
    }


    private static
    function existsUrl(string $url): bool
    {
        return self::where('short_url', url($url))->exists();
    }


    public
    static function getUrls()
    {
        return self::all()->where('session_id', session()->getId())->sortByDesc('created_at');
    }

    public
    static function getUrl(): Url
    {
        if (!$url = self::where('short_url', request()->fullUrl())->first()) {
            abort(404);
        }
        return $url;
    }

}
