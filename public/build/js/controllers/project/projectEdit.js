angular.module('app.controllers')
    .controller('ProjectEditController',['$scope','$location','$routeParams','Project',
        function($scope,$location,$routeParams,Project){
             $scope.project = Project.get({id: $routeParams.id});

            $scope.save = function(){
                if ($scope.form.$valid) {
                    Project.update({id: $scope.project.id},$scope.project, function () {
                        $location.path('/projects');
                    });
                }
            }

        }
    ]);