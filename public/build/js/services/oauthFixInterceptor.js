angular.module('app.services')
    .service('oauthFixInterceptor',
    ['$q', '$rootScope', 'OAuthToken', function ($q, $rootScope, OAuthToken) {
        return {
            request: function(config) {
                // Inject `Authorization` header.
                if (OAuthToken.getAuthorizationHeader()) {
                    config.headers = config.headers || {};
                    config.headers.Authorization = OAuthToken.getAuthorizationHeader();
                }

                return config;
            },
            responseError: function(rejection) {
                // Catch `invalid_request` and `invalid_grant` errors and ensure that the `token` is removed.
                var deferred = $q.defer();
                if (400 === rejection.status && rejection.data &&
                    ('invalid_request' === rejection.data.error || 'invalid_grant' === rejection.data.error)
                ) {
                    OAuthToken.removeToken();
                    $rootScope.$emit('oauth:error', {rejection: rejection, deferred: deferred});
                }

                // Catch `invalid_token` and `unauthorized` errors.
                // The token isn't removed here so it can be refreshed when the `invalid_token` error occurs.
                if (401 === rejection.status &&
                    (rejection.data && 'access_denied' === rejection.data.error) ||
                    (rejection.headers('www-authenticate') && 0 === rejection.headers('www-authenticate').indexOf('Bearer'))
                ) {
                    $rootScope.$emit('oauth:error', {rejection: rejection, deferred: deferred});
                    return deferred.promise;
                }
                return $q.reject(rejection);
            }
        };
    }]);