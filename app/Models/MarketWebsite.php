<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class MarketWebsite extends Model implements Contracts\RelatesToWebsite
{
    use HasFactory, Traits\HasAllowableFields, Traits\AccessibilityFilter;

    const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'market_id',
        'website_id',
        'period',
        'result_day',
        // 'off_day', not fillable, auto-filled by the diff of result_day and static::DAYS
        'close_time',
        'result_time',
        'updated_by_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'market_id' => 'integer',
        'website_id' => 'integer',
        'updated_by_id' => 'integer',
        'result_day' => 'array',
        'off_day' => 'array',
        'is_result_day_everyday' => 'boolean',
        'is_off_day_everyday' => 'boolean',
    ];


    public static function booted()
    {
        static::saving(function (MarketWebsite $marketWebsite) {
            $marketWebsite->updated_by_id = auth()->user()->id ?? 1;
            $marketWebsite->is_result_day_everyday = static::isEveryday($marketWebsite->result_day);
            $marketWebsite->is_off_day_everyday = static::isEveryday($marketWebsite->off_day);
        });
    }

    public static function sortDays($days)
    {
        $flippedDays = array_flip(static::DAYS);
        return collect($days)->sortBy(function ($day) use ($flippedDays) {
            return $flippedDays[$day];
        })
        ->values()
        ->all();
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->where('website_id', $website->id);
    }

    public function scopeSearch($query, $search)
    {
        $query->whereHas('market', function ($query) use ($search) {
            $query->where('markets.code', 'like', "%{$search}%");
            $query->orWhere('markets.name', 'like', "%{$search}%");
        });
    }

    public function setResultDayAttribute($value)
    {
        $result_day = static::sortDays($value);
        $off_day = collect(static::DAYS)->diff($result_day)->values()->all();

        $this->attributes['result_day'] = json_encode($result_day);
        $this->attributes['off_day'] = json_encode($off_day);
    }

    public static function isEveryday($days)
    {
        return static::sortDays($days) === static::DAYS;
    }
}
