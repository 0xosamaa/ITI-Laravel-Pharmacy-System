@extends('admin.layouts.app')

@section('title')
    Update User's Data
@endsection

@section('extra-css')
    <!-- Select2 -->
    <link rel="stylesheet" href={{ asset('admins/plugins/select2/css/select2.min.css') }}>
    <link rel="stylesheet" href={{ asset('admins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>

    <!-- Toastr -->
    <link rel="stylesheet" href={{ asset("admins/plugins/toastr/toastr.min.css") }}>
@endsection

@section('content')
    <div class="container py-4">

        <div> 
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <!-- general form elements -->
        <div class="card card-primary mx-auto w-75 mb-0">
            <div class="card-header">
                <h3 class="card-title">Update {{ $userData->user->name }}'s Data</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            placeholder="Enter user name">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="national_id">National ID</label>
                        <input type="text" class="form-control @error('national_id') is-invalid @enderror" id="national_id" name="national_id"
                            placeholder="Enter national id">
                        @error('national_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label> <br>
                        <input type="radio" name="gender" id="gender" value="male">&nbsp;&nbsp;<span>Male</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" id="gender" value="female">&nbsp;&nbsp;<span>Female</span>
                        @error('gender')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Address</label> <br>
                        <div class="input-group">
                            <span class="input-group-text">Address</span>
                            <input type="number" min=0 aria-label="Flat Number" class="form-control @error('flat_number') is-invalid @enderror"  name="flat_number" placeholder="Flat Number">
                            @error('flat_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <input type="number" min=0 aria-label="Floor Number" class="form-control @error('floor_number') is-invalid @enderror" name="floor_number" placeholder="Floor Number">
                            @error('floor_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <input type="number" min=0 aria-label="Building Number" class="form-control @error('building_number') is-invalid @enderror" name="building_number" placeholder="Building Number">
                            @error('building_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <input type="text" min=0 aria-label="Area ID" class="form-control @error('area_id') is-invalid @enderror" name="area_id" placeholder="Area ID">
                            @error('area_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <input type="text" min=0 aria-label="Street Name" class="form-control @error('street_name') is-invalid @enderror" name="street_name" placeholder="Street Name">
                            @error('street_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-check d-flex align-content-center my-3">
                            <input class="form-check-input @error('is_main') is-invalid @enderror" type="checkbox" value="1" name="is_main" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Make As Default Address
                            </label>
                            @error('is_main')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar_image">Avatar Image</label>
                        <input type="file" class="form-control @error('avatar_image') is-invalid @enderror" name="avatar_image" id="avatar_image">
                    </div>
                    @error('avatar_image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

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
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create User</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection

@section('extra-js')
    <!-- Select2 -->
    <script src={{ asset('admins/plugins/select2/js/select2.full.min.js') }}></script>

    <!-- Toastr -->
    <script src={{ asset("admins/plugins/toastr/toastr.min.js") }}></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            // @if ($errors->any())
            //     @foreach ($errors->all() as $error)
            //         toastr["error"]("{{ $error }}", "Error")
            //     @endforeach

            //     toastr.options = {
            //         "closeButton": false,
            //         "debug": false,
            //         "newestOnTop": false,
            //         "progressBar": false,
            //         "positionClass": "toast-top-right",
            //         "preventDuplicates": false,
            //         "onclick": null,
            //         "showDuration": "300",
            //         "hideDuration": "1000",
            //         "timeOut": "5000",
            //         "extendedTimeOut": "1000",
            //         "showEasing": "swing",
            //         "hideEasing": "linear",
            //         "showMethod": "fadeIn",
            //         "hideMethod": "fadeOut"
            //     }
            // @endif
        });
    </script>
@endsection
