<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
<!-- Bootstrap CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

@extends('header')

<div id="daily_diary_page" class="page_class">
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>{{ $report->title }}</h2>
            </div>

            <div class="row g-5">
                <div class="col-md-7 col-lg-8">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="sei" class="form-label">姓</label>
                            <h3>{{ $report->sei }}</h3>
                        </div>
                        <div class="col-sm-6">
                            <label for="mei" class="form-label">名</label>
                            <h3>{{ $report->mei }}</h3>
                        </div>

                        <div class="col-16">
                            <span>内容</span>
                            <br>
                            <span>{{ $report->content }}</span>
                        </div>

                        <div class="col-16">
                            <span>参照</span>
                            <br>
                            <span>{{ $report->url }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        <br>
        <br>
        <br>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3" id="notification_record_btn">メール送信する</button>
        </div>

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

</div>
</body>

</html>
