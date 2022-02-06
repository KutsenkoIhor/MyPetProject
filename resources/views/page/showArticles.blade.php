<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cutting News</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
</head>
<body>
<main>
    <div id="infinite-scroll"  class="album py-3 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @foreach($arrData as $value)
                    <div class="col">
                        <a href="{{$value['url']}}" class="text-decoration-none text-reset">
                            <div class="card h-100">
                                <img src="{{$value['image_news']}}" class="card-img-top" alt="storage/fon.png">
                                <div class="card-body">
                                    <h5 class="card-title">{{$value['name_news_channel']}}</h5>
                                    <p class="card-text">{{$value['title']}}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">{{$value['date']}}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
<script>
    var counter = 1;
    window.addEventListener("scroll", function(){
        var block = document.getElementById('infinite-scroll');
        var contentHeight = block.offsetHeight;      // 1) высота блока контента вместе с границами
        var yOffset       = window.pageYOffset;      // 2) текущее положение скролбара
        var window_height = window.innerHeight;      // 3) высота внутренней области окна документа
        var y             = yOffset + window_height;
        // если пользователь достиг конца
        if(y >= contentHeight)
        {
            counter = counter + 1;
            $.ajax({
                url: "http://127.0.0.1:8000/?page=" + counter ,         /* Куда пойдет запрос */
                method: 'GET',             /* Метод передачи (post или get) */
                dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
                data: {},      /* Параметры передаваемые в запросе. */
                success: function(data) {
                    block.innerHTML = block.innerHTML + data;/* функция которая будет выполнена после успешного запроса.  */
                    // console.log(123213213);            /* В переменной data содержится ответ от index.php. */
                    // console.log(data);            /* В переменной data содержится ответ от index.php. */
                }
            });
        }
    });
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
