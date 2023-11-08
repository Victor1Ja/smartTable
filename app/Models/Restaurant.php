<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'restaurants';

    // Define the primary key field
    protected $primaryKey = 'RestaurantID';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'Name',
        'Location',
        'ContactInformation',
        'OperatingHours',
    ];

    // Define the relationship with Table and Menu Item models
    public function tables()
    {
        return $this->hasMany(Table::class, 'RestaurantID');
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'RestaurantID');
    }
}
