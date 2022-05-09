<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GameMarket extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'game4d';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'market_code',
        'market_period',
        'period',
        'close_time',
        'result_time',
        'market_result',
        // 'result_day', # this is automatically set base from market_period date
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'market_period' => 'date',
        'period' => 'integer',
        'close_time' => 'datetime',
        'result_time' => 'datetime',
        'result_day' => 'integer',
    ];


    public static function booted()
    {
        static::saving(function (GameMarket $gameMarket) {
            $gameMarket->result_day = $gameMarket->market_period->dayOfWeek;
        });
    }

    public static function from(MarketWebsite $marketWebsite, $market_period): static
    {
        return new static([
            'market_code' => $marketWebsite->market->code,
            'market_period' => $market_period,
            'period' => static::getNextPeriod($marketWebsite->market->code),
            'close_time' => $marketWebsite->close_time,
            'result_time' => $marketWebsite->result_time,
            'market_result' => null,
        ]);
    }

    public static function getNextPeriod($market_code)
    {
        return static::where('market_code', $market_code)
            ->value(DB::raw('max(period)')) + 1;
    }
}
