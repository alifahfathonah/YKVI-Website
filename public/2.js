(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./Modules/Core/Resources/js/components/TableComponent.vue":
/*!*****************************************************************!*\
  !*** ./Modules/Core/Resources/js/components/TableComponent.vue ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _TableComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TableComponent.vue?vue&type=script&lang=js& */ "./Modules/Core/Resources/js/components/TableComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _TableComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "Modules/Core/Resources/js/components/TableComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./Modules/Core/Resources/js/components/TableComponent.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./Modules/Core/Resources/js/components/TableComponent.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TableComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./TableComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./Modules/Core/Resources/js/components/TableComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TableComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./Modules/Core/Resources/js/components/TableComponent.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./Modules/Core/Resources/js/components/TableComponent.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var call;
/* harmony default export */ __webpack_exports__["default"] = ({
  props: {
    uri: {
      type: String,
      required: true
    },
    headers: {
      type: Array,
      required: true
    },
    noDataText: {
      type: String,
      "default": "No data found."
    },
    noResultsText: {
      type: String,
      "default": "No data found."
    },
    searchText: {
      type: String,
      "default": "Search"
    },
    searchIcon: {
      type: String,
      "default": "mdi-magnify"
    },
    refreshText: {
      type: String,
      "default": "Reload"
    },
    refreshIcon: {
      type: String,
      "default": "mdi-sync"
    },
    addNewText: {
      type: String,
      "default": "Add New"
    },
    addNewIcon: {
      type: String,
      "default": "mdi-plus"
    },
    addNewUri: {
      type: String,
      "default": ""
    },
    addNewColor: {
      type: String,
      "default": "info"
    },
    itemsPerPageAllText: {
      type: String,
      "default": "All"
    },
    itemsPerPageText: {
      type: String,
      "default": "Rows per page:"
    },
    pageTextLocale: {
      type: String,
      "default": "en"
    },
    detailUri: {
      type: String,
      "default": ""
    },
    detailUriParameter: {
      type: String,
      "default": ""
    },
    detailText: {
      type: String,
      "default": "Detail"
    },
    detailIcon: {
      type: String,
      "default": "mdi-eye"
    },
    detailColor: {
      type: String,
      "default": "primary"
    },
    editUri: {
      type: String,
      "default": ""
    },
    editUriParameter: {
      type: String,
      "default": ""
    },
    editText: {
      type: String,
      "default": "Edit"
    },
    editIcon: {
      type: String,
      "default": "mdi-pencil"
    },
    editColor: {
      type: String,
      "default": "primary"
    },
    deleteUri: {
      type: String,
      "default": ""
    },
    deleteUriParameter: {
      type: String,
      "default": ""
    },
    deleteText: {
      type: String,
      "default": "Delete"
    },
    deleteIcon: {
      type: String,
      "default": "mdi-trash-can-outline"
    },
    deleteColor: {
      type: String,
      "default": "red lighten-1"
    },
    deleteConfirmationText: {
      type: String,
      "default": "Are you sure want to delete this data ?"
    },
    deleteCancelText: {
      type: String,
      "default": "Cancel"
    },
    tableNumber: {
      type: Boolean,
      "default": function _default() {
        return false;
      }
    },
    withActions: {
      type: Boolean,
      "default": function _default() {
        return false;
      }
    }
  },
  data: function data() {
    return {
      prompt_delete: false,
      search: '',
      total_data: 0,
      from_data: 0,
      to_data: 0,
      table_headers: [],
      table_items: [],
      loading: true,
      options: {},
      selected: null,
      delete_loader: false,
      table_alert: false,
      table_alert_text: '',
      table_alert_state: 'info'
    };
  },
  watch: {
    options: {
      handler: function handler() {
        this.dataHandler();
      },
      deep: true
    }
  },
  mounted: function mounted() {
    this.dataHandler();
  },
  computed: {
    query: function query() {
      return '?page=' + this.options.page + '&search=' + this.search + '&paginate=' + this.options.itemsPerPage;
    }
  },
  methods: {
    dataHandler: function dataHandler() {
      if (this.tableNumber) {
        var table_index = [{
          "text": '#',
          "align": 'center',
          "sortable": false,
          "value": 'table_index'
        }];
        this.table_headers = _.concat(table_index, this.headers);
      } else {
        this.table_headers = this.headers;
      }

      if (this.withActions) {
        var table_actions = [{
          "text": 'Aksi',
          "align": 'center',
          "sortable": false,
          "value": 'actions'
        }];
        this.table_headers = _.concat(this.table_headers, table_actions);
      }

      setTimeout(this.getData(), 2000);
    },
    getData: function getData() {
      var _this = this;

      this.loading = true;

      if (call) {
        call.cancel();
      }

      call = axios.CancelToken.source();
      axios.get(this.uri + this.query, {
        cancelToken: call.token
      }).then(function (response) {
        _this.setData(response.data.data.data);

        _this.total_data = response.data.data.total;
        _this.from_data = response.data.data.from;
        _this.to_data = response.data.data.to;
        _this.loading = false;
      })["catch"](function (error) {
        _this.loading = false;
      });
    },
    setData: function setData(data) {
      var items = [];

      _.forEach(data, function (value, key) {
        value.table_index = parseInt(key) + 1;
        items.push(value);
      });

      this.table_items = items;
    },
    promptDeleteItem: function promptDeleteItem(item) {
      this.prompt_delete = true;
      this.selected = item;
    },
    deleteItem: function deleteItem() {
      var _this2 = this;

      this.delete_loader = true;
      axios["delete"](this.ziggy(this.deleteUri, [this.selected[this.deleteUriParameter]]).url()).then(function (response) {
        if (response.data.success) {
          _this2.table_alert = true;
          _this2.table_alert_state = 'success';
          _this2.table_alert_text = response.data.message;

          _this2.dataHandler();
        } else {
          _this2.table_alert = true;
          _this2.table_alert_state = 'error';
          _this2.table_alert_text = response.data.message;
        }

        _this2.delete_loader = false;
        _this2.prompt_delete = false;
      })["catch"](function (error) {
        _this2.table_alert = true;
        _this2.table_alert_state = 'error';
        _this2.table_alert_text = 'Oops, something went wrong. Please try again later.';
        _this2.delete_loader = false;
        _this2.prompt_delete = false;
      });
    }
  }
});

/***/ })

}]);