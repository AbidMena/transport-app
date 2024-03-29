
App.controller('myTripCtrl', function($scope,$rootScope, $ionicLoading, $compile, $ionicModal,$window,$timeout,$ionicPopup,serv ) {
	
	/* JAVASCRIPT
	===========================*/
	function animate_Trip_item(){
			$('#content-tab-area').addClass('hidden');
			
			$timeout(function (){
				$('#content-tab-area').removeClass('hidden');
			}, 300);
	 }	
	
	
	
	$scope.myTrip_menu = [
												{'name':'Viajes hoy'},
												{'name':'Historial'}
											 ];
 
	//$scope.myTrip_menu_selected = 0;
	
	$scope.Trip_menu_click = function (index){
		console.log("Trip_menu_click");
		 
		if( $rootScope.myTrip_menu_selected != index ){
			
			$rootScope.myTrip_menu_selected = index;
			if( index == 0 ){
				$rootScope.active_trip = $rootScope.Trips.today;
			}else if( index ==  1 ){
				$rootScope.active_trip = $rootScope.Trips.history;
			} 
			animate_Trip_item();
		}
	}
	
	$scope.show_details = function( index ){

		$rootScope.details = $rootScope.active_trip[index];
	}

});