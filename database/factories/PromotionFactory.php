<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Promotion;
use App\Models\Website;

class PromotionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promotion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'title' => $this->faker->sentence(4),
            'short_description' => $this->faker->word,
            'description' => $this->faker->text,
            'sort_order' => $this->faker->randomDigitNotNull,
            'imgloc' => $this->faker->word,
            'slug' => $this->faker->slug,
            'is_active' => $this->faker->boolean,
        ];
    }
}
