if(wordpress == true ){
	var base_url 	 = server_domain + '/wp-admin/admin-ajax.php';
}else{
	var base_url 	 = server_domain + '/index.php/web_service/';
}

var user_data = null;

angular.module('CallApp', ['ionic','ngCordova','CallAppcontrollers'])

  .filter("langTranslate", function() {
      return function(englishInput, translatedLang) {
        if(translatedLang === undefined){
            return englishInput;
        }

        if(translatedLang.length == 0 )
        {
            return englishInput;
        }else{
            return translatedLang;
        }

      }
    })

	.filter("menuLangTranslate", function() {
		return function(englishInput, all_rides, completed, booked) {
			if(all_rides === undefined || completed === undefined || booked === undefined){
					return englishInput;
			}
			if(englishInput=="ALL RIDES"){
					return all_rides;
			}
			if(englishInput=="COMPLETED"){
					return completed;
			}
			if(englishInput=="BOOKED"){
					return booked;
			}

		}
	})


	.filter("rateCardMenuLangTranslate", function() {
		return function(englishInput, day, night) {
			if(day === undefined || night === undefined){
					return englishInput;
			}
			if(englishInput=="DAY"){
					return day;
			}
			if(englishInput=="NIGHT"){
					return night;
			}
		}
	})
	

.run(function($rootScope, $ionicPlatform, $ionicHistory,$state) {
	
	//$cordovaSplashScreen.hide();
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
		
    if (window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(false);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
		
		
		$ionicPlatform.registerBackButtonAction(function(e){
			//alert($ionicHistory.currentStateName())
			if($ionicHistory.currentStateName() =='landing' || $ionicHistory.currentStateName() =='app.landing' ){
				// alert('exit');
				// ionic.Platform.exitApp();
				
				navigator.app.clearCache();
				navigator.app.exitApp();
			}
			else if ($ionicHistory.backView()) {
				 $ionicHistory.goBack();
			}else if($ionicHistory.backTitle()){
				 $ionicHistory.goBack();
			}
			else {
				$state.go('app.landing'); 
				 $ionicHistory.nextViewOptions({
						historyRoot: true
				 });
				
			}
			e.preventDefault();
			return false;
		},122);
		
		
		
	
	});
})
// .config(function($ionicConfigProvider) {
  // if(!ionic.Platform.isIOS())$ionicConfigProvider.scrolling.jsScrolling(false);
// })
.config(function($stateProvider, $urlRouterProvider , $cordovaInAppBrowserProvider) {
		
		setTimeout(function() {
				
         navigator.splashscreen.hide();
    }, 3000);
		
	 var browserOptions = {
      location: "yes",
      toolbar: "yes"
    };

		$cordovaInAppBrowserProvider.setDefaultOptions(browserOptions);
		
	/* NETWORK + PAGE DIRECTION
===================================================	*/

	 if( localStorage.getItem('user_data') === null ){
		 
		 roots = '/landing' ;
	 }else{
		 roots = 'app/landing' ;
		 
	 }
	
	/*===============================================*/
	
  $stateProvider

   .state('landing', {
	url: '/landing',
	templateUrl: 'templates/landing.html',
	controller: 'AppCtrl'
  })

  .state('app', {
	  url: '/app',
	  abstract: true,
	  templateUrl: 'templates/menu.html',
	  controller: 'AppCtrl'
   })

    .state('app.landing', {
      url: '/landing',
      views: {
        'menuContent': {
          templateUrl: 'templates/main-landing.html',
          controller: 'landCtrl'
        }
      }
    })
   
   .state('app.mytrip', {
      url: '/mytrip',
      views: {
        'menuContent': {
          templateUrl: 'templates/my-trip.html',
					controller: 'myTripCtrl'
        }
      }
    })
	
	 .state('app.tripDetials', {
      url: '/tripDetials',
      views: {
        'menuContent': {
          templateUrl: 'templates/trip-details.html',
					controller: 'myTripCtrl'
        }
      }
    })
    
		.state('app.rateCard', {
      url: '/rateCard',
      views: {
        'menuContent': {
          templateUrl: 'templates/rate-card.html',
					controller: 'rateCardCtrl'
        }
      }
    })
		
		.state('app.settings', {
      url: '/settings',
      views: {
        'menuContent': {
          templateUrl: 'templates/settings.html',
					controller: 'settingsCtrl'
        }
      }
    });
	
  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise(roots);
});




