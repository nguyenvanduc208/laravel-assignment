@extends('layout.master')

@section('title', 'User page')



@section('content-title', isset($user) ? 'User Edit' : 'User Create')

@section('content')
    <form action="{{ route('user.save') }}" class="form" method="POST">
        @csrf
        @if (isset($user))
            <input type="hidden" name="id" value="{{ $user->id }}" />
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" class="form-control" id="name"
                value="{{ old('name', isset($user) ? $user->name : '') }}" />
            @error('name')
                <div id="passwordHelpBlock" class="form-text text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" class="form-control" id="email"
                value="{{ old('email', isset($user) ? $user->email : '') }}" />
            @error('email')
                <div id="passwordHelpBlock" class="form-text text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password"
                value="{{ old('password', isset($user) ? $user->password : '') }}" />
            @error('password')
                <div id="passwordHelpBlock" class="form-text text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('user.index') }}" class="btn btn-warning">
                Cancel
            </a>
        </div>
    </form>
    <div></div>

@endsection
