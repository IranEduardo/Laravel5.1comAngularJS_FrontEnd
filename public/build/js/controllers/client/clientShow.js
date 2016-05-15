angular.module('app.controllers')
    .controller('ClientShowController',['$scope','$location','$routeParams','Client',
        function($scope,$location,$routeParams,Client){
            $scope.client = Client.get({id: $routeParams.id});

            $scope.show = function(){
                 $location.path('/clients');
            };
        }
    ]);