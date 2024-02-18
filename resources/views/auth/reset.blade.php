<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WIP SYSTEM | Recover Password</title>
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
    {{--  <div class="login-logo">
      <a href="{{ url('login') }}"><b>WIP SYSTEM</b></a>
    </div>  --}}
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <h1 style="text-align: center"><a href="{{ route('login') }}"><b>WIP SYSTEM</b></a></h1>

        <p class="login-box-msg">recover your password</p>

        <form action="{{ route('reset.password.post') }}" method="post">
          @csrf

          <input type="hidden" name="token" value="{{ $token }}">
          @if ($errors->has('email'))
          <span class="text-danger">{{ $errors->first('email') }}</span>
          @endif
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" id="email"
              value="{{ $email ?? old('email') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          @if ($errors->has('password'))
          <span class="text-danger">{{ $errors->first('password') }}</span>
          @endif
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          @if ($errors->has('password_confirmation'))
          <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
          @endif
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation"
              id="password-confirm">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="{{ url('login') }}">Login</a>
        </p>
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