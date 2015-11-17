/**
 * Created by madcloud on 15/11/11.
 */
app = angular.module("test", []);

app.run(function($rootScope){
    $rootScope.name = "Ari Lerner";
});


app.controller('MyController', ['$scope', function($scope) {
    $scope.person = {
        name : "Ari lerner"
    };
    var updateClock = function() {
        $scope.clock = new Date();
    };
    var tiemer = setInterval(function(){
        $scope.$apply(updateClock);
    }, 1000);
    updateClock();
}]);

app.controller('DemoController', ['$scope', function($scope) {
    $scope.counter = 0;
    $scope.add = function(amount){
        $scope.counter += amount;
    };
    $scope.subtract = function(amount) {
        $scope.counter -= amount;
    };

    $scope.roommates = [
        { name: 'Ari'},
        { name: 'Q'},
        { name: 'Sean'},
        { name: 'Anand'}
    ];
    $scope.people = {
        'ari' : 'red',
        'haha' : 'blue',
        'test' : 'green'
    }
}]);
