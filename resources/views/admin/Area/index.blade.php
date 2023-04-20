@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                    <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
           
                        @foreach ($areas as $area)
                        <tr>
                            <td>{{ $area->id}}</td>
                            <td>{{ $area->name }}</td>
                            <td>{{ $area->address }}</td>
                        </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection



