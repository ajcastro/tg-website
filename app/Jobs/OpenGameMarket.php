<?php

namespace App\Jobs;

use App\Models\GameMarket;
use App\Models\Market;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OpenGameMarket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $today = now();
        $markets = $this->getMarketsForToday($today);

        foreach ($markets as $market) {
            $gameMarket = GameMarket::from($market->marketWebsite, $today);
            $gameMarket->save();
        }
    }

    private function getMarketsForToday($today)
    {
        return Market::marketsForToday($today)
            ->with('marketWebsite')
            ->get();
    }
}
