'use strict';

/**
 * Module dependencies.
 */
var users = require('../../app/controllers/users.server.controller'),
    engines = require('../../app/controllers/engines.server.controller');

module.exports = function(app) {
    // Article Routes
    app.route('/engines')
        .get(engines.list)
        .post(users.requiresLogin, engines.create);

    app.route('/engines/:engineId')
        .get(engines.read)
        .put(users.requiresLogin, engines.hasAuthorization, engines.update)
        .delete(users.requiresLogin, engines.hasAuthorization, engines.delete);

    // Finish by binding the article middleware
    app.param('engineId', engines.engineByID);
};
