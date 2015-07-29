var express = require('express');
var router = express.Router();
var Engine = require('../models/engine');

router.get('/', function(req, res, next) { //eslint-disable-line no-unused-vars
    Engine.find().lean().exec(function(err, engines) {
        if (err) {
            return next(err);
        }
        res.json(engines);
    });
});

module.exports = router;
