<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

@yield('url')

<form action="{{route('admin.logout')}}" method="post">
    @csrf
    <div class="text-center">
        <button class="w-100 btn btn-lg btn-primary" type="submit">Logout</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
    </div>
</form>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
