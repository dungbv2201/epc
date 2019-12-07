<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','price','is_hot'
    ];

    public function toppings(){
        return $this->belongsToMany(Topping::class);
    }

    public function stores(){
        return $this->belongsToMany(Store::class);
    }
}
