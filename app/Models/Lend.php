<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lend extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_user_id',
        'owner_user_id',
        'product_id',
        'date_out',
        'date_in',
        'status',
    ];

    public function lends()
    {
        return $this->belongsTo(Product::class, '_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_user_id', 'id');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_user_id', 'id');
    }


}
