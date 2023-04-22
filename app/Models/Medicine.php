<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public $fillable = [
        'name',
        'description',
        'SKU',
        'image',
        'price',
        'category_id',
        'discount_id',
    ];
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
    public function hasActiveDiscount()
    {
        if ($this->discount && $this->discount->active) return true;
        return false;
    }

    function formatted_price()
    {
        return format_price($this->price);
    }

    function formatted_discount()
    {
        if (!isset($this->discount) || !($this->discount->active)) return $this->formatted_price();

        $percent = $this->discount->discount_percent;
        $discounted_price = $this->price - ($this->price * $percent / 100);

        return format_price($discounted_price);
    }
}
