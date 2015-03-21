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