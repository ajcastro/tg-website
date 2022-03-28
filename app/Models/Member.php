<?php

namespace App\Models;

use App\Enums\MemberLevel;
use App\Enums\MemberTransactionStatus;
use App\Enums\WarningStatus;
use App\Http\Queries\MemberQuery;
use App\Models\Contracts\RelatesToWebsite;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Member extends Authenticatable implements RelatesToWebsite
{
    use HasFactory, Traits\HasAllowableFields, Traits\RelatesToWebsiteTrait, Traits\AccessibilityFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'upline_referral_id',
        'referral_number',
        'username',
        'password',
        'email',
        'phone_number',
        'member_level',
        'bank_group',
        'balance_amount',
        'balance_credit',
        'warning_status',
        'warning_notes',
        'redeem_point',
        'total_deposit',
        'total_withdrawal',
        'rebate_group',
        'login_time',
        'logout_time',
        'suspended_at',
        'suspended_by_id',
        'suspended_reason',
        'blacklisted_at',
        'blacklisted_by_id',
        'blacklisted_reason',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'upline_referral_id' => 'integer',
        'member_level' => 'integer',
        'balance_amount' => 'decimal:2',
        'balance_credit' => 'decimal:2',
        'warning_status' => 'integer',
        'total_deposit' => 'decimal:2',
        'total_withdrawal' => 'decimal:2',
        'login_time' => 'datetime',
        'logout_time' => 'datetime',
        'suspended_at' => 'datetime',
        'suspended_by_id' => 'integer',
        'blacklisted_at' => 'datetime',
        'blacklisted_by_id' => 'integer',
    ];


    public static function booted()
    {
        static::creating(function (Member $member) {
            $member->website_id = Website::getWebsiteId();
            $member->referral_number = $member->referral_number ?? static::generateReferralCode();
        });
    }

    public static function kickAll()
    {
        return MemberLog::whereNull('kicked_at')->update([
            'kicked_at' => now(),
        ]);
    }

    public static function generateReferralCode()
    {
        return Website::getWebsiteId().Str::random(8);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function uplineReferral()
    {
        return $this->belongsTo(Member::class);
    }

    public function referrals()
    {
        return $this->hasMany(Member::class, 'upline_referral_id');
    }

    public function suspendedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function blacklistedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function banks()
    {
        return $this->hasMany(MemberBank::class);
    }

    public function transactions()
    {
        return $this->hasMany(MemberTransaction::class);
    }

    public function memberPromotions()
    {
        return $this->hasMany(MemberPromotion::class);
    }

    public function activeLog()
    {
        return $this->hasOne(MemberLog::class)->whereNull('kicked_at');
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%");
            $query->orWhere('referral_number', 'like', "%{$search}%");
            $query->orWhere('email', 'like', "%{$search}%");
            $query->orWhere('phone_number', 'like', "%{$search}%");
        });
    }

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->where('website_id', $website->id);
    }

    public function isNewMember()
    {
        return $this->is_new_member;
    }

    public function incrementBalanceAmount($amount)
    {
        static::where('id', $this->id)
            ->increment('balance_amount', $amount);
    }

    public function decrementBalanceAmount($amount)
    {
        static::where('id', $this->id)
            ->decrement('balance_amount', $amount);
    }

    public function getCurrentBalance()
    {
        return $this->balance_amount;
    }

    public function getMemberLevelDisplayAttribute()
    {
        if ($this->member_level === MemberLevel::Regular) {
            return 'Regular';
        }

        if ($this->member_level === MemberLevel::VIP) {
            return 'VIP';
        }

        if ($this->member_level === MemberLevel::VVIP) {
            return 'VVIP';
        }
    }

    public function getWarningStatusDisplayAttribute()
    {
        if ($this->warning_status === WarningStatus::NoWarning) {
            return '';
        }

        if ($this->warning_status === WarningStatus::Suspend) {
            return 'Suspend';
        }

        if ($this->warning_status === WarningStatus::Blacklist) {
            return 'Blacklist';
        }
    }

    public function suspend($reason, $user = null)
    {
        $this->warning_status = WarningStatus::Suspend;
        $this->suspended_at = now();
        $this->suspended_by_id = $user->id ?? auth()->user()->id ?? 0;
        $this->suspended_reason = $reason;
        $this->save();
    }

    public function blacklist($reason, $user = null)
    {
        $this->warning_status = WarningStatus::Blacklist;
        $this->blacklisted_at = now();
        $this->blacklisted_by_id = $user->id ?? auth()->user()->id ?? 0;
        $this->blacklisted_reason = $reason;
        $this->save();
    }

    public function removeSuspension()
    {
        $this->warning_status = WarningStatus::NoWarning;
        $this->suspended_at = null;
        $this->suspended_by_id = null;
        $this->suspended_reason = null;
        $this->save();
    }

    public function countPromoUsage(Promotion $promotion)
    {
        return $this->memberPromotions()->where('member_promotions.promotion_id', $promotion->id)->count();
    }

    public function countPromoUsageForTheDay(Promotion $promotion, Carbon $date)
    {
        return $this->memberPromotions()->where('member_promotions.promotion_id', $promotion->id)
            ->whereDate('deposit_date', $date->format('Y-m-d'))
            ->count();
    }

    public function countPromoUsageForTheWeek(Promotion $promotion, Carbon $date)
    {
        return $this->memberPromotions()->where('member_promotions.promotion_id', $promotion->id)
            ->whereRaw('WEEK(deposit_date)', $date->weekOfYear)
            ->count();
    }

    public function countPromoUsageForTheMonth(Promotion $promotion, Carbon $date)
    {
        return $this->memberPromotions()->where('member_promotions.promotion_id', $promotion->id)
            ->whereRaw('MONTH(deposit_date)', $date->month)
            ->count();
    }
}
