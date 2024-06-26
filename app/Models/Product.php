<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'stock',
        'price',
        'description',
    ];

    protected $appends = ['format_description', 'formatted_price'];
    public function formatDescription(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return Str::limit($attributes['description'], 80, '...');
            },
            // set:fn ($value) => Str::upper($value)
        );
    }

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 0, ',', '.');
    }

    public function getDiscountAttribute(){
        return $this->price + rand(20000,100000);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class, 'id_product', 'id');
    }
    public function shows()
    {
        return $this->hasMany(ShoppingCart::class, 'id_product', 'id');
    }
    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
