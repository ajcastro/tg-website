<?php

namespace App\Models;

use App\Http\Queries\ClientQuery;
use App\Models\Contracts\RelatesToWebsite;
use App\Observers\SetsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Client extends Model implements RelatesToWebsite
{
    use HasFactory, Traits\HasAllowableFields, Traits\SetActiveStatus, Traits\RelatesToWebsiteTrait, Traits\AccessibilityFilter;

    const DEFAULT_ID = 1;
    const DEFAULT_CODE = 'spvadmin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'remarks',
        'percentage_share',
        'created_by_id',
        'updated_by_id',
        'is_hidden',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'percentage_share' => 'decimal:2',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
        'is_active' => 'boolean',
        'is_hidden' => 'boolean',
    ];

    protected $attributes = [
        'is_active' => 1,
        'is_hidden' => 0,
    ];

    public static function booted()
    {
        static::observe(SetsCreatedByAndUpdatedBy::class);

        static::created(function (Client $client) {
            ParentGroup::create([
                'client_id' => $client->id,
                'code' => $client->code,
                'created_by_id' => $client->created_by_id,
                'updated_by_id' => $client->updated_by_id,
                'is_hidden' => $client->is_hidden,
            ]);
        });
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return (new ClientQuery)
            ->withFields()
            ->withInclude()
            ->withFilter()
            ->findOrFail($value);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function scopeSearch($query, $search)
    {
        $query->where('code', 'like', "%{$search}%");
    }

    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website)
    {
        $query->whereIn('clients.id', function (Builder|QueryBuilder $query) use ($website) {
            $query->select('assigned_client_id')
                ->from('websites')
                ->where('id', $website->id);
        });
    }
}
