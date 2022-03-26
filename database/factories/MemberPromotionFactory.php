<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\MemberPromotion;
use App\Models\Promotion;
use App\Models\Website;

class MemberPromotionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MemberPromotion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'member_id' => Member::factory(),
            'promotion_id' => Promotion::factory(),
            'deposit_date' => $this->faker->dateTime(),
            'expire_date' => $this->faker->word,
            'deposit_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'bonus_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'obligation_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'turn_over_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
        ];
    }
}
