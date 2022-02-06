<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
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
        <h3 >List of sites</h3>
        <h3 class="border-bottom"></h3>
        @foreach($data as $value)
            <div class="d-flex text-muted pt-3">
                <div class="me-3" >
                    <img src="{{$value->logo}}" width="32" height="32">
                </div>
                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                    <div class="d-flex justify-content-between">
                        <strong class="text-gray-dark">{{$value->name}}</strong>
                        <div class="d-flex flex-row-reverse bd-highlight pt-2">
                            <form action="{{route('admin.deleteNewsUrl')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger" name="delete" value="{{$value->url}}">Delete</button>
                            </form>
                            <div class="form-check form-switch pt-2 pe-5" >
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" value="{{$value->id}}" name="{{$value->id}}"
                                    {{$value->active ? "checked" : ""}}>
                                <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                            </div>
                        </div>
                    </div>
                    <span class="d-block ">{{$value->url}}</span>
                </div>
            </div>
        @endforeach
        <small class="d-block text-end mt-3">
            <form action="{{route('admin.logout')}}" method="post">
                @csrf
                <button class="w-10 btn btn-lg btn-primary" type="submit">Logout</button>
            </form>
        </small>
        <script>
            $(document).ready(function() {
                $('.form-check-input').change(function() {
                    let state = this.checked;
                    let sourceId = $(this).val();
                    console.log('CHANGE!' + sourceId);
                    console.log(state);
                    $.ajax({
                        url: "{{route('admin.changeStatusOfSource')}}",         /* Куда пойдет запрос */
                        method: 'post',             /* Метод передачи (post или get) */
                        dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */
                        data: {_method: 'PATCH', id: sourceId, state: state, "_token": "{{ csrf_token() }}"},      /* Параметры передаваемые в запросе. */
                        success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
                            console.log(data);            /* В переменной data содержится ответ от index.php. */
                        }
                    });
                });
            });
        </script>
    </div>
</main>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
