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
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css"
        rel="stylesheet"
    />
    <script src="https://kit.fontawesome.com/dfb2727f7d.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../../resources/Images/ava-web.png">
    <title>Đăng ký - SugmaStadium</title>
    <style>
        #intro {
            background-image: url("https://m.media-amazon.com/images/I/61wbDovWcpL.jpg");
            height: 100vh;
            background-size: cover;
        }
    </style>
</head>
<body>
<div id="intro" class="bg-image">
    <div class="mask" style="background-color: rgba(0, 0, 0, 0.7);">
        <div class="container text-center">
            <div class="row d-flex align-items-center justify-content-center" style="height: 750px">
                <div class="col align-self-center">
                    <form class="needs-validation border border-warning bg-success py-5 px-5 align-self-center"
                          method="post"
                          action="{{ route('customers.store') }}" style="color: black" novalidate>
                        <label style="font-size: 50px">SugmaStadium</label><br>
                        @csrf
                        <div class="col-12">
                            <p>Email:</p><input class="form-control" type="email" name="email" required><br>
                            <div class="invalid-feedback">Ô này không được để trống</div>
                            <p>Địa chỉ:</p><input class="form-control" type="text" name="address" required><br>
                            <div class="invalid-feedback">Ô này không được để trống</div>
                            <p>Số điện thoại:</p><input class="form-control" type="text" name="phonenumber" required><br>
                            <div class="invalid-feedback">Ô này không được để trống</div>
                            <p>Họ và tên</p><input class="form-control" type="text" name="name" required><br>
                            <div class="invalid-feedback">Ô này không được để trống</div>
                            <p>Mật khẩu:</p><input class="form-control" type="password" name="password" required><br>
                            <div class="invalid-feedback">Ô này không được để trống</div>
                            <a href="{{ route('customers.login') }}" class="btn btn-warning mt-3">Quay lại</a>
                            <button class="btn btn-warning mt-3">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../resources/js/validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>
