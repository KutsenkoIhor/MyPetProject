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

<form action="{{route('admin.activeNewsUrl')}}" method="post">
    @csrf

    <div class="d-flex justify-content-between">
        <h3 >List of sites</h3>
        <button class="w-10 btn btn-lg btn-primary" type="submit">Save</button>
    </div>
    <h3 class="border-bottom"></h3>

    @foreach($data as $value)
{{--        <div class="d-flex text-muted pt-3">--}}
{{--            <div class="me-3" >--}}
{{--                <img src="{{$value->logo}}" width="32" height="32">--}}
{{--            </div>--}}


{{--            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">--}}
{{--                <div class="d-flex justify-content-between">--}}
{{--                    <strong class="text-gray-dark">{{$value->name}}</strong>--}}

{{--                    <div class="d-flex flex-row-reverse bd-highlight pt-2">--}}

                        <form action="{{route('admin.deleteNewsUrl')}}" method="post">
                            @csrf
{{--                            <button type="submit" class="btn btn-danger" name="delete" value="{{$value->url}}">Delete</button>--}}
                        </form>

                        <div class="form-check form-switch pt-2 pe-5" >
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" value="{{$value->id}}" name="{{$value->id}}"
                                {{$value->active ? "checked" : ""}}>
                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                        </div>
{{--                    </div>--}}
{{--                </div>--}}
{{--                <span class="d-block ">{{$value->url}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
    @endforeach
</form>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
