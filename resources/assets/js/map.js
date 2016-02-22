$(function() {
    var map;

    var markers = [];

    DG.then(function () {
        if ($('#map').length == 0) {
            return;
        }

        map = DG.map('map', {
            center: [54.95, 73.31],
            zoom: 11
        });


        services.getNews().then(function (news) {
            var item;

            for (var key in news) {
                item = news[key];

                markers.push(item.addresses.filter(function (address) {
                    return (address.latitude != null) &&  (address.longitude != null);
                }).map(function (address) {
                    var marker = DG.marker([address.latitude, address.longitude]).addTo(map);
                    marker.news = item;


                    return marker;
                }));
            }
        });

    });
});