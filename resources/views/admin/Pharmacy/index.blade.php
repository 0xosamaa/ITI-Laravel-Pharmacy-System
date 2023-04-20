@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Priority</th>
                        <th>Pharmacy Name</th>
                        <th>Area Name</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($pharmacies as $pharmacy)
                        <tr>
                            <td>{{ $pharmacy->id}}</td>
                            <td>{{ $pharmacy->priority }}</td>
                            <td>{{ $pharmacy->name }}</td>
                            <td>{{ $pharmacy->area->name }}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
