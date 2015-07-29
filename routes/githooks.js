var express = require('express');
var router = express.Router();
var sys = require('sys');
var exec = require('child_process').exec;
var child;

router.get('/refresh', function(req, res, next) { //eslint-disable-line no-unused-vars
    child = exec('npm refresh', function(error, stdout, stderr) {
        if (error !== null) {
            console.log('exec error: ' + error);
        }
    });
});

module.exports = router;
