angular.module('app.controllers')
    .controller('ProjectNoteEditController',['$scope','ProjectNote','$routeParams', '$location',
        function($scope, ProjectNote, $routeParams, $location){

            $scope.projectNote = ProjectNote.get({id: $routeParams.id, idNote: $routeParams.idNote});

            $scope.save = function(){
                if ($scope.form.$valid) {
                    ProjectNote.update({},$scope.projectNote, function () {
                        $location.path('/project/' + $routeParams.id  + '/notes');
                    });
                }
            }

        }
    ]);