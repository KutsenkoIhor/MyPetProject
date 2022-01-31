@extends('layouts.articles')

@section('title', 'CUT NEWS')

@section('content')

    @foreach($tagsss as $value)
        <p>{{$value->date}}   <img src="{{$value->logo}}" width="20" height="20">  <a href="{{$value->url}}">{{$value->title}}</a></p>
    @endforeach

@endsection

@section('text')
    @foreach($tagsss as $value)

        <div class="col">
            <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><img src="{{$value->logo}}"><rect width="100%" height="100%" fill="#55595c"/></svg>
{{--                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>--}}
{{--                <img src="{{$value->logo}}" width="420" height="225">--}}
                <div class="card-body">
                    <p class="card-text"><a href="{{$value->url}}">{{$value->title}}</a></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                        </div>
                        <small class="text-muted">{{$value->date}}</small>
                    </div>
                </div>
            </div>
        </div>



{{--        <p>{{$value->date}}   <img src="{{$value->logo}}" width="20" height="20">  <a href="{{$value->url}}">{{$value->title}}</a></p>--}}
    @endforeach
@endsection
