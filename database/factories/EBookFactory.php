<?php

namespace Database\Factories;

use App\Models\EBook;
use Illuminate\Database\Eloquent\Factories\Factory;

class EBookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EBook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraph(mt_rand(4,12)),
        ];
    }
}
