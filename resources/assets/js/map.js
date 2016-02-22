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
            news = [];
            var item;

            for (var key in data) {
                item = data[key];

                item.markers = item.addresses.filter(function (address) {
                    return (address.latitude != null) &&  (address.longitude != null);
                }).map(function (address) {
                    var marker = DG.marker([address.latitude, address.longitude], {
                        icon: DG.divIcon({
                            className: 'category-' + item.id_category,
                            iconAnchor: [19, 53],
                            iconSize: [38, 50],
                            html: categories[item.id_category]
                        })
                    }).addTo(map);

                    marker.news = item;

                    marker.on('mouseover', function (e) {
                        $('.js-news').removeClass('_hover');
                        var $news = $('.js-news[data-id-news=' + e.target.news.id_news + ']');
                        $news.addClass('_hover');
                        console.log($news.offset().top - $news.parent().offset().top - 15);
                        $('.js-news-list').scrollTop($news.offset().top - $news.parent().offset().top - 15);
                    }).on('mouseout', function (e) {
                        $('.js-news[data-id-news=' + e.target.news.id_news + ']').removeClass('_hover');
                    });

                    return marker;
                });

                news[item.id_news] = item;

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
    };

    $(document).on('mouseenter', '.js-news', function (e) {
        var id = $(this).data('idNews');

        if (id in news) {
            for (key in news[id].markers) {
                news[id].markers[key].setOpacity(0.8);
            }
        }
    }).on('mouseleave', '.js-news', function (e) {
        var id = $(this).data('idNews');

        if (id in news) {
            for (key in news[id].markers) {
                news[id].markers[key].setOpacity(1);
            }
        }
    });
});