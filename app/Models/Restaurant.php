<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Restaurant extends Model
{
    use HasFactory;

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_restaurant')->withTimestamps();
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function favorited_users() {
        return $this->belongsToMany(User::class, 'restaurant_user')->withTimestamps();
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
