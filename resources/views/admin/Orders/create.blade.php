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
                    <input type="text" class="form-control" id="doctorName">
                </div>
                <div class="form-group col-6">
                    <label for="assignedPharmacy">Assigned Pharmacy</label>
                    <input type="text" class="form-control" id="assignedPharmacy">
                </div>
                <div class="form-group col-12">
                    <label for="userName">User Name</label>
                    <select class="custom-select rounded-0" id="userName">
                        <option>Value 1</option>
                        <option>Value 2</option>
                        <option>Value 3</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="medicine">User Name</label>
                    <select name="medicines[]" class="selectpicker" id="medicine" multiple aria-label="Default select example" data-live-search="true">
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>


@endsection

// set the page scripts
@section ( 'extra-js' )
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
@endsection

// set the page styles
@section ( 'extra-css' )
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
@endsection
