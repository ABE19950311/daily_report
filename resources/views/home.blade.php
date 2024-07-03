<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
<!-- Bootstrap CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

@extends('header')

<div class="input-group">
    <input type="hidden" name="page" value="hoge">
    @if (isset($titleSearch))
        <input type="text" id="title_search" value={{ $titleSearch }}>
    @else
        <input type="text" id="title_search" placeholder="タイトルで検索">
    @endif
    <button class="btn btn-outline-success" type="submit" id="title_search_btn"><i class="fas fa-search"></i>
        検索</button>
</div>

<div class="input-group">
    <select aria-label="Default select example" id="category_search">
        @if (isset($categorySearch))
            <option value="">カテゴリを選択して下さい</option>
            <option {{ $categorySearch == '開発' ? 'selected' : '' }} value="開発">開発</option>
            <option {{ $categorySearch == 'サーバ' ? 'selected' : '' }} value="サーバ">サーバ</option>
            <option {{ $categorySearch == 'ネットワーク' ? 'selected' : '' }} value="ネットワーク">ネットワーク</option>
            <option {{ $categorySearch == 'AWS' ? 'selected' : '' }} value="AWS">AWS</option>
            <option {{ $categorySearch == 'コマンドライン' ? 'selected' : '' }} value="コマンドライン">コマンドライン</option>
            <option {{ $categorySearch == 'OS' ? 'selected' : '' }} value="OS">OS</option>
            <option {{ $categorySearch == 'ミドルウェア' ? 'selected' : '' }} value="ミドルウェア">ミドルウェア</option>
            <option {{ $categorySearch == 'エラー対応' ? 'selected' : '' }} value="エラー対応">エラー対応</option>
            <option {{ $categorySearch == 'その他' ? 'selected' : '' }} value="その他">その他</option>
        @else
            <option value="" selected>カテゴリを選択して下さい</option>
            <option value="開発">開発</option>
            <option value="サーバ">サーバ</option>
            <option value="ネットワーク">ネットワーク</option>
            <option value="AWS">AWS</option>
            <option value="コマンドライン">コマンドライン</option>
            <option value="OS">OS</option>
            <option value="ミドルウェア">ミドルウェア</option>
            <option value="エラー対応">エラー対応</option>
            <option value="その他">その他</option>
        @endif
    </select>
</div>

<table class="table">
    <thead class="table-dark">
        <tr>
            <th scope="col">タイトル</th>
            <th scope="col">名字</th>
            <th scope="col">名前</th>
            <th scope="col">カテゴリ</th>
            <th scope="col">内容</th>
            <th scope="col">編集</th>
            <th scope="col">削除</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reportList as $report)
            <tr>
                <th scope="row">{{ $report->title }}</th>
                <td>{{ $report->sei }}</td>
                <td>{{ $report->mei }}</td>
                <td>{{ $report->category }}</td>
                <td>
                    <form method="GET" action="https://192.168.64.6/report/show">
                        <button class="show_report_btn btn btn-primary" name="reportid" value={{ $report->id }}>閲覧</button>
                    </form>
                </td>
                <td>
                    <form method="GET" action="https://192.168.64.6/report/update">
                        <button class="navigate_to_update_report_btn btn btn-success" name="reportid" value={{ $report->id }}>編集</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="https://192.168.64.6/report">
                        @method('DELETE')
                        @csrf
                        <button class="delete_report_btn btn btn-dark" name="reportid" value={{ $report->id }}>削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item" id="pagenation_previous"><a class="page-link" href="#">Previous</a></li>
        @for ($i = 1; $i <= $reportSize; $i++)
            <li class="pagenation-item" value={{ $i }}><a class="page-link"
                    href="#">{{ $i }}</a></li>
        @endfor
        <li class="page-item" id="pagenation_next"><a class="page-link" href="#">Next</a></li>
    </ul>
</nav>

</body>

</html>
