angular.module('app.controllers')
    .controller('ProjectFileListController',['$scope','ProjectFile','$routeParams',
        function($scope, ProjectFile, $routeParams){
            $scope.projectFiles = ProjectFile.query({id: $routeParams.id});

        }
 ]);