'use strict';

angular.module('onlineshopApp')
  .config(function ($stateProvider) {
    $stateProvider
      .state('food', {
        url: '/food',
        templateUrl: 'app/food/food.html',
        controller: 'FoodCtrl'
      });
  });