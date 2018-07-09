<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Log in</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bower_components/AdminLTE/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bower_components/AdminLTE/plugins/iCheck/square/blue.css') }}">
</head>

<body class="hold-transition login-page">
<div class="login-box">
    {{--<div class="login-logo">--}}
    {{--<img src="{{ asset('public/images/logo.png') }}" width="200">--}}
    {{--</div>--}}

    <div class="login-box-body">
        <h2><p class="login-box-msg">Login PPLI</p></h2>

        <form action="{{ route('login') }}" method="post">
            {{ csrf_field() }}

            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>

                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>

            </div>
        </form>

    </div>

</div>

<script src="{{ asset('/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/bower_components/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
    });
</script>
</body>
</html>