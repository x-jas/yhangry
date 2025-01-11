<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description',
        'price_per_person',
        'min_spend',
        'available',
        'number_of_orders',
        'thumbnail'
    ];
    
    public function cuisines()
    {
        return $this->belongsToMany(Cuisine::class, 'set_menu_cuisine');
    }
}