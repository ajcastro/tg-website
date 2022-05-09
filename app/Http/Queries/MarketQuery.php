<?php

namespace App\Http\Queries;

use App\Http\Queries\BaseQuery;
use App\Http\Queries\Contracts\QueryContract;
use App\Http\Queries\CustomSorts\SortBySub;
use App\Models\Bank;
use App\Models\BankGroup;
use App\Models\Market;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class MarketQuery extends BaseQuery implements QueryContract
{
    public function __construct()
    {
        parent::__construct(Market::query());
    }

    public function withFields()
    {
        $this->allowedFields([
            ...Market::allowableFields(),
        ]);

        return $this;
    }

    public function withInclude()
    {
        $this->allowedIncludes([
            'marketWebsite',
        ]);

        return $this;
    }

    public function withFilter()
    {
        // $this->allowedFilters([
        // ]);

        return $this;
    }

    public function withSort()
    {
        $this->allowedSorts([
            ...Market::allowableFields(),
        ]);

        return $this;
    }
}
