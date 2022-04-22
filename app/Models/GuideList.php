<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property GuideContent $guideContent
 */
class GuideList extends Model
{
    use HasFactory, Traits\HasAllowableFields, Traits\SetActiveStatus;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'category',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_active' => 'boolean',
    ];

    public function guideContent()
    {
        // hasOne in conjunction with a website_id selection
        return $this->hasOne(GuideContent::class)->withDefault();
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%");
            $query->orWhere('category', 'like', "%{$search}%");
        });
    }

    public function scopeOnlyActive($query)
    {
        $query->where('is_active', 1);
    }

    public function scopeEagerLoadGuideContentForWebsite($query, $websiteId)
    {
        $query->with(['guideContent' => function ($query) use ($websiteId) {
            $query->where('guide_contents.website_id', $websiteId);
        }]);
    }

    public function getContent()
    {
        return $this->guideContent->content;
    }
}
