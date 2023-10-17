@extends('dashboard')
@section('content')
<main class="signup-form">
    <div class="row d-flex justify-content-center my-5">
        <h1 class="fs-3 text-dark text-center fw-bold my-3">Create New Product</h1>
        @include('layouts.partials.error')
        @include('layouts.partials.success')
        <form class="row g-3" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="coverImage" class="form-label">Cover Image</label>
            <div class="col-md-6">
                <img id="frame" src="" class="cover-image" />
            </div>
            <div class="col-md-9">
                <div class="input-group col-md-6 mb-3">
                    @if ($errors->has('cover_image'))
                        <span class="text-danger">{{ $errors->first('cover_image') }}</span>
                    @endif
                    <input type="file" class="form-control" id="coverImage" name="cover_image" onchange="preview()">
                    <label class="input-group-text" for="coverImage">Upload</label>
                    <button class="btn btn-primary mx-2" onclick="clearImage()">Remove Cover</button>
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputTitle" class="form-label">Title</label>
                <input type="text" id="inputTitle" class="form-control" placeholder="Title" name="title" aria-label="Title">
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputIsbn" class="form-label">ISBN</label>
                <input type="number" id="inputIsbn" class="form-control" name="isbn" placeholder="International Standard Book Number" aria-label="ISBN">
                @if ($errors->has('isbn'))
                    <span class="text-danger">{{ $errors->first('isbn') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputAuther" class="form-label">Auther</label>
                <input type="text" id="inputAuther" class="form-control" name="author" placeholder="Auther" aria-label="Auther">
                @if ($errors->has('author'))
                    <span class="text-danger">{{ $errors->first('author') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputGenre" class="form-label">Genre</label>
                <input type="text" id="inputGenre" class="form-control" name="genre" placeholder="Such as the epic, tragedy, comedy, novel, and short story" aria-label="Genre">
                @if ($errors->has('genre'))
                    <span class="text-danger">{{ $errors->first('genre') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputPublisher" class="form-label">Publisher</label>
                <input type="text" id="inputPublisher" class="form-control" placeholder="Publisher" name="publisher" aria-label="Publisher">
                @if ($errors->has('publisher'))
                    <span class="text-danger">{{ $errors->first('publisher') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputPublisherDate" class="form-label">Publisher Date</label>
                <input type="date" id="inputPublisherDate" class="form-control" placeholder="Publisher Date" name="published_date" aria-label="Publisher">
                @if ($errors->has('published_date'))
                    <span class="text-danger">{{ $errors->first('published_date') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputBuyPrice" class="form-label">Buy Price</label>
                <input type="number" id="inputBuyPrice" class="form-control" placeholder="Product Buy Price" min="0" value="0" name="buy_price" aria-label="Buy Price">
                @if ($errors->has('buy_price'))
                    <span class="text-danger">{{ $errors->first('buy_price') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputSalePrice" class="form-label">Sale Price</label>
                <input type="number" id="inputSalePrice" class="form-control" placeholder="Product Sale Price" min="0" value="0" name="sale_price" aria-label="Sale Price">
                @if ($errors->has('sale_price'))
                    <span class="text-danger">{{ $errors->first('sale_price') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputSaleDisc" class="form-label">Sale Discount</label>
                <input type="number" id="inputSaleDisc" class="form-control" placeholder="Product Sale Disc" min="0" value="0" name="disc" aria-label="Sale Disc">
                @if ($errors->has('disc'))
                    <span class="text-danger">{{ $errors->first('disc') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputqty" class="form-label">Stock</label>
                <input type="number" id="inputqty" class="form-control" placeholder="Stock" aria-label="Stock" value="0" name="quantity">
                @if ($errors->has('quantity'))
                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                @endif
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Create Product</button>
            </div>
        </form>
    </div>
</main>
@endsection