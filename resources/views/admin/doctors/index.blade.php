@extends('admin.layouts.app')

@section('title')
    Doctors
@endsection

@section('extra-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                    <a name="" id="" class="btn btn-success" href="{{ route('admin.doctors.create') }}"
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
                            <table id="doctors-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>National Id</th>
                                        <th>Created At</th>

                                        @role('admin')
                                        <th>Pharmacy</th>
                                        @endrole

                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                        @if(auth()->user()->hasRole('admin') ||
                                        (auth()->user()->hasRole('pharmacist') && $doctor->pharmacy->owner_user_id == auth()->user()->id))
                                        <tr id="{{ $doctor->id }}">
                                            <td>
                                                <img src="{{ asset('storage/images/doctors/' . $doctor->avatar_image) }}"
                                                    alt="avatar-image">
                                            </td>
                                            <td>{{ $doctor->user->name }}</td>
                                            <td>{{ $doctor->user->email }}</td>
                                            <td>{{ $doctor->national_id }}</td>
                                            <td>{{ $doctor->created_at }}</td>

                                            @role('admin')
                                            <td>{{ $doctor->pharmacy->name }}</td>
                                            @endrole

                                            <td>
                                                <span
                                                    class="badge rounded-pill @if ($doctor->user->isBanned()) bg-danger @else bg-success @endif">
                                                    @if ($doctor->user->isBanned())
                                                        Banned
                                                    @else
                                                        Active
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                                                    class="btn btn-primary rounded-lg mx-1">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger rounded-lg mx-1"
                                                    data-toggle="modal" data-target="#deleteModal"
                                                    data-id="{{ $doctor->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                @if ($doctor->user->isBanned())
                                                    <button type="button" class="btn btn-success rounded-lg mx-1"
                                                    data-toggle="modal" data-target="#unbanModal"
                                                    data-id="{{ $doctor->id }}">
                                                        Unban
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-danger rounded-lg mx-1"
                                                    data-toggle="modal" data-target="#banModal"
                                                    data-id="{{ $doctor->id }}">
                                                        Ban
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
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
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">No</button>
                                            <button class="btn btn-danger delete-btn"
                                                data-dismiss="modal" data-url="">Yes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- Unban Modal -->
                            <div class="modal fade" id="unbanModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Unban Doctor</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure to unban doctor?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">No</button>
                                            <button class="btn btn-danger unban-btn"
                                                data-dismiss="modal" data-url="">Yes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- Ban Modal -->
                            <div class="modal fade" id="banModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ban Doctor</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure to ban doctor?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">No</button>
                                            <button class="btn btn-danger ban-btn"
                                                data-dismiss="modal" data-url="">Yes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
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
            $("#doctors-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#doctors-table_wrapper .col-md-6:eq(0)');

            // Delete Modal
            $(document).on('click', 'button[data-target="#deleteModal"]', function() {
                let id = $(this).data('id');
                // $('#deleteModal .delete-btn').data('url', '/doctors/' + id);
                $('#deleteModal .delete-btn')
                .data('url', '{{ route("admin.doctors.destroy", ":id") }}'.replace(':id', id));
            });
            $(document).on('click', '#deleteModal .delete-btn', function(event) {
                $.ajax({
                    url: $(this).data('url'),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: response => {
                        toastr["success"]("Doctor deleted successfully");
                        toastr.options = toastr_options;
                        const id = $(this).data('url').split('/').pop();
                        const table = $('#doctors-table').DataTable();
                        const row = table.row('#' + id);
                        row.remove().draw();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            // Ban Modal
            $(document).on('click', 'button[data-target="#banModal"]', function() {
                let id = $(this).data('id');
                $('#banModal .ban-btn')
                .data('url', '{{ route("admin.doctors.ban", ":id") }}'.replace(':id', id));
            });
            $(document).on('click', '#banModal .ban-btn', function(event) {
                $.ajax({
                    url: $(this).data('url'),
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: response => {
                        const banUrl = $(this).data('url');
                        const id = banUrl.split('/').pop();
                        const $tr = $('#' + id);
                        const $status = $tr.find('.badge');
                        const $banButton = $tr.find('button[data-target="#banModal"]');

                        $status.text('Banned').removeClass('bg-success').addClass('bg-danger');
                        $banButton.text('Unban').removeClass('btn-danger').addClass('btn-success');
                        $banButton.attr('data-target', '#unbanModal');

                        toastr["success"]("Doctor banned successfully");
                        toastr.options = toastr_options;
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            // Unban Modal
            $(document).on('click', 'button[data-target="#unbanModal"]', function() {
                let id = $(this).data('id');
                $('#unbanModal .unban-btn')
                .data('url', '{{ route("admin.doctors.unban", ":id") }}'.replace(':id', id));
            });
            $(document).on('click', '#unbanModal .unban-btn', function(event) {
                $.ajax({
                    url: $(this).data('url'),
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: response => {
                        const unbanUrl = $(this).data('url');
                        const id = unbanUrl.split('/').pop();
                        const $tr = $('#' + id);
                        const $status = $tr.find('.badge');
                        const $unbanButton = $tr.find('button[data-target="#unbanModal"]');

                        $status.text('Active').removeClass('bg-danger').addClass('bg-success');
                        $unbanButton.text('ban').removeClass('btn-success').addClass('btn-danger');
                        $unbanButton.attr('data-target', '#banModal');

                        toastr["success"]("Doctor unbanned successfully");
                        toastr.options = toastr_options;
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            @if (session('success'))
                toastr["success"]("{{ session('success') }}");
                toastr.options = toastr_options;
            @endif

            toastr_options = {
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
        });
    </script>
@endsection
