@extends('admin.layouts.app')

@section('title')
    Payment Through Stripe
@endsection

@section('content')
    <form action="{{ route('admin.stripe.post') }}" method="post">
        @csrf
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ config('services.stripe.key') }}"
                data-amount="1000"
                data-name="Example"
                data-description="Example charge"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-currency="usd"
                data-email="customer@example.com">
        </script>
    </form>
@endsection
