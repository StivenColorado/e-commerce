<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $price = $this->faker->numberBetween($min = 25000, $max = 1000000);
        return [
            'category_id' => $this->faker->randomElement([1, 2, 3]),
            'title' => $this->faker->sentence(),
            'stock' => $this->faker->randomDigit(),
            'price' => $price,
            'description' => $this->faker->paragraph(),
        ];
    }

    public function configure()
    {
        // despues de crear un proveedor, traerlo de la db y agregarle 8 productos a dicho proveedor
        return $this->afterCreating(function (Product $product) {
            $file = new File(['route' => '/storage/images/products/default.png']);
            $product->file()->save($file);
        });
    }
}
