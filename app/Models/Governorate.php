<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function pharmacies()
    {
        return $this->hasMany(Pharmacy::class);
    }

    public function user_addresses()
    {
        return $this->hasMany(UserAddress::class);
    }
}
