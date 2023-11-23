<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'restaurant_tables';

    // Define the primary key field
    protected $primaryKey = 'id';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'restaurantID',
        'location',
        'number'
    ];

    // Define the relationship with the Restaurant model
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurantID');
    }
}
