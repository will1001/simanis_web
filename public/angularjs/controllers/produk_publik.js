angular.module('myApp.controllers')
    .controller('ProdukPublikCtrl', ['$http', '$scope', '$window',
        function ($http, $scope, $window) {
            $scope.kabupatenArray = [
                { 'id': '-', 'name': 'Semua' }
            ];

            $scope.kecamatanArray = [
                { 'id': '-', 'name': 'Semua' }
            ];
            $scope.desaArray = [
                { 'id': '-', 'name': 'Semua' }
            ];

            $scope.filterData = {
                id_kabupaten: '-',
                id_kecamatan: '-',
                id_kelurahan: '-'
            };

            if ($window.badanUsaha != null) {
                $scope.filterData.id_kabupaten = $window.badanUsaha.id_kabupaten;
                $scope.filterData.id_kecamatan = $window.badanUsaha.id_kecamatan;
                $scope.filterData.id_kelurahan = $window.badanUsaha.id_kelurahan;
                $scope.kabupatenArray = $window.kabupaten;
                $scope.kecamatanArray = $window.kecamatan;
                $scope.desaArray = $window.desa;
            }

            $scope.getKecamatan = function () {
                $http({
                    url: '/api/kabupaten/' + $scope.filterData.id_kabupaten + '/kecamatan',
                    method: 'GET'
                }).then(function (data) {
                    $scope.kecamatanArray = [{ 'id': '-', 'name': 'Semua' }];
                    $scope.kecamatanArray = $scope.kecamatanArray.concat(data.data);
                    $scope.desaArray = [{ 'id': '-', 'name': 'Semua' }];
                    $scope.filterData.id_kelurahan = $scope.desaArray[0].id;
                    $scope.filterData.id_kecamatan = $scope.kecamatanArray[0].id;
                });
            }

            $scope.getDesa = function () {
                $scope.desaArray = [{ 'id': '-', 'name': 'Semua' }];
                if ($scope.filterData.id_kecamatan == '-') {
                    $scope.filterData.id_kelurahan = '-';
                } else {
                    $http({
                        url: '/api/kecamatan/' + $scope.filterData.id_kecamatan + '/kelurahan',
                        method: 'GET'
                    }).then(function (data) {
                        $scope.desaArray = $scope.desaArray.concat(data.data);
                        $scope.filterData.id_kelurahan = $scope.desaArray[0].id;
                    });
                }
            }

        }]);
