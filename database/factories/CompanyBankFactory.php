<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CompanyBank;
use App\Models\Website;

class CompanyBankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyBank::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'bank_type' => $this->faker->randomElement(['deposit', 'withdraw']),
            'bank_code' => $this->faker->word,
            'bank_acc_no' => $this->faker->word,
            'bank_acc_name' => $this->faker->word,
            'is_active' => $this->faker->boolean,
            'is_auto_update_balance' => $this->faker->boolean,
            'bank_factor' => $this->faker->randomFloat(2, 10, 100),
            'min_amount' => $this->faker->randomNumber(),
            'max_amount' => $this->faker->randomNumber(),
        ];
    }
}
