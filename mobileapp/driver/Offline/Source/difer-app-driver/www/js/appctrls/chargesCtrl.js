App.controller('chargesCtrl', function($ionicHistory, $scope, $rootScope, $state, WebService, $ionicLoading, $window, $http, $ionicLoading, $timeout) {
$scope.message = {
	data : ''
};

	function callMessageWS() {

        var link = 'getMessage';
        
        var post_data = {
        }
        var promise = WebService.send_data(link, post_data);

        promise.then(function(data) {
            console.log(data);
            $scope.message.data = data.message_account;
        });
    }
    callMessageWS();
 });