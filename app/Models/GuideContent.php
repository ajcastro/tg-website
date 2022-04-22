<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideContent extends Model
{
    use HasFactory, Traits\SetActiveStatus;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'guide_list_id',
        'content',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'guide_list_id' => 'integer',
        'is_active' => 'boolean',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function guideList()
    {
        return $this->belongsTo(GuideList::class);
    }
}
