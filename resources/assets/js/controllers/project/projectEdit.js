angular.module('app.controllers')
    .controller('ProjectEditController',['$scope','$location','$routeParams','Project','Client',
        function($scope,$location,$routeParams,Project,Client){
             $scope.project = Project.get({id: $routeParams.id});

             $scope.selected_client = null;

             $scope.allClients = Client.query({},function(){

                 angular.forEach($scope.allClients,function(clientObject, index) {
                    if (clientObject.id == $scope.project.client_id){
                        $scope.selected_client =  clientObject;
                    }
                 });

             });

            $scope.save = function(){
                if ($scope.form.$valid) {

                    $scope.project.client_id = $scope.selected_client.id;

                    Project.update({id: $scope.project.id},$scope.project, function () {
                        $location.path('/projects');
                    });
                }
            }

        }
    ]);