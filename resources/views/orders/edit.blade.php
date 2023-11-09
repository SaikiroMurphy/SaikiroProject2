<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    >
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css"
        rel="stylesheet"
    />
    <script src="https://kit.fontawesome.com/dfb2727f7d.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../../../../resources/Images/ava-web.png">
    <title>Trang quản trị - Quản lý đặt sân</title>
</head>
<body style="background-color: whitesmoke">
<div class="d-flex flex-nowrap">
    <div class="d-flex flex-column flex-shrink-0 bg-success bg-gradient border-end border-black border-1 ps-2">
        <a href="{{ route('customers.index') }}" class="link-dark" style="width: 83px">
            <img src="../../../../resources/Images/ava-web.png" style="width: 100%">
        </a>
        <ul class=" nav nav-pills nav-flush flex-column mb-auto text-center">
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}" class="nav-link py-3 border-bottom border-black border-2"
                   style="width: 83px">
                    <img src="../../../../resources/Images/bar-chart.png" style="width: 28px; height: 28px">
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('fields.index') }}" class="nav-link py-3 border-bottom border-black border-2"
                   style="width: 83px">
                    <img src="../../../../resources/Images/football-field.png" style="width: 28px; height: 28px">
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('field_types.index') }}" class="nav-link py-3 border-bottom border-black border-2"
                   style="width: 83px">
                    <img src="../../../../resources/Images/scalability.png" style="width: 28px; height: 28px">
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.customers') }}" class="nav-link py-3 border-bottom border-black border-2"
                   style="width: 83px">
                    <img src="../../../../resources/Images/customer.png" style="width: 28px; height: 28px">
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.orders') }}"
                   class="nav-link bg-warning py-3 border-bottom border-black border-2" style="width: 83px">
                    <img src="../../../../resources/Images/clipboard.png" style="width: 28px; height: 28px">
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('times.index') }}" class="nav-link py-3 border-bottom border-black border-2"
                   style="width: 83px">
                    <img src="../../../../resources/Images/24-hours.png" style="width: 28px; height: 28px">
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link py-3 border-bottom border-black border-2"
                   style="width: 83px">
                    <img src="../../../../resources/Images/setting.png" style="width: 28px; height: 28px">
                </a>
            </li>
        </ul>
        <div class="dropup border-top">
            <a href="#"
               class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle"
               data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../../../../resources/Images/ava-web.png" alt="Admin" width="42" height="42"
                     class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small shadow">
                <li>
                    <a class="dropdown-item" href="{{ route('customers.logout') }}">Đăng xuất</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col col-11 ps-3">
        <p><a href="{{ route('customers.index') }}" class="link-primary">Trang chủ</a> / <a href="#"
                                                                                            class="link-secondary"
                                                                                            aria-disabled="true">Sửa đơn
                hàng</a></p>
        <div>
            <h1 class="text-success mt-4" style="font-family: 'Segoe UI Black'; font-size: xxx-large">Sửa đơn hàng</h1>
        </div>
        <div class="border-top border-success border-4 my-4">
            <form method="post" action="{{ route('orders.update', $details) }}">
                @csrf
                @method('PUT')
                <div class="col-6 mt-3">
                    <div class="form-floating mb-3">
                        <input placeholder="Select date" class="form-control" type="text" name="order_id"
                               id="order_id" placeholder="ID đơn" value="{{ $details -> order_id }}" readonly>
                        <label for="order_id" class="form-label">ID đơn</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="fields" id="fields" required>
                            @foreach($fields as $field)
                                @if($field->id == $details->field_id)
                                    <option value="{{ $field -> id }}" id="fields"
                                            selected>{{ $field -> name }}</option>
                                @else
                                    <option value="{{ $field -> id }}" id="fields">{{ $field -> name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="fields">Sân</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input placeholder="Select date" class="form-control" type="date" name="date"
                               id="date" placeholder="Ngày đặt sân" min="{{ $datenow }}" value="{{ $details -> date }}"
                               required>
                        <label for="Date" class="form-label">Ngày đặt sân</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="times" id="times" onchange="selectFunc()" required>
                            @foreach($times as $time)
                                @if($time->id == $details->time_id)
                                    <option id="type{{$time -> id}}"
                                            value="{{ $time->id }}" selected>{{ $time->timeStart }}
                                        - {{ $time->timeEnd }}</option>
                                @else
                                    <option id="type{{$time -> id}}"
                                            value="{{ $time->id }}">{{ $time->timeStart }}
                                        - {{ $time->timeEnd }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="times">Khung giờ</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="order_note" id="order_note"
                               value="{{ $details -> orders -> order_note }}">
                        <label for="order_note" class="form-label">Ghi chú</label>
                    </div>
                    <div class="form-floating mb-3" id="payment">
                        @if($details -> orders -> payment == 1)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment" id="cod" value=1 checked>
                                <label class="form-check-label" for="cod">
                                    COD
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment" id="banking" value=2>
                                <label class="form-check-label" for="banking">
                                    Chuyển khoản
                                </label>
                            </div>
                        @else
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment" id="cod" value=1>
                                <label class="form-check-label" for="cod">
                                    COD
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="payment" id="banking" value=2
                                       checked>
                                <label class="form-check-label" for="banking">
                                    Chuyển khoản
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
                <button id="dmm" class="btn btn-success btn-lg mt-3">Cập nhật đơn hàng</button>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#times').on('change', function () {
            var time_id = $(this).val();
            var field_id = $('#fields').val();
            var date = $('#date').val();
            let url = "{{ route('checkTime2', ['field' => ":field_id", 'time' => ":time_id", 'date' => ":date"]) }}";
            url = url.replace(":field_id", field_id);
            url = url.replace(":time", time_id);
            url = url.replace(":date", date);

            if (time_id) {
                $.ajax({
                    url: url,
                    type: "GET",
                    {{--data: {"_token": "{{ csrf_token() }}"},--}}
                        {{--dataType: "json",--}}
                    success: function (data) {
                        if (data == '') {
                            $("#dmm").show();
                        } else {
                            alert('Khung thời gian này đã được chọn.\n' +
                                'Vui lòng chọn khung thời gian khác.');
                            $("#dmm").hide();
                        }
                    }
                });
            }
        });
    });

    function selectFunc() {

    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>
