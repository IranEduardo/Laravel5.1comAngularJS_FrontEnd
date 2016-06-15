angular.module('app.controllers')
    .controller('ProjectTaskListController',['$scope','$routeParams', 'ProjectTask','appConfig',
        function($scope, $routeParams, ProjectTask, appConfig ){

            $scope.projectTask = new ProjectTask();

            $scope.save = function() {
                if ($scope.form.$valid) {
                    $scope.projectTask.status = appConfig.projectTask.status[0].value;
                    $scope.projectTask.$save({id: $routeParams.id}, function(){
                        $scope.projectTask = new ProjectTask();
                        $scope.loadTask();
                    });
                }
            };

            $scope.loadTask =  function() {
                $scope.projectTasks = ProjectTask.query({
                   id: $routeParams.id,
                   orderBy: 'id',
                   sortedBy: 'desc'
                });
            };

            $scope.loadTask();
        }
 ]);