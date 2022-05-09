<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder marketsForToday($today)
 * @property MarketWebsite $marketWebsite
 */
class Market extends Model
{
    use HasFactory, Traits\HasAllowableFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    /**
     * This is a hasOne relation in conjunction with a website.
     */
    public function marketWebsite()
    {
        return $this->hasOne(MarketWebsite::class);
    }

    /**
     * This is a hasOne relation in conjunction with a website.
     */
    public function limitSetting()
    {
        return $this->hasOne(MarketLimitSetting::class)->withDefault();
    }

    public function scopeMarketsForToday($query, $today)
    {
        $dayOfWeekInText = carbon($today)->format('l');

        $query->whereHas('marketWebsite', function ($query) use ($dayOfWeekInText) {
            $query->where('is_result_day_everyday', 1);
            $query->orWhere('result_day', 'like', '%'.$dayOfWeekInText.'%'); // TODO: change to json query later
        });
    }
}
