<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'biography',
    ];

    public function Product()
    {
        return $this->hasMany(Product::class, 'author_id', 'id');
    }
}
