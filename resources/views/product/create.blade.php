@extends('layout.master')

@section('title', 'Product page')



@section('content-title', isset($product) ? 'Product Edit' : 'Product Create')

@section('content')
    <form action="{{ route('products.save') }}" class="form" method="POST">
        @csrf
        @if (isset($product))
            <input type="hidden" name="id" value="{{ $product->id }}" />
        @endif
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" name="category_id" aria-label="Default select example">
                <option value="">Open this select menu</option>
                @foreach ($cate as $item)
                    <option value="{{ $item->id }}" {{ old('category_id',isset($product) ? $product->category_id : '') == $item->id ? 'selected' : '' }} > {{ $item->name }} </option>
                @endforeach
              </select>
              @error('category_id')
                <div id="passwordHelpBlock" class="form-text text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" class="form-control" id="name" value="{{ old('name',isset($product) ? $product->name : '')}}" />
            @error('name')
            <div id="passwordHelpBlock" class="form-text text-danger">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input name="description" class="form-control" id="description"
                value="{{ old('description',isset($product) ? $product->description : '')}}" />
                @error('description')
                <div id="passwordHelpBlock" class="form-text text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" class="form-control" id="price"
                value="{{ old('price',isset($product) ? $product->price : '')}}" />
                @error('price')
                <div id="passwordHelpBlock" class="form-text text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="image_url">Image Url</label>
            <input name="image_url" class="form-control" id="image_url"
                value="{{old('image_url',isset($product) ? $product->image_url : '')}}" />
                @error('image_url')
                <div id="passwordHelpBlock" class="form-text text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="radio" name="status" id="status" value="0"
                {{ old('status',isset($product) ? $product->status : '') == 0 ? 'checked' : '' }}>
            <label for="status">Deactive</label>
    
        </div>
        <div class="form-group">
            <input type="radio" name="status" id="status" value="1"
                {{ old('status',isset($product) ? $product->status : '') == 1 ? 'checked' : '' }}>
            <label for="status">Active</label>
            <br>
            @error('status')
            <div id="passwordHelpBlock" class="form-text text-danger">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('products.index') }}" class="btn btn-warning">
                Cancel
            </a>
        </div>
    </form>
    <div></div>

@endsection
