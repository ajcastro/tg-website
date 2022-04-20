<?php

namespace App\Models;

use App\Models\Contracts\RelatesToWebsite;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Str;

class PageContent extends Model implements RelatesToWebsite
{
    use HasFactory, Traits\AccessibilityFilter, Traits\HasAllowableFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'short_description',
        'url',
        'is_shown',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'content',
        'is_footer_displayed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'is_shown' => 'boolean',
        'is_footer_displayed' => 'boolean',
    ];


    public static function findBySlug($slug): ?PageContent
    {
        return static::where('url', $slug)
            ->where('is_shown', 1)
            ->first();
    }

    public static function findBySlugOrFail($slug): PageContent
    {
        return static::where('url', $slug)
            ->where('is_shown', 1)
            ->firstOrFail();
    }

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
            $query->where('short_description', 'like', "%{$search}%");
            $query->orWhere('url', 'like', "%{$search}%");
        });
    }

    public function getKeywords(): array
    {
        return Str::of($this->meta_keyword)->explode(',')->all();
    }

    public function registerSeoTags()
    {
        SEOTools::setTitle($this->short_description);
        SEOTools::setDescription($this->meta_description);
        SEOTools::opengraph()->setUrl(url($this->url ?? ''));
        SEOMeta::addKeyword($this->getKeywords());
    }
}
