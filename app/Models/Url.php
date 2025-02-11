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

    public static function generateShortUrl(?string $custom_short_url): string
    {

        if (empty($custom_short_url)) {
            return url(Str::random(3));
        }

        if (self::where('short_url', url($custom_short_url))->exists()) {
            throw ValidationException::withMessages([
                'custom_short_url' => 'The short URL already exists',
            ]);
        }

        return url($custom_short_url);

    }


    public static function getUrls()
    {
        return self::all()->where('session_id', session()->getId())->sortByDesc('created_at');
    }

    public static function getUrl(): Url
    {
        if (!$url = self::where('short_url', request()->fullUrl())->first()) {
            abort(404);
        }
        return $url;
    }

}
