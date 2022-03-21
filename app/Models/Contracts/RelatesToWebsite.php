<?php

namespace App\Models\Contracts;

use App\Models\Website;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

interface RelatesToWebsite
{
    public function scopeOfWebsite(Builder|QueryBuilder $query, Website $website);
}
