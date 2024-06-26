<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Rumah Kost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
</head>
<style>
    .login-dark {
        height: 1000px;
        background-size: cover;
        position: relative;
    }

    .login-dark form {
        max-width: 320px;
        width: 90%;
        background-color: #1e2833;
        padding: 40px;
        border-radius: 4px;
        transform: translate(-50%, -50%);
        position: absolute;
        top: 50%;
        left: 50%;
        color: #fff;
        box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.2);
    }

    .login-dark .illustration {
        text-align: center;
        padding: 15px 0 20px;
        font-size: 100px;
        color: #2980ef;
    }

    .login-dark form .form-control {
        background: none;
        border: none;
        border-bottom: 1px solid #434a52;
        border-radius: 0;
        box-shadow: none;
        outline: none;
        color: inherit;
    }

    .login-dark form .btn-primary {
        background: #214a80;
        border: none;
        border-radius: 4px;
        padding: 11px;
        box-shadow: none;
        margin-top: 26px;
        text-shadow: none;
        outline: none;
    }

    .login-dark form .btn-primary:hover,
    .login-dark form .btn-primary:active {
        background: #214a80;
        outline: none;
    }

    .login-dark form .forgot {
        display: block;
        text-align: center;
        font-size: 12px;
        color: #6f7a85;
        opacity: 0.9;
        text-decoration: none;
    }

    .login-dark form .forgot:hover,
    .login-dark form .forgot:active {
        opacity: 1;
        text-decoration: none;
    }

    .login-dark form .btn-primary:active {
        transform: translateY(1px);
    }
</style>

<body style="background: #214a80;">
    <div class="login-dark" style="height: 695px;">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group">
                <input class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" placeholder="Email">
            </div>
            <div class="form-group">
                <input id="password" class="form-control block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" placeholder="password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Log In</button>
            </div>
            @if (Route::has('password.request'))
                <a class="underline text-sm forgot text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
