<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function setMenus()
    {
        return $this->belongsToMany(SetMenu::class, 'set_menu_cuisine');
    }
}
