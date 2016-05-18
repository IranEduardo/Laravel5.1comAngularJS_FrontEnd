angular.module('app.controllers')
    .controller('ProjectListController',['$scope','Project',
        function($scope, Project, $cookies){
            $scope.projects = Project.query();
        }
    ]);