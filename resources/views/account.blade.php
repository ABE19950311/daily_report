<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
<!-- Bootstrap CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

@extends('header')

<h2>ユーザ名</h2>
<h2>{{ $userName }}</h2>

<form method="GET" action="https://192.168.64.6/account/user">
    <button type="submit" class="btn btn-info">ユーザ名を変更する</button>
</form>

<form method="GET" action="https://192.168.64.6/account/password">
    <button type="submit" class="btn btn-info">パスワードを変更する</button>
</form>