@extends('admin.layouts.app')
@section('title')
    Pharmacy
@endsection

@section('content')
    <div class="my-6">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Edit Pharmacy</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.pharmacies.update', $pharmacy->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="priority">Priority</label>
                                    <input id="priority" type="number"
                                        class="form-control @error('priority') is-invalid @enderror" name="priority"
                                        value="{{ old('priority', $pharmacy->priority) }}" required autofocus>
                                    @error('priority')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="owner_user_id">Owner User ID</label>
                                    <select name="owner_user_id" id="owner_user_id"
                                        class="form-control @error('owner_user_id') is-invalid @enderror" required>
                                        <option value="">Select an owner user</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('owner_user_id') == $user->id ? 'selected' : '' }}>
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

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $pharmacy->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Update Pharmacy
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
