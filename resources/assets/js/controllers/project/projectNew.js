angular.module('app.controllers')
    .controller('ProjectNewController',['$scope','$location','Project','$cookies',
        function($scope,$location, Project, $cookies){
            $scope.project = new Project();
            $scope.project.owner_id = $cookies.getObject('user').id;

            $scope.save = function(){
                if ($scope.form.$valid) {
                    $scope.project.$save().then(function () {
                         $location.path('/projects');
                    });
                }
            }

        }
]);