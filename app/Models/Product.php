<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'color', 'description', 'price', 'stock', 'state_id', 'category_id'
    ];

    protected static function booted()
    {
        static::saved(function ($product) {
            if (!str_starts_with($product->image, 'http')) {
                $product->image = asset('storage') . '/' .  $product->image;
                $product->save();
            }
        });
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot(['quantity', 'price'])
            ->withTimestamps();
    }
}
