'use strict';

// Setting up route
angular.module('engines').config(['$stateProvider',
    function($stateProvider) {
        // Articles state routing
        $stateProvider.
        state('listEngines', {
            url: '/engines',
            templateUrl: 'modules/engines/views/list-engines.client.view.html'
        }).
        state('createEngine', {
            url: '/engines/create',
            templateUrl: 'modules/engines/views/create-engine.client.view.html'
        }).
        state('viewEngine', {
            url: '/engine/:engineId',
            templateUrl: 'modules/engines/views/view-engine.client.view.html'
        }).
        state('editEngine', {
            url: '/engines/:engineId/edit',
            templateUrl: 'modules/engines/views/edit-engine.client.view.html'
        });
    }
]);
