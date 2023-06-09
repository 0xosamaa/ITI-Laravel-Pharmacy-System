<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'medicine_id',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(OrderDetails::class, 'order_id', 'id');}
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
