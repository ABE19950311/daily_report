<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
<!-- Bootstrap CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

@extends('header')

<h2>ランキング</h2>

<table class="table">
    <thead>
        <tr>
            <th scope="col">ランキング</th>
            <th scope="col">タイトル</th>
            <th scope="col">カテゴリ</th>
            <th scope="col">内容</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($rankList))
            @foreach ($rankList as $rank)
                <tr>
                    <th scope="row">{{ $rank->report_rank }}</th>
                    <td>{{ $rank->title }}</td>
                    <td>{{ $rank->category }}</td>
                    <td>
                        <form method="GET" action="https://192.168.64.6/report/show">
                            <button class="show_report_btn btn btn-primary" name="reportid" value="{{ $rank->report_id }}">閲覧</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
