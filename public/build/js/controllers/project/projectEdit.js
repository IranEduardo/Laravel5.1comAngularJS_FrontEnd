angular.module('app.controllers')
    .controller('ProjectEditController',['$scope','appConfig','$location','$cookies', '$routeParams','Project','Client',
        function($scope,appConfig,$location,$cookies,$routeParams,Project,Client){

            Project.get({project: $routeParams.id},function(data){
                 $scope.project = data;
                 $scope.clientSelected = data.client.data[0];
            });

            $scope.due_date = {
                status:{
                    opened: false
                }
            };

            $scope.open = function($event){
                $scope.due_date.status.opened = true;
            };

            $scope.status = appConfig.project.status;

            $scope.save = function(){
                if ($scope.form.$valid) {

                    $scope.project.owner_id = $cookies.getObject('user').id;

                    Project.update({project: $scope.project.id},$scope.project, function () {
                        $location.path('/projects');
                    });
                }
            }

            $scope.formatName = function (model) {
                if (model) {
                    return model.name;
                }
                return '';
            };

            $scope.getClients = function (name) {
                return Client.query({
                    search: name,
                    searchFields: 'name:like'
                }).$promise;
            };

            $scope.selectClient = function(item){
                $scope.project.client_id = item.id;
            };
        }
    ]);