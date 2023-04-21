@extends('admin.layouts.app')

@section('content')
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
                                <input id="priority" type="number" class="form-control @error('priority') is-invalid @enderror" name="priority" value="{{ old('priority', $pharmacy->priority) }}" required autofocus>
                                @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="owner_user_id">Owner User ID</label>
                                <input id="owner_user_id" type="number" class="form-control @error('owner_user_id') is-invalid @enderror" name="owner_user_id" value="{{ old('owner_user_id', $pharmacy->owner_user_id) }}" required>
                                @error('owner_user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="area_id">Area ID</label>
                                <input id="area_id" type="number" class="form-control @error('area_id') is-invalid @enderror" name="area_id" value="{{ old('area_id', $pharmacy->area_id) }}" required>
                                @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $pharmacy->name) }}" required>
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
@endsection
