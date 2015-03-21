angular.module('onlineshopApp', [])
  .controller('FoodController', ['$scope', function($scope) {
    $scope.foodList = [{
        name: 'Sausage',
        price: 100
    }, {
        name: 'Cheese',
        price: 400
    }, {
        name: 'Coke',
        price: 200
    }, {
        name: 'Ham',
        price: 100
    }];
    $scope.message = 'Hello';
    $scope.choose = '';

    $scope.changeSelection = function (selectedFood) {
        $scope.choose = selectedFood;
    }

    $scope.add = function () {
        if (!$scope.choose) return;
        //$scope.cart += $scope.choose.name;
        if (!$scope.cart[$scope.choose.name]) {
            $scope.cart[$scope.choose.name] = 1;
        } else {
            $scope.cart[$scope.choose.name]++;
        }
        $scope.totalPrice = $scope.totalPrice + $scope.choose.price;
    }

    $scope.remove = function () {
        if (!$scope.choose) return;
        if (!$scope.cart[$scope.choose.name]) {
            $scope.cart[$scope.choose.name] = 1;
        } else {
            $scope.cart[$scope.choose.name]--;
        }
        $scope.totalPrice = $scope.totalPrice + $scope.choose.price;

    }

    $scope.cart = {};
    $scope.totalPrice = 0;
  }]);
