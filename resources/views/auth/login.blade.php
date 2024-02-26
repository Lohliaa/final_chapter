<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WIP SYSTEM | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        {{-- <div class="login-logo">
            <a href="{{ route('login') }}"><b>WIP SYSTEM</b></a>
        </div> --}}
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                {{--  <div style="display: flex; align-items: center; justify-content: center;">
                    <img style="height: 25px; margin-right: 0px; margin-top: 10px" src="dist/img/SAI transparent.png">
                    <div style="height: 40px; border-left: 1px solid black; margin: 0 10px;"></div>
                    <img style="height: 25px; margin-left: 0px; margin-top: 5px" src="dist/img/sai_transparent.png">
                </div>  --}}
                <h1 style="text-align: center;"><a href="{{ route('login') }}"><b>WIP SYSTEM</b></a></h1>
                <p class="login-box-msg pb-4">Sign in to start your session</p>
                <form action="{{ route('loginaksi') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="id" class="form-control" required="" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control rounded-bottom"
                            placeholder="Password" required="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-8">
                            <p class="mb-1">
                                <a href="{{ url('forget-password') }}">Forgot Password</a>
                            </p>
                            <p class="mb-0">
                                <a href="{{ url('register') }}" class="text-center">Register Here</a>
                            </p>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

</body>

</html>