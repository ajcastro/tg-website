<?php

namespace App\Services\Game4D;

use App\Models\Member;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Game4DHttpFactory
{
    protected static $token;

    protected static Game4DHttp $http;

    public static function instance(): Game4DHttp
    {
        return static::$http ?? static::$http = static::make();
    }

    public static function make(): Game4DHttp
    {
        $member = auth()->user();

        static::$token = static::getToken($member);

        $http = Http::withToken(static::$token)
            ->withHeaders(['Accept' => 'application/json'])
            ->baseUrl(config('services.game4d.url'));

        return new Game4DHttp($http);
    }

    public static function getToken(Member $member)
    {
        $isProduction = app()->isProduction();

        return remember("game4d.sanctum_token.{$member->id}", now()->addMinutes($isProduction ? 30 : 1), function () use ($member) {
            $response = Http::withHeaders(['Accept' => 'application/json'])
                ->post(config('services.game4d.url').'/api/gamesite/auth/login', [
                    'token' => $member->createToken('game4d_http')->plainTextToken, // TODO: expire tokens after 12 hours
                    'from_website_url' => url('/'),
                ]);

            $json = $response->json();

            return Arr::get($json, 'data.access_token');
        });
    }
}
