angular.module('onlineshopApp', [])

// .config(function ($stateProvider, $urlRouterProvider) {
//     $stateProvider
//         .state('home', {
//             url: '/home',
//             templateUrl: 'templates/home.html'
//         })
//         .state('list', {
//             url: '/list',
//             templateUrl: 'templates/list.html',
//             controller: 'ListCtrl'
//         });
//     $urlRouterProvider.otherwise('/');
// })

.service('ApiService', ['$http', function ($http) {
        var host = 'http://example.com/'
        this.examplecall = function (value) {
            value = value || 0;
            $http.post(host + '/example', {
                    name: 123
                })
                .success(function (data, status, headers, config) {
                    // this callback will be called asynchronously
                    // when the response is available
                })
                .error(function (data, status, headers, config) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });
            return value;
        };
    }])
    .controller('FoodController', ['$scope', function ($scope) {
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

        $scope.cart = {};
        $scope.totalPrice = 0;

        !(function init() {
            var foodList = $scope.foodList;
            for (var i = 0; i < foodList.length; i++) {
                var food = {
                    quantity: 0,
                    price: foodList[i].price
                }
                $scope.cart[foodList[i].name] = food;
            }
        })();

        $scope.changeSelection = function (selectedFood) {
            $scope.choose = selectedFood;
        }

        var calculatePrice = function () {
            var amount = 0;
            angular.forEach($scope.cart, function (item, name) {
                amount += $scope.cart[name].price * $scope.cart[name].quantity;
            });
            $scope.totalPrice = amount;
        };

        $scope.add = function () {
            if (!$scope.choose) return;
            //$scope.cart += $scope.choose.name;

            $scope.cart[$scope.choose.name].quantity++;

            calculatePrice();
        }

        $scope.deduct = function (itemName) {
            $scope.cart[itemName].quantity--;
            calculatePrice();
        }

        // $scope.deduct = function () {
        //     if (!$scope.choose) return;
        //     if ($scope.cart[$scope.choose.name]) {
        //         $scope.cart[$scope.choose.name] --;
        //         $scope.totalPrice = $scope.totalPrice - $scope.choose.price;
        //     }
        // }

        $scope.checkout = function () {
            alert("Checkout");
        }
    }]);
