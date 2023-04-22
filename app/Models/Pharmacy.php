<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacy extends Model
{
    use HasFactory, SoftDeletes;

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

    public function decreasePriority()
    {
        if ($this->priority > 1) {
            $this->priority *= 0.9;
            $this->save();
        }
    }


    public function increasePriority()
    {
        if ($this->priority) {
            $this->priority /= 0.9;
            $this->save();
        }
    }
    public function orders()
    {
        return $this->hasMany(OrderDetails::class);
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
