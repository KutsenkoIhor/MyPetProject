<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админка</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/authorization.css') }}" rel="stylesheet">
</head>
<body>
<main class="form-signin">
    <form action="{{route('admin.registration')}}" method="post">
        @csrf
        <div class="text-center">
            <h1 class="h3 mb-3 fw-normal">Please registration</h1>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" value="{{ old('Login') }}" placeholder="name@example.com" name="Login" >
            <label for="floatingInput">Login</label>
        </div>
        @error('Login')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" value="{{ old('Password') }}" placeholder="Password" name="Password">
            <label for="floatingPassword">Password</label>
        </div>
        @error('Password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me" name="checkbox"> Remember me
            </label>
        </div>
        <div class="text-center">
            <button class="w-100 btn btn-lg btn-primary" type="submit">Registration</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
        </div>
    </form>
</main>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
