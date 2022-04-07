@extends('layout.master')

@section('title', 'Category page')



@section('content-title', isset($data) ? 'Parent Category Edit' : 'Parent Category Create')

@section('content')
    <form action="{{ route('parent-cate.save') }}" class="form" method="POST">

        @csrf
        @if (isset($data))
            <input type="hidden" name='id' value="{{ $data->id }}" />
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" class="form-control" id="name" value="{{ old('name' , isset($data) ? $data->name : '') }}" />
            @error('name')
                <div id="passwordHelpBlock" class="form-text text-danger">
                    {{ $message }}
                </div>
            @enderror

        </div>
        <div class="form-group">
            <label for="name">Status</label> <br>
            <input type="radio" name="status" id="status" value="0"
                {{ old('status' , isset($data) ? $data->status : '') == 0 ? 'checked' : '' }}>
            <label for="status">Deactive</label>
        </div>
        <div class="form-group">

            <input type="radio" name="status" id="status" value="1"
                {{ old('status' , isset($data) ? $data->status : '') == 1 ? 'checked' : '' }}>
            <label for="status">Active</label>
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
