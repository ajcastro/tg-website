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
    ];

    protected $appends = [
        'is_require_account_no',
    ];


    public static function getBanksOfCurrentWebsite()
    {
        return memo(__METHOD__, function () {
            return static::query()
                ->orderBy('code')
                ->get();
        });
    }

    public function bankGroup()
    {
        return $this->belongsTo(BankGroup::class, 'bank_group_id');
    }

    public function getIsRequireAccountNoAttribute()
    {
        return $this->bankGroup->is_require_account_no ?? false;
    }
}
