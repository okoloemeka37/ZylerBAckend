<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        
        return [
            'user_id'=>1,
            'name' => fake()->name(),
            'Description'=>fake()->sentence,
            'price'=>fake()->randomFloat(2,5,500),
            'stock'=>fake()->numberBetween(40,100),
            'gender'=>fake()->randomElement(['Male','Female','Unisex','Babies']),
            'tag'=>fake()->randomElement(["Hats","Scarves","Belts","Bags","Jewelry"]),
            'category'=>'Accessories',
            'image'=>fake()->randomElement(['071e9d15-35c8-492f-a267-1df1fdda3721.jpeg','0a86b3be-5a90-49eb-95b7-e2013f27e766.jpeg','0b3d2697-807a-46f8-88d2-dbda89a589ef.jpg'])
        ];
    }
//php artisan db:seed --class=DatabaseSeeder
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
