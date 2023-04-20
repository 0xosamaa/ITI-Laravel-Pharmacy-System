<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 8d0e4480603ac6e605bb79638a364bcf115d4254
        protected $fillable = [
            'priority',
            'owner_user_id',
            'area_id',
            'name'
        ];

<<<<<<< HEAD

=======
>>>>>>> 8d0e4480603ac6e605bb79638a364bcf115d4254
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }
<<<<<<< HEAD

=======
>>>>>>> e89560f (edit order details table)
=======
>>>>>>> 8d0e4480603ac6e605bb79638a364bcf115d4254
}
