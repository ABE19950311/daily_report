<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/index.css">
    <!-- Bootstrap CSS -->
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
    <!-- Bootstrap JS (optional, for components that require JS) -->
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../public/js/login.js"></script>
    <script type="module" src="../../public/js/class.js"></script>
    <script type="module" src="../../public/js/request.js"></script>
</head>
<body>
<div id="login_page" class="page_class">
<div class="row mgTp">
    <h3 class="title">Please sign in</h3>
    <hr class="divisor">
    <div class="form-group">
        <label>Username</label>
        <input type="email" class="form-control" id="login_user" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" id="login_password" placeholder="Password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1111">
        <label class="form-check-label">Remember me</label>
    </div>
    <button id="login_btn" type="submit" class="btn btn-primary topBtn"><i class="fa fa-sign-in"></i> Sign in</button>
    <button id="login_register_btn" type="submit" class="btn btn-primary topBtn"><i class="fa fa-sign-in"></i> 新規登録</button>
</div>
</div>
</body>
</html>