@extends('admin.layouts.app')

@section('content')
    <h1>Create Pharmacy</h1>
    <form method="POST" action="{{ route('admin.pharmacies.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>
            <input type="number" name="priority" id="priority" class="form-control @error('priority') is-invalid @enderror" value="{{ old('priority') }}" required>
            @error('priority')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="owner_user_id">Owner User ID</label>
            <select name="owner_user_id" id="owner_user_id" class="form-control @error('owner_user_id') is-invalid @enderror" required>
                <option value="">Select an owner user</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('owner_user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
            @error('owner_user_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="governorate_id">Governorate</label>
            <select name="governorate_id" id="governorate_id" class="form-control @error('governorate_id') is-invalid @enderror" required>
                <option value="">Select Governorate</option>
                @foreach($governorates as $governorate)
                    <option value="{{ $governorate->id }}" {{ old('governorate_id') == $governorate->id ? 'selected' : '' }}>{{ $governorate->name }}</option>
                @endforeach
            </select>
            @error('governorate_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
