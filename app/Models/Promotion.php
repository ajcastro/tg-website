<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'title',
        'short_description',
        'description',
        'sort_order',
        'imgloc',
        'slug',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public static function getPromotionsOfCurrentWebsite()
    {
        return static::ofCurrentWebsite()
            ->orderBy('sort_order')
            ->get();
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function setting()
    {
        return $this->hasOne(PromotionSetting::class);
    }

    public function promotionSetting()
    {
        return $this->hasOne(PromotionSetting::class);
    }
    public function scopeOfCurrentWebsite($query)
    {
        $query->where('website_id', Website::getWebsiteId());
    }
}
