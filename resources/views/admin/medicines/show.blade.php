@extends('admin.layouts.app')
@section('title')
    {{ $medicine->name }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $medicine->name }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-4 order-1 order-md-2">
                    <img src="{{ asset($medicine->image) }}" alt="">
                </div>
                <div class="col-12 col-sm-8 order-1 order-md-2">
                    <h3 class="text-primary">{{ $medicine->name }}</h3>
                    <div class="text-muted">
                        <p class="text-sm">
                            Category: <b>{{ $medicine->category->name }}</b>
                        </p>
                    </div>
                    <p class="text-muted">{{ $medicine->description }}</p>
                    <br>
                    <h5 class="mt-5 text-muted">Medicine Info</h5>
                    <ul class="list-unstyled">
                        <li>
                            <p class="text-sm">
                                SKU: <b>{{ $medicine->SKU }}</b>
                            </p>
                        </li>
                        @if ($medicine->hasActiveDiscount())
                            <li>
                                <p class="text-sm">
                                    Price: <del><b>{{ $medicine->formatted_price() }}</b></del>
                                </p>
                            </li>
                            <li>
                                <p class="text-sm">
                                    Price after discount:
                                    <b>{{ $medicine->formatted_discount() }} ({{ $medicine->discount->discount_percent }}%)</b>
                                </p>
                            </li>
                        @else
                            <li>
                                <p class="text-sm">
                                    Price: {{ $medicine->formatted_price() }}</del>
                                </p>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
