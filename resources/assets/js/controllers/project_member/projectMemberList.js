angular.module('app.controllers')
    .controller('ProjectMemberListController',['$scope','ProjectMember','$routeParams', '$location',
        function($scope, ProjectMember, $routeParams){
            $scope.projectMembers = ProjectMember.query({id: $routeParams.id, idMember: $routeParams.idMember});

        }
 ]);