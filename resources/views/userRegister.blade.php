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
</head>

<body>

    <form action="https://192.168.64.6/register" method="POST">
        @csrf
        <div id="register_page" class="page_class">
            <div class="mb-3">
                <label class="form-label">ユーザ名</label>
                <input type="email" name="user" class="form-control" id="register_user"
                    aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label class="form-label">パスワード</label>
                <input type="password" name="password" class="form-control" id="register_password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label">Check me out</label>
            </div>
            <button id="register_submit_btn" type="submit" class="btn btn-primary">Submit</button>
    </form>

    <form action="https://192.168.64.6/login" method="GET">
        <button id="register_back_login_btn" type="submit" class="btn btn-primary">ログイン画面に戻る</button>
    </form>
    </div>

</body>

</html>
