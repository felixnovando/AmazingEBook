<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $accountCount = 6;
        $ebookCount = 20;
        return [
            'user_id' => rand(1, $accountCount),
            'ebook_id' => rand(1, $ebookCount),
            'order_date' => now()
        ];
    }
}
