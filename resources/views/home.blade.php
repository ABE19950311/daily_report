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

<div class="input-group">
  <input type="text" placeholder="タイトルで検索">
  <button class="btn btn-outline-success" type="button" id="button-addon2"><i class="fas fa-search"></i> 検索</button>
</div>

<div class="input-group">
<select aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
<button class="btn btn-outline-success" type="button" id="button-addon2"><i class="fas fa-search"></i> 検索</button>
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
        <th scope="row">{{$report->title}}</th>
        <td>{{$report->sei}}</td>
        <td>{{$report->mei}}</td>
        <td>{{$report->category}}</td>
        <td><button class="show_report_btn btn btn-primary" value={{$report->id}}>閲覧</button></td>
        <td><button class="navigate_to_update_report_btn btn btn-success" value={{$report->id}}>編集</button></td>
        <td><button class="delete_report_btn btn btn-dark" value={{$report->id}}>削除</button></td>
      </tr>
    @endforeach
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item" id="pagenation_previous"><a class="page-link" href="#">Previous</a></li>
    @for ($i=1;$i<=$reportSize;$i++)
      <li class="pagenation-item" value={{$i}}><a class="page-link" href="#">{{$i}}</a></li>
    @endfor
    <li class="page-item" id="pagenation_next"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>

</body>
</html>