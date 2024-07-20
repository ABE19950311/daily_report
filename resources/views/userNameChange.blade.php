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

<form action="https://192.168.64.6/account/user" method="POST">
    @csrf
    <div class="form-group">
        <label>新しいユーザ名</label>
        <input type="text" class="form-control" name="user" value="{{ old('user') }}"
            placeholder="Password">
    </div>
    <div class="form-group">
        <label>再度入力</label>
        <input type="text" class="form-control" name="user_confirmation" value="{{ old('user_confirmation') }}"
            placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary topBtn"><i class="fa fa-sign-in"></i>変更する</button>
</form>