<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'orderID',
        'menuItemID',
        'quantity',
        // 'specialRequests', // Uncomment if special requests are required
    ];



    // Define the relationship with the RestaurantTable model
    public function order()
    {
        return $this->belongsTo(Orders::class, 'orderID');
    }
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menuItemID');
    }
}
