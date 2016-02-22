$(function() {
    var map;

    var markers = [];

    var news = [];

    var templates = {
        news: Handlebars.compile($("#template-news").html())
    };

    DG.then(function () {
        if ($('#map').length == 0) {
            return;
        }

        map = DG.map('map', {
            center: [54.95, 73.31],
            zoom: 11
        });



        services.getNews().then(function (data) {
            news = data;
            var item;

            for (var key in news) {
                item = news[key];

                item.markers = item.addresses.filter(function (address) {
                    return (address.latitude != null) &&  (address.longitude != null);
                }).map(function (address) {

                    var marker = DG.marker([address.latitude, address.longitude]).addTo(map);
                    marker.news = item;


                    return marker;
                });

                markers.push(item.markers);
            }

            drawNews(news);
        });
    });

    var getLocation = function(href) {
        var l = document.createElement("a");
        l.href = href;

        return l;
    };

    var drawNews = function (news) {
        var list = $('.news-list');

        list.html(templates.news({
            news: news.map(function(news) {
                news.domain = news.link ? getLocation(news.link).hostname : '';

                return news;
            })
        }));
    }
});