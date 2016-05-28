angular.module('app.controllers')
    .controller('ProjectNoteListController',['$scope','ProjectNote','$routeParams', '$location',
        function($scope, ProjectNote, $routeParams){
            $scope.projectNotes = ProjectNote.query({id: $routeParams.id});

        }
 ]);