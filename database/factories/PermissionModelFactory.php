<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\permissionModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\permissionModel>
 */
class PermissionModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = permissionModel::class;
    public function definition(): array
    {
        return [
            'permissions_name' => $this->faker->unique()->word,
            'type' => $this->faker->randomElement(['permission', 'software', 'hardware', 'user']),
        ];
    }
}
