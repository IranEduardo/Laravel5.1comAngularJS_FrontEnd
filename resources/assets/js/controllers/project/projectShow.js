angular.module('app.controllers')
    .controller('ProjectShowController',['$scope','$location','$routeParams','Project', '$cookies',
        function($scope,$location,$routeParams,Project,$cookies){
            $scope.project = Project.get({project: $routeParams.id});

            $scope.show = function(){
                 $location.path('/projects');
            };
        }
    ]);