<?php

namespace App\Models;

use App\Enums\MemberTransactionStatus;
use App\Models\Contracts\RelatesToWebsite;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class MemberTransaction extends Model implements RelatesToWebsite
{
    use HasFactory, Traits\HasAllowableFields, Traits\RelatesToWebsiteTrait, Traits\AccessibilityFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'member_id',
        'type',
        'is_adjustment',
        'account_code',
        'account_name',
        'account_number',
        'company_bank',
        'company_bank_factor',
        'amount',
        'credit_amount',
        'debit_amount',
        'remarks',
        'status',
        'member_ip',
        'member_info',
        'screenshot_name',
        'screenshot_path',
        'approved_by_id',
        'approved_at',
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
        'type' => 'string',
        'is_adjustment' => 'boolean',
        'company_bank_factor' => 'decimal:2',
        'amount' => 'decimal:2',
        'credit_amount' => 'decimal:2',
        'debit_amount' => 'decimal:2',
        'status' => 'integer',
        'approved_by_id' => 'integer',
        'approved_at' => 'timestamp',
    ];

    protected $attributes = [
        'status' => MemberTransactionStatus::NEW
    ];


    public static function booted()
    {
        static::creating(function (MemberTransaction $transaction) {
            $transaction->website_id = $transaction->website_id ?? Website::getWebsiteId();
            $transaction->sequence = static::getNextSequence($transaction->type, $transaction->website_id);
        });
    }

    public static function getNextSequence($type, $website_id)
    {
        return static::where(['type' => $type, 'website_id' => $website_id])
            ->orderByDesc('created_at')
            ->value('sequence')+1;
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->whereHas('member', function ($query) use ($search) {
                $query->where('members.username', 'like', "%{$search}%");
            });
            $query->orWhere('company_bank', 'like', "%{$search}%");
        });
    }

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->where('website_id', $website->id);
    }

    public function scopeOfTicketId(Builder|QueryBuilder $query, $ticket_id)
    {
        [$type, $website_id, $sequence] = static::destructTicketId($ticket_id);

        $query->where('type', $type)
            ->where('website_id', $website_id)
            ->where('sequence', $sequence);
    }

    public static function destructTicketId($ticket_id)
    {
        $prefix = $ticket_id[0] ?? null;
        $type = is_null($prefix) || !in_array(strtoupper($prefix), ['D', 'W'])
            ? null
            : (strtoupper($prefix) === 'D' ? 'deposit' : 'withdraw');
        $websiteId = (int) substr($ticket_id, 1, 4);
        $sequence = (int) last(explode('-', $ticket_id));

        return [$type, $websiteId, $sequence];
    }

    public static function parseToTicketId($type, $websiteId, $sequence)
    {
        $prefix = $type === 'deposit' ? 'D' : 'W';

        $websiteId = num_zero_pad($websiteId, 4);

        $sequence = num_zero_pad($sequence, 6);

        return "{$prefix}{$websiteId}-{$sequence}";
    }

    public function getTicketIdAttribute()
    {
        return static::parseToTicketId($this->type, $this->website_id, $this->sequence);
    }

    public function setAmountAttribute($amount)
    {
        $this->attributes['amount'] = $amount;

        if ($this->type === 'deposit') {
            $this->attributes['credit_amount'] = $amount;
        } else {
            $this->attributes['debit_amount'] = $amount;
        }
    }

    public function getStatusDisplayAttribute()
    {
        if ($this->status === MemberTransactionStatus::NEW) {
            return 'New';
        }

        if ($this->status === MemberTransactionStatus::APPROVED) {
            return 'Approved';
        }

        if ($this->status === MemberTransactionStatus::REJECTED) {
            return 'Rejected';
        }

        if ($this->status === MemberTransactionStatus::IN_PROGRESS) {
            return 'In-progress';
        }
    }

    public function approve($user)
    {
        $this->status = MemberTransactionStatus::APPROVED;
        $this->approved_by_id = $user->id;
        $this->approved_at = now();
        $this->save();
    }

    public function reject($user)
    {
        $this->status = MemberTransactionStatus::REJECTED;
        $this->approved_by_id = $user->id;
        $this->approved_at = now();
        $this->save();
    }
}
