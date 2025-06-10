<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\rolesModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\rolesModel>
 */
class RoleModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = rolesModel::class;
    public function definition(): array
    {
        return [
            "role_name"=> $this->faker->word,
            'assigned_at' => now(),
        ];
    }
}
