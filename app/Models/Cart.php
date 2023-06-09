<?php

namespace App\Models;

use App\Models\Medicine;
use Error;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function empty()
    {
        $items = $this->items()->get();
        foreach ($items as $item) {
            $item->delete();
        }
        $this->delete();
        return true;
    }

    public function has(Medicine $medicine)
    {
        $items = $this->items()->get();

        foreach ($items as $item) {
            if ($item->medicine_id === $medicine->id) {
                return true;
            }
        }
        return false;
    }

    public function add(Medicine $medicine)
    {
        if (!($this->has($medicine))) {
            CartItem::create([
                "medicine_id" => $medicine->id,
                "cart_id" => $this->id
            ]);
            return true;
        }
        return false;
    }

    public function remove(Medicine $medicine)
    {
        $items = $this->items()->get();

        if ($this->has($medicine)) {
            $items->where('medicine_id', $medicine->id)->first()->delete();
            if ($this->items()->get()->count() <= 0)
                $this->delete();
            return true;
        }
        return false;
    }

    public function increase(Medicine $medicine)
    {
        $items = $this->items()->get();
        foreach ($items as $item) {
            if ($item->medicine_id === $medicine->id) {
                if ($medicine->stock <= $item->quantity) return;
                $item->quantity++;
                $item->save();
                return true;
            }
        }
        return false;
    }

    public function decrease(Medicine $medicine)
    {
        $items = $this->items()->get();
        foreach ($items as $item) {
            if ($item->medicine_id === $medicine->id) {
                if ($item->quantity <= 1) return;
                $item->quantity--;
                $item->save();
                return true;
            }
        }
        return false;
    }

    public function sub_totals()
    {
        $sub_totals = [];
        $items = $this->items()->get();
        foreach ($items as $item) {
            $sub_totals[$item->id]['id'] = $item->id;
            $sub_totals[$item->id]['medicine_id'] = $item->medicine_id;
            $sub_totals[$item->id]['quantity'] = $item->quantity;
            $sub_totals[$item->id]['item_total'] = $item->quantity * $item->medicine->actual_price();
        }
        return $sub_totals;
    }

    public function sub_total()
    {
        $sub_total = 0;
        $items = $this->items()->get();
        foreach ($items as $item) {
            $sub_total += $item->quantity * $item->medicine->actual_price();
        }
        return $sub_total;
    }
    public function total()
    {
        $total = 0;
        $items = $this->items()->get();
        foreach ($items as $item) {
            $total += $item->quantity * $item->medicine->actual_price();
        }
        return $total;
    }
}
