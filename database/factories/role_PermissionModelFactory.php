<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\role_permissionModel>
 */
class role_PermissionModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 1000), // Assuming IDs are between 1 and 1000
            'role_name' => $this->faker->word,
            'permission_name' => $this->faker->word, // Assuming permission IDs are between 1 and 20
            'assigned_at' => now(),
        ];
    }
}
