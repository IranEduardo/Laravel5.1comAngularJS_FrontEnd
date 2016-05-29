angular.module('app.controllers')
    .controller('ProjectFileNewController',['$scope','$routeParams', '$location','appConfig','Upload','Url',
        function($scope, $routeParams, $location, appConfig, Upload, Url){

            $scope.save = function(){
                if ($scope.form.$valid) {
                    var url = appConfig.baseUrl + Url.getUrlFromUrlSymbol(appConfig.urls.projectFile,{
                          id: '',
                          idFile: ''
                        });
                    Upload.upload({
                        url: url,
                        data: {
                            name: $scope.projectFile.name,
                            description: $scope.projectFile.description,
                            file: $scope.projectFile.file,
                            project_id: $routeParams.id
                        }
                    }).then(function (resp) {
                        $location.path('/project/' + $routeParams.id + '/files');
                    });

                }
            }
        }
    ]);