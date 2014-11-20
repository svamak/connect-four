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
        $scope.gridInverse = {};
        for (var i = data.grid.length - 1; i >= 0; i--) {
            $scope.gridInverse['row.' + i] = {
                'id' : 'row.' + i,
                'grid': data.grid[i]
            };
        }
    };

    $scope.checkItem = function(disk) {
        var out = [
            'glyphicon',
            'glyphicon-unchecked'
        ];

        if (disk == 'd1') {
            out.push('text-primary');
        } else if (disk == 'd2') {
            out.push('text-danger');
        }

        return out;
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