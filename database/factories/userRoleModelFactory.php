<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\userRoleModel;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\userRoleModel>
 */
class userRoleModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = userRoleModel::class;
    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->word,
            'role_name' => $this->faker->word,
            'assigned_at' => now(),
        ];
    }
}
