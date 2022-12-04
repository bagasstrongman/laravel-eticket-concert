<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $translate = config()->get('language.list');

        if (empty($translate)) {
            throw new \Exception('Error: config/language.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        return [
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'language' => fake()->randomElement($translate),
            'password' => 'password'
        ];
    }
}
