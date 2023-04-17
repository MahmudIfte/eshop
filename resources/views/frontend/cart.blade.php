@extends('layouts.front')
@section('title')
    My Cart
@endsection
@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a style="color: black" href="{{ url('/') }}">Home</a>/
                <a style="color: black" href="{{ url('cart') }}">cart</a>
            </h6>
        </div>
    </div>
    <div class="container my-5">
        {{-- product_data --}}
        <div class="card shadow ">
            @if ($cartItems->count() > 0)
                <div class="card-body">
                    @php
                        $total=0;
                    @endphp
                    @foreach ($cartItems as $item)
                        <div class="row product_data">
                            <div class="col-md-2 ">
                                <img src="{{ asset('assets/uploads/products/' . $item->products->image) }}" height="70px"
                                    width="70px" alt="Image here">
                            </div>
                            <div class="col-md-2 ">
                                <h2>{{ $item->products->name }}</h2>
                            </div>
                            <div class=" col-md-2">
                                <label for="Selling price">Selling price</label>
                                <h2>{{ $item->products->selling_price }}</h2>
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                @if ($item->products->qty > $item->prod_qty)
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3 col-md-2" style="width:130px;">
                                        <button class="input-group-text changeQuantity decrement-btn">-</button>
                                        <input type="text" class="from-control qty-input text-center w-25" name="quantity"
                                            value="{{ $item->prod_qty }}">
                                        <button class="input-group-text changeQuantity increment-btn">+</button>
                                    </div>
                                    @php
                                    $total += $item->products->selling_price * $item->prod_qty;
                                    @endphp
                                @else
                                    <h6>Out of stock</h6>
                                @endif
                            </div>
                            <div class="col-md-2 mt-4">
                                <button class="btn btn-danger delete-cart-item"><i class="fa fa-trash"></i>
                                    Delete</button>
                            </div>
                        </div>
                        {{-- @php
                        $total += $item->products->selling_price * $item->prod_qty;
                        @endphp --}}
                    @endforeach
                </div>
                <div class="card-footer">
                    <h6>Total Price : BDT{{ $total }}
                        <a href="{{ url('/checkout') }}" class="btn btn-outline-success float-end">Proceed To Check_out</a>
                    </h6>
                </div>
            @else
                <div class="card-body text-center">
                    <h2>Your <i class="fa fa-shopping-cart"></i>Cart is empty</h2>
                    <a href="{{ url('category') }}" class="btn btn-outline-success float-end">Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>

@endsection
