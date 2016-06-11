var app = angular.module('app',['app.controllers', 'ngRoute', 'angular-oauth2']);

angular.module('app.controllers',['angular-oauth2', 'ngMessages', 'app.services', 'app.directives',
               'ui.bootstrap.typeahead', 'ui.bootstrap.datepickerPopup' ,'ui.bootstrap.tpls', 'ngFileUpload']);

angular.module('app.services',['ngResource']);
angular.module('app.directives',[]);

app.provider('appConfig', ['$httpParamSerializerProvider',function($httpParamSerializerProvider){

    var config = {
        baseUrl: 'http://localhost:8000',
        project: {
            status: [
                {value: 1, label: 'Não Iniciado'},
                {value: 2, label: 'Iniciado'},
                {value: 3, label: 'Concluido'}
            ]
        },
        urls: {
            projectFile: '/project/{{id}}/file/{{idFile}}'
        },
        utils: {
            transformRequest: function (data) {
                if (angular.isObject(data)) {
                    return $httpParamSerializerProvider.$get()(data);
                }
                return data;
            },
            transformResponse: function (data, headers) {
                var headersGetter = headers();
                if (headersGetter['content-type'] == 'application/json' ||
                    headersGetter['content-type'] == 'text/json') {
                    var dataJson = JSON.parse(data);
                    if (dataJson.hasOwnProperty('data')) {
                        dataJson = dataJson.data;
                    }
                    return dataJson;
                }
                return data;
            }
        }
    };

    return {
            config: config,
            $get: function () {
                return config;
            }
    };

}]);

app.config(['OAuthProvider','OAuthTokenProvider','$routeProvider', '$httpProvider', 'appConfigProvider',
    function(OAuthProvider, OAuthTokenProvider, $routeProvider, $httpProvider, appConfigProvider) {

        $httpProvider.defaults.headers.post['Content-Type'] =
            'application/x-www-form-urlencoded;charset-utf-8';
        $httpProvider.defaults.headers.put['Content-Type'] =
            'application/x-www-form-urlencoded;charset-utf-8';
        $httpProvider.defaults.transformRequest = appConfigProvider.config.utils.transformRequest;
        $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;

        $routeProvider
            .when('/login', {
                   templateUrl : 'build/views/login.html',
                   controller : 'LoginController'
            })
            .when('/home', {
                    templateUrl : 'build/views/home.html',
                    controller  : 'HomeController'
            })
            .when('/clients', {
                    templateUrl: 'build/views/client/list.html',
                    controller: 'ClientListController'
            })
            .when('/clients/new', {
                templateUrl: 'build/views/client/new.html',
                controller: 'ClientNewController'
            })
            .when('/clients/:id/edit', {
                templateUrl: 'build/views/client/edit.html',
                controller: 'ClientEditController'
            })
            .when('/clients/:id/remove', {
                templateUrl: 'build/views/client/remove.html',
                controller: 'ClientRemoveController'
            })
            .when('/clients/:id', {
                templateUrl: 'build/views/client/show.html',
                controller: 'ClientShowController'
            })
            .when('/projects', {
                templateUrl: 'build/views/project/list.html',
                controller: 'ProjectListController'
            })
            .when('/projects/new', {
                templateUrl: 'build/views/project/new.html',
                controller: 'ProjectNewController'
            })
            .when('/projects/:id/edit', {
                templateUrl: 'build/views/project/edit.html',
                controller: 'ProjectEditController'
            })
            .when('/projects/:id/remove', {
                templateUrl: 'build/views/project/remove.html',
                controller: 'ProjectRemoveController'
            })
            .when('/projects/:id', {
                templateUrl: 'build/views/project/show.html',
                controller: 'ProjectShowController'
            })
            .when('/project/:id/notes', {
                templateUrl: 'build/views/project_note/list.html',
                controller: 'ProjectNoteListController'
            })
            .when('/project/:id/notes/:idNote/edit', {
                templateUrl: 'build/views/project_note/edit.html',
                controller: 'ProjectNoteEditController'
            })
            .when('/project/:id/notes/new', {
                templateUrl: 'build/views/project_note/new.html',
                controller: 'ProjectNoteNewController'
            })
            .when('/project/:id/notes/:idNote/remove', {
                templateUrl: 'build/views/project_note/remove.html',
                controller: 'ProjectNoteRemoveController'
            })
            .when('/project/:id/notes/:idNote', {
                templateUrl: 'build/views/project_note/show.html',
                controller: 'ProjectNoteShowController'
            })
            .when('/project/:id/files', {
                templateUrl: 'build/views/project_file/list.html',
                controller: 'ProjectFileListController'
            })
            .when('/project/:id/files/:idFile/edit', {
                templateUrl: 'build/views/project_file/edit.html',
                controller: 'ProjectFileEditController'
            })
            .when('/project/:id/files/new', {
                templateUrl: 'build/views/project_file/new.html',
                controller: 'ProjectFileNewController'
            })
            .when('/project/:id/files/:idFile/remove', {
                templateUrl: 'build/views/project_file/remove.html',
                controller: 'ProjectFileRemoveController'
            })
            .when('/project/:id/tasks', {
                templateUrl: 'build/views/project_task/list.html',
                controller: 'ProjectTaskListController'
            })
            .when('/project/:id/tasks/:idTask/edit', {
                templateUrl: 'build/views/project_task/edit.html',
                controller: 'ProjectTaskEditController'
            })
            .when('/project/:id/tasks/new', {
                templateUrl: 'build/views/project_task/new.html',
                controller: 'ProjectTaskNewController'
            })
            .when('/project/:id/tasks/:idTask/remove', {
                templateUrl: 'build/views/project_task/remove.html',
                controller: 'ProjectTaskRemoveController'
            })
            .when('/project/:id/tasks/:idTask', {
                templateUrl: 'build/views/project_task/show.html',
                controller: 'ProjectTaskShowController'
            })
            .when('/project/:id/members', {
                templateUrl: 'build/views/project_member/list.html',
                controller: 'ProjectMemberListController'
            })
            .when('/project/:id/members/:idMember/edit', {
                templateUrl: 'build/views/project_member/edit.html',
                controller: 'ProjectMemberEditController'
            })
            .when('/project/:id/members/new', {
                templateUrl: 'build/views/project_member/new.html',
                controller: 'ProjectMemberNewController'
            })
            .when('/project/:id/members/:idMember/remove', {
                templateUrl: 'build/views/project_member/remove.html',
                controller: 'ProjectMemberRemoveController'
            })
            .when('/project/:id/members/:idMember', {
                templateUrl: 'build/views/project_member/show.html',
                controller: 'ProjectMemberShowController'
            });

        OAuthProvider.configure({
            baseUrl: appConfigProvider.config.baseUrl,
            clientId: 'appid1',
            clientSecret: 'secret',
            grantPath: 'oauth/access_token'
        });

        OAuthTokenProvider.configure({
           name: 'token',
           options: {
               secure: false
           }
        });

     }

]);

app.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth) {
        $rootScope.$on('oauth:error', function(event, rejection) {
            // Ignore `invalid_grant` error - should be catched on `LoginController`.
            if ('invalid_grant' === rejection.data.error) {
                return;
            }

            // Refresh token when a `invalid_token` error occurs.
            if ('invalid_token' === rejection.data.error) {
                return OAuth.getRefreshToken();
            }

            // Redirect to `/login` with the `error_reason`.
            return $window.location.href = '/login?error_reason=' + rejection.data.error;
        });
}]);
