@extends('layouts.front')
@section('title')
    My Cart
@endsection
@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a style="color: black" href="{{ url('/') }}">Home</a>/
                <a style="color: black" href="{{ url('wishlist') }}">Wishlist</a>
            </h6>
        </div>
    </div>
    <div class="container my-5">
        {{-- product_data --}}
        <div class="card shadow ">
            <div class="card-body">
                @if ($wishlist->count() > 0)
                    @foreach ($wishlist as $item)
                        <div class="row product_data">
                            <div class="col-md-2 my-auto ">
                                <img src="{{ asset('assets/uploads/products/' . $item->products->image) }}" height="70px"
                                    width="70px" alt="Image here">
                            </div>
                            <div class="col-md-2 my-auto ">
                                <h2>{{ $item->products->name }}</h2>
                            </div>
                            <div class=" col-md-2 my-auto">
                                <label for="Selling price">Selling price</label>
                                <h2>{{ $item->products->selling_price }}</h2>
                            </div>

                            <div class="col-md-2 my-auto">
                                <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                @if ($item->products->qty >= $item->prod_qty)
                                    {{-- @php $total += $item->products->selling_price*$item->prod_qty;@endphp --}}
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3 col-md-2" style="width:130px;">
                                        <button class="input-group-text decrement-btn">-</button>
                                        <input type="text" class="from-control qty-input text-center w-25" name="quantity"
                                            value="1">
                                        <button class="input-group-text increment-btn">+</button>
                                    </div>
                                    {{-- <h6>In stock</h6> --}}

                                @else
                                    <h6>Out of stock</h6>

                                @endif

                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-success addToCartBtn"><i class="fa fa-shopping-cart"></i>
                                    Add to Cart</button>
                            </div>

                            <div class="col-md-2 my-auto">
                                <button class="btn btn-danger remove-wishlist-item"><i class="fa fa-trash"></i>
                                    Remove</button>
                            </div>
                        </div>

                    @endforeach
                @else
                    <h4>There is no product</h4>

                @endif
            </div>



        </div>
    </div>
@endsection
