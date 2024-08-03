<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->productName;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description'=> $this->faker->paragraph,
            'price'=> $this->faker->randomFloat(1,100,1000),
            'compare_price'=> $this->faker->randomFloat(1,1000,10000),
            'category_id' => Category::all()->random()->id,
            'store_id' => Store::all()->random()->id,
            
        ];
    }
}
