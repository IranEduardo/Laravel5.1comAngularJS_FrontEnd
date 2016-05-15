angular.module('app.controllers')
    .controller('ProjectNoteNewController',['$scope','ProjectNote','$routeParams', '$location',
        function($scope, ProjectNote, $routeParams, $location){

            $scope.projectNote =  new ProjectNote();
            $scope.projectNote.project_id = $routeParams.id;

            $scope.save = function(){
                if ($scope.form.$valid) {
                    $scope.projectNote.$save(function () {
                        $location.path('/project/' + $routeParams.id  + '/notes');
                    });
                }
            }

        }
    ]);