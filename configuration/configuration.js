'use strict';

module.exports = function(app) {
    app.set('environment', process.env.NODE_ENV || 'development');
    if (app.get('environment') === 'development') {
        app.set('dbName', 'barrelapi-dev');
        app.set('dbServer', 'localhost');
    }
    else {
        app.set('dbName', 'barrelapi');
        app.set('dbServer', 'localhost');
    }

    app.set('dbURL', ['mongodb://', app.get('dbServer'), '/', app.get('dbName')].join(''));
};
