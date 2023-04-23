@extends('admin.layouts.app')
@section('title')
    Pharmacy
@endsection
@section('extra-css')
    <!-- DataTables -->
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pharmacies</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-sm-12"><a href="{{ route('admin.pharmacies.create') }}" type="submit"
                            class="btn btn-success w-25 my-2">New Pharmacy</a></div>
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                            aria-describedby="example1_info">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">ID</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending">Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending">
                                        Address</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending">
                                        Priority</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending">Owner
                                    </th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="2" aria-label="CSS grade: activate to sort column ascending">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pharmacies as $pharmacy)
                                    <tr>
                                        <td>{{ $pharmacy->id }}</td>
                                        <td>{{ $pharmacy->name }}</td>
                                        <td>{{ $pharmacy->governorate->name }}</td>
                                        <td>{{ $pharmacy->priority }}</td>
                                        <td>{{ $pharmacy->owner_name }}</td>

                                        <td>
                                            <div class="btn-container">
                                                <a href="{{ route('admin.pharmacies.edit', $pharmacy->id) }}" class="btn btn-lg btn-info w-100">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="btn-container">
                                                <form method="POST" action="{{ route('admin.pharmacies.destroy', $pharmacy->id ) }}" style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-lg btn-danger w-100" data-toggle="modal" data-target="#confirm-delete-{{$pharmacy->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="confirm-delete-{{$pharmacy->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this item?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                </form>
                                            </div>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->
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
