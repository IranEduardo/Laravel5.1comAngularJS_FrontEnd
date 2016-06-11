angular.module('app.controllers')
    .controller('ProjectMemberEditController',['$scope','ProjectMember','$routeParams', '$location',
        function($scope, ProjectMember, $routeParams, $location){

            $scope.projectMember = ProjectMember.get({id: $routeParams.id, idMember: $routeParams.idMember});

            $scope.save = function(){
                if ($scope.form.$valid) {
                    ProjectMember.update({id: $routeParams.id, idMember: $routeParams.idMember},$scope.projectMember, function () {
                        $location.path('/project/' + $routeParams.id  + '/members');
                    });
                }
            }

        }
    ]);