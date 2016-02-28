/**
 * Created by Taywan_ka on 25/02/2016.
 */
app.factory("RailtypeFactory", ['$resource', function ($resource) {
    return $resource("api/railtypes/:id/", {id: '@ID'}, {
        update: {
            method: 'PUT'
        }
    });
}]);

app.service('RailtypeService', ['RailtypeFactory', '$rootScope', '$q', '$timeout', 'ngToast', function (RailtypeFactory, $rootScope, $q, $timeout, ngToast) {

    var self = {
        'page': 1,
        'hasMore': true,
        'isLoading': false,
        'isSaving': false,
        'selectedRailType': null,
        'list': [],
        'search': null,
        'ordering': 'ID',
        'getRailType': function (id) {
            for (var i = 0; i < self.list.length; i++) {
                var obj = self.list[i];
                if (parseInt(obj.ID) == id)
                    return obj;
            }
        },
        'doSearch': function () {
            self.hasMore = true;
            self.page = 1;
            self.list = [];
            self.loadRailtypes();
        },
        'doOrder': function () {
            self.hasMore = true;
            self.page = 1;
            self.list = [];
            self.loadRailtypes();
        },
        'loadRailtypes': function () {
            if (self.hasMore && !self.isLoading) {
                self.isLoading = true;

                var params = {
                    'page': self.page,
                    'search': self.search,
                    'ordering': self.ordering
                };

                RailtypeFactory.get(params, function (data) {
                    angular.forEach(data.results, function (item) {
                        self.list.push(new RailtypeFactory(item));
                    });

                    if (!data.next)
                        self.hasMore = false;

                    self.isLoading = false;
                });
            }
        },
        'loadMore': function () {
            if (self.hasMore && !self.isLoading) {
                self.page += 1;
                self.loadRailtypes();
            }
        },
        'getRailTypeById': function (_id) {
            var params = {
                'id': _id
            };
            RailtypeFactory.get(params, function (data) {
                self.selectedRailType = new RailtypeFactory(data);
            });
        },
        'createRailType': function (railtypeItem) {
            var d = $q.defer();
            self.isSaving = true;
            RailtypeFactory.save(railtypeItem).$promise.then(function () {
                self.isSaving = false;
                self.selectedRailType = null;
                self.hasMore = true;
                self.page = 1;
                self.list = [];
                self.doSearch();
                ngToast.success({
                    content: 'ทำรายการสำเร็จ'
                });
                d.resolve();
            }, function (error) {
                ngToast.error({
                    content: error.message
                });
                d.resolve();
            });
            return d.promise;
        },
        'updateRailType': function (railtypeItem) {
            var d = $q.defer();
            self.isSaving = true;
            railtypeItem.$update()
                .then(function (data) {
                    self.isSaving = false;
                    ngToast.success({
                        content: 'อัพเดทรายการสำเร็จ'
                    });
                    self.doSearch();
                    d.resolve();
                }, function (error) {
                    ngToast.error({
                        content: error.message
                    });
                    d.resolve();
                });
            return d.promise;
        },
        'removeRailType': function (railtypeItem) {
            console.log(railtypeItem);
            var d = $q.defer();
            self.isDeleting = true;
            railtypeItem.$remove().then(function () {
                ngToast.success({
                    content: 'ลบรายการสำเร็จ'
                });
                self.isDeleting = false;
                var index = self.list.indexOf(railtypeItem);
                self.list.splice(index, 1);
                self.selectedRailType = null;
                d.resolve()
            }, function (error) {
                ngToast.error({
                    content: error.message
                });
                d.resolve();
            });
            return d.promise;
        }
    };

    self.loadRailtypes();

    return self;

}]);