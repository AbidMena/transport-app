App.controller('settingsCtrl', function($scope,$rootScope, $ionicModal, $timeout,$state,$ionicLoading, $ionicPopup,serv, WebService,$filter) {
	
	$scope.signUp = {};
  $scope.do_update = function( form ) {
		
		if(
				 form.$valid 
				 && $scope.signUp.pwd ==  $scope.signUp.c_pwd  
				
			){
		 
			var link = 'update_pwd';
				
			var post_data = {  
								'username'  : $rootScope.user_data.User_name ,
								'Password'  : $scope.signUp.pwd ,
								'token'  		: $rootScope.user_data.token  ,
								
							 }
			
			WebService.show_loading();	
			 
			 var promise = WebService.send_data( link,post_data);
			 
			 promise.then(function(data){  
				 
				 $ionicLoading.hide();
				 
				 form.$setPristine();
				 $scope.signUp = {};
				 
				 if(data.status == 'success'){
						
							$ionicPopup.alert({
								title: '<p class="text-center color-yellow">sucess</p>',
								
								template: "<p class='text-center color-gery'>"+$filter('langTranslate')("Password successfully updated",$rootScope.appConvertedLang['Password_successfully_updated'])+"</p>",
								scope: $scope					
							});
				 }
				 
			 })
		}else{
			
			form.pwd.$setDirty();
		}	
	}
});		