<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Website;

class WebsiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Website::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'assigned_client_id' => Client::factory(),
            'code' => Str::random(8),
            'ip_address' => $this->faker->ipv4(),
            'domain_name' => $this->faker->domainName(),
            'remarks' => $this->faker->word(),
            'is_active' => $this->faker->boolean(),
            'created_by_id' => User::factory(),
            'updated_by_id' => User::factory(),
        ];
    }
}
