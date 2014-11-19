var app = angular.module('connectFourApp', []);

phonecatApp.controller('GameController', function ($scope, $http) {

    $scope = {
        opponent: null,
        players: null,
        grid: null
    };

    $http.get('service.php/players.json').success(function(data) {
        $scope.players = data;
    });

    $scope.showPlayers = function() {
        return !$scope.grid && !$scope.opponent && $scope.players;
    };

    $scope.selectPlayer = function(player) {
        $scope.opponent = player;
    };

    var loadGrid = function(data) {
        $scope.grid = data.grid;
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