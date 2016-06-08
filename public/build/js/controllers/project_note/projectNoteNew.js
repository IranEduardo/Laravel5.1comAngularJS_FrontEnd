angular.module('app.controllers')
    .controller('ProjectNoteNewController',['$scope','ProjectNote','$routeParams', '$location',
        function($scope, ProjectNote, $routeParams, $location){

            $scope.projectNote =  new ProjectNote();

            $scope.save = function(){
                if ($scope.form.$valid) {
                    $scope.projectNote.$save({id: $routeParams.id},function () {
                        $location.path('/project/' + $routeParams.id  + '/notes');
                    });
                }
            }

        }
    ]);