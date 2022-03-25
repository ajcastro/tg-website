<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'promotion_id',
        'valid_from',
        'valid_until',
        'given_method',
        'is_for_new_member_only',
        'promotion_type',
        'allowed_n_times',
        'calculation_type',
        'calculation_fix_amount',
        'calculation_rate',
        'turn_over_obligation',
        'is_include_bonus_to_calculate_obligation',
        'min_deposit',
        'max_given_count',
        'max_given_amount',
        'is_auto_release',
        'is_lock_withdrawal',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'promotion_id' => 'integer',
        'valid_from' => 'timestamp',
        'valid_until' => 'timestamp',
        'is_for_new_member_only' => 'boolean',
        'promotion_type' => 'integer',
        'allowed_n_times' => 'integer',
        'calculation_type' => 'integer',
        'calculation_fix_amount' => 'integer',
        'calculation_rate' => 'decimal:2',
        'turn_over_obligation' => 'integer',
        'is_include_bonus_to_calculate_obligation' => 'boolean',
        'min_deposit' => 'decimal:2',
        'max_given_count' => 'integer',
        'max_given_amount' => 'decimal:2',
        'is_auto_release' => 'boolean',
        'is_lock_withdrawal' => 'boolean',
    ];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
