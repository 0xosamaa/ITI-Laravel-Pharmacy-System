// extend the layout from the admin layout file
    @extends ( 'admin.layouts.app' )

    // set the page title
    @section ( 'title' ,   'Orders' )

    // set the active sidebar element
    @section ( 'active' ,   'orders' )

    // set the page content
    @section ( 'content' )
            <div class="container-fluid p-4">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Delivering Address</th>
                        <th>Creation Date</th>
                        <th>Doctor Name</th>
                        <th>Is Insured</th>
                        <th>Status</th>
                        <th>Creator Type</th>
                        <th>Assigned Pharmacy </th>
                        <th>Actions</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order['id']}}</td>
                                <td>{{$order['user_name']}}</td>
                                <td>{{$order['delivery_address']}}</td>
                                <td>{{$order['createdAt']}}</td>
                                <td>{{$order['doctor_name']}}</td>
                                <td>{{$order['is_insured']}}</td>
                                <td>
                                    <span class="badge badge-{{$order['status'] == 'New' ? 'primary' :
                                    ($order['status'] == 'Processing' ? 'success' :
                                    ($order['status'] == 'Delivered' ? 'info' :
                                    ($order['status'] == 'Canceled' ? 'danger' :
                                    ($order['status'] == 'WaitingForUserConfirmation' ? 'warning' : 'dark'))))
                                        }}">{{$order['status']}}</span>
                                </td>
                                <td>{{$order['creator_type']}}</td>
                                <td>{{$order['assigned_pharmacy']}}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{route('admin.orders.show',$order['id'])}}" class="btn btn-outline-info">
                                        <i class="fas fa-info"></i>
                                    </a>
                                    <a href="{{route('admin.orders.edit',$order['id'])}}" class="btn btn-outline-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-outline-danger w-25" data-toggle="modal" data-target="#deleteModal{{$order['id']}}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- /.modal -->
                            <div class="modal fade" id="deleteModal{{$order['id']}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Warning!!! Delete!!!</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are You Sure You Want To Delete ????&hellip;</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <form action="{{route('admin.orders.destroy',$order['id'])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        @endforeach
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>

            </div>


    @endsection

    // set the page scripts
    @section ( 'extra-js' )
        <script src="{{asset('admins/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('admins/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- DataTables  & Plugins -->
        <script src="{{asset('admins/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('admins/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('admins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('admins/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('admins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('admins/plugins/jszip/jszip.min.js')}}"></script>
        <script src="{{asset('admins/plugins/pdfmake/pdfmake.min.js')}}"></script>
        <script src="{{asset('admins/plugins/pdfmake/vfs_fonts.js')}}"></script>
        <script src="{{asset('admins/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('admins/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('admins/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
        <script>
            $(function () {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
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

    // set the page styles
    @section ( 'extra-css' )
        <!-- DataTables -->
        <link rel="stylesheet" href="{{asset('admins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    @endsection

