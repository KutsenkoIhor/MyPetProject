@extends('layouts.app')

@section('title', 'CUT NEWS')

@section('content')
    <p>{{print_r("d")}}</p>
    <p>{{"d"}}</p>
    <p>{{htmlspecialchars_decode("&quot;Чого хоче Путін?&quot;: Блінкен розповів, про що запитував у Лаврова на зустрічі, і яку отримав відповідь")}}</p>
    @foreach($tagsss as $value)
        <p>{{$value->date}}   <img src="{{$value->logo}}" width="20" height="20">  <a href="{{$value->url}}">{{$value->title}}</a></p>
    @endforeach

{{--    <p>{{$tagsss}}</p>--}}
@endsection


{{--@foreach ($users as $user)--}}
{{--    <p>This is user {{ $user->id }}</p>--}}
{{--@endforeach--}}
