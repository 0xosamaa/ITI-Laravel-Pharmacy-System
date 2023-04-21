@extends('admin.layout.app')

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
            <input type="number" name="owner_user_id" id="owner_user_id" class="form-control @error('owner_user_id') is-invalid @enderror" value="{{ old('owner_user_id') }}" required>
            @error('owner_user_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="area_id">Area ID</label>
            <input type="number" name="area_id" id="area_id" class="form-control @error('area_id') is-invalid @enderror" value="{{ old('area_id') }}" required>
            @error('area_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
