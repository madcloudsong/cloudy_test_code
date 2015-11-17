/**
 * Created by madcloud on 15/11/11.
 */
var app = angular.module('myApp', []);

app.run(function($rootScope){
   $rootScope.name = "Ari Lerner";
});

app.factory('audio', ['$document', function($document) {
    var audio = $document[0].createElement('audio');
    return audio;
}]);

app.factory('player', ['audio', function(audio) {
    var player = {
        playing: false,
        current: null,
        ready: false,

        play: function(program) {
            // If we are playing, stop the current playback
            if (player.playing) player.stop();
            var url = program.audio[0].format.mp3.$text; // from the npr API
            player.current = program; // Store the current program
            audio.src = url;
            audio.play(); // Start playback of the url
            player.playing = true
        },

        stop: function() {
            if (player.playing) {
                audio.pause(); // stop playback
                // Clear the state of the player
                playerplayer.ready = player.playing = false;
                player.current = null;
            }
        }
    };
    return player;
}]);

app.controller('PlayerController', ['$scope', 'player', function($scope, player) {
    //$scope.playing = false;
    //$scope.audio = audio;
    //$scope.audio.src = 'media/npr.mp3';

    $scope.player = player;
    //$scope.play = function() {
    //    $scope.audio.play();
    //    $scope.playing = true;
    //};
    //$scope.stop = function() {
    //    $scope.audio.pause();
    //    $scope.playing = false;
    //};
    //$scope.audio.addEventListener('ended', function() {
    //    $scope.$apply(function() {
    //        $scope.stop()
    //    });
    //});
}]);

app.controller('RelatedController', ['$scope', function($scope) {
}]);

