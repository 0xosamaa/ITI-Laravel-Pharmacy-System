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
        <h3 class="text-center mb-3">User Info</h3>
        <hr>
        <table class="table table-striped-columns">
            <tbody>
                <tr class="">
                    <th>ID</th>
                    <td scope="row">{{ $user->id }}</td>
                </tr>
                <tr class="">
                    <th>Avatar</th>
                    <td scope="row">
                        {{ $user->image }}
                        @if ($user->image == null)
                            <small class="text-warning">Not Added Yet</small>
                        @endif
                    </td>
                </tr>
                <tr class="">
                    <th>Name</th>
                    <td scope="row">{{ $user->name }}</td>
                </tr>
                <tr class="">
                    <th>Email</th>
                    <td scope="row">{{ $user->email }}</td>
                </tr>
                <tr class="">
                    <th>Defualt Address</th>
                    <td scope="row" class="d-flex justify-content-between">
                        <span>
                            @if ($address == null)
                                <small class="text-warning">No Defualt Address Yet</small>
                            @else
                                {{ $address->street_name }},{{ $address->governorate->name }}
                            @endif
                        </span>
                        <!-- &nbsp;&nbsp;&nbsp; -->
                        <a href="{{ route('admin.users.addresses.index', $user->id) }}"
                            class="btn btn-icon btn-light text-primary rounded-pill m-2  shadow bg-body-tertiary">
                            Show {{ $user->name }}'s Addresses
                        </a>
                    </td>
                </tr>
                <tr class="">
                    <th>Gender</th>
                    <td scope="row">{{ $user->gender }}</td>
                </tr>
                <tr class="">
                    <th>Date Of Birth</th>
                    <td scope="row">
                        {{ $user->date_of_birth }}
                        @if ($user->date_of_birth == null)
                            <small class="text-warning">Not Added Yet</small>
                        @endif
                    </td>
                </tr>
                <tr class="">
                    <th>Mobile Number</th>
                    <td scope="row">
                        {{ $user->mobile_number }}
                        @if ($user->mobile_number == null)
                            <small class="text-warning">Not Added Yet</small>
                        @endif
                    </td>
                </tr>
                <tr class="">
                    <th>National ID</th>
                    <td scope="row">
                        {{ $user->national_id }}
                        @if ($user->national_id == null)
                            <small class="text-warning">Not Added Yet</small>
                        @endif
                    </td>
                </tr>
                <tr class="">
                    <th>Created At</th>
                    <td scope="row">{{ $user->created_at }}</td>
                </tr>
                <tr class="">
                    <a href="{{ route('admin.users.edit', $user->id) }}"
                        class="btn btn-icon btn-light text-info rounded-pill m-2  shadow bg-body-tertiary">
                        Edit {{ $user->name }}'s Data
                    </a>
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
