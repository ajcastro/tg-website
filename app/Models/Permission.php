<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    use HasFactory, Traits\HasAllowableFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public static function booted()
    {
        static::creating(function (Permission $permission) {
            $permission->name = $permission->name ?? Str::slug($permission->label, '_');
        });
    }

    public function getGroupAttribute()
    {
        [$group] = explode('.', $this->name);

        return $group;
    }

    public function getGroupDisplayAttribute()
    {
        return Str::title($this->group);
    }
}
