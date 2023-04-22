@extends('admin.layouts.app')

@section('title')
    Create Doctor
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
        <!-- general form elements -->
        <div class="card card-primary mx-auto w-75 mb-0">
            <div class="card-header">
                <h3 class="card-title">Create User</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter doctor name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <label for="national_id">National ID</label>
                        <input type="text" class="form-control" id="national_id" name="national_id"
                            placeholder="Enter national id">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label> <br>
                        <input type="radio" name="gneder" id="gender" value="male">&nbsp;&nbsp;<span>Male</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gneder" id="gender" value="female">&nbsp;&nbsp;<span>Female</span>
                    </div>
                    <div class="form-group">
                        <label for="gender">Address</label> <br>
                        <input type="radio" name="gneder" id="gender" value="male">&nbsp;&nbsp;<span>Male</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gneder" id="gender" value="female">&nbsp;&nbsp;<span>Female</span>
                    </div>
                    <div class="form-group">
                        <label for="avatar_image">Avatar Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="avatar_image" id="avatar_image">
                                <label class="custom-file-label" for="avatar_image">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="governorate_id" class="form-label">Governorate</label>
                        <select class="form-select select2" style="width: 100%" name="governorate" id="pharmacy_id">
                            @foreach ($governorates as $governorate)
                                <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                            @endforeach
                        </select>
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

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr["error"]("{{ $error }}", "Error")
                @endforeach

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            @endif
        });
    </script>
@endsection
