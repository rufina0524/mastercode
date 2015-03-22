'use strict';

app
    .service('ApiService', function ($http, $q, $rootScope) {
            var httpGet = function (url, params) {
                var deferred = $q.defer();
                $http.get(url, {params: params})
                    .success(function (response) {
                        deferred.resolve(response);
                    });
                return deferred.promise;
            };
    
            var httpPost = function (url, object) {
                var deferred = $q.defer();
                $http.post(url, object)
                    .success(function (response) {
                        deferred.resolve(response);
                    });
                return deferred.promise;
            };
    
            var httpPut = function (url, object) {
                var deferred = $q.defer();
                $http.put(url, object)
                    .success(function (response) {
                        deferred.resolve(response);
                    });
                return deferred.promise;
            };
    
            var httpDelete = function (url) {
                var deferred = $q.defer();
                $http.delete(url)
                    .success(function (response) {
                        deferred.resolve(response);
                    });
                return deferred.promise;
            };
    
            var baseUrl = 'http://localhost/mastercodeAPI/WalletWebContent/A1.php';
    
            this.examplePost = function(obj) {
                // When API is ready
                return httpGet(baseUrl, obj).then(function(response) {
					console.log(response);
					response.callbackUrl = "http://" + window.location.host + "/mastercodeAPI/" + response.callbackUrl;
					MasterPass.client.checkout(response);
					
//                    return response;
                });
    
                // dummy below
                var deferred = $q.defer();
                deferred.resolve({
                    status: 'success'
                });
                return deferred.promise;
            };
        });