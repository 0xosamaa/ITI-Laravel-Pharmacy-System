@extends ( 'admin.layouts.app' )

@section ( 'title' ,   'Order Details' )

@section ( 'active' ,   'orders' )

@section ( 'content' )

    <div class="container-fluid row d-flex justify-content-around p-5 h-75">
        <div class="card p-3 col-4">
            <h5>
                Doctor Name : <span style="color: #777;"> {{ auth()->user()->hasRole('doctor') ? $order->doctor->name : "" }}</span>
            </h5>
            <hr>
            <h5>
                User Name : <span style="color: #777;"> {{ $order->user->name }}</span>
            </h5>
            <hr>
            <h5>
                Creation Date : <span style="color: #777;"> {{ $order['created_at'] }}</span>
            </h5>
            <hr>
            <h5>
                Delivering Address : <span style="color: #777;"> {{ $order['delivery_address'] }}</span>
            </h5>
            <hr>
            <h5>
                Is Insured : <span style="color: #777;"> {{ $order['is_insured']==1 ? 'True' : 'False' }}</span>
            </h5>
            <hr>
            <h5>
                Status : <span style="color: #777;"> {{ $order['status'] }}</span>
            </h5>
            <hr>
            <h5>
                Creator Type : <span style="color: #777;"> {{ $order['creator_type'] }}</span>
            </h5>
            <hr>
            <h5>
                Assigned Pharmacy : <span style="color: #777;"> {{ $order->pharmacy->name }}</span>
            </h5>
            <hr>
            <div class="buttons w-100 d-flex justify-content-around">
                <a href="{{route('admin.orders.edit',$order['id'])}}" class="btn btn-outline-success w-25">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{route('admin.orders.index')}}" class="btn btn-outline-info w-25">
                    <i class="fas fa-info"></i>
                </a>
                @if($order->status == 'WaitingForUserConfirmation' || $order->status == 'Confirmed')
                    <a href="#" class="btn btn-outline-secondary w-25">
                        <i class="fas fa-money-bill"></i>
                    </a>
                @endif
            </div>
        </div>
        <div class="card p-3 col-7 d-flex align-items-center justify-content-center  flex-column" style="overflow: scroll;">
            @foreach($order->items as $item)
                <div class="card p-3 col-10 d-flex flex-row justify-content-around align-items-center" style="max-height: 80px">
                    <h5>
                        Name : <span style="color: #777;"> {{ $item->medicine->name }}</span>
                    </h5>
                    <h6>
                        Price : <span style="color: #777;"> {{ format_price($item->medicine->price) }}</span>
                    </h6>
                    <h6>
                        Quantity : <span style="color: #777;"> {{ $item['quantity'] }}</span>
                    </h6>
                </div>
            @endforeach


        </div>

    </div>


@endsection

@section ( 'extra-js' )
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
@endsection

@section ( 'extra-css' )
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
@endsection
