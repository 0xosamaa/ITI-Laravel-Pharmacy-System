<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    use HasFactory, SoftDeletes;

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

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
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

}
