angular.module('myApp', [
  'myApp.controllers',
])
  .run(function ($http) {
    $http.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
  })

  .directive('fileModel', ['$parse', function ($parse) {
    return {
      restrict: 'A',
      link: function (scope, element, attrs) {
        var model = $parse(attrs.fileModel);
        var modelSetter = model.assign;

        element.bind('change', function () {
          scope.$apply(function () {
            modelSetter(scope, element[0].files[0]);
          });
        });
      }
    };
  }])

  .directive('convertToNumber', function () {
    return {
      require: 'ngModel',
      link: function (scope, element, attrs, ngModel) {
        ngModel.$parsers.push(function (val) {
          return val ? parseInt(val, 10) : null;
        });
        ngModel.$formatters.push(function (val) {
          return val ? '' + val : null;
        });
      }
    };
  })

  .directive("repeatEnd", function () {
    return {
      restrict: "A",
      link: function (scope, element, attrs) {
        if (scope.$last) {
          scope.$eval(attrs.repeatEnd);
        }
      }
    };
  });