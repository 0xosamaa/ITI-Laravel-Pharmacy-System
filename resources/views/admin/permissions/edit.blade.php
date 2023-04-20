@extends('admin.layouts.app')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Permission</h3>
        </div>
        <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">ID</label>
                    <input type="text" class="form-control" value="{{ $permission->id }}"
                        disabled>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name"
                        value="{{ $permission->name }}">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
