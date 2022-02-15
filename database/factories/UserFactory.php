<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genders = ['Male', 'Female'];
        $gender_id = rand(1, 2);
        $role_id = rand(1, 2);;
        return [
            'role_id' => $role_id,
            'gender_id' => $gender_id,
            'first_name' => $this->faker->title($genders[$gender_id - 1]),
            'middle_name' => $this->faker->firstName($genders[$gender_id - 1]),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'display_picture_link' => '',
            'delete_flag' => 0,
            'modified_at' => now(),
            'modified_by' => 'Admin',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
