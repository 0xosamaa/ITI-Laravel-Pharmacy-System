@extends('admin.layouts.app')

@section('title')
    Create a doctor
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
                <h3 class="card-title">Create a doctor</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
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
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <label for="national_id">National ID</label>
                        <input type="text" class="form-control" id="national_id" name="national_id"
                            placeholder="Enter national id">
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
                        <label for="pharmacy_id" class="form-label">Pharmacy Name</label>
                        <select class="form-select select2" style="width: 100%" name="pharmacy_id" id="pharmacy_id">
                            @foreach ($pharmacies as $pharmacy)
                                <option value="{{ $pharmacy->id }}">{{ $pharmacy->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create Doctor</button>
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
