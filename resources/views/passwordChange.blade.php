<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
<!-- Bootstrap CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

@extends('header')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="https://192.168.64.6/account" method="POST">
    @csrf
    <div class="form-group">
        <label>古いパスワード</label>
        <input type="password" class="form-control" name="oldPassword" value="{{ old('oldPassword') }}"
            aria-describedby="emailHelp" placeholder="Password">
    </div>
    <div class="form-group">
        <label>新しいパスワード</label>
        <input type="password" class="form-control" name="password" value="{{ old('password') }}"
            placeholder="Password">
    </div>
    <div class="form-group">
        <label>再度入力</label>
        <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}"
            placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary topBtn"><i class="fa fa-sign-in"></i>変更する</button>
</form>
