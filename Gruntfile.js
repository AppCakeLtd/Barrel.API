module.exports = function (grunt) {
    'use strict';

    require('load-grunt-tasks')(grunt);
    var path = require('path');
    var fs = require('fs');

    var getSemanticFiles = function() {
        var files = {};
        var config = JSON.parse(fs.readFileSync('less/semantic-ui/semantic.json'));
        var srcDir = 'bower_components/semantic-ui/src/definitions/';
        var outputDir = 'less/semantic-ui/output/';

        for (var type in config) {
            config[type].forEach(function(ele) {
                files[outputDir + type + '.' + ele + '.output'] = [srcDir + type + '/' + ele + '.less'];
            });
        }
        return files;
    };

    grunt.initConfig({
        less: {
            semantic: {
                options: {
                    cleancss: false
                },
                files: getSemanticFiles()
            },
            dev: {
                options: {
                    cleancss: false,
                    compile: true
                },
                files: {
                    'public/stylesheets/style.css' : 'less/style.less',
                    'public/stylesheets/semantic-ui/semantic.css' : 'less/semantic-ui/output/**/*.output'
                }
            }
        },
        nodemon: {
            dev: {
                script: path.resolve(__dirname, 'bin/www'),
                options: {
                    ext: 'js,ejs,less',
                    watch: ['app.js', 'bin/www', 'less/**/*.less', 'routes/**/*.js', 'views/**/*.ejs']
                }
            },
            debug: {
                script: path.resolve(__dirname, 'bin/www'),
                options: {
                    nodeArgs: ['--debug'],
                    ext: 'js,ejs,less',
                    watch: ['app.js', 'bin/www', 'less/**/*.less', 'routes/**/*.js', 'views/**/*.ejs']
                }
            }
        },
        'node-inspector': {
            debug: {
                options: {
                    'web-port': 1337,
                    'web-host': 'localhost',
                    'debug-port': 5858,
                    'save-live-edit': true,
                    'no-preload': true,
                    'stack-trace-limit': 50,
                    'hidden': []
                }
            }
        },
        concurrent: {
            dev: ['nodemon:dev'],
            debug: ['nodemon:debug', 'node-inspector'],
            options: {
                logConcurrentOutput: true
            }
        }
    });

    grunt.registerTask('default', [
        'dist'
    ]);
    grunt.registerTask('dev', [
        'less:semantic',
        'less:dev',
        'concurrent:dev'
    ]);
    grunt.registerTask('debug', [
        'less:semantic',
        'less:dev',
        'concurrent:debug'
    ]);
    grunt.registerTask('dist', []);
};
