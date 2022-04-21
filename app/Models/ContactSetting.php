<?php

namespace App\Models;

use App\Models\Contracts\RelatesToWebsite;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class ContactSetting extends Model implements RelatesToWebsite
{
    use HasFactory, Traits\AccessibilityFilter, Traits\HasAllowableFields, Traits\SetActiveStatus;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'title',
        'value',
        'is_active',
        'is_shown',
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
        'is_shown' => 'boolean',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->where('website_id', $website->id);
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%");
            $query->orWhere('value', 'like', "%{$search}%");
        });
    }

    public function scopeForCurrentWebsite($query)
    {
        $query->where('website_id', Website::getWebsiteId());
    }

    public function scopeOnlyDisplayable($query)
    {
        $query->where('is_active', 1);
        $query->where('is_shown', 1);
    }
}
