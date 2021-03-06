/**
 * Created by Taywan_ka on 25/02/2016.
 */
app.factory("BogieFactory", ['$resource', function ($resource) {
    return $resource("api/bogies/:id/", {id: '@ID'}, {
        update: {
            method: 'PUT'
        }
    });
}]);

app.service('BogieService', ['BogieFactory', '$rootScope', '$q', '$timeout', 'ngToast', function (BogieFactory, $rootScope, $q, $timeout, ngToast) {

    var self = {
        'page': 1,
        'hasMore': true,
        'isLoading': false,
        'isSaving': false,
        'selectedBogie': null,
        'bogieListOfRailType': [],
        'list': [],
        'search': null,
        'ordering': 'ID',
        'getBogie': function (id) {
            console.log(id);
            for (var i = 0; i < self.list.length; i++) {
                var obj = self.list[i];
                if (parseInt(obj.ID) == id) {
                    return obj;
                }
            }
        },
        'doSearch': function () {
            self.hasMore = true;
            self.page = 1;
            self.list = [];
            self.loadBogies();
        },
        'doOrder': function () {
            self.hasMore = true;
            self.page = 1;
            self.list = [];
            self.loadBogies();
        },
        'loadBogies': function () {
            if (self.hasMore && !self.isLoading) {
                self.isLoading = true;

                var params = {
                    'page': self.page,
                    'search': self.search,
                    'ordering': self.ordering
                };

                BogieFactory.get(params, function (data) {
                    console.log(data);
                    angular.forEach(data.results, function (bogie) {
                        self.list.push(new BogieFactory(bogie));
                    });

                    if (!data.next) {
                        self.hasMore = false;
                    }
                    self.isLoading = false;
                });
            }
        },
        'loadMore': function () {
            if (self.hasMore && !self.isLoading) {
                self.page += 1;
                self.loadBogies();
            }
        },
        'getBogieById': function(_id){
            var params = {
                'id' : _id
            };
            BogieFactory.get(params, function(data){
                self.selectedBogie = new BogieFactory(data);
            });
        },
        'getBogiesByRailTypeId':function(id, isAllBogie, isWithSelected){
            var params = {
                'id' : id,
                'withselected': (isWithSelected == true ? 'Y' : 'N'),
                'allbogie': (isAllBogie == true ? 'Y' : 'N')
            };
            BogieFactory.get(params, function(data){
                self.bogieListOfRailType = data.results;
            });
        },
        'createBogie': function (bogieItem) {
            var d = $q.defer();
            self.isSaving = true;
            BogieFactory.save(bogieItem).$promise.then(function () {
                self.isSaving = false;
                self.selectedBogie = null;
                self.hasMore = true;
                self.page = 1;
                self.list = [];
                self.doSearch();
                ngToast.success({
                    content: 'ทำรายการสำเร็จ'
                });
                d.resolve();
            }, function(error){
                ngToast.error({
                    content: error.message
                });
                d.resolve();
            });
            return d.promise;
        },
        'updateBogie': function (bogieItem) {
            var d = $q.defer();
            self.isSaving = true;
            bogieItem.$update()
                .then(function (data) {
                    self.isSaving = false;
                    ngToast.success({
                        content: 'อัพเดทรายการสำเร็จ'
                    });
                    self.doSearch();
                    d.resolve();
                }, function(error){
                    ngToast.error({
                        content: error.message
                    });
                    d.resolve();
                });
            return d.promise;
        },
        'removeBogie': function (bogieItem) {
            console.log(bogieItem);
            var d = $q.defer();
            self.isDeleting = true;
            bogieItem.$remove().then(function () {
                ngToast.success({
                    content: 'ลบรายการสำเร็จ'
                });
                self.isDeleting = false;
                var index = self.list.indexOf(bogieItem);
                self.list.splice(index, 1);
                self.selectedBogie = null;
                d.resolve()
            }, function(error){
                ngToast.error({
                    content: error.message
                });
                d.resolve();
            });
            return d.promise;
        },
        'watchFilters': function () {
            $rootScope.$watch(function () {
                return self.search;
            }, function (newVal) {
                if (angular.isDefined(newVal)) {
                    self.doSearch();
                }
            });

            $rootScope.$watch(function () {
                return self.ordering;
            }, function (newVal) {
                if (angular.isDefined(newVal)) {
                    self.doOrder();
                }
            });
        }
    };

    self.loadBogies();
    self.watchFilters();

    return self;

}]);