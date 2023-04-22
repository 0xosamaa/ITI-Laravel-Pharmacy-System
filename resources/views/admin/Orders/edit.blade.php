@extends ( 'admin.layouts.app' )

// set the page title
@section ( 'title' ,   'Order Edit' )

// set the active sidebar element
@section ( 'active' ,   'orders' )

// set the page content
@section ( 'content' )

    <div class="container d-flex justify-center p-5">
        @if($order->status == 'Completed' || $order->status == 'Cancelled' )
            <div class="alert alert-danger" role="alert">
                You can't edit this order
            </div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Back</a>
        @else
            <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-6">
                        <label for="doctorName">Doctor Name</label>
                        <input name type="text" readonly value="{{ auth()->user()->hasRole('doctor') ? $order->doctor->name : null }}" class="form-control" id="doctorName">
                    </div>
                    <div class="form-group col-6">
                        <label for="assignedPharmacy">Assigned Pharmacy</label>
                        <select name="pharmacy_id" class="custom-select form-select" id="assignedPharmacy">
                            @if(auth()->user()->hasRole('doctor') | $order->status == 'Confirmed' | $order->status == 'WaitingForUserConfirmation')
                                <option value="{{ $order->pharmacy->id }}" selected>{{ $order->pharmacy->name }}</option>
                            @elseif(($order->status <> 'Confirmed' | $order->status <> 'WaitingForUserConfirmation') & auth()->user()->hasRole('admin'))
                                @foreach($pharmacies as $pharmacy)
                                    <option value="{{ $pharmacy->id }}"  {{ $pharmacy->id === $order->pharmacy_id ? 'selected' : '' }}>{{ $pharmacy->name }}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="userName">User Name</label>
                        <select class="custom-select form-select" id="userName">
                            @if($order->status == 'Confirmed' | $order->status == 'WaitingForUserConfirmation')
                                <option value="{{ $order->user_id }}" selected>{{ $order->user->name }}</option>
                            @else
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id === $order->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="status">Status</label>
                        <select name="status" class="custom-select form-select" id="status">
                            <option {{ $order->status === 'New' ? 'selected' : '' }} value="New" >New</option>
                            <option {{ $order->status === 'Processing'? 'selected' : '' }} value="Processing" >Processing</option>
                            <option {{ $order->status === 'WaitingForUserConfirmation' ? 'selected' : '' }} value="WaitingForUserConfirmation">WaitingForUserConfirmation</option>
                            <option {{ $order->status === 'Canceled' ? 'selected' : '' }} value="Canceled" >Canceled</option>
                            <option {{ $order->status === 'Confirmed' ? 'selected' : '' }} value="Confirmed" >Confirmed</option>
                            <option {{ $order->status === 'Delivered' ? 'selected' : '' }} value="Delivered" >Delivered</option>
                        </select>
                    </div>
                    <div class="form-group col-8">
                        <h6 class="font-weight-bold">Medicine</h6>
                        <select id="medicine" class="custom-select form-select w-100" name="medicines[]" multiple="multiple">
                            @if($order->status == 'Confirmed' | $order->status == 'WaitingForUserConfirmation')
                                @foreach($order->items as $item)
                                    <option value="{{ $item->medicine->id }}" selected>{{ $item->medicine->name }}</option>
                                @endforeach
                            @else
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}" {{ in_array($medicine->id, $order->items->pluck('medicine_id')->toArray()) ? 'selected' : '' }}>{{ $medicine->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-center align-items-center pt-4 col-4">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>

            </form>
        @endif
    </div>


@endsection

// set the page scripts
@section ( 'extra-js' )
    <script src="{{ asset('admins/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>

        $('.custom-select').select2({
            theme: 'bootstrap4'
        });
    </script>
@endsection

// set the page styles
@section ( 'extra-css' )
    <link rel="stylesheet" href={{ asset('admins/plugins/select2/css/select2.min.css') }}>
    <link rel="stylesheet" href={{ asset('admins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>

@endsection
