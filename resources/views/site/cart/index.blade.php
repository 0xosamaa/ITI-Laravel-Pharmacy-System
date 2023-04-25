@extends('site.layouts.app')
@section('title')
    Cart
@endsection
@section('bread-crumbs')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('site.landing-page') }}">Home</a> <span
                        class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->items as $item)
                                    <tr id="item_{{ $item->id }}">
                                        <td class="product-thumbnail">
                                            <img src="{{ asset($item->medicine->image) }}" alt="Image" class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $item->medicine->name }}</h2>
                                        </td>
                                        @if ($item->medicine->hasActiveDiscount())
                                            <td>
                                                <del>{{ $item->medicine->formatted_price() }}</del>
                                                {{ $item->medicine->formatted_discount() }}
                                            </td>
                                        @else
                                            <td>
                                                {{ $item->medicine->formatted_price() }}
                                            </td>
                                        @endif
                                        <td>
                                            <div class="input-group mb-3" style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <button
                                                        class="btn btn-outline-primary decrease-quantity-button js-btn-minus"
                                                        data-medicine_id="{{ $item->medicine_id }}"
                                                        data-item_id="{{ $item->id }}" type="submit">&minus;
                                                    </button>
                                                </div>
                                                <input type="text" class="form-control text-center" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1" value="{{ $item->quantity }}">
                                                <div class="input-group-append">
                                                    <button
                                                        class="btn btn-outline-primary increase-quantity-button js-btn-plus"
                                                        data-medicine_id="{{ $item->medicine_id }}"
                                                        data-item_id="{{ $item->id }}" type="submit">&plus;
                                                    </button>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="sub_total">
                                            {{ format_price($item->medicine->actual_price() * $item->quantity) }}</td>
                                        <td>
                                            <form action="{{ route('site.cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="medicine_id" value="{{ $item->medicine_id }}">
                                                <button type="submit" class="btn btn-primary height-auto btn-sm">X</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-primary btn-md btn-block">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-primary btn-md btn-block">Continue Shopping</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Coupon</label>
                            <p>Enter your coupon code if you have one.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-md px-4">Apply Coupon</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong
                                        class="text-black final-sub-total">{{ format_price($cart->sub_total()) }}</strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black final-total">{{ format_price($cart->total()) }}</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-lg btn-block"
                                        onclick="window.location='checkout.html'">Proceed To
                                        Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
                        <div class="banner-1-inner align-self-center">
                            <h2>Pharma Products</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio
                                voluptatem.
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
                        <div class="banner-1-inner ml-auto  align-self-center">
                            <h2>Rated by Experts</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio
                                voluptatem.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        });
        sub_total = 0
        total = 0

        $('.increase-quantity-button').on('click', function(event) {
            sub_total = 0
            total = 0
            event.preventDefault();

            let that = $(this);

            $.ajax({
                type: "POST",
                url: "/cart/increase",
                data: {
                    medicine_id: parseInt($(this).data('medicine_id')),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $.ajax({
                        type: "GET",
                        url: "/cart/sub_totals",
                        success: function(cart) {
                            $(`#item_${that.data('item_id')} .sub_total`).text(formatter
                                .format(cart[that
                                    .data('item_id')].item_total / 100))
                            for (const key in cart) {
                                console.log();
                                sub_total += cart[key]['item_total']
                                total += cart[key]['item_total']
                            }
                            $('.final-sub-total').text(formatter.format(sub_total / 100))
                            $('.final-total').text(formatter.format(total / 100))
                        },
                        error: function(xhr, status, error) {}
                    });
                },
                error: function(xhr, status, error) {}
            });

        });
        $('.decrease-quantity-button').on('click', function(event) {
            sub_total = 0
            total = 0
            event.preventDefault();

            let that = $(this);

            $.ajax({
                type: "POST",
                url: "/cart/decrease",
                data: {
                    medicine_id: parseInt($(this).data('medicine_id')),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $.ajax({
                        type: "GET",
                        url: "/cart/sub_totals",
                        success: function(cart) {
                            $(`#item_${that.data('item_id')} .sub_total`).text(formatter
                                .format(cart[that
                                    .data('item_id')].item_total / 100))
                            for (const key in cart) {
                                console.log();
                                sub_total += cart[key]['item_total']
                                total += cart[key]['item_total']
                            }
                            $('.final-sub-total').text(formatter.format(sub_total / 100))
                            $('.final-total').text(formatter.format(total / 100))
                        },
                        error: function(xhr, status, error) {}
                    });
                },
                error: function(xhr, status, error) {}
            });
        });
    </script>
@endsection
