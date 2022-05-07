<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
