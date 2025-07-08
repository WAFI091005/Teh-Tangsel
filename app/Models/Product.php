<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'image', 'kategori'];

    public function favoritedByUsers() {
    return $this->hasMany(\App\Models\Favorite::class);
    }   


}
