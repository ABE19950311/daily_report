<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
<!-- Bootstrap CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
<script type="module" src="{{ asset('/js/dashboard.js') }}"></script>

@extends('header')

<div class="conteiner">
  <div class="wrap">
    <div class="tgt" id="chart" ></div>
    <div class="tgt" id="chart2" ></div>
    <div class="tgt" id="chart3" ></div>
    <div class="tgt" id="chart4" ></div>
  </div>
</div>