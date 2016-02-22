var services = {
    getNews: function (callback) {
        var deffer = Q.defer();
        $.get('/api/news').done(function (response) {
            deffer.resolve(response);
        });

        return deffer.promise;
    }
};