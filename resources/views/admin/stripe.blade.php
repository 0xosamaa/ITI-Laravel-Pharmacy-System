@extends('admin.layouts.app')

@section('title')
    Payment Through Stripe
@endsection

@section('content')
    @if(session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif
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
