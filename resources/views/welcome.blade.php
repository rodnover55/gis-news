<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <script src="http://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
        <script src="js/all.js"></script>
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
        <div class="b-header">
            <b-header class="logo">
                <img src="images/logo.png" class="logo__image" alt="Logo">
            </b-header>
        </div>
        <div class="b-content">
            <div class="b-sidebar">
                <div class="news-list"></div>
            </div>
            <div id="map" class="b-map"></div>
        </div>
        <script id="template-news" type="text/x-handlebars-template">
        @{{#each news}}
            <div class="news">
                @{{#if image}}
                <div class="news__image">
                    @{{image}}
                </div>
                @{{/if}}
                <div class="news__title">
                    @{{title}}
                </div>
                <div class="news__content">@{{content}}</div>
                <div class="news__link"><a href="@{{link}}" target="__blank">Показать целиком</a></div>
                <div class="news__date">@{{date_news.time_news}}</div>
                <div class="news__domain">@{{domain}}</div>
            </div>
        @{{/each}}
        </script>
    </body>
</html>
