var app = angular.module('connectFourApp', []);

app.controller('GameController', function ($scope, $http) {

    $http.get('service.php/players.json').success(function(data) {
        $scope.players = data;
    });

    $scope.showPlayers = function() {
        return !$scope.grid && !$scope.opponent && $scope.players;
    };

    $scope.selectPlayer = function(player) {
        $scope.opponent = player;
    };

    $scope.showStart =function() {
        return !$scope.grid && $scope.opponent;
    };

    var loadGrid = function(data) {
        $scope.grid = data.grid;
        $scope.gridInverse = [];
        for (var i = data.grid.length - 1; i >= 0; i--) {
            $scope.gridInverse.push(data.grid[i]);
        }
    };

    $scope.opponentStart = function() {
        $http.post('service.php/game.json', {
            'opponent': $scope.opponent
        }).success(loadGrid);
    };

    $scope.playerStart = function() {
        $http.post('service.php/game.json', {}).success(loadGrid);
    };

    $scope.move = function(move) {
        $http.post('service.php/game.json', {
            opponent: $scope.opponent,
            move: move,
            grid: $scope.grid
        }).success(loadGrid);
    };
});