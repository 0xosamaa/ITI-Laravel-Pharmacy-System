<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = Medicine::with(['category', 'discount'])->get();
        return view('admin.medicines.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $discounts = Discount::all();
        return view('admin.medicines.create', compact('categories', 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'SKU' => 'required',
            'image' => 'required|mimes:png,jpg|max:2048',
            'price' => 'required|numeric',
            'image' => 'required|mimes:jpg,png,jpeg|max:2048',
            'category_id' => 'required|numeric',
            'discount_id' => 'required|numeric',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images/medicines', 'public');
            $validated['image'] = 'storage/' . $image;
        } else {
            return redirect()->back()->withErrors("Image upload failed.");
        }
        Medicine::create($validated);

        return redirect()->route('admin.medicines.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        return view('admin.medicines.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        $categories = Category::all();
        $discounts = Discount::all();
        return view('admin.medicines.edit', compact('medicine', 'categories', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'SKU' => 'required',
            'image' => 'mimes:png,jpg|max:2048',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'discount_id' => 'required|numeric',
        ]);
        dd($validated);
        if ($request->hasFile('image')) {
            if (File::exists($medicine->image)) {
                File::delete($medicine->image);
            }
            $image = $request->file('image')->store('images/medicines', 'public');
            $validated['image'] = 'storage/' . $image;

            $medicine->update($validated);
        } else {
            $validated['image'] = $medicine->image;
        }
        Medicine::create($validated);
        return redirect()->route('admin.medicines.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
    }
}
