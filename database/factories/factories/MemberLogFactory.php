<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\MemberLog;
use App\Models\Website;

class MemberLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MemberLog::class;

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
            'activity' => $this->faker->word,
            'ip_address' => $this->faker->ipv4,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'isp' => $this->faker->word,
            'login_date' => $this->faker->dateTime(),
            'kicked_at' => $this->faker->dateTime(),
        ];
    }
}
