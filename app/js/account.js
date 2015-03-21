'use strict';

app
    .service('AccountService', function ($rootScope) {
            this.login = function (username) {
                console.log("Logged in as: " + username);
                $rootScope.user = username;
            };

            this.logout = function () {
                console.log("Logged out");
                $rootScope.user = '';
            };
        });