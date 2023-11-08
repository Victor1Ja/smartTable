<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'menu_items';

    // Define the primary key field
    protected $primaryKey = 'ItemID';
    
    // Define the fillable fields for mass assignment
    protected $fillable = [
        'RestaurantID',
        'Name',
        'Description',
        'Price',
        'Category',
        'Image',
    ];
    
    // Define the relationship with the Restaurant model
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'RestaurantID');
    }
}
