@extends('admin.layouts.app')
@section('extra-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Role</h3>
        </div>
        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="form-group">
                    <h3>Role Permissions:</h3>


                    {{-- <div class="container mt-5">
                        <select class="selectpicker" multiple aria-label="Default select example" data-live-search="true">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="4">Four</option>
                        </select>
                    </div> --}}

                </div>
                <div class="form-group">
                    <label for="name">ID</label>
                    <input type="text" class="form-control" value="{{ $role->id }}" disabled>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name"
                        value="{{ $role->name }}">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('extra-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
@endsection
