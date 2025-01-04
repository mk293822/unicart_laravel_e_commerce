<?php

namespace Database\Factories;

use App\Models\OrderedProducts;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $orderStatuses = [
            'pending',  // Order placed but not yet processed.
            'processing',  // Payment confirmed, order being prepared.
            'shipped',  // Order has been shipped.
            'completed',  // Order has been successfully delivered.
            'cancelled',  // Order was cancelled by customer or due to stock issues.
            'refunded',  // Order refunded due to returns or issues.
            'failed'  // Payment or processing failed.
        ];

        return [
            "user_id" => 1,
            "status" => $this->faker->randomElement(array: $orderStatuses),
        ];
    }
}