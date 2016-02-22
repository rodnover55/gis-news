$(function() {
    var map;

    var markers;

    DG.then(function () {
        map = DG.map('map', {
            center: [54.95, 73.31],
            zoom: 11
        });

        var news = services.getNews();
        var item;

        for (var key in news) {
            item = news[key];
            DG.marker([item.lat, item.lon]).addTo(map);
        }
    });
});