'use strict';

app
    .controller('NavbarController', function ($scope, $location, AccountService) {
        $scope.menu = [{
            'title': 'Home',
            'link': '/',
            'icon': 'home'
        }, {
            'title': 'Food',
            'link': 'food',
            'icon': 'list-alt'
        }, {
            'title': 'Tab3',
            'link': 'tab3',
            'icon': 'camera'
        }, {
            'title': 'Tab4',
            'link': 'tab4',
            'icon': 'user'
        }, {
            'title': 'Tab5',
            'link': 'tab5',
            'icon': 'user'
        }, {
            'title': 'Tab6',
            'link': 'tab6',
            'icon': 'list'
        }];

        $scope.isActive = function (route) {
            return '/' + route === $location.path();
        };

        $scope.loggedIn = '';
        $scope.username = '';

        $scope.login = function () {
            if ($scope.username) {
                AccountService.login($scope.username);
                $scope.loggedIn = $scope.username;
                $scope.username = '';
            }
        };

        $scope.logout = function () {
            AccountService.logout();
            $scope.loggedIn = '';
        }
    });