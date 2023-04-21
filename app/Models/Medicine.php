<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    function formatted_price()
    {
        return format_price($this->price);
    }

    function formatted_discount()
    {
        if (!isset($this->discount)) return $this->price;
        
        $percent = $this->discount->discount_percent;
        $discounted_price = $this->price - ($this->price * $percent / 100);

        return format_price($discounted_price);
    }
}
