    @extends ( 'admin.layouts.app' )

    @section ( 'title' ,   'Orders' )

    @section ( 'active' ,   'orders' )

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
                        @if(auth()->user()->hasRole('admin'))
                            <th>Creator Type</th>
                            <th>Assigned Pharmacy </th>
                        @endif
                        <th>Actions</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order['id']}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order['delivery_address']}}</td>
                                <td>{{$order['created_at']}}</td>
                                @if($order->doctor)
                                    <td>{{$order->doctor->name}}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{$order['is_insured']==1 ? 'True' : 'False' }}</td>
                                <td>
                                    <span class="badge badge-{{$order['status'] == 'New' ? 'primary' :
                                    ($order['status'] == 'Processing' ? 'success' :
                                    ($order['status'] == 'Delivered' ? 'info' :
                                    ($order['status'] == 'Canceled' ? 'danger' :
                                    ($order['status'] == 'WaitingForUserConfirmation' ? 'warning' : 'dark'))))
                                        }}">{{$order['status']}}</span>
                                </td>
                                @if(auth()->user()->hasRole('admin'))
                                    <td>{{$order['creator_type']}}</td>
                                    <td>{{$order->pharmacy->name}}</td>
                                @endif
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
            <a href="{{route('admin.orders.create')}}" class="btn btn-primary d-flex justify-content-center align-items-center rounded-circle shadow-lg" style="position: fixed; bottom: 30px; right: 30px; z-index: 1000;width: 50px;height: 50px">
                <i class="fas fa-plus"></i>
            </a>



    @endsection

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

    @section ( 'extra-css' )
        <!-- DataTables -->
        <link rel="stylesheet" href="{{asset('admins/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    @endsection

