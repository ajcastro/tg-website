<?php

namespace App\Services\Game4D;

use App\Services\Game4D\Game4DHttpFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'flag_url',
        'date',
        'result',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
    ];

    public static function getDisplayableMarkets()
    {
        return remember('game4d.market_results', now()->addMinutes(5), function () {
            $api = Game4DHttpFactory::instance();
            $results = $api->getMarketResults();

            return collect($results)->map(function ($result) {
                return new Market($result);
            })->filter(function ($market) {
                return filled($market->result);
            })->values();
        });
    }
}
