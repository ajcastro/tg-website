<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBank extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'bank_type',
        'bank_code',
        'bank_acc_no',
        'bank_acc_name',
        'is_active',
        'is_auto_update_balance',
        'bank_factor',
        'min_amount',
        'max_amount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'is_active' => 'boolean',
        'is_auto_update_balance' => 'boolean',
        'bank_factor' => 'decimal:2',
        'min_amount' => 'integer',
        'max_amount' => 'integer',
    ];

    public static function getCompanyBanksOfCurrentWebsite($bank_type = null)
    {
        return memo([__METHOD__, $bank_type], function () use ($bank_type) {
            return static::ofCurrentWebsite()
                ->when($bank_type, function ($query, $bank_type)  {
                    $query->where('bank_type', $bank_type);
                })
                ->orderBy('bank_code')
                ->get();
        });
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function scopeOfCurrentWebsite($query)
    {
        $query->where('website_id', Website::getWebsiteId());
    }
}
