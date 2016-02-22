<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
    <script src="js/all.js"></script>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <div class="container">
        <div class="row"><div class="col-md-6">
            <form action="news" role="form" method="post">
                <div class="form-group">
                    <label for="news-title">Откуда</label>
                    <input type="text" class="form-control" id="news-title" name="link">
                </div>
                <div class="form-group">
                    <label for="news-title">О чем</label>
                    <input type="text" class="form-control" id="news-title" name="title">
                </div>
                <div class="form-group">
                    <label for="news-content">Что</label>
                    <textarea class="form-control" id="news-content" name="content"></textarea>
                </div>
                <div class="form-group">
                    <label for="news-address">Где</label>
                    <input type="text" class="form-control" id="news-address" name="address">
                </div>
                <div class="form-group">
                    <label>Координаты</label>
                    <input type="text" class="form-control js-insert-map-lat" id="news-address" name="latitude">
                    <input type="text" class="form-control js-insert-map-lon" id="news-address" name="longitude">
                </div>
                <div class="form-group">
                    <div id="insert-map" class="js-insert-map b-insert-map">

                    </div>
                </div>
                <div class="form-group">
                    <label for="news-date">Когда</label>
                    <input type="text" class="form-control" id="news-date" name="date">
                </div>

                <div class="form-group">
                    <label for="news-category">Категория</label>
                    <select name="category" id="news-category" class="form-control">
                        <option value="culture">Культура</option>
                        <option value="social">Общество</option>
                        <option value="policy">Политика</option>
                        <option value="accident">Происшествия</option>
                        <option value="sport">Спорт</option>
                        <option value="economy">Экономика</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Отправить</button>
            </form>
        </div></div>
    </div>
    <script type="text/javascript">
        DG.then(function () {
            var map = DG.map('insert-map', {
                center: [54.95, 73.31],
                zoom: 11
            });

            var marker;
            var $lat = $('.js-insert-map-lat');
            var $lng = $('.js-insert-map-lon');

            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                if (marker) {
                    marker.setLatLng(DG.latLng(lat, lng));
                } else {
                    marker = DG.marker([lat, lng]).addTo(map);
                }

                $lat.val(lat);
                $lng.val(lng);
            });

        });
    </script>
    <style>
        .b-insert-map {
            width: 600px;
            height: 300px;
        }
    </style>
</body>
</html>
