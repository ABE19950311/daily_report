<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
<!-- Bootstrap CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

@extends('header')

<body class="bg-dark">
<div class="container">
<div class="main container-fluid">
    <div class="row bg-light text-dark py-5">
        <div class="col-md-8 offset-md-2">
            <h2 class="fs-1 mb-5 text-center fw-bold">お問い合わせ</h2>
            <form method="POST" action="https://192.168.64.6/contact">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="名前（必須）" value="">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="address" placeholder="メールアドレス（必須）" value="">
                </div>
                <div class="mb-4">
                    <textarea class="form-control" name="contact" rows="5" placeholder="メッセージを入力してください"></textarea>
                </div>
                <div class="text-center pt-4 col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-primary">送信</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>