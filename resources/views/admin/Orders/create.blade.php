@extends ( 'admin.layouts.app' )

// set the page title
@section ( 'title' ,   'Order Create' )

// set the active sidebar element
@section ( 'active' ,   'orders' )

// set the page content
@section ( 'content' )

    <div class="container d-flex justify-center p-5">
        <form method="POST" action="{{ route('admin.orders.store') }}">
            @csrf
            @method('POST')
            <div class="row">
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
                    @if(auth()->user()->hasRole('admin'))
                        @foreach($pharmacies as $pharmacy)
                            <option value="{{ $pharmacy->id }}">{{ $pharmacy->name }}</option>
                        @endforeach
                    @elseif(auth()->user()->hasRole('doctor'))
                            <option selected value="{{ auth()->user()->doctor->$pharmacy_id }}">{{ auth()->user()->doctor->pharmacy->name }}</option>
                    @else
                    @endif

                    </select>
                </div>
                <div class="form-group col-12">
                    <label for="userName">User Name</label>
                    <select name="user_id" class="custom-select rounded-0" id="userName">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-8">
                    <h6 class="font-weight-bold">Medicines</h6>
                    <select id="medicine" class="js-example-basic-multiple w-100" name="medicines[]" multiple="multiple">
                        @foreach($medicines as $medicine)
                            <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group d-flex justify-content-center align-items-center pt-4 col-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>


@endsection

// set the page scripts
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

// set the page styles
@section ( 'extra-css' )
    <link href="{{ asset('admins/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
@endsection
