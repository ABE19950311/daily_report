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

<div id="home_page" class="page_class">
    <h1>工事中</h1>
</div>

</body>
</html>