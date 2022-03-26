<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    const CALCULATION_TYPE_FIX_AMOUNT = 0;
    const CALCULATION_TYPE_PERCENTAGE = 1;

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

    public function shouldIncludeBonusToCalculateObligation()
    {
        return $this->setting->is_include_bonus_to_calculate_obligation;
    }

    public function calculateBonusAmount($deposit)
    {
        if ($this->setting->calculation_type === static::CALCULATION_TYPE_FIX_AMOUNT) {
            return $this->calculation_fix_amount;
        }

        if ($this->setting->calculation_type === static::CALCULATION_TYPE_PERCENTAGE) {
            return $deposit * $this->calculation_rate;
        }

        return 0;
    }

    public function calculateObligationAmount($deposit)
    {
        if ($this->shouldIncludeBonusToCalculateObligation()) {
            return ($deposit + $this->calculateBonusAmount($deposit)) * $this->turn_over_obligation;
        }

        return $deposit * $this->turn_over_obligation;
    }
}
