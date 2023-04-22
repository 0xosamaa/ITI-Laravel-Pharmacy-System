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
<<<<<<< HEAD

    public function user_addresses()
    {
        return $this->hasMany(UserAddress::class);
    }
=======
>>>>>>> b2c544443471a25cca6b4850c8c035340394d24b
}
