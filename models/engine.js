'use strict';

var mongoose = require('mongoose');

var EngineSchema = new mongoose.Schema({
    created: Date,
    name: String,
    path: String
});

module.exports = mongoose.model('Engine', EngineSchema);
