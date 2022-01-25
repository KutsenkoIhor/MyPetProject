<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админка</title>
{{--    <link href="css/app.css" rel="stylesheet">--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/authorization.css') }}" rel="stylesheet">
{{--    <link href="css/authorization.css" rel="stylesheet">--}}
</head>
<body>
<main class="form-signin">
    <form action="{{route('authorization.login')}}" method="post">
        @csrf
        <div class="text-center">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        </div>

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>

        <div class="text-center">
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
        </div>

    </form>
</main>


<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
