<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberLog extends Model
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
        'activity',
        'ip_address',
        'country',
        'city',
        'isp',
        'login_date',
        'kicked_at',
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
        'login_date' => 'datetime',
        'kicked_at' => 'datetime',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
