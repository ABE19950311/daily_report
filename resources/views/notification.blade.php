<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
<!-- Bootstrap CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

@extends('header')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

<div id="notification_register_page" class="page_class">
    <div class="row g-3">
        <div class="col-auto">
            <h2>通知先</h2>
        </div>
        <form method="POST" action="https://192.168.64.6/mail">
        @csrf
        <div class="col-auto">
            <input type="text" name="mailAddress" class="form-control" id="notification_address" value="{{ old('mailAddress') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3" id="notification_record_btn">登録する</button>
        </div>
        </form>
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
</div>

</body>

</html>
