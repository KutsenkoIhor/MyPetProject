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

                    <form action="{{route('admin.deleteNewsUrl')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger" name="delete" value="{{$value->url}}">Delete</button>
                    </form>
                </div>
                <span class="d-block">{{$value->url}}</span>
            </div>
        </div>
    @endforeach

@endsection
