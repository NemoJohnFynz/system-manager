<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\routePermissionModel>
 */
class routePermissionModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\routePermissionModel::class;
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique(),
            'permissions_name' => $this->faker->unique()->word,
            'route_name' => $this->faker->unique()->word,
            
        ];
    }
}
