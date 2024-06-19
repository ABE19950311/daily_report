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
    <script type="module" src="{{ asset('/js/home.js') }}"></script>
    <script type="module" src="{{ asset('/js/class.js') }}"></script>
    <script type="module" src="{{ asset('/js/request.js') }}"></script>
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

<div id="notification_register_page" class="page_class">
    <div class="row g-3">
        <div class="col-auto">
          <h2>通知先</h2>
        </div>
        <div class="col-auto">
          <input type="password" class="form-control" id="notification_address">
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3" id="notification_record_btn">登録する</button>
        </div>
    </div>
    <table class="table table-striped table-hover" class="d-none">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Address</th>
          </tr>
        </thead>
          {foreach from=$mailAddressList item=value name=mail}
            <tbody id="mailAddressBody">
              <th scope="row">{$smarty.foreach.mail.iteration}</th>
              <td>{$value}</td>
            </tbody>
          {/foreach}
      </table>

      <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3" id="notification_submit_btn">メールを送信する</button>
      </div>
</div>

</body>
</html>