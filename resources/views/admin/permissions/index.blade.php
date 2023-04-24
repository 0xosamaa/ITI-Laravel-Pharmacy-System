@extends('admin.layouts.app')
@section('extra-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- DataTables -->
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
@endsection
@section('title')
    Permissions
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Permissions</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="permissions_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('admin.permissions.create') }}" type="submit"
                            class="btn btn-success w-25 my-2">New
                            Permission</a>

                    </div>
                    <div class="col-sm-12">
                        <table id="permissions_table" class="table table-bordered table-striped dataTable dtr-inline"
                            aria-describedby="permissions_table_info">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="permissions_table"
                                        rowspan="1" colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">ID
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="permissions_table" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending">Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="permissions_table" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($permissions as $permission)
                                    <tr class="@if ($loop->odd) odd @else even @endif"
                                        id="{{ $permission->id }}">
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                class="btn btn-info"><i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger rounded-lg mx-1"
                                                data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $permission->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <h3>No permissions found</h3>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Permission</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete permission?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button class="btn btn-danger delete-btn" data-dismiss="modal" data-url="">Yes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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
            $("#permissions_table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#permissions_table_wrapper .col-md-6:eq(0)');

            const toastr_options = {
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
            // Delete Modal
            $(document).on('click', 'button[data-target="#deleteModal"]', function() {
                let id = $(this).data('id');
                $('#deleteModal .delete-btn').data('url', 'permissions/' + id);
            });
            $(document).on('click', '#deleteModal .delete-btn', function(event) {
                $.ajax({
                    url: $(this).data('url'),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: response => {
                        toastr["success"]("Permission deleted successfully");
                        toastr.options = toastr_options;
                        const id = $(this).data('url').split('/').pop();
                        const table = $('#permissions_table').DataTable();
                        const row = table.row('#' + id);
                        row.remove().draw();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
