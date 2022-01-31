<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body class="bg-light">

<main class="container">


    <form action="{{route('admin.handlerPanel')}}" method="post">
        @csrf
        <div class="my-5 p-3 bg-body rounded shadow-sm">
            <div class="d-flex justify-content-between">
                <h4 class="pt-3">News site</h4>
                <div class="form-floating w-75">
                    <input type="text" class="form-control" id="floatingInput"  name="newUrl" placeholder="Add url">
                    <label for="floatingInput">Add Url</label>
                </div>
                <button class="w-10 btn btn-lg btn-success" type="submit">Add</button>
            </div>
        </div>
    </form>

    @error('ErrorUrl')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror


    <div class="my-3 p-3 bg-body rounded shadow-sm">

        <form action="{{route('admin.activeNewsUrl')}}" method="post">
            @csrf

            <div class="d-flex justify-content-between">
                <h3 >List of sites</h3>
                <button class="w-10 btn btn-lg btn-primary" type="submit">Save</button>
            </div>
            <h3 class="border-bottom"></h3>

{{--            <button class="w-10 btn btn-lg btn-primary" type="submit">Save</button>--}}
{{--            <h3 class="border-bottom pb-1 mb-0">List of sites</h3>--}}

            @yield('bloc')
        </form>


        <small class="d-block text-end mt-3">
            <form action="{{route('admin.logout')}}" method="post">
                @csrf
                <button class="w-10 btn btn-lg btn-primary" type="submit">Logout</button>
            </form>
        </small>
    </div>
</main>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

