@extends('dashboard')
@section('content')
<main class="signup-form">
    <div class="row d-flex justify-content-center my-5">
        <h1 class="fs-3 text-dark text-center fw-bold my-3">Edit Product</h1>
        @include('layouts.partials.error')
        @include('layouts.partials.success')
        <form class="row g-3" action="{{ route('product.update',[$product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="coverImage" class="form-label">Cover Image</label>
            <div class="col-md-6">
                <img id="frame" src="{{ asset('cover_images/' . $product->cover_image_path) }}" class="cover-image" />
            </div>
            <div class="col-md-9">
                <div class="input-group col-md-6 mb-3">
                    @if ($errors->has('cover_image'))
                        <span class="text-danger">{{ $errors->first('cover_image') }}</span>
                    @endif
                    <input type="file" class="form-control" id="coverImage" name="cover_image" value="{{$product->cover_image_path}}" onchange="preview()">
                    <label class="input-group-text" for="coverImage">Upload</label>
                    <button class="btn btn-primary mx-2" onclick="clearImage()">Remove Cover</button>
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputTitle" class="form-label">Title</label>
                <input type="text" id="inputTitle" class="form-control" placeholder="Title" name="title" aria-label="Title" value="{{$product->title}}">
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputIsbn" class="form-label">ISBN</label>
                <input type="number" id="inputIsbn" class="form-control" name="isbn" placeholder="International Standard Book Number" value="{{$product->isbn}}" aria-label="ISBN">
                @if ($errors->has('isbn'))
                    <span class="text-danger">{{ $errors->first('isbn') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputAuther" class="form-label">Auther</label>
                <input type="text" id="inputAuther" class="form-control" name="author" placeholder="Auther" aria-label="Auther" value="{{$product->author}}">
                @if ($errors->has('author'))
                    <span class="text-danger">{{ $errors->first('author') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputGenre" class="form-label">Genre</label>
                <input type="text" id="inputGenre" class="form-control" name="genre" placeholder="Such as the epic, tragedy, comedy, novel, and short story" aria-label="Genre" value="{{$product->genre}}">
                @if ($errors->has('genre'))
                    <span class="text-danger">{{ $errors->first('genre') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputPublisher" class="form-label">Publisher</label>
                <input type="text" id="inputPublisher" class="form-control" placeholder="Publisher" name="publisher" aria-label="Publisher" value="{{$product->publisher}}">
                @if ($errors->has('publisher'))
                    <span class="text-danger">{{ $errors->first('publisher') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputPublisherDate" class="form-label">Publisher Date</label>
                <input type="date" id="inputPublisherDate" class="form-control" placeholder="Publisher Date" name="published_date" aria-label="Publisher" value="{{$product->published_date}}">
                @if ($errors->has('published_date'))
                    <span class="text-danger">{{ $errors->first('published_date') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputBuyPrice" class="form-label">Buy Price</label>
                <input type="number" id="inputBuyPrice" class="form-control" placeholder="Product Buy Price" name="buy_price" aria-label="Buy Price" value="{{$product->buy_price}}">
                @if ($errors->has('buy_price'))
                    <span class="text-danger">{{ $errors->first('buy_price') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputSalePrice" class="form-label">Sale Price</label>
                <input type="number" id="inputSalePrice" class="form-control" placeholder="Product Sale Price" name="sale_price" aria-label="Sale Price" value="{{$product->sale_price}}">
                @if ($errors->has('sale_price'))
                    <span class="text-danger">{{ $errors->first('sale_price') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputSaleDisc" class="form-label">Sale Discount</label>
                <input type="number" id="inputSaleDisc" class="form-control" placeholder="Product Sale Disc" name="disc" aria-label="Sale Disc" value="{{$product->disc}}">
                @if ($errors->has('disc'))
                    <span class="text-danger">{{ $errors->first('disc') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputqty" class="form-label">Stock</label>
                <input type="number" id="inputqty" class="form-control" placeholder="Stock" aria-label="Stock" name="quantity" value="{{$product->quantity}}">
                @if ($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
            </div>
            <div class="col-12 d-flex justify-content-center ">
                <button type="submit" class="btn btn-primary" href="{{ route('product.update', [$product->id]) }}">Update</button>
            </div>
        </form>
    </div>
</main>
@endsection