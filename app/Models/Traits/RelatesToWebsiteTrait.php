<?php

namespace App\Models\Traits;

use App\Models\Website;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait RelatesToWebsiteTrait
{
    public function getParentGroupIdsFromWebsitesSubquery(Website $website)
    {
        return function (Builder|QueryBuilder $query) use ($website) {
            $sub = trim(<<<SQL
            select * from parent_groups where client_id in(
                select assigned_client_id from websites where websites.id={$website->id}
            )
            SQL);
            $query->select('id')
                ->fromSub($sub, 'parent_group_ids_from_websites');
        };
    }
}
