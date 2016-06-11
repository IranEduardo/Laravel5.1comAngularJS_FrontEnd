angular.module('app.services')
    .service('ProjectMember',['$resource', 'appConfig', function($resource, appConfig) {
        var baseApiUrl = appConfig.baseUrl + '/project/:id/member/:idMember';
        return $resource(baseApiUrl, {id: '@project_id', idMember: '@user_id'},
            {update: {method: 'PUT'}}
        );
    }]);