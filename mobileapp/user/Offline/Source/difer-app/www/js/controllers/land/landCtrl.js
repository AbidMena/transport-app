
App.controller('landCtrl', function($scope,$rootScope,$q, $ionicLoading, $compile, $ionicModal,$window,$timeout,$ionicPopup, landInit, WebService,$filter) {
	
	
	var directionsDisplay = new google.maps.DirectionsRenderer;
    var directionsService = new google.maps.DirectionsService;
	/* Funtion For set Map
	=========================================================== */
	
	function set_map() {
	    // Create an array of styles.
			var styles = landInit.mapStyles();
	  	
		// Create a new StyledMapType object, passing it the array of styles, 
			var styledMap = new google.maps.StyledMapType(styles,
			{name: "Styled Map"});
	
			var myLatlng = new google.maps.LatLng(43.07493,-89.381388);
        
			var mapOptions = {
			  center: myLatlng,
			  zoom: 16,
			  
			  disableDefaultUI: true,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			
			var map = new google.maps.Map(document.getElementById("map"),
				mapOptions);
			
			 map.mapTypes.set('map_style', styledMap);
			 map.setMapTypeId('map_style');
			
			
			$scope.map = map;
			
			$scope.init_status = true;
		
      }

      function showDriverDetails(driverUsername){
      	$scope.Trip_now = true;
		$scope.book_date = new Date();	
		$scope.fetch_cabs(driverUsername);
      }

      function drawDriverPositions(map, carType){
      	console.log('cartype selected ' + carType);
      	var method = 'fetchDriverLocations';
      	var promise = WebService.getDriverLocations(method);
      	var infowindow;
	        promise.then(function (data) {
	        	console.log(data);
	        	//infowindow = new google.maps.InfoWindow();

	        	for(var i = 0; i < data.length; i++){
	        		var driverLatLng = {lat: parseFloat(data[i].latitude), lng: parseFloat(data[i].longitude)};
	        		var image = '';
	        		if(data[i].cartype == carType){
	        			if(data[i].cartype == 'Sedan'){
		        			image = 'img/icons/car-marker.png';
		        		}else if(data[i].cartype == 'Pickup'){
		        			image = 'img/icons/pickup-marker.png';
		        		}else if(data[i].cartype == 'Camion'){
		        			image = 'img/icons/camion-marker.png';
		        		}else if(data[i].cartype == 'Motocicleta'){
		        			image = 'img/icons/moto-marker.png';
		        		}else if(data[i].cartype == 'Taxi'){
		        			image = 'img/icons/taxi-marker.png';
		        		}else if(data[i].cartype == 'Mototaxi'){
		        			image = 'img/icons/mototaxi-marker.png';
		        		}else if(data[i].cartype == 'Camioneta'){
		        			image = 'img/icons/car-marker.png';
		        		}
				      	
				      	var infowindow = new google.maps.InfoWindow({
						    content: data[i].user_name
						});
				      	 var marker = new google.maps.Marker({
						    position: driverLatLng,
						    map: map,
						    title: 'Driver',
						    icon: image

						 });
						 
						google.maps.event.addListener(marker, 'click', (function(marker, i) {
							return function() {
								infowindow.setContent(data[i].user_name);
								infowindow.setOptions({maxWidth: 200});
								infowindow.open(map, marker);
								showDriverDetails(data[i].user_name);
							}
						}) (marker, i));
	        		}
	        	}
	    })
      }



      function drawMapWithPositions(carType) {

        var image = 'img/icons/google_marker.png';
        var styles = landInit.mapStyles();
        // Create a new StyledMapType object, passing it the array of styles,
        // as well as the name to be displayed on the map type control.
       var styledMap = new google.maps.StyledMapType(styles,
			{name: "Styled Map"});

        // Create a map object, and include the MapTypeId to add
        // to the map type control.
        var mapOptions = {
            zoom: 11,
            center: new google.maps.LatLng($rootScope.pickup_lat, $rootScope.pickup_lng),
            disableDefaultUI: true,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
            }
        };


        var map = new google.maps.Map(document.getElementById('map'),mapOptions);
        $scope.map=map;

        directionsDisplay.setMap(map);
        directionsDisplay.setOptions( { suppressMarkers: true } );
        calculateAndDisplayRoute(directionsService, directionsDisplay);
        //  directionsDisplay.setPanel(document.getElementById('right-panel'));


		var contentString = 'frdfdfdfd';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });



        

        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set('map_style', styledMap);
        map.setMapTypeId('map_style');

        var pick_up_mark = new google.maps.Marker({
            position: {
                lat: $rootScope.pickup_lat,
                lng: $rootScope.pickup_lng
            },
            map: map,
            icon: image
        });

        pick_up_mark.addListener('click', function () {
            infowindow.open(map, pick_up_mark);
        });

        var drop_mark = new google.maps.Marker({
            position: {
                lat: $rootScope.drop_lat,
                lng: $rootScope.drop_lng
            },
            map: map,
            icon: image
        });

        setTimeout(drawDriverPositions(map, carType), 3000);
    }


     function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var selectedMode = "DRIVING";

        directionsService.route({
            origin: {
                lat: $rootScope.pickup_lat,
                lng: $rootScope.pickup_lng
            }, // Haight.
            destination: {
                lat: $rootScope.drop_lat,
                lng: $rootScope.drop_lng
            }, 
            travelMode: google.maps.TravelMode[selectedMode]
        }, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);

            } else {
                alert('Directions request failed due to ' + status);
            }
        });
    }


	 
	 
	 /* Function For Get place from LatLng
	 ==================================================*/
	 function codeLatLng(lat, lng) {
		    $scope.loading = $ionicLoading.show({
          content: 'Getting current location...',
          showBackdrop: false
        });
		geocoder = new google.maps.Geocoder();
		
		var latlng = new google.maps.LatLng(lat, lng);
		geocoder.geocode({'latLng': latlng}, function(results, status) {
		  if (status == google.maps.GeocoderStatus.OK) {
		  // console.log(results)
			if (results[1]) {
			
				$scope.$apply(function(){
					$scope.Location = results[0].formatted_address ;
					$scope.start_box.location = results[0].formatted_address ;
				});
				
				$scope.start_box_copy = angular.copy( $scope.start_box );
				$scope.current_box = angular.copy( $scope.start_box );
				
			} else {
			  //alert("No results found");
			  // $scope.Location = "You are here";
			  
			}
		  } else {
			  // $scope.Location = "You are here";
			  
			//alert("Geocoder failed due to: " + status);
		  }
		});
	  }

	function onResume() {
	    cordova.plugins.diagnostic.isLocationEnabled(function(enabled) {
	    	//getCurrentLocation();
	    }, function(error) {});
	}
	document.addEventListener("resume", onResume, false);
	 
	 $scope.getCurrentLocation = function() {
	 	if (window.cordova) {
  			cordova.plugins.diagnostic.isGpsLocationEnabled(
                function(e) {
                    if (e){
                      console.log(e);
                    }   
                    else {
                      alert("Por favor enciende tu GPS");
                      cordova.plugins.diagnostic.switchToLocationSettings();
                    }
                },
                function(e) {
                    alert('Error ' + e);
                }
            );
        }

        if(!$scope.map) {
          return;
        }

        
		/**/
		var contentString = "<div style='width: 200px'><a  ng-click='clickTest()'>{{Location}}</a></div>";
        var compiled = $compile(contentString)($scope);

		var image = 'img/icons/google_marker.png';
			
        $scope.infowindow = new google.maps.InfoWindow({
          content: compiled[0]
        });
		
		/**/
        navigator.geolocation.getCurrentPosition(function(pos) {
			//console.log(pos);
			
			//alert(JSON.stringify(pos));
			if(pos == null){
				alert("No se encontró su ubicación, active el GPS");
				return;
			}
		   var myLatlng	= new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
			
			$scope.start_box.lat = pos.coords.latitude;
			$scope.start_box.lng = pos.coords.longitude;
			
			codeLatLng( pos.coords.latitude, pos.coords.longitude );
			
			var marker = new google.maps.Marker({
			  position: myLatlng,
			  map: $scope.map,
			  title: '',
			  icon: image
			});		
			
			$scope.infowindow.open($scope.map,marker);
			
			google.maps.event.addListener(marker, 'click', function() {
				$scope.infowindow.open($scope.map,marker);
			}); 
			
			
			
            $scope.map.setCenter(myLatlng);
            $ionicLoading.hide();
        }, function(error) {
          alert('Unable to get location: ' + error.message);
        });
      };


      

         var drawCoordinates = function (pick_up, drop, carType) {
	       // alert(pick_up);

	        $rootScope.pickup_loc = pick_up;
	        $rootScope.drop_loc = drop;

	        var pickup_location = 'https://maps.googleapis.com/maps/api/geocode/json?address=' + pick_up + '&key=' + map_api_key;
	        var drop_location = 'https://maps.googleapis.com/maps/api/geocode/json?address=' + drop + '&key=' + map_api_key;


	        var pickup_lat;
	        var pickup_lng;
	        var drop_lat;
	        var drop_lng;

	        var promise_pickup = WebService.get_google_lat_lng(pickup_location);
	       
	        promise_pickup.then(function (data) {
	        			console.log("pickup");
	        			console.log(data);
	                   $rootScope.pickup_lat=0;
	                    $rootScope.pickup_lng=0;
	            var pick_up_lat_lng = data.results[0].geometry.location;
	            $rootScope.pickup_lat = pick_up_lat_lng.lat;
	            $rootScope.pickup_lng = pick_up_lat_lng.lng;

	            //After get the pickup values get drop values
	            var promise_drop = WebService.get_google_lat_lng(drop_location);
	     
		        promise_drop.then(function (data) {
		        	console.log("drop");
		        	console.log(data);
		            $rootScope.drop_lat=0;
		            $rootScope.drop_lng=0;
		            var drop_lat_lng = data.results[0].geometry.location;
		            $rootScope.drop_lat = drop_lat_lng.lat;
		            $rootScope.drop_lng = drop_lat_lng.lng; 
		            drawMapWithPositions(carType);
		        });
	        });

	        

	    }

      //google.maps.event.addDomListener(window, 'load', initialize);
	  
	  /* Auto comlplete boxes
	  =====================================*/
	 function setAutocompleteBoxes( data ) {
		 var options = {
			// componentRestrictions: {country: "in"}
				componentRestrictions: {country: data.country}
      };
		 var from_el = document.getElementById('autocompletefrom') ;
		
		 var places = new google.maps.places.Autocomplete(from_el,options);
            google.maps.event.addListener(places, 'place_changed', function () {
              var place = places.getPlace();
              $scope.$apply(function(){  
								$scope.start_box.location = place.formatted_address;
                $scope.start_box.lat = place.geometry.location.lat();
								$scope.start_box.lng = place.geometry.location.lng();
							});
							
							$scope.start_box_copy = angular.copy( $scope.start_box );
						
			});  
			
		var to_el = document.getElementById('autocompleteto') ;
		
		 var Tplaces = new google.maps.places.Autocomplete(to_el,options);
            google.maps.event.addListener(Tplaces, 'place_changed', function () {
                
								var Tplace = Tplaces.getPlace();
								$scope.$apply(function(){
									$scope.end_box.location = Tplace.formatted_address;
									$scope.end_box.lat = Tplace.geometry.location.lat();
									$scope.end_box.lng = Tplace.geometry.location.lng();
									drawCoordinates($scope.start_box.location, $scope.end_box.location, $scope.start_box.cartype);
								})      
								
								$scope.end_box_copy = angular.copy( $scope.end_box );
								
            });  
			
			
	 }
	  
	  var directionsService = new google.maps.DirectionsService();

		function calcRoute(	) {
			// var start = document.getElementById("start").value;
			// var end = document.getElementById("end").value;
			
			var deferred = $q.defer();
			
			
			var request = {
				origin: new google.maps.LatLng( $scope.start_box.lat, $scope.start_box.lng),
				destination: new google.maps.LatLng( $scope.end_box.lat, $scope.end_box.lng),
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			};
			
			directionsService.route(request, function(response, status) {
				if (status == google.maps.DirectionsStatus.OK) {
					//directionsDisplay.setDirections(response);
					$scope.trip_distance = response.routes[0].legs[0].distance.value / 1000;
					 
					$scope.trip_distance = round_num($scope.trip_distance);
   				
					deferred.resolve( $scope.trip_distance );		
				
					
				}
			});
			return deferred.promise;
		}  

	 
       	// 
		function round_num(num){
			return Math.ceil(num * 10) / 10;
		}
	  function animate_tab(){
				$('#tab-hide').addClass('hidden');
				
				$timeout(function (){
					$('#tab-hide').removeClass('hidden');
				}, 300);
		 }	
/* ##################################################################################  */
	
	 //$scope.user_data = user_data;	 
	 
	 
	 // alert( $scope.user_data.Name )
	 $scope.Location= 'You are here';
	 $scope.start_box = { 'location' : null, 'lat': null, 'lng' : null };
	 $scope.end_box = {  'location' : null, 'lat': null, 'lng' : null };
	 $scope.start_box_copy, $scope.end_box_copy ,current_box = {}
	 
	 $scope.my_model;
	 $scope.pop_status =  false;
	 
	 /* STARTING Point
	 ================================================================*/
	 if( $scope.init_status === undefined ){
			
			set_map();	

			ionic.Platform.ready(function(){
			   $scope.getCurrentLocation();
			});
				
					
				 var link = 'settings';
				 var post_data = {  
									//'user_name' : "Point to Point Transfer" ,
								  
								 }
				
				 WebService.show_loading();	
				 
				 var promise = WebService.send_data( link,post_data);
				 
				 promise.then(function(data){  
					 //alert(JSON.stringify(data,null,4));
						setAutocompleteBoxes(data); 
						
				 });
		}
   
  	$scope.$on( "$ionicView.enter", function( scopes, states ) {
			 google.maps.event.trigger( $scope.map, 'resize' );
		});  
	 
	 function animateMyPop () {
		  $('#my-pop').toggleClass('my-active');
			$scope.pop_status = !$scope.pop_status;
			$scope.Trip_Date = null;
	  }
	  
		/* RIDE NOW 
		======================================*/
	  $scope.ride = function(time){
			
			
			if(  $scope.start_box.lat == null ){
				var alertPopup = $ionicPopup.alert({
					 title: '<p class="text-center color-yellow">'+$filter('langTranslate')("FAILED",$rootScope.appConvertedLang['FAILED'])+'</p>',
					 template: '<p class="text-center color-gery">'+$filter('langTranslate')("Enter pickup location",$rootScope.appConvertedLang['Enter_pickup_location'])+'</p>'
				 });
				 alertPopup.then(function(res) {
					 console.log('');
				 });
			}else if($scope.end_box.lat == null){
				 alertPopup = $ionicPopup.alert({
					 title: '<p class="text-center color-yellow">'+$filter('langTranslate')("FAILED",$rootScope.appConvertedLang['FAILED'])+'</p>',
					 template: '<p class="text-center color-gery">'+$filter('langTranslate')("Enter Drop location",$rootScope.appConvertedLang['Enter_Drop_location'])+'</p>'
				 });
				 alertPopup.then(function(res) {
					 
				 });
			}else{
				
				//$scope.infowindow.close();
				angular.copy( $scope.start_box_copy, $scope.start_box );
				angular.copy( $scope.end_box_copy, $scope.end_box );
				
				
				if( time == 'later' ){ 
						$scope.Trip_now = false; 
						$scope.past_date = false;
						//$scope.book_date = $scope.Trip_Date;
						$scope.date_data = {};
						//if(appConvertedLang['Enter_date_and_time']!='')
						min_date = new Date().toISOString();
						var myPopup = $ionicPopup.show({
							template: '<input   class="color-yellow" placeholder="Date:" style=" background-color: #3e3e3e; padding-left:20px;width:100%; line-Height: 20px" ng-model="date_data.Trip_Date" min='+min_date+' type="datetime-local">'+
												'<div class="error  text-center" ng-show="past_date==true">Invalid Date and Time </div>',
							title: '<p class="color-yellow">'+$filter('langTranslate')("Enter date and time",$rootScope.appConvertedLang['Enter_date_and_time'])+'</p>',
							scope: $scope,
							buttons: [
								{ text: $filter('langTranslate')("Cancel",$rootScope.appConvertedLang['Cancel']), 
									onTap: function(e) {
										return false;
									}
								},
								{
									text: $filter('langTranslate')("Save",$rootScope.appConvertedLang['Save']),
								  onTap: function(e) {
									  //alert($scope.date_data.Trip_Date);
										if ($scope.date_data.Trip_Date == null) {
											//don't allow the user to close unless he enters wifi password
											$scope.past_date = true;
											e.preventDefault();
										} else {
											
											return $scope.date_data.Trip_Date;
										}
									}
								}
							]
						});
						
						myPopup.then(function(res) {
							if(res != false){
								$scope.book_date = res;
								$scope.fetch_cabs();	
							}
							
						});
						
				}else{ 
							$scope.Trip_now = true;
							$scope.book_date = new Date();	
							$scope.fetch_cabs(); 
				}
				 
			}
		 
	  };
	  
		$scope.cancel = function(){ animateMyPop(); }
		
		$scope.fetch_cabs = function(driverUsername){
			 
				 /* LOAD CAB DETAILS
				 =================================*/
				 
				 var link = 'fetch_cab_details';
				 var post_data = {  
								   "transfertype" : "Point to Point Transfer" ,
								  "book_date"    : $scope.book_date ,
								  "driver_username" : driverUsername
								 }
				
				 WebService.show_loading();	
				 
				 var promise = WebService.send_data( link,post_data);
				 
				 promise.then(function(data){  
					 console.log(data);
					 $ionicLoading.hide();
					 //alert(JSON.stringify(data,null,4));
					 
					 if( data.cabs.length == 0 ){
						alert('no cabs');
					 }else{
						 
							$scope.cabs = data.cabs;
							$scope.active_cab = 0;
						  $scope.selected_cab = $scope.cabs[0];
							
							
							/* FIND DISTANCE 
							==============================*/
							
							var dist_promise =  calcRoute();
							
							dist_promise.then(function(dist){  
							  //animateMyPop();
							  $('#my-pop').addClass('my-active');
							  $scope.pop_status = true;
							});
							
							
					 }
				 });
					
		}
		
		$scope.book = function(){
			
			$rootScope.user_data = JSON.parse( localStorage.getItem('user_data') );			
			
			var link = 'book_cab';
			var post_data = {  
							'user_name'    : $rootScope.user_data.User_name,
							'token'   		 : $rootScope.user_data.token,
							'transfertype' : "Point to Point Transfer" ,
							'book_date'    : $scope.book_date ,
							'pickup_area'  : $scope.start_box.location,
							'drop_area'    : $scope.end_box.location,
							'car_type'    : $scope.selected_cab.cartype,
							'driver_user'  : $scope.selected_cab.user_name,
							'km'					 : $scope.trip_distance
						 }
	
			WebService.show_loading();	

			var promise = WebService.send_data( link,post_data);

			promise.then(function(data){  
			 
				$ionicLoading.hide();
				if( data.status = 'success'){
					alertPopup = $ionicPopup.alert({
						title: '<p class="text-center color-yellow">Tu solicitud ha sido registrada con éxito</p>',
						template: '<p class="text-center color-gery">Recorreras ' + $scope.trip_distance + ' KM</p>'
					});
					animateMyPop();
				}else{
					alertPopup = $ionicPopup.alert({
						title: '<p class="text-center color-yellow">'+$filter('langTranslate')("FAILED",$rootScope.appConvertedLang['FAILED'])+'</p>',
						template: '<p class="text-center color-gery">'+$filter('langTranslate')("Process Failed!",$rootScope.appConvertedLang['Process_Failed'])+'</p>'+
											'<p class="text-center color-gery">Try again! </p>'
					});
				}
			});
		}
		
   
      	
	
  
				
     $scope.clicked_item = function(index){
			 // $window.alert(item); 
			 $scope.active_cab = index;
			 animate_tab();
			 $scope.selected_cab = $scope.cabs[index];
			 
		 }
	   
		$scope.disableTapTo = function(){
			container = document.getElementsByClassName('pac-container');
			// disable ionic data tab
			angular.element(container).attr('data-tap-disabled', 'true');
			// leave input field if google-address-entry is selected
			angular.element(container).on("click", function(){
					document.getElementById('autocompleteto').blur();
			});
		}
		
  	$scope.disableTapFrom = function(){
			container = document.getElementsByClassName('pac-container');
			// disable ionic data tab
			angular.element(container).attr('data-tap-disabled', 'true');
			// leave input field if google-address-entry is selected
			angular.element(container).on("click", function(){
					document.getElementById('autocompletefrom').blur();
			});
		}
  	
});

App.service('serv', function($rootScope) {
  
    this.set_trip_tab = function(){
		  
			$rootScope.myTrip_menu_selected = 0;
			
		};

  
});