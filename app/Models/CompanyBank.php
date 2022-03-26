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

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
