<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'biography' => $this->faker->paragraph()
        ];
    }

    //metodo de factory
    public function configure(){
        // despues de crear un autor, traerlo de la db y agregarle 8 productos a dicho autor
        return $this->afterCreating(function (Supplier $supplier){
            Product::factory(8)->supplierId($supplier)->create();
        });
    }
}
