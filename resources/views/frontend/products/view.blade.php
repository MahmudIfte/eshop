@extends('layouts.front')
@section('title', $products->name)
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ url('/add-rating') }}" method="POST">
                    @csrf


                    <input type="hidden" name="product_id" value="{{ $products->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rate {{ $products->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">

                                @if ($user_rating)
                                    @for ($i = 1; $i <= $user_rating->stars_rated; $i++)
                                        <input type="radio" value="{{ $i }}" name="product_rating" checked
                                            id="rating{{ $i }}">
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                    @for ($j = $user_rating->stars_rated + 1; $j <= 5; $j++)
                                        <input type="radio" value="{{ $j }}" name="product_rating"
                                            id="rating{{ $j }}">
                                        <label for="rating{{ $j }}" class="fa fa-star"></label>
                                    @endfor

                                @else
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                @endif



                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <div class="mb-0">
                <h6>Collections/{{ $products->category->name }}/{{ $products->name }}</h6>
            </div>

            {{-- <h6 class="mb-0">
                <a href="{{ url('category') }}">Collections</a>/
                <a href="{{ url('category/' . $products->category->slug) }}">{{ $product->category->name }}</a>/
                <a
                    href="{{ url('category/' . $products->category->slug . '/' . $product->slug) }}">{{ $product->category->name }}</a>/

            </h6> --}}

        </div>
    </div>

    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="col-mb-4 border-right">
                        <img src="{{ asset('assets/uploads/products/' . $products->image) }}" class="img-responsive w-25"
                            alt="">
                    </div>
                    <div class="col-md-8">
                        {{-- <div class="mb-0"> --}}
                        <h2>
                            {{ $products->name }}

                            @if ($products->trending == '1')
                                <label class="float-end badge bg-danger thending_tag"
                                    style="font-size:16px;">Trending</label>
                            @endif
                        </h2>
                        <hr>
                        <label class="me-3">Original_Price:<s>BDT{{ $products->original_price }}</s></label>
                        <label class="fw-bold">Selling_Price:BDT {{ $products->selling_price }}</label>
                        @php $ratenum=number_format($rating_value) @endphp
                        <div class="rating">
                            @for ($i = 1; $i <= $ratenum; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for ($j = $ratenum + 1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>
                                @if ($ratings->count() > 0)
                                    {{ $ratings->count() }} Ratings
                                @else
                                    No ratings
                                @endif
                            </span>
                        </div>
                        <p class="mt-3">
                            {!! $products->small_description !!}
                        </p>
                        <hr>
                        @if ($products->qty > 0)
                            <label class="badge bg-success">In stock</label>
                        @else
                            <label class="badge bg-success">Out of stock</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                <label class="Quantity">Quantity:</label>
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity " value="1"
                                        class="form-control text-center qty-input" />
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <br />
                                @if ($products->qty > 0)
                                    <label class="badge bg-success">In stock</label>
                                    <button type="button" class="btn btn-success me-3 addToCartBtn float-start">Add to cart
                                        <i style="color:rgb(4, 0, 255);" class="fa fa-shopping-cart"></i> </button>
                                    {{-- @else
                                    <label class="badge bg-success">Out of stock</label> --}}
                                @endif
                                <button type="button" class="btn btn-success me-3 addToWishlist float-start">Add to
                                    wishlist <i style="color:rgb(119, 0, 0);" class="fa fa-heart"></i> </button>
                            </div>
                        </div>
                        {{-- </div> --}}
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <h3>Description</h3>
                        <p class="mt-3">
                            {!! $products->description !!}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Rate this product
                        </button>
                        <a href="{{ url('add-review/'.$products->slug.'/userreview') }}" class="btn btn-link">
                            Write a review
                        </a>
                    </div>
                    <div class="col-md-8">
                        @foreach ($reviews as $item)
                            <div class="user-review">
                                <label for="">{{ $item->user->name . ' ' . $item->user->lname }}</lable>
                                    @if ($item->user_id == Auth::id())
                                        <a href="{{ url('edit-review/' . $product->slug . '/userreview') }}">edit</a>
                                    @endif
                                    <br>
                                    @if ($item->rating)
                                        @php $user_rated=$item->rating->stars_rated @endphp

                                        @for ($i = 1; $i <= $user_rated; $i++)
                                            <i class="fa fa-star checked"></i>
                                        @endfor
                                        @for ($j = $user_rated + 1; $j <= 5; $j++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    @endif
                                    <small>Reviewed on {{ $item->created_at->format('d M Y') }}</small>
                                    <p>
                                        {{ $item->user_review }}
                                    </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

{{-- @section('scripts')
    <script>

    </script>
@endsection --}}
