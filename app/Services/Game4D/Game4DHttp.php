<?php

namespace App\Services\Game4D;

class Game4DHttp
{
    protected $http;

    public function __construct($http)
    {
        $this->http = $http;
    }

    public function getMarketResults()
    {
        $response = $this->http->get('/api/gamesite/market_results');

        return $response->json();
    }
}
