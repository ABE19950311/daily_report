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
    <div id="login_page" class="page_class">
        <div class="row mgTp">
            <h3 class="title">Please sign in</h3>
            <hr class="divisor">

            <form action="https://192.168.64.6/login" method="POST">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="email" class="form-control" name="user" id="login_user"
                        aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="login_password"
                        placeholder="Password">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1111">
                    <label class="form-check-label">Remember me</label>
                </div>
                <button id="login_btn" type="submit" class="btn btn-primary topBtn"><i class="fa fa-sign-in"></i> Sign
                    in</button>
            </form>

            <form action="https://192.168.64.6/register" method="GET">
                <button id="login_register_btn" type="submit" class="btn btn-primary topBtn"><i
                        class="fa fa-sign-in"></i> 新規登録</button>
            </form>
        </div>
    </div>
</body>

</html>
