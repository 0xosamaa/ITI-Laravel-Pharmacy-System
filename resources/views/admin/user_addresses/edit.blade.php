@extends('admin.layouts.app')
@section('title')
    User Address
@endsection

@section('content')
    <div class="my-6">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Edit Address</div>

                        <div class="card-body">
                            <form method="POST"
                                action="{{ route('admin.users.addresses.update', ['user' => $user_id, 'id' => $address->id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="flat_number">Flat Number</label>
                                    <input type="text" name="flat_number" class="form-control" id="flat_number"
                                        value="{{ $address->flat_number }}" @error('flat_number') is-invalid @enderror"
                                        required autofocus>
                                    @error('flat_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="floor_number">Floor Number</label>
                                    <input type="text" name="floor_number" class="form-control" id="floor_number"
                                        value="{{ $address->floor_number }}" @error('floor_number') is-invalid @enderror"
                                        required>
                                    @error('floor_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="building_number">Building Number</label>
                                    <input type="text" name="building_number" value="{{ $address->building_number }}"
                                        class="form-control" id="building_number">
                                    @error('building_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="area_id">Area ID</label>
                                    <input type="text" name="area_id" value="{{ $address->area_id }}" class="form-control" id="area_id"
                                        placeholder="Area ID">
                                    @error('area_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="street_name">Street Name</label>
                                    <input type="text" name="street_name" value="{{ $address->street_number }}"
                                        class="form-control" id="street_name">
                                    @error('street_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="governorate_id">Governorate</label>
                                    <select name="governorate_id" id="governorate_id"
                                        class="form-control @error('governorate_id') is-invalid @enderror" required>
                                        <option value="{{ $address->governrate }}">Select Governorate</option>
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

                                <button type="submit" class="btn btn-primary">
                                    Update Address
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
