angular.module('app.controllers')
    .controller('ProjectMemberListController',['$scope','$routeParams', '$location', 'ProjectMember','User',
        function($scope, $routeParams, $location, ProjectMember, User){

            $scope.projectMember = new ProjectMember();

            $scope.save = function() {
                if ($scope.form.$valid) {
                    $scope.projectMember.$save({id: $routeParams.id, idProjectMember: null}, function(){
                       $scope.projectMember = new ProjectMember();
                       $scope.loadMember();
                    });
                }
            };

            $scope.loadMember = function(){
                $scope.projectMembers = ProjectMember.query(
                               {id: $routeParams.id,
                                idProjectMember: null,
                                orderBy: 'users:user_id|users.name',
                                sortedBy: 'asc'
                });
            };
            $scope.formatName = function (model) {
                if (model) {
                    return model.name;
                }
                return '';
            };

            $scope.getUsers = function (name) {
                return User.query({
                    search: name,
                    searchFields: 'name:like'
                }).$promise;
            };

            $scope.selectUser = function(item){
                $scope.projectMember.user_id = item.id;
            };

            $scope.loadMember();
        }
 ]);