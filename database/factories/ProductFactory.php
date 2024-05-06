<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function authorId($author)
    {
        return $this->state(
            [
                'author_id' => $author->id
            ]
        );
    }
    public function definition()
    {
        return [
            'category_id' => $this->faker->randomElement([1, 2, 3]),
            'title' => $this->faker->sentence(),
            'stock' => $this->faker->randomDigit(),
            'description' => $this->faker->paragraph(),

        ];
    }
    public function configure(){
        // despues de crear un autor, traerlo de la db y agregarle 8 productos a dicho autor
        return $this->afterCreating(function (Product $product){
            $file = new File(['route'=> '/storage/images/products/default.png']);
            $product->file()->save($file);
        });
    }
}
