angular.module('app.services')
    .service('ProjectNote',['$resource', 'appConfig', function($resource, appConfig) {
        var baseApiUrl = appConfig.baseUrl + '/project';
        return $resource(baseApiUrl, {},
            { query:  {url: baseApiUrl + '/:id/note', params: {id: '@project_id'}, isArray: true},
              update: {method: 'PUT', url: baseApiUrl + '/note/:idNote', params: {idNote: '@id'}},
              get:    {url: baseApiUrl +  '/:id/note/:idNote', params: {id: '@project_id', idNote: '@id'}},
              save:   {method: 'POST', url: baseApiUrl + '/note'},
              delete: {method: 'DELETE', url: baseApiUrl + '/note/:idNote', params: {idNote: '@id'}}
            }
        );
    }]);