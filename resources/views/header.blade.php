<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Document</title>
    <!-- Bootstrap JS (optional, for components that require JS) -->
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="module" src="{{ asset('/js/home.js') }}"></script>
    <script type="module" src="{{ asset('/js/class.js') }}"></script>
    <script type="module" src="{{ asset('/js/request.js') }}"></script>
    <style>
        .header_class {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        body {
            padding-top: 60px;
            /* ヘッダーの高さに応じて調整 */
        }
    </style>
</head>

<body>

    <div id="header" class="header_class">
        <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://192.168.64.6/home/1">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" id="diary_list_home_btn">日記一覧</a>
                        </li>
                        @if ($userType != 'report_viewer')
                            <li class="nav-item">
                                <a class="nav-link" id="daily_diary_btn" href="https://192.168.64.6/report">日間日記</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" id="ranking_btn" href="https://192.168.64.6/ranking">ランキング</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="notification_register_btn" href="https://192.168.64.6/mail">通知先</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://192.168.64.6/dashboard">ダッシュボード</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://192.168.64.6/contact">お問い合わせ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://192.168.64.6/account">アカウント設定</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="logout_btn" href="https://192.168.64.6/logout">ログアウト</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
