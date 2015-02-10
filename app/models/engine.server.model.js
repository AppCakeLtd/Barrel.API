'use strict';

/**
 * Module dependencies.
 */
var mongoose = require('mongoose'),
    Schema = mongoose.Schema;

/**
 * Article Schema
 */
var EngineSchema = new Schema({
    created: {
        type: Date,
        default: Date.now
    },
    name: {
        type: String,
        default: '',
        trim: true,
        required: 'Name cannot be blank'
    },
    path: {
        type: String,
        default: '',
        trim: true,
        required: 'Path cannot be empty'
    }
});

mongoose.model('Engine', EngineSchema);
