App.controller('settingsCtrl', function ($scope, $rootScope, $ionicModal, $timeout, $state, $ionicLoading, $ionicPopup, WebService, $ionicHistory, $filter) {
  
    $ionicHistory.nextViewOptions({
        disableBack: true
    });
    $scope.signUp = {};

    $scope.get_current_car_type = function(){
        var link = 'get_driver_car_type';

            var post_data = {
                'username': $rootScope.user_data.User_name
            }
            
            WebService.show_loading();
            var promise = WebService.send_data(link, post_data);

            promise.then(function (data) {
                console.log(data);
                $ionicLoading.hide();
                $scope.signUp.car_type = data.cab_type_id;
            });
    }

    $scope.update_car_type = function(){
        var link = 'update_driver_car_type';

            var post_data = {
                'username': $rootScope.user_data.User_name,
                'cab_type_id': $scope.signUp.car_type
            }
            console.log(post_data);
            WebService.show_loading();
            var promise = WebService.send_data(link, post_data);

            promise.then(function (data) {
                $ionicLoading.hide();
                if (data.status == 'success') {

                    $ionicPopup.alert({
                        title: '<p class="text-center color-yellow">Exito</p>',

                        template: "<p class='text-center color-gery'>Tipo de vehículo actualizado a " + data.cartype + "</p>",
                        scope: $scope
                    });
                    
                }
                if (data.status == 'fail') {
                    $ionicPopup.alert({
                        title: '<p class="text-center color-yellow">Error</p>',

                        template: "<p class='text-center color-gery'>Ocurrió una falla en la comunicación con el servidor, por favor intente más tarde.</p>",
                        scope: $scope
                    });
                }
            });

    }

    $scope.do_update = function (form) {

        if (
            form.$valid && $scope.signUp.pwd == $scope.signUp.c_pwd

        ) {

            var link = 'update_driver_pwd';

            var post_data = {
                'username': $rootScope.user_data.User_name,
                'Password': $scope.signUp.pwd,
                'old_pass': $scope.signUp.old_pwd,
                'car_type': $scope.signUp.car_type
            }

            WebService.show_loading();

            var promise = WebService.send_data(link, post_data);

            promise.then(function (data) {

                $ionicLoading.hide();

                form.$setPristine();
                $scope.signUp.pwd = '';
                $scope.signUp.old_pwd = '';

                if (data.status == 'success') {

                    $ionicPopup.alert({
                        title: '<p class="text-center color-yellow">Exito</p>',

                        template: "<p class='text-center color-gery'>La contraseña se actualizo correctamente</p>",
                        scope: $scope
                    });
                }
                if (data.status == 'fail') {
                    $ionicPopup.alert({
                        title: '<p class="text-center color-yellow">Error</p>',

                        template: "<p class='text-center color-gery'>La contraseña actual registrada no coincide con la del sistema.</p>",
                        scope: $scope
                    });
                }

            })
        } else {

            form.pwd.$setDirty();
        }
    }

    $scope.get_current_car_type();
})