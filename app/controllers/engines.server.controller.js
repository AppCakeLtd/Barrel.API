'use strict';

/**
 * Module dependencies.
 */
var mongoose = require('mongoose'),
    errorHandler = require('./errors.server.controller'),
    Engine = mongoose.model('Engine'),
    uuid = require('node-uuid'),
    multiparty = require('multiparty'),
    fs = require('fs'),
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

exports.uploadEngine = function(req, res) {
    var form = new multiparty.Form();
    form.parse(req, function(err, fields, files) {
        var file = files.file[0];
        var contentType = file.headers['content-type'];
        var tmpPath = file.path;
        var extIndex = tmpPath.lastIndexOf('.');
        var extension = (extIndex < 0) ? '' : tmpPath.substr(extIndex);

        // UUID to generate unique filenames
        var filename = file.originalFilename;
        var destPath = process.cwd() + '/public/engineFiles/' + filename;
        var returnPath = '/engineFiles/' + filename;

        fs.rename(tmpPath, destPath, function(err) {
            if (err) {
                return res.status(400).send({
                    message: errorHandler.getErrorMessage(err)
                });
            } else {
                res.json(returnPath);
            }
        });
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
        if (!engine) return next(new Error('Failed to load engine ' + id));
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
