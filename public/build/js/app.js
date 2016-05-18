var app = angular.module('app',['app.controllers', 'ngRoute', 'angular-oauth2']);

angular.module('app.controllers',['angular-oauth2', 'ngMessages', 'app.services']);

angular.module('app.services',['ngResource']);


app.provider('appConfig', function(){

    var config =  {
        baseUrl: 'http://localhost:8000'
    };

    return {
            config: config,
            $get: function () {
                return config;
            }
    };

});

app.config(['OAuthProvider','OAuthTokenProvider','$routeProvider','appConfigProvider',
    function(OAuthProvider, OAuthTokenProvider, $routeProvider, appConfigProvider) {
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
