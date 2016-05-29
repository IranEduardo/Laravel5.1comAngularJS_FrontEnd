angular.module('app.controllers')
    .controller('ProjectFileEditController',['$scope','ProjectFile','$routeParams', '$location',
        function($scope, ProjectFile, $routeParams, $location){

            $scope.projectFile = ProjectFile.get({id: $routeParams.id, idFile: $routeParams.idFile});

            $scope.save = function(){
                if ($scope.form.$valid) {
                    ProjectFile.update({id: $routeParams.id,
                                        idFile: $routeParams.idFile}, $scope.projectFile, function () {
                           $location.path('/project/' + $routeParams.id  + '/files');
                    });
                }
            }

        }
    ]);