/**
 * Created by Taywan_ka on 25/02/2016.
 */
app.factory("BogieFactory", function ($resource) {
    return $resource("api/bogies/:id/", {id: '@ID'}, {
        update: {
            method: 'PUT'
        }
    });
});
app.service('BogieService', function (BogieFactory, $rootScope, $q, toaster, $timeout, notifications) {

    var self = {
        'page': 1,
        'hasMore': true,
        'isLoading': false,
        'isSaving': false,
        'selectedBogie': null,
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
                //toaster.pop('success', 'สร้าง ' + bogieItem.BOGIE_NAME_TH + ' สำเร็จ');
                notifications.showSuccess({message: 'ทำรายการสำเร็จ'});
                d.resolve();
            }, function(error){
                notifications.showError({message: error.message});
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
                    //toaster.pop('success', 'อัพเดทสำเร็จแล้ว');
                    notifications.showSuccess({message: 'อัพเดทรายการสำเร็จ'});
                    self.doSearch();
                    d.resolve();
                }, function(error){
                    notifications.showError({message: error.message});
                    d.resolve();
                });
            return d.promise;
        },
        'removeBogie': function (bogieItem) {
            console.log(bogieItem);
            var d = $q.defer();
            self.isDeleting = true;
            bogieItem.$remove().then(function () {
                //toaster.pop('success', 'ลบ ' + bogieItem.BOGIE_NAME_TH + ' แล้ว');
                notifications.showSuccess({message: 'ลบข้อมูลสำเร็จ'});
                self.isDeleting = false;
                var index = self.list.indexOf(bogieItem);
                self.list.splice(index, 1);
                self.selectedBogie = null;
                d.resolve()
            }, function(error){
                notifications.showError({message: error.message});
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

});