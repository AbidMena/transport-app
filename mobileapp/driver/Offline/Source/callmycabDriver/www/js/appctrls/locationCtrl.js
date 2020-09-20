App.controller('locationCtrl', function($ionicHistory, $scope, $rootScope, $state, WebService, $ionicLoading, $window, $http, $ionicLoading, $timeout) {



    $scope.updateMyLocation = function() {
        getCurrentPosition();
    };


    function getCurrentPosition() {
        if (window.cordova) {
            cordova.plugins.diagnostic.isGpsLocationEnabled(
                function(e) {
                    if (e) {

                    } else {
                        alert("Por favor enciende tu GPS");
                        cordova.plugins.diagnostic.switchToLocationSettings();
                    }
                },
                function(e) {
                    alert('Error ' + e);
                }
            );
        }


        /**/
        navigator.geolocation.getCurrentPosition(function(pos) {

            if (pos == null) {
                alert("No se encontró su ubicación, active el GPS");
                return;
            }
            var myLatlng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);

            $scope.latitude = pos.coords.latitude;
            $scope.longitude = pos.coords.longitude;
            callWebService($rootScope.user_data.Id, $scope.latitude, $scope.longitude);
            initialize($scope.latitude, $scope.longitude);
            $ionicLoading.hide();
        }, function(error) {
            alert('No fue posible encontrar la localización: ' + error.message);
        });
    }

    function callWebService(id, latitude, longitude) {

        var link = 'update_driver_location';

        var post_data = {
            'id': id,
            'latitude': latitude,
            'longitude': longitude
        }
        var promise = WebService.send_data(link, post_data);

        promise.then(function(data) {
            console.log(data);
        });
    }

    function initialize(latitude, longitude) {
        var image = 'img/icons/google_marker.png';
        var styles = WebService.map_style();

        // Create a new StyledMapType object, passing it the array of styles,
        // as well as the name to be displayed on the map type control.
        var styledMap = new google.maps.StyledMapType(styles, {
            name: "Styled Map"
        });

        // Create a map object, and include the MapTypeId to add
        // to the map type control.
        var mapOptions = {
            zoom: 20,
            center: new google.maps.LatLng(latitude, longitude),
            disableDefaultUI: true,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
            }
        };


        var map = new google.maps.Map(document.getElementById('map'),
            mapOptions);
        $scope.map = map;

        var infowindow = new google.maps.InfoWindow({
            content: "Usted está aquí"
        });

        var myLatlng = new google.maps.LatLng(latitude, longitude);

        var marker = new google.maps.Marker({
            position: {
                lat: latitude,
                lng: longitude
            },
            map: map,
            icon: image
        });
        $scope.map.setCenter(myLatlng);
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });

        infowindow.open(map, marker);
    }



    getCurrentPosition();

});