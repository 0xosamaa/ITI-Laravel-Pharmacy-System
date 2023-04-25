@extends('admin.layouts.app')
@section('extra-css')
    <!-- DataTables -->
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('admins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Modal -->

    <div class="table-responsive w-75 m-auto p-5">
        <h3 class="text-center mb-3">Address Info</h3>
        <hr>
        <table class="table table-striped-columns">
            <tbody>

                <tr>
                    <th>ID</th>
                    <td scope="row">{{ $address->id }}</td>
                </tr>

                <tr>
                    <th>Flat Number</th>
                    <td scope="row">{{ $address->flat_number }}</td>
                </tr>

                <tr>
                    <th>Floor Number</th>
                    <td scope="row">{{ $address->floor_number }}</td>
                </tr>

                <tr>
                    <th>Building</th>
                    <td scope="row">{{ $address->building_number }}</td>
                </tr>

                <tr>
                    <th>Area ID</th>
                    <td scope="row">{{ $address->area_id }}</td>
                </tr>

                <tr>
                    <th>Street Name</th>
                    <td scope="row">{{ $address->street_name }}</td>
                </tr>

                <tr>
                    <th>Governrate</th>
                    <td scope="row">{{ $address->governorate_id }}</td>
                </tr>

            </tbody>
        </table>
    </div>
    <!-- End Modal -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
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
