<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>后台登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="{{asset(__ADMIN__)}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset(__ADMIN__)}}/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="{{asset(__ADMIN__)}}/css/animate.css" rel="stylesheet">
    <link href="{{asset(__ADMIN__)}}/css/style.css" rel="stylesheet">
    <link href="{{asset(__ADMIN__)}}/css/login.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>

</head>

<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-12">
                <form method="post" action="{{route('admin.login.dologin')}}">
                    @csrf
                    <h4 class="no-margins">管理员登录：</h4>
                    <p class="m-t-md">登录到资源站后台</p>
                    <input type="text" class="form-control uname" placeholder="账号" name="username"/>
                    <input type="password" class="form-control pword m-b" placeholder="密码" name="password"/>
                    <input type="text" class="form-control m-b" placeholder="验证码" maxlength="4" name="captcha" style="width: 50%;margin-right: 3%; float: left; margin-top: 0px;"/>
                    <img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()" style="width: 50%; float: right">
                    <button class="btn btn-success btn-block">登录</button>
                    @if(session()->has('errormsg'))
                        <div class="alert">
                            {{session('errormsg')}}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
</body>

</html>
