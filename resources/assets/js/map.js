$(function() {
    var map;

    var markers = [];

    var news = [];

    var categories = {
        'culture': 'К',
        'social': 'О',
        'policy': 'П',
        'accident': 'П',
        'sport': 'С',
        'economy': 'Э'
    }

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
                    console.log('category-' + item.id_category);
                    var marker = DG.marker([address.latitude, address.longitude], {
                        icon: DG.divIcon({
                            className: 'category-' + item.id_category,
                            iconAnchor: [19, 53],
                            iconSize: [38, 50],
                            html: categories[item.id_category]
                        })
                    }).addTo(map);
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

                if (news.content.length > 170) {
                    news.content = news.content.substring(0, 167) + '...';
                }

                return news;
            })
        }));
    }
});