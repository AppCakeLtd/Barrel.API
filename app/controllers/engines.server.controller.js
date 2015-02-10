'use strict';

/**
 * Module dependencies.
 */
var mongoose = require('mongoose'),
    errorHandler = require('./errors.server.controller'),
    Engine = mongoose.model('Engine'),
    _ = require('lodash');

/**
 * Create an engine
 */
exports.create = function(req, res) {
    var engine = new Engine(req.body);


    engine.save(function(err) {
        if (err) {
            return res.status(400).send({
                message: errorHandler.getErrorMessage(err)
            });
        } else {
            res.json(engine);
        }
    });
};

/**
 * Show the current engine
 */
exports.read = function(req, res) {
    res.json(req.engine);
};

/**
 * Delete an engine
 */
exports.delete = function(req, res) {
    var engine = req.engine;

    engine.remove(function(err) {
        if (err) {
            return res.status(400).send({
                message: errorHandler.getErrorMessage(err)
            });
        } else {
            res.json(engine);
        }
    });
};

/**
 * Update a article
 */
exports.update = function(req, res) {
    var engine = req.engine;

    engine = _.extend(engine, req.body);

    engine.save(function(err) {
        if (err) {
            return res.status(400).send({
                message: errorHandler.getErrorMessage(err)
            });
        } else {
            res.json(engine);
        }
    });
};

/**
 * List of Engines
 */
exports.list = function(req, res) {
    Engine.find().sort('-created').populate('user', 'displayName').exec(function(err, engines) {
        if (err) {
            return res.status(400).send({
                message: errorHandler.getErrorMessage(err)
            });
        } else {
            res.json(engines);
        }
    });
};

/**
 * Engine middleware
 */
exports.engineByID = function(req, res, next, id) {
    Engine.findById(id).populate('user', 'displayName').exec(function(err, engine) {
        if (err) return next(err);
        if (!engine) return next(new Error('Failed to load article ' + id));
        req.engine = engine;
        next();
    });
};

/**
 * Engine authorization middleware
 */
exports.hasAuthorization = function(req, res, next) {
    if (req.user.id !== 0) {
        return res.status(403).send({
            message: 'User is not authorized'
        });
    }
    next();
};
