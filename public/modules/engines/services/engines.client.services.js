'use strict';

//Engines service used for communicating with the engines REST endpoints
angular.module('engines').factory('Engines', ['$resource',
    function($resource) {
        return $resource('engines/:engineId', {
            engineId: '@_id'
        }, {
            update: {
                method: 'PUT'
            }
        });
    }
]);
