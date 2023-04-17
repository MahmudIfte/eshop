@extends('layouts.front')
@section('title')
    Category
@endsection
@section('content')
    <div class="py-5">
        <div class="container">
            <h2>All categories</h2>
            <div class="row my-5" style="background-color:rgba(219, 213, 213, 0.829)">


                <div class="col-md-12">


                    <div class="row">

                        @foreach ($category as $cate)
                            <div class="col-lg-4 col-md-4 mb-4 ">
                                <a href="{{ url('view-category/' . $cate->slug) }}">
                                    <div class="card " style="background-color:rgba(219, 213, 213, 0.829)">
                                        <img src="{{ asset('assets/uploads/category/' . $cate->image) }}" height="300px"
                                            weight="300px" class="img-responsive" alt="category here">
                                        <div class="card-body">
                                            <h4>{{ $cate->name }}</h4>
                                            <p>{{ $cate->small_description }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
