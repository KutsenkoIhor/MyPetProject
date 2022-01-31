@extends('layouts.adminsSetting')

@section('bloc')

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
<script>
    $(document).ready(function() {
        //set initial state.

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
@endsection
