'use strict';

angular.module('engines').controller('EnginesController', ['$scope', '$stateParams', '$location', '$upload', 'Authentication', 'Engines',
    function($scope, $stateParams, $location, $upload, Authentication, Engines) {
        $scope.authentication = Authentication;

        $scope.$watch('files', function(files) {
            if (files && files.length) {
                $scope.onFileSelect(files);
            }
        });

        $scope.create = function() {
            var engine = new Engines({
                name: this.name,
                path: this.uploadedEnginePath
            });
            engine.$save(function(response) {
                $location.path('engines/' + response._id);

                $scope.name = '';
                $scope.uploadedEnginePath = '';
            }, function(errorResponse) {
                $scope.error = errorResponse.data.message;
            });
        };

        $scope.onFileSelect = function(files, event) {
            if (files && files.length) {
                var engineFile = files;
                if (angular.isArray(engineFile)) {
                    engineFile = engineFile[0];
                }

                // if (engineFile.type !== '')

                $scope.uploadInProgress = true;
                $scope.uploadProgress = 0;

                $scope.upload = $upload.upload({
                    url: '/engines/upload',
                    method: 'POST',
                    file: engineFile
                })/*.progress(function(event) {
                    $scope.uploadProgress = Math.floor(event.loaded / event.total);
                    $scope.$apply();
                })*/.success(function(data, status, headers, config) {
                    $scope.uploadInProgress = false;
                    $scope.uploadedEnginePath = JSON.parse(data);
                }).error(function(err) {
                    $scope.uploadInProgress = false;
                    console.log('Error uploading file: ' + err.message || err);
                });
            }
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

        $scope.$watch('files', function() {

        });
    }
]);
