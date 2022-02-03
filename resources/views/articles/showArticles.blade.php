<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cutting News</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<main>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                @foreach($tagsss as $value)
                    <div class="col">
                        <a href="{{$value->url}}" class="text-decoration-none text-reset">
                            <div class="card h-100">
                                <img src="{{$value->logo}}" class="card-img-top" alt="storage/fon.png">
                                <div class="card-body">
                                    <h5 class="card-title">CNN.com - RSS Channel - World</h5>
                                    <p class="card-text">{{$value->title}}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">{{$value->date}} Last updated 3 mins ago</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

</main>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
