angular.module('app.controllers')
    .controller('ProjectMemberShowController',['$scope','$location','$routeParams','ProjectMember',
        function($scope,$location,$routeParams,ProjectMember){

            $scope.projectMember = ProjectMember.get({id: $routeParams.id, idMember: $routeParams.idMember});

            $scope.show = function(){
                  $location.path('/project/' + $routeParams.id  + '/members');
            }
        }
    ]);