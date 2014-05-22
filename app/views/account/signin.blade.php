<!DOCTYPE html>
<html>
<head>
    <title>DANS ENERGY - Sign In</title>
    <link rel="stylesheet" href="{{ URL::asset('css/signin.css') }}">
</head>
<body>
    <div class="content gradienr">
        <form action="{{ URL::route('account-sign-in-post') }}" method="post">
            @if(Session::has('msg'))
                <span class="errors">{{ Session::get('msg') }}</span>
                <br>
            @endif
            <input type="text" placeholder="Username" name="username" class="login-input-text" maxlength="30">
            <br>
            @if($errors->has('username'))
                <span class="errors">{{ $errors->first('username') }}</span>
                <br>
            @endif
            <input type="password" placeholder="Password" name="password" class="login-input-text">
            <br>
            @if($errors->has('password'))
                <span class="errors">{{ $errors->first('password') }}</span>
                <br>
            @endif
            <input type="submit" value="Sign In">
            {{ Form::token() }}
        </form>
        <a href="#">Forgot Password?</a>
    </div>
</body>
</html>
