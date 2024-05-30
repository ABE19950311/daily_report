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
    <script type="module" src="../../public/js/home.js"></script>
    <script type="module" src="../../public/js/class.js"></script>
    <script type="module" src="../../public/js/request.js"></script>
</head>
<body>

<div id="header" class="header_class">
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#" id="diary_list_home_btn">日記一覧</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="monthly_diary_btn">月間日記</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="daily_diary_btn">日間日記</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="notification_register_btn">通知先</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="logout_btn">LOGOUT</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
    </nav>
</div>

<div id="daily_diary_page" class="page_class">
    <div class="container">
    <main>
      <div class="py-5 text-center">
        <h2>日間日記</h2>
      </div>

      <div class="row g-5">
        <div class="col-md-7 col-lg-8">
          <form class="needs-validation" novalidate>
            <div class="col-sm-6">
                <label for="familyName" class="form-label">タイトル</label>
                <input type="text" class="form-control" id="familyName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  名字を入力してください
                </div>
              </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="familyName" class="form-label">姓</label>
                <input type="text" class="form-control" id="familyName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  名字を入力してください
                </div>
              </div>
              <div class="col-sm-6">
                <label for="givenName" class="form-label">名</label>
                <input type="text" class="form-control" id="givenName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  名前を入力してください
                </div>
              </div>

              <div class="col-12">
                <label class="form-label">カテゴリ</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                    開発
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                    サーバ
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                    ネットワーク
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                  <label class="form-check-label" for="flexRadioDefault2">
                    AWS
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                  <label class="form-check-label" for="flexRadioDefault2">
                    コマンドライン
                </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                  <label class="form-check-label" for="flexRadioDefault2">
                    OS
                </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                  <label class="form-check-label" for="flexRadioDefault2">
                    ミドルウェア
                </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    エラー対応
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                  <label class="form-check-label" for="flexRadioDefault2">
                    その他
                </label>
                </div>
              </div>

              <div class="col-16">
                <div class="input-group">
                    <span class="input-group-text">内容</span>
                    <textarea class="form-control" aria-label="With textarea"></textarea>
                </div>
              </div>

              <div class="col-16">
                <div class="input-group">
                    <span class="input-group-text">参照</span>
                    <textarea class="form-control" aria-label="With textarea"></textarea>
                </div>
              </div>

              <div class="col-12">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile01">
                </div>
              </div>
            </div>

            <button class="w-100 btn btn-primary btn-lg" type="submit">日記を出す</button>
          </form>
        </div>
      </div>
    </main>

    <footer class="my-5 pt-5 text-body-secondary text-center text-small">
      <p class="mb-1">&copy; 2017−2024 会社名</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">プライバシー</a></li>
        <li class="list-inline-item"><a href="#">条項</a></li>
        <li class="list-inline-item"><a href="#">サポート</a></li>
      </ul>
    </footer>
  </div>

</div>

</body>
</html>