<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

        protected $fillable = [
            'priority',
            'owner_user_id',
            'governorate_id',
            'name'
        ];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

}
