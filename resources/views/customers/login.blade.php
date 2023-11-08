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
    <title>Đăng nhập - SugmaStadium</title>
    <link rel="stylesheet" href="../../resources/css/customer.css">
</head>
<body>
<div class="intro">
    <div style="background-color: rgba(0, 0, 0, 0.7);">
        <div class="container text-center">
            <div class="row" style="height: 750px">
                <div class="col align-self-center" style="background-color:#05b50b">
                    <form class="py-5" method="post"
                          action="{{ route('customers.loginProcess') }}" style="color: black">
                        <label style="font-size: 50px">SugmaStadium</label><br>
                        @csrf
                        <p class="">Email:</p>    <input type="email" name="email"><br>
                        <p class="mt-3">Password:</p> <input type="password" name="password"><br>
                        <a class="btn btn-outline-warning mt-3" href="{{ route('customers.register') }}">Đăng ký</a>
                        <button class="btn btn-outline-warning mt-3">Đăng nhập</button>
                        <a href="{{ route('dashboard.login') }}" class="btn btn-outline-warning mt-3">Quản trị viên</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>
