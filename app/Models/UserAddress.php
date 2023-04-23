<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'flat_number',
        'floor_number',
        'building_number',
        'street_name',
        'area_id',
        'is_main',
        'user_id',
        'governorate_id'
    ];

    public function governorate(){
        return $this->hasMany(Governorate::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
