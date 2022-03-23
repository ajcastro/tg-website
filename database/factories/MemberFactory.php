<?php

namespace Database\Factories;

use App\Enums\MemberLevel;
use App\Enums\WarningStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;
use App\Models\User;
use App\Models\Website;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'upline_referral_id' => null,
            'referral_number' => $this->faker->unique()->words(3, true),
            'username' => $this->faker->userName,
            'password' => bcrypt('password'),
            'email' => $this->faker->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'member_level' => $this->faker->numberBetween(MemberLevel::Regular, MemberLevel::VVIP),
            'bank_group' => $this->faker->word,
            'balance_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'balance_credit' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'warning_status' => $this->faker->numberBetween(WarningStatus::NoWarning, WarningStatus::Blacklist),
            'warning_notes' => $this->faker->word,
            'redeem_point' => $this->faker->numberBetween(-10000, 10000),
            'total_deposit' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'total_withdrawal' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'rebate_group' => $this->faker->word,
            'login_time' => $this->faker->dateTime(),
            'logout_time' => $this->faker->dateTime(),
            'suspended_at' => $this->faker->dateTime(),
            'suspended_by_id' => User::factory(),
            'suspended_reason' => $this->faker->text(),
            'blacklisted_at' => $this->faker->dateTime(),
            'blacklisted_by_id' => User::factory(),
            'blacklisted_reason' => $this->faker->text(),
        ];
    }
}
