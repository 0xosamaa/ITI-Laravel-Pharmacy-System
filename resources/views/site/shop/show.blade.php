@extends('site.layouts.app')
@section('title')
    {{ $medicine->name }}
@endsection
@section('bread-crumbs')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('site.landing-page') }}">Home</a>
                    <span class="mx-2 mb-0">/</span>
                    <a href="{{ route('site.shop.index') }}">Shop</a>
                    <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">{{ $medicine->name }}</strong>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mr-auto">
                    <div class="border text-center">
                        <img src="{{ asset($medicine->image) }}" alt="Image" class="img-fluid p-5">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $medicine->name }}</h2>
                    <small>Category: {{ $medicine->category->name }}</small>
                    <p>{{ $medicine->description }}</p>
                    @if ($medicine->hasActiveDiscount())
                        <p><del>{{ $medicine->formatted_price() }}</del> <strong
                                class="text-primary h4">{{ $medicine->formatted_discount() }}</strong>
                        </p>
                    @else
                        <p><strong class="text-primary h4"></strong></p>
                    @endif
                    <p>
                    <form action="{{ route('site.cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="medicine_id" value="{{ $medicine->id }}">
                        <button type="submit"
                            class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary add-to-cart-button"
                            data-medicine_id="{{ $medicine->id }}">Add To
                            Cart</button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-secondary bg-image" style="background-image: url('{{ asset('site/images/bg_2.jpg') }}');">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <a href="#" class="banner-1 h-100 d-flex"
                        style="background-image: url('{{ asset('site/images/bg_1.jpg') }}');">
                        <div class="banner-1-inner align-self-center">
                            <h2>Pharma Products</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio
                                voluptatem.
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <a href="#" class="banner-1 h-100 d-flex"
                        style="background-image: url('{{ asset('site/images/bg_2.jpg') }}');">
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
        $('.add-to-cart-button').on('click', function(event) {
            event.preventDefault();

            $.ajax({
                type: "POST",
                url: "/cart/add",
                data: {
                    medicine_id: parseInt($(this).data('medicine_id')),
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    let items_no = parseInt($('.cart-number').text())
                    $('.cart-number').text(++items_no)
                },
                error: function(xhr, status, error) {
                    window.location.href = '/login';
                }
            });

        });
    </script>
@endsection
