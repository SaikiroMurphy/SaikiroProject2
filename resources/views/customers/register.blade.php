<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    />
    <script src="https://kit.fontawesome.com/dfb2727f7d.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../../resources/Images/ava-web.png">
    <title>Đăng ký - SugmaStadium</title>
    <link rel="stylesheet" href="../../resources/css/customer.css">
</head>
<body>
<div class="intro">
    <div style="background-color: rgba(0, 0, 0, 0.7);">
        <div class="container text-center">
            <div class="row" style="height: 1000px">
                <div class="col align-self-center" style="background-color:#05b50b">

                    {{--                    @if($errors->any())--}}
                    {{--                        <div class="alert alert-danger">--}}
                    {{--                            <ul>--}}
                    {{--                                @foreach($errors->all() as $error)--}}
                    {{--                                    <li>{{ $error }}</li>--}}
                    {{--                                @endforeach--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}

                    <form class="py-3" method="post"
                          action="{{ route('customers.store') }}" novalidate>
                        <label style="font-size: 50px">SugmaStadium</label><br>
                        @csrf
                        <p>Email:</p><input type="email" name="email" class="@error('email') is-invalid @enderror"><br>
                        @error('email')
                        <div class="d-flex justify-content-center mt-2"><p
                                class="alert alert-danger col-3">{{ $message }}</p></div>
                        @enderror
                        <p>Địa chỉ:</p><input type="text" name="address" class="@error('address') is-invalid @enderror"><br>
                        @error('address')
                        <div class="d-flex justify-content-center mt-2"><p
                                class="alert alert-danger col-3">{{ $message }}</p></div>
                        @enderror
                        <p>Số điện thoại:</p><input type="text" name="phonenumber"
                                                    class="@error('phonenumber') is-invalid @enderror"><br>
                        @error('phonenumber')
                        <div class="d-flex justify-content-center mt-2"><p
                                class="alert alert-danger col-3">{{ $message }}</p></div>
                        @enderror
                        <p>Họ và tên</p><input type="text" name="name" class="@error('name') is-invalid @enderror"><br>
                        @error('name')
                        <div class="d-flex justify-content-center mt-2"><p
                                class="alert alert-danger col-3">{{ $message }}</p></div>
                        @enderror
                        <p>Mật khẩu:</p><input type="password" name="password"
                                               class="@error('password') is-invalid @enderror"><br>
                        @error('password')
                        <div class="d-flex justify-content-center mt-2"><p
                                class="alert alert-danger col-3">{{ $message }}</p></div>
                        @enderror
                        <a style="width: 100px" href="{{ route('customers.login') }}" class="btn btn-outline-light mt-3">Quay lại</a>
                        <button style="width: 100px" class="btn btn-outline-light mt-3">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
        {{--Footer--}}
        <footer class="d-flex flex-warp justify-content-between align-items-center py-2"
                style="background-color: #05b50b">
            <div class="col-md-4 align-items-center text-white ms-3" style="--bs-text-opacity: .75;">© 2023 SugmaStadium
                Copyright.
            </div>
            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex me-3">
                <li class="ms-3" style="font-size: 25px">
                    <a href="https://twitter.com" class="text-white" style="--bs-text-opacity: .75;"><i
                            class="fa-brands fa-twitter"></i></a>
                </li>
                <li class="ms-3" style="font-size: 25px">
                    <a href="https://www.facebook.com" class="text-white" style="--bs-text-opacity: .75;"><i
                            class="fa-brands fa-facebook"></i></a>
                </li>
                <li class="ms-3" style="font-size: 25px">
                    <a href="https://github.com" class="text-white" style="--bs-text-opacity: .75;"><i
                            class="fa-brands fa-github"></i></a>
                </li>
            </ul>
        </footer>
    </div>
</div>
{{--<script src="../../resources/js/validate.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>
