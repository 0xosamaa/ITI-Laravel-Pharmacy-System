<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'national_id',
        'avatar_image',
        'pharmacy_id'
    ];

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
