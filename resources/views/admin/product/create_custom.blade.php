@extends('dashboard')
@section('content')
<main class="signup-form">
    <div class="row d-flex justify-content-center mx-md-5 my-5">
        <h1 class="fs-3 text-dark text-center fw-bold my-3">Create New Custom Product</h1>
        @include('layouts.partials.error')
        @include('layouts.partials.success')
        <form class="row g-3" action="{{ route('custom-product-create') }}" method="POST" enctype="multipart/form-data">
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
                <label for="inputbarcode" class="form-label">Barcode</label>
                <input type="number" id="inputbarcode" class="form-control" name="isbn" placeholder="Barcode" aria-label="barcode">
                @if ($errors->has('isbn'))
                    <span class="text-danger">{{ $errors->first('isbn') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputBuyPrice" class="form-label">Cost Price</label>
                <input type="number" id="inputBuyPrice" class="form-control" placeholder="Product Cost Price" value="0" name="cost_price" aria-label="Cost Price">
                @if ($errors->has('cost_price'))
                    <span class="text-danger">{{ $errors->first('cost_price') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputSalePrice" class="form-label">Sale Price</label>
                <input type="number" id="inputSalePrice" class="form-control" placeholder="Product Sale Price" value="0" name="sale_price" aria-label="Sale Price">
                @if ($errors->has('sale_price'))
                    <span class="text-danger">{{ $errors->first('sale_price') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputSaleDisc" class="form-label">Sale Discount</label>
                <input type="number" id="inputSaleDisc" class="form-control" placeholder="Product Sale Disc" name="disc" min='0' value="0" aria-label="Sale Disc">
                @if ($errors->has('disc'))
                    <span class="text-danger">{{ $errors->first('disc') }}</span>
                @endif
            </div>
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Create Custom Product</button>
            </div>
        </form>
    </div>
</main>
@endsection