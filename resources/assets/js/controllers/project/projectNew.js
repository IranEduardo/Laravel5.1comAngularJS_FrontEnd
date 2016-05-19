angular.module('app.controllers')
    .controller('ProjectNewController',['$scope','$location','Project','$cookies', 'Client',
        function($scope,$location, Project, $cookies, Client){
            $scope.project = new Project();
            $scope.project.owner_id = $cookies.getObject('user').id;

            $scope.selected_client = null;

            $scope.allClients = Client.query({},function(){
                $scope.selected_client = $scope.allClients[0];
            });


            $scope.save = function(){
                if ($scope.form.$valid) {

                    $scope.project.client_id = $scope.selected_client.id;

                    $scope.project.$save().then(function () {
                         $location.path('/projects');
                    });
                }
            }

        }
]);