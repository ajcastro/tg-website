<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPromotion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'member_id',
        'promotion_id',
        'deposit_date',
        'expire_date',
        'deposit_amount',
        'bonus_amount',
        'obligation_amount',
        'turn_over_amount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'member_id' => 'integer',
        'promotion_id' => 'integer',
        'deposit_date' => 'timestamp',
        'deposit_amount' => 'decimal:2',
        'bonus_amount' => 'decimal:2',
        'obligation_amount' => 'decimal:2',
        'turn_over_amount' => 'decimal:2',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
