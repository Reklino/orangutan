angular.module('sortable', []);
angular.module('sortable').factory('sortable', ['$filter', function($filter){

  return function (scope, data, itemsPerPage, initSortingOrder) {
    scope.sortingOrder = initSortingOrder;
      scope.reverse = true;
      scope.filteredItems = [];
      scope.groupedItems = [];
      scope.itemsPerPage = itemsPerPage;
      scope.pagedItems = [];
      scope.currentPage = 0;
    scope.items = data;

    var searchMatch = function (haystack, needle) {
          if (!needle) {
              return true;
          }
          return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;
      };


      // init the filtered items
      scope.search = function () {

          scope.filteredItems = $filter('filter')(scope.items, scope.query);

          // take care of the sorting order
        if (scope.sortingOrder !== '') {
            scope.filteredItems = $filter('orderBy')(scope.filteredItems, scope.sortingOrder, scope.reverse);
        }

          scope.currentPage = 0;

          // now group by pages
          scope.groupToPages();
      };
      

      // calculate page in place
      scope.groupToPages = function () {
          scope.pagedItems = [];
          
          for (var i = 0; i < scope.filteredItems.length; i++) {
              if (i % scope.itemsPerPage === 0) {
                  scope.pagedItems[Math.floor(i / scope.itemsPerPage)] = [ scope.filteredItems[i] ];
              } else {
                  scope.pagedItems[Math.floor(i / scope.itemsPerPage)].push(scope.filteredItems[i]);
              }
          }
      };
      

      scope.range = function (start, end) {
          var ret = [];
          if (!end) {
              end = start;
              start = 0;
          }
          for (var i = start; i < end; i++) {
              ret.push(i);
          }
          return ret;
      };
      
      scope.prevPage = function () {
          if (scope.currentPage > 0) {
              scope.currentPage--;
          }
      };
      
      scope.nextPage = function () {
          if (scope.currentPage < scope.pagedItems.length - 1) {
              scope.currentPage++;
          }
      };
      
      scope.setPage = function () {
          scope.currentPage = this.n;
      };


      // functions have been described process the data for display
      scope.search();


      // change sorting order
      scope.sort_by = function(newSortingOrder) {
          if (scope.sortingOrder == newSortingOrder)
              scope.reverse = !scope.reverse;

          scope.sortingOrder = newSortingOrder;

          // icon setup
          $('.thead li i').each(function(){
              // icon reset
              $(this).removeClass();
          });
          if (scope.reverse)
              $('.thead li.'+newSortingOrder+' i').removeClass().addClass('fa fa-chevron-down');
          else
              $('.thead li.'+newSortingOrder+' i').removeClass().addClass('fa fa-chevron-up');

          // call search again to make sort affect whole query
          scope.search();
      };

      scope.sort_by(initSortingOrder);
  }

}]);