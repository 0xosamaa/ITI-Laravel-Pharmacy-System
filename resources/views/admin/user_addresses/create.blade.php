@extends('admin.layouts.app')
@section('title')
    New User Address
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New User Address</h3>
        </div>
        {{-- {{ route('admin.users.addresses.store', $id) }} --}}
        <form method="POST" action="/admin/users/{{ $id }}/addresses">
            @csrf

            <div class="container">

                <div class="form-group">
                    <label for="flat_number">Flat Number</label>
                    <input type="text" name="flat_number" class="form-control" id="flat_number" placeholder="Flat Number"
                        @error('flat_number') is-invalid @enderror" value="{{ old('flat_number') }}" required>
                    @error('flat_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="floor_number">Floor Number</label>
                    <input type="text" name="floor_number" class="form-control" id="floor_number"
                        placeholder="Floor Number" @error('floor_number') is-invalid @enderror"
                        value="{{ old('floor_number') }}" required>
                    @error('floor_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="building_number">Building Number</label>
                    <input type="text" name="building_number" class="form-control" id="building_number"
                        placeholder="Building Number">
                    @error('building_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="street_name">Street Name</label>
                    <input type="text" name="street_name" class="form-control" id="street_name" placeholder="Enter Name">
                    @error('street_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="governorate_id">Governorate</label>
                    <select name="governorate_id" id="governorate_id"
                        class="form-control @error('governorate_id') is-invalid @enderror" required>
                        <option value="">Select Governorate</option>
                        @foreach ($governorates as $governorate)
                            <option value="{{ $governorate->id }}"
                                {{ old('governorate_id') == $governorate->id ? 'selected' : '' }}>
                                {{ $governorate->name }}</option>
                        @endforeach
                    </select>
                    @error('governorate_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary my-3">Submit</button>
            </div>
        </form>
    </div>
@endsection
