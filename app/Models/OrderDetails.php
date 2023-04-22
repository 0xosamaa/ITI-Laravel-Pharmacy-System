<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    use HasFactory, SoftDeletes;

<<<<<<< HEAD
    protected $fillable = [
        'doctor_id',
        'pharmacy_id',
        'status',
        'is_insured',
        'delivery_address',
        'creator_type',
        'total',
        'user_id'
    ];

=======
>>>>>>> b2c544443471a25cca6b4850c8c035340394d24b
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
<<<<<<< HEAD
    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
=======
>>>>>>> b2c544443471a25cca6b4850c8c035340394d24b
}
