@extends('layouts/admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Add Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('update-product/' . $products->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select">
                            <option value="">{{ $products->category->name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $products->name }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ $products->slug }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Small Description</label>
                        <textarea name="small_description" rows="3"
                            class="form-control">{{ $products->small_description }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" rows="3"
                            class="form-control">{{ $products->description }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">original_price</label>
                        <input type="number" name="original_price" class="form-control"
                            value="{{ $products->original_price }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">selling_price</label>
                        <input type="number" name="selling_price" class="form-control"
                            value="{{ $products->selling_price }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Quantity</label>
                        <input type="number" name="qty" class="form-control" value="{{ $products->qty }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">tax</label>
                        <input type="number" name="tax" class="form-control" value="{{ $products->tax }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" {{ $products->status == 1 ? 'checked' : '' }} name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">trending</label>
                        <input type="checkbox" {{ $products->trending == 1 ? 'checked' : '' }} name="trending">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ $products->meta_title }}">
                    </div>
                    <div class="col-md-12">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" rows="3"
                            class="form-control">{{ $products->meta_keywords }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_descrip" rows="3"
                            class="form-control">{{ $products->meta_descrip }}</textarea>
                    </div>

                    @if ($products->image)
                        <img src="{{ asset('assets/uploads/products/' . $products->image) }}" height="300px" weight="300px" alt="">
                    @endif
                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                    </div>


                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
