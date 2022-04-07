@extends('layout.master')

@section('title', 'Category page')



@section('content-title', isset($category) ? 'Category Edit' : 'Category Create')

@section('content')
    <form action="{{ route('categories.save') }}" class="form" method="POST">
        @csrf
        @if (isset($category))
            <input type="hidden" name="id" value="{{ $category->id }}"/>
        @endif
        <div class="form-group">
            <label for="parent_id">Parent Category</label>
            <select class="form-control" name="parent_id" aria-label="Default select example">
                <option value="">Open this select menu</option>
                @foreach ($parentCategory as $item)
                    <option value="{{ $item->id }}" {{ old('parent_id',isset($category) ? $category->parent_id : '') == $item->id ? 'selected' : '' }} > {{ $item->name }} </option>
                @endforeach
              </select>
              @error('parent_id')
                <div id="passwordHelpBlock" class="form-text text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" class="form-control" id="name" value="{{ old('name' ,isset($category) ? $category->name : '') }}" />
            @error('name')
                <div id="passwordHelpBlock" class="form-text text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input name="description" class="form-control" id="description"
                value="{{ old('description' ,isset($category) ? $category->description : '') }}" />
            @error('description')
                <div id="passwordHelpBlock" class="form-text text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="radio" name="status" id="status" value="0"
                {{ old('status' ,isset($category) ? $category->status : '') == 0 ? 'checked' : '' }}>
            <label for="status">Deactive</label>
        </div>
        <div class="form-group">
            <input type="radio" name="status" id="status" value="1"
                {{ old('status' ,isset($category) ? $category->status : '') == 1 ? 'checked' : '' }}>
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
            <a href="{{ route('categories.index') }}" class="btn btn-warning">
                Cancel
            </a>
        </div>
    </form>
    <div></div>

@endsection
