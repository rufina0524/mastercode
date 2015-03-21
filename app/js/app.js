var app = angular.module('onlineshopApp', ['ngRoute']);

app.config(function($routeProvider, $locationProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'views/food.html',
            controller: 'FoodController'
        })
        .when('/food', {
            templateUrl: 'views/food.html',
            controller: 'FoodController'
        })
        .otherwise({
            redirectTo: function() {
                console.log('redirect');
                return '/food';
            }
        });
});

app.service('ApiService', ['$http',
    function($http) {
        var host = 'http://example.com/'
        this.examplecall = function(value) {
            value = value || 0;
            $http.post(host + '/example', {
                name: 123
            })
                .success(function(data, status, headers, config) {
                    // this callback will be called asynchronously
                    // when the response is available
                })
                .error(function(data, status, headers, config) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });
            return value;
        };
    }
]);