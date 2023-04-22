@extends('admin.layouts.app')

@section('title')
    Doctors
@endsection

@section('extra-css')
    <!-- DataTables -->
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>

    <!-- Toastr -->
    <link rel="stylesheet" href={{ asset('admins/plugins/toastr/toastr.min.css') }}>

    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ asset('admins/plugins/fontawesome-free/css/all.min.css') }}>

    <style>
        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        td {
            vertical-align: middle !important;
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Doctors</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <a name="" id="" class="btn btn-success" href="{{ route('doctors.create') }}"
                        role="button">Create Doctor</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>National Id</th>
                                        <th>Created At</th>
                                        <th>Pharmacy</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/images/doctors/' . $doctor->avatar_image) }}"
                                                    alt="avatar-image">
                                            </td>
                                            <td>{{ $doctor->user->name }}</td>
                                            <td>{{ $doctor->user->email }}</td>
                                            <td>{{ $doctor->national_id }}</td>
                                            <td>{{ $doctor->created_at }}</td>
                                            <td>{{ $doctor->pharmacy->name }}</td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill @if ($doctor->is_banned == 0) bg-success @else bg-danger @endif">
                                                    @if ($doctor->is_banned == 0)
                                                        Not Banned
                                                    @else
                                                        Banned
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <a href="/doctors/{{ $doctor->id }}/edit"
                                                    class="btn btn-primary rounded-lg mx-1">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger rounded-lg mx-1"
                                                    data-toggle="modal" data-target="#deleteModal"
                                                    data-id="{{ $doctor->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Delete Doctor</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure to delete doctor?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="" method="POST" id='delete-form'>
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->

                                                <button class="btn btn-warning rounded-lg mx-1">
                                                    <i class="fas fa-user-slash"></i>
                                                </button>

                                                <!-- Ban/Unban Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                                                                    Post</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure to delete post?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="" method="POST" id='delete-form'>
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">No</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Yes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@section('extra-js')
    <!-- JQuery -->
    <script src={{ asset('admins/plugins/jquery/jquery.js') }}></script>

    <!-- bootstrap 4 js -->
    <script src={{ asset('admins/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>

    <!-- DataTables  & Plugins -->
    <script src={{ asset('admins/plugins/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('admins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}></script>
    <script src={{ asset('admins/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}></script>
    <script src={{ asset('admins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}></script>
    <script src={{ asset('admins/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}></script>
    <script src={{ asset('admins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}></script>
    <script src={{ asset('admins/plugins/jszip/jszip.min.js') }}></script>
    <script src={{ asset('admins/plugins/pdfmake/pdfmake.min.js') }}></script>
    <script src={{ asset('admins/plugins/pdfmake/vfs_fonts.js') }}></script>
    <script src={{ asset('admins/plugins/datatables-buttons/js/buttons.html5.min.js') }}></script>
    <script src={{ asset('admins/plugins/datatables-buttons/js/buttons.print.min.js') }}></script>
    <script src={{ asset('admins/plugins/datatables-buttons/js/buttons.colVis.min.js') }}></script>

    <!-- Toastr -->
    <script src={{ asset('admins/plugins/toastr/toastr.min.js') }}></script>
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

            let id;
            $('button[data-bs-target="#deleteModal"]').on('click', function() {
                id = $(this).get(0).dataset['id'];
                $('#delete-form').attr('action', '/doctors/' + id);
            });

            @if (session('success'))
                toastr["success"]("{{ session('success') }}");
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
