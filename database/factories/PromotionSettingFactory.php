<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Promotion;
use App\Models\PromotionSetting;

class PromotionSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PromotionSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'promotion_id' => Promotion::factory(),
            'valid_from' => $this->faker->dateTime(),
            'valid_until' => $this->faker->dateTime(),
            'given_method' => $this->faker->word,
            'is_for_new_member_only' => $this->faker->boolean,
            'promotion_type' => $this->faker->randomDigitNotNull,
            'allowed_n_times' => $this->faker->randomNumber(),
            'calculation_type' => $this->faker->randomDigitNotNull,
            'calculation_fix_amount' => $this->faker->randomNumber(),
            'calculation_rate' => $this->faker->randomFloat(2, 0, 9.99),
            'turn_over_obligation' => $this->faker->randomNumber(),
            'is_include_bonus_to_calculate_obligation' => $this->faker->boolean,
            'min_deposit' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'max_given_count' => $this->faker->randomNumber(),
            'max_given_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'is_auto_release' => $this->faker->boolean,
            'is_lock_withdrawal' => $this->faker->boolean,
        ];
    }
}
