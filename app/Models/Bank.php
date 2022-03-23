<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'code',
        'group',
        'is_active',
        'is_require_account_no',
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
        'is_require_account_no' => 'boolean',
    ];

    public static function booted()
    {
        static::creating(function (Bank $bank) {
            $bank->website_id = $bank->website_id ?? Website::getWebsiteId();
        });
    }

    public static function getBanksOfCurrentWebsite()
    {
        return static::ofCurrentWebsite()
            ->orderBy('code')
            ->get();
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
