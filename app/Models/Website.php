<?php

namespace App\Models;

use App\Http\Queries\WebsiteQuery;
use App\Models\Contracts\AccessibleByUser;
use App\Observers\SetsCreatedByAndUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model implements AccessibleByUser
{
    use HasFactory, Traits\HasAllowableFields, Traits\SetActiveStatus, Traits\AccessibilityFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'assigned_client_id',
        'ip_address',
        'domain_name',
        'remarks',
        'is_active',
        'created_by_id',
        'updated_by_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'assigned_client_id' => 'integer',
        'is_active' => 'boolean',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
    ];

    protected $attributes = [
        'is_active' => 1,
    ];

    public static function booted()
    {
        static::observe(SetsCreatedByAndUpdatedBy::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return (new WebsiteQuery)
            ->withFields()
            ->withInclude()
            ->withFilter()
            ->findOrFail($value);
    }

    public function parentGroups()
    {
        return $this->belongsToMany(ParentGroup::class, 'parent_groups_websites');
    }

    public function assignedClient()
    {
        return $this->belongsTo(Client::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        $query->where('code', 'like', "%{$search}%");
    }

    public function scopeAccessibleBy($query, User $user)
    {
        $query->where('assigned_client_id', $user->parentGroup->client_id);
    }
}
