@extends('layouts.adminsSetting')

@section('url')

    @foreach($data as $value)
        <p>{{$value->id}}  {{$value->url}}  {{$value->created_at}}  {{$value->updated_at}}</p>
    @endforeach

@endsection
