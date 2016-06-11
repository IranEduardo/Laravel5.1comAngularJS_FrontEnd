angular.module('app.controllers')
    .controller('ProjectTaskEditController',['$scope','ProjectTask','$routeParams', '$location',
        function($scope, ProjectTask, $routeParams, $location){

            $scope.projectTask = ProjectTask.get({id: $routeParams.id, idTask: $routeParams.idTask});

            $scope.save = function(){
                if ($scope.form.$valid) {
                    ProjectTask.update({},$scope.projectTask, function () {
                        $location.path('/project/' + $routeParams.id  + '/tasks');
                    });
                }
            }

        }
    ]);