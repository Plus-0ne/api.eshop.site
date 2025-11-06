<?php

namespace Database\Factories;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    protected $model = UserDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'user_uuid' => Str::uuid()->toString(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'middle_name' => $this->faker->optional()->firstName(),
            'display_name' => Str::random(11),
            'deleted_at' => null,
        ];
    }
}
