<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Show extends Model
{
    protected $fillable = [
        'id_product',
        'amount',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id_user', 'id');
    // }
}
