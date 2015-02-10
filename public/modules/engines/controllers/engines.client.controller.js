'use strict';

angular.module('engines').controller('EnginesController', ['$scope', '$stateParams', '$location', 'Authentication', 'Engines',
    function($scope, $stateParams, $location, Authentication, Engines) {
        $scope.authentication = Authentication;

        $scope.create = function() {
            var engine = new Engines({
                title: this.title,
                content: this.content
            });
            engine.$save(function(response) {
                $location.path('engines/' + response._id);

                $scope.title = '';
                $scope.content = '';
            }, function(errorResponse) {
                $scope.error = errorResponse.data.message;
            });
        };

        $scope.remove = function(engine) {
            if (engine) {
                engine.$remove();

                for (var i in $scope.engines) {
                    if ($scope.engines[i] === engine) {
                        $scope.engines.splice(i, 1);
                    }
                }
            } else {
                $scope.engine.$remove(function() {
                    $location.path('engines');
                });
            }
        };

        $scope.update = function() {
            var engine = $scope.engine;

            engine.$update(function() {
                $location.path('engines/' + engine._id);
            }, function(errorResponse) {
                $scope.error = errorResponse.data.message;
            });
        };

        $scope.find = function() {
            $scope.engines = Engines.query();
        };

        $scope.findOne = function() {
            $scope.engine = Engines.get({
                engineId: $stateParams.engineId
            });
        };
    }
]);
