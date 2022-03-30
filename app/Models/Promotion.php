<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property PromotionSetting $setting
 */
class Promotion extends Model
{
    use HasFactory;

    const CALCULATION_TYPE_FIX_AMOUNT = 0;
    const CALCULATION_TYPE_PERCENTAGE = 1;

    const GIVEN_ON_DEPOSIT = 0;
    const GIVEN_AFTER_TURNOVER_REACHED = 1;

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

    public static function getPromotionsOfCurrentWebsite(?Member $member = null)
    {
        return static::query()
            ->with('setting')
            ->ofCurrentWebsite()
            ->when($member, function ($query, $member) {
                $query->availableFor($member);
            })
            ->notExpired()
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

    public function scopeAvailableFor($query, Member $member)
    {
        $query->where('is_active', 1);
        $query->whereHas('setting', function ($query) use ($member) {

            $query->where(function ($query) use ($member) {
                $query->where('is_for_new_member_only', 0);
                if ($member->isNewMember()) {
                    $query->orWhere('is_for_new_member_only', 1);
                }
            });
        });
    }

    public function scopeNotExpired($query)
    {
        $query->whereHas('setting', function ($query) {
            $now = now()->format('Y-m-d H:i:s');
            $query->whereRaw("('{$now}' between promotion_settings.valid_from and promotion_settings.valid_thru)");
        });
    }

    public function getImagePlaceholderUrl()
    {
        return url('img/promotion-placeholder-image.png');
    }

    public function getImageUrlAttribute()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter */
        $storage = Storage::disk('public');

        return $this->image
            ? $storage->url($this->image)
            : $this->getImagePlaceholderUrl();
    }

    public function getImageThumbUrlAttribute()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter */
        $storage = Storage::disk('public');

        // TODO: replace with image_thumb
        return $this->image
            ? $storage->url($this->image)
            : $this->getImagePlaceholderUrl();
    }

    public function shouldIncludeBonusToCalculateObligation()
    {
        return $this->setting->is_include_bonus_to_calculate_obligation;
    }

    public function calculateBonusAmount($deposit)
    {
        if ($this->setting->calculation_type === static::CALCULATION_TYPE_FIX_AMOUNT) {
            return $this->setting->calculation_fix_amount;
        }

        if ($this->setting->calculation_type === static::CALCULATION_TYPE_PERCENTAGE) {
            return $deposit * $this->setting->calculation_rate;
        }

        return 0;
    }

    public function calculateObligationAmount($deposit)
    {
        $amount = $this->shouldIncludeBonusToCalculateObligation()
            ? $deposit + $this->calculateBonusAmount($deposit)
            : $deposit;

        return $amount * $this->setting->turn_over_obligation;
    }

    public function isGivenOnDeposit()
    {
        return $this->setting->given_method === static::GIVEN_ON_DEPOSIT;
    }

    public function isAutoRelease()
    {
        return $this->setting->is_auto_release;
    }

    public function isPromotionType($promotion_type)
    {
        return $this->setting->promotion_type === $promotion_type;
    }
}
