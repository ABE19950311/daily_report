<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
<!-- Bootstrap CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

@extends('header')

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
        @if (is_array($addressList) && count($addressList))
            @foreach ($addressList as $address)
                <tbody id="mailAddressBody">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $address->address }}</td>
                </tbody>
            @endforeach
        @endif
    </table>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3" id="notification_submit_btn">メールを送信する</button>
    </div>
</div>

</body>

</html>
