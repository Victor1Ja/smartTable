<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'order_id',
        'menuItem_id',
        'quantity',
        'status',
        // 'specialRequests', // Uncomment if special requests are required
    ];



    // Define the relationship with the RestaurantTable model
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menuItem_id');
    }
}
