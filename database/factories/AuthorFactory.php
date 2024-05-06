<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    protected $model = Author::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'biography' => $this->faker->paragraph()
        ];
    }

    //metodo de factory
    public function configure(){
        // despues de crear un autor, traerlo de la db y agregarle 8 libros a dicho autor
        return $this->afterCreating(function (Author $author){
            Product::factory(8)->authorId($author)->create();
        });
    }
}
