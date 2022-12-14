<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class ProductsFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'productId' => uniqid(),
			'shop_id' => 1,
			// 'name' => fake()->word(),
			'img_showcase' => 'woggy_alright.png',
			'img' => [
				'woggy_angry.png',
				'woggy_complain.png',
				'woggy_cool.png',
			],
			'category' => 'null',
			'price' => 1200,
			'is_variant' => 0,
			'cart_max_quantity' => 50,
			'description' => 'test product description',
			'details' => [
				'speficications' => [
					'dimensions' => '120mm',
					'decibels' => '100db',
				],
				'transfer_method' => [
					'delivery',
					'pick-up',
					'meet-up',
				],
				'payment_method' => [
					'cash',
					'online',
				],
				'condition' => 'new',
			],

		];
	}
}
