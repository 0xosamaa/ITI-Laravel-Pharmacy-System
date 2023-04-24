@extends ( 'admin.layouts.app' )


@section ( 'title' ,   'Medicines Quantity' )


@section ( 'active' ,   'orders' )


@section ( 'content' )

    <div class="container d-flex justify-center p-5">
        <form method="POST" action="{{ $sender == 'create'? route('admin.orders.store') : route('admin.orders.update', $data['id']) }}">
            @csrf
            @if($sender == 'edit')
                @method('PUT')
            @else
                @method('POST')
            @endif
            <div class="row">
                @foreach($medicines as $item)
                    <div class="form-group col-6">
                        <label for="{{$item->name}}">{{$item->name}}</label>
                        <input type="number" class="form-control" id="{{$item->name}}" name="{{$item->id}}">
                    </div>
                @endforeach
            </div>
            <div class="form-group d-flex justify-content-center align-items-center pt-4 col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            <!-- Order Data -->

            <div hidden class="row">
                <div class="form-group col-6">
                    <label for="doctorName">Doctor Name</label>
                    @if(auth()->user()->hasRole('doctor'))
                        <input type="text" class="form-control" id="doctorName" value="{{auth()->user()['name']}}" readonly>
                    @else
                        <input type="text" class="form-control" readonly id="doctorName">
                    @endif
                </div>
                <div class="form-group col-6">
                    <label for="assignedPharmacy">Assigned Pharmacy</label>
                    <select name="pharmacy_id" class="custom-select rounded-0" id="assignedPharmacy">
                            <option selected value="{{ $data['pharmacy_id'] }}">{{ $data['pharmacy_id'] }}</option>
                    </select>
                </div>
                <div class="form-group col-12">
                    <label for="userName">User Name</label>
                    <select name="user_id" class="custom-select rounded-0" id="userName">
                            <option selected value="{{ $data['user_id'] }}">{{ $data['user_id'] }}</option>
                    </select>
                </div>
                <div class="form-group col-8">
                    <h6 class="font-weight-bold">Medicines</h6>
                    <select id="medicine" class="js-example-basic-multiple w-100" name="medicines[]" multiple="multiple">
                        @foreach($medicines as $medicine)
                            <option selected value="{{ $medicine['id'] }}">{{ $medicine['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                @if($sender == 'edit')
                    <div hidden class="form-group col-8">
                        <select id="status" class="js-example-basic-multiple w-100" name="status">
                            <option selected value="{{ $data['status'] }}">{{ $data['status'] }}</option>
                        </select>
                    </div>
                @endif


            </div>

        </form>
    </div>


@endsection

@section ( 'extra-js' )
    <script src="{{ asset('admins/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
        $('.js-example-basic-multiple').trigger({
            type: 'select2:select',
            params: {
                data: 'Alabama'
            }
        })
    </script>
@endsection

@section ( 'extra-css' )
    <link href="{{ asset('admins/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
@endsection
