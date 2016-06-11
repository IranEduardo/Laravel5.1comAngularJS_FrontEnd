angular.module('app.controllers')
    .controller('ProjectTaskNewController',['$scope','ProjectTask','$routeParams', '$location',
        function($scope, ProjectTask, $routeParams, $location){

            $scope.projectTask =  new ProjectTask();

            $scope.save = function(){
                if ($scope.form.$valid) {
                    $scope.projectTask.$save({id: $routeParams.id, idTask: null},function () {
                        $location.path('/project/' + $routeParams.id  + '/tasks');
                    });
                }
            }

        }
    ]);