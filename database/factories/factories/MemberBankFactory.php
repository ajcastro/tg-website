<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\MemberBank;

class MemberBankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MemberBank::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'member_id' => Member::factory(),
            'account_name' => ucfirst($this->faker->word),
            'account_code' => $this->faker->randomNumber(4, true),
            'account_number' => $this->faker->randomNumber(4, true),
        ];
    }
}
