angular.module('app.controllers')
    .controller('ProjectMemberNewController',['$scope','ProjectMember','$routeParams', '$location',
        function($scope, ProjectMember, $routeParams, $location){

            $scope.projectMember =  new ProjectMember();

            $scope.save = function(){
                if ($scope.form.$valid) {
                    $scope.projectMember.$save({id: $routeParams.id, idMember: null},function () {
                        $location.path('/project/' + $routeParams.id  + '/members');
                    });
                }
            }

        }
    ]);