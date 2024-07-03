<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
<!-- Bootstrap CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

@extends('header')

<div id="daily_diary_page" class="page_class">
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>日間日記</h2>
            </div>
            <form method="POST" action="https://192.168.64.6/report">
            @method('PUT')
            @csrf
            <input type="hidden" id="update_report" name="reportid" value={{ $report->id }}>
            <div class="row g-5">
                <div class="col-md-7 col-lg-8">
                    <div class="col-sm-6">
                        <label for="report_title" class="form-label">タイトル</label>
                        <input type="text" class="form-control" id="update_report_title" name="title" value={{ $report->title }}>
                        <div class="invalid-feedback">
                            タイトルを入力してください
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="sei" class="form-label">姓</label>
                            <input type="text" class="form-control" id="update_report_sei" name="sei" value={{ $report->sei }}>
                            <div class="invalid-feedback">
                                名字を入力してください
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="mei" class="form-label">名</label>
                            <input type="text" class="form-control" id="update_report_mei" name="mei" value={{ $report->mei }}>
                            <div class="invalid-feedback">
                                名前を入力してください
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">カテゴリ</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" value="開発">開発
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" value="サーバ">サーバ
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category"
                                    value="ネットワーク">ネットワーク
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" value="AWS">AWS
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category"
                                    value="コマンドライン">コマンドライン
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" value="OS">OS
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category"
                                    value="ミドルウェア">ミドルウェア
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category"
                                    value="エラー対応">エラー対応
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" value="その他">その他
                            </div>
                        </div>

                        <div class="col-16">
                            <div class="input-group">
                                <span class="input-group-text">内容</span>
                                <textarea class="form-control" aria-label="With textarea" id="update_report_content" name="content" value={{ $report->content }}>{{ $report->content }}</textarea>
                            </div>
                        </div>

                        <div class="col-16">
                            <div class="input-group">
                                <span class="input-group-text">参照</span>
                                <textarea class="form-control" aria-label="With textarea" id="update_report_url" name="url" value={{ $report->url }}>{{ $report->url }}</textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="update_report_image" name="image_path"
                                    value={{ $report->image_path }}>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" name="is_release" value="1" id="update_report_submit_release_btn">編集（公開）</button>
                    <button type="submit" class="btn btn-secondary btn-lg" name="is_release" value="0" id="update_report_submit_btn">編集（非公開）</button>
                </div>
            </div>
            </form>
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
