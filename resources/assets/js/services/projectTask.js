angular.module('app.services')
    .service('ProjectTask',['$resource', 'appConfig', function($resource, appConfig) {
        var baseApiUrl = appConfig.baseUrl + '/project/:id/task/:idTask';
        return $resource(baseApiUrl, {id: '@project_id', idTask: '@id'},
            {
                update: {method: 'PUT'}
            }
         )
    }]);