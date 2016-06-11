angular.module('app.controllers')
    .controller('ProjectTaskListController',['$scope','ProjectTask','$routeParams', '$location',
        function($scope, ProjectTask, $routeParams){
            $scope.projectTasks = ProjectTask.query({id: $routeParams.id, idTask: $routeParams.idTask});

        }
 ]);