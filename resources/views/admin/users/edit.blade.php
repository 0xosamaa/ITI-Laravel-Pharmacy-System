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
            <form action="{{ route('admin.users.update', $userData->user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body p-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" value="{{ $userData->user->name? $userData->user->name: '' }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            placeholder="Enter user name">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="national_id">National ID</label>
                        <input type="text" class="form-control @error('national_id') is-invalid @enderror" id="national_id" name="national_id"
                            placeholder="not added yet" value="{{ $userData->user->national_id != null? $userData->user->national_id:'' }}">
                        @error('national_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number"
                            placeholder="not added yet" value="{{ $userData->user->mobile_number? $userData->user->mobile_number:'' }}">
                        @error('mobile_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label> <br>
                        <input type="radio" name="gender" id="gender" value="male" {{ $userData->user->gender? 'checked':'' }}>
                        &nbsp;&nbsp;<span>Male</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" id="gender" value="female" {{ $userData->user->gender? 'checked':'' }}>
                        &nbsp;&nbsp;<span>Female</span>
                        @error('gender')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date Of Birth</label> <br>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ ($userData->user->date_of_birth != null)? $userData->user->date_of_birth:'' }}">
                        @error('date_of_birth')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Address</label> <br>

                        <select name="address_id" id="address_id" class="form-control" required>
                            <option value="">Select Main Address</option>
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}" {{ $userData->id == $address->id ? 'selected' : '' }}>
                                    {{ $address->flat_number . ', ' . $address->floor_number . ', ' . $address->building_number . ', ' . $address->street_name . ', ' . $address->area_id . ', ' . $address->governorate->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('governorate_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="avatar_image">Avatar Image</label>
                        <div class="d-flex justify-content-around align-items-center">
                            <img src="{{ asset('/storage/images/users/' . $userData->user->profile_image_path) }}" alt="avatar image">
                            <input type="file" class="form-control @error('avatar_image') is-invalid @enderror" name="avatar_image" id="avatar_image">
                        </div>
                    </div>
                    @error('avatar_image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
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
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
