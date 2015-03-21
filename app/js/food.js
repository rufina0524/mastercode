app.controller('FoodController', ['$scope', 'ApiService',
        function($scope, $api) {
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

            $scope.changeSelection = function(selectedFood) {
                $scope.choose = selectedFood;
            }

            var calculatePrice = function() {
                var amount = 0;
                angular.forEach($scope.cart, function(item, name) {
                    amount += $scope.cart[name].price * $scope.cart[name].quantity;
                });
                $scope.totalPrice = amount;
            };

            $scope.add = function() {
                if (!$scope.choose) return;
                //$scope.cart += $scope.choose.name;

                $scope.cart[$scope.choose.name].quantity++;

                calculatePrice();
            }

            $scope.deduct = function(itemName) {
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

            $scope.checkout = function() {
                alert("Checkout");
            }

            var tryCallDummyApi = function () {
                $api.examplePost({dummyObject: true})
                    .then(function (response) {
                        console.log(response);
                    });
            };
            tryCallDummyApi();
        }
    ]);