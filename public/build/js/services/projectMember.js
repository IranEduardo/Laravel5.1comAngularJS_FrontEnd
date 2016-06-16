angular.module('app.services')
    .service('ProjectMember',['$resource', 'appConfig', function($resource, appConfig) {
        var baseApiUrl = appConfig.baseUrl + '/project/:id/member/:idProjectMember';
        return $resource(baseApiUrl, {
             id: '@project_id', idProjectMember: '@user_id'
        }, {
            update: {method: 'PUT'}
        });
    }]);