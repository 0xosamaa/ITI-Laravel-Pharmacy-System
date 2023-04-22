@extends('admin.layouts.app')
@section('title')
    New Medicine
@endsection
@section('extra-css')
    <!-- Select2 -->
    <link rel="stylesheet" href={{ asset('admins/plugins/select2/css/select2.min.css') }}>
    <link rel="stylesheet" href={{ asset('admins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>

    <!-- Toastr -->
    <link rel="stylesheet" href={{ asset('admins/plugins/toastr/toastr.min.css') }}>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">New Medicine</h3>
        </div>
        <form action="{{ route('admin.medicines.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control" id="description"
                        placeholder="Enter Description">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" inputmode="numeric" name="price" class="form-control" id="price"
                        placeholder="Enter Price">
                </div>
                <div class="form-group">
                    <label for="name">SKU</label>
                    <input type="text" inputmode="numeric" name="SKU" class="form-control" id="SKU"
                        placeholder="Enter SKU">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image">
                            <label class="custom-file-label" for="image">Choose Image</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-select select2 w-100" name="category_id" id="category_id">
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <label for="discount_id">Discount</label>
                <select class="form-select select2 w-100" name="discount_id" id="discount_id">
                    @forelse ($discounts as $discount)
                        <option value="{{ $discount->id }}">{{ $discount->name }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
    </div>
@endsection

@section('extra-js')
    <!-- Select2 -->
    <script src={{ asset('admins/plugins/select2/js/select2.full.min.js') }}></script>

    <!-- Toastr -->
    <script src={{ asset('admins/plugins/toastr/toastr.min.js') }}></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr["error"]("{{ $error }}", "Error")
                @endforeach

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            @endif
        });
    </script>
@endsection
