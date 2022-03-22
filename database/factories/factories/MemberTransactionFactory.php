<?php

namespace Database\Factories;

use App\Enums\MemberTransactionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\MemberTransaction;
use App\Models\Type;
use App\Models\User;
use App\Models\Website;

class MemberTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MemberTransaction::class;

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
            'type' => $this->faker->randomElement(['deposit', 'withdraw']),
            'is_adjustment' => $this->faker->boolean(),
            'account_code' => $this->faker->word(),
            'account_name' => $this->faker->word(),
            'account_number' => $this->faker->word(),
            'company_bank' => $this->faker->word(),
            'company_bank_factor' => $this->faker->randomFloat(2, 0, 20.00),
            'amount' => $this->faker->randomFloat(2, 0, 10000.00),
            'credit_amount' => function ($data) {
                return $data['type'] === 'deposit' ? $data['amount'] : 0;
            },
            'debit_amount' => function ($data) {
                return $data['type'] === 'withdraw' ? $data['amount'] : 0;
            },
            'remarks' => $this->faker->words(3, true),
            'status' => $this->faker->randomElement([
                MemberTransactionStatus::NEW,
                MemberTransactionStatus::APPROVED,
                MemberTransactionStatus::REJECTED,
                MemberTransactionStatus::IN_PROGRESS,
            ]),
            'member_ip' => $this->faker->ipv4(),
            'member_info' => $this->faker->words(3, true),
            'screenshot_name' => $this->faker->word.'.png',
            'screenshot_path' => $this->faker->imageUrl(),
            'approved_by_id' => User::factory(),
            'approved_at' => $this->faker->dateTime(),
        ];
    }
}
