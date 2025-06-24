<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

protected $fillable = [
    'user_id',
    'name',
    'email',
    'phone',
    'address',
    'total_price',
    'payment_method',
    'status',
    'payment_proof',
    'no_resi',
   
];

    // Relasi ke User (jika ada)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}


    // Relasi ke Produk (jika ada)
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function items()
    {
    return $this->hasMany(OrderItem::class);
    }

}
