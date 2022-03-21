<?php

namespace App\Models\Traits;

use App\Models\Contracts\AccessibleByUser;
use App\Models\Contracts\RelatesToWebsite;
use App\Models\Website;

/**
 * @method static \Illuminate\Database\Eloquent\Builder applyAccessibilityFilter($request = null)
 */
trait AccessibilityFilter
{
    public function scopeApplyAccessibilityFilter($query, $request = null)
    {
        $request = $request ?? request();

        if ($this->shouldQueryByWebsiteRelation($query, $request)) {
            $query->ofWebsite(id_to_model(Website::class, $request->input('website_selector_website_id')));
        }

        if ($this->implementsAccessibleBy($query)) {
            $query->accessibleBy($request->user());
        }
    }

    protected function shouldQueryByWebsiteRelation($query, $request)
    {
        $model = $query->getModel();
        return $model instanceof RelatesToWebsite && filled($request->input('website_selector_website_id'));
    }

    protected function implementsAccessibleBy($query)
    {
        $model = $query->getModel();
        return $model instanceof AccessibleByUser;
    }
}
