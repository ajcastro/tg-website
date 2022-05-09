<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\GameMarket;

class GameMarketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GameMarket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'market_code' => $this->faker->word,
            'market_period' => $this->faker->date(),
            'period' => $this->faker->randomNumber(),
            'close_time' => $this->faker->dateTime(),
            'result_time' => $this->faker->dateTime(),
            'market_result' => $this->faker->word,
            'result_day' => $this->faker->randomDigitNotNull,
        ];
    }
}
