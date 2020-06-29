(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["dist/scripts/routes/common"],{

/***/ "./assets/scripts/lib/cart/add-to-cart.js":
/*!************************************************!*\
  !*** ./assets/scripts/lib/cart/add-to-cart.js ***!
  \************************************************/
/*! exports provided: addToCart */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "addToCart", function() { return addToCart; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_1__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


function addToCart() {
  scanProducts();
}

function scanProducts() {
  var _queryStrings = queryStrings(),
      action = _queryStrings.action,
      els = document.querySelectorAll(action),
      products = [];

  for (var i = 0; i < els.length; i++) {
    var element = els[i];
    products.push(element);
    element.addEventListener('submit', function (e) {
      return e.preventDefault();
    });
    createAddToCartEvent(element);
  }

  return {
    products: products,
    els: els
  };
}

function createAddToCartEvent(element) {
  element.addEventListener('submit', /*#__PURE__*/function () {
    var _ref = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(e) {
      var data, productID, quantity, res, cart, close_btn;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              data = new FormData(), productID = element.dataset['product'], quantity = getQuantity(element);

              if (productID) {
                _context.next = 3;
                break;
              }

              throw Error('Product ID not found');

            case 3:
              data.set('product_id', productID);
              data.set('quantity', quantity);
              _context.next = 7;
              return axios__WEBPACK_IMPORTED_MODULE_1___default.a.post('?wc-ajax=add_to_cart', data);

            case 7:
              res = _context.sent;

              if (res.data.fragments) {
                refreshCartTotals(res.data.fragments['cart_contents_count']);
              } else {
                cart = document.querySelector('div.widget_shopping_cart_content'), close_btn = document.querySelector('.js-close-cart');
                cart.classList.add('active');
                document.body.dispatchEvent(new Event('mini-cart-opened'));
                cart.addEventListener('click', function (e) {
                  if (e.target !== this) {
                    return;
                  }

                  e.target.classList.remove('active');
                  document.body.dispatchEvent(new Event('mini-cart-closed'));
                });
              }

            case 9:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }));

    return function (_x) {
      return _ref.apply(this, arguments);
    };
  }());
}

function getQuantity(el) {
  var _queryStrings2 = queryStrings(),
      quantity = _queryStrings2.quantity;

  var qty_el = el.querySelector(quantity);

  if (qty_el) {
    return qty_el.value;
  }

  return '1';
}

function refreshCartTotals(count) {
  var badge = document.querySelector('.js-cart-amount');
  badge.dataset['amount'] = count.toString();
  badge.innerHTML = count.toString();
}

function queryStrings() {
  return {
    action: '[data-action="add-to-cart"]',
    product: '[data-product]',
    quantity: '[name="quantity"]'
  };
}

/***/ }),

/***/ "./assets/scripts/lib/navigation/filterOpener.js":
/*!*******************************************************!*\
  !*** ./assets/scripts/lib/navigation/filterOpener.js ***!
  \*******************************************************/
/*! exports provided: filterOpener */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "filterOpener", function() { return filterOpener; });
function filterOpener() {
  var _getElements = getElements(),
      openFilterButton = _getElements.openFilterButton,
      filterWrapper = _getElements.filterWrapper,
      body = _getElements.body;

  if (!openFilterButton) {
    return;
  }

  openFilterButton.addEventListener('click', function () {
    if (!filterWrapper) {
      return;
    }

    if (filterWrapper.classList.contains('active')) {
      filterWrapper.classList.remove('active');
      body.dispatchEvent(new Event('filter-closed'));
    } else {
      filterWrapper.classList.add('active');
      body.dispatchEvent(new Event('filter-opened'));
    }
  });
}

function getElements() {
  return {
    openFilterButton: document.querySelector('.js-filter-opener'),
    filterWrapper: document.querySelector('.js-filter-container'),
    body: document.body
  };
}

/***/ }),

/***/ "./assets/scripts/lib/navigation/opener.js":
/*!*************************************************!*\
  !*** ./assets/scripts/lib/navigation/opener.js ***!
  \*************************************************/
/*! exports provided: navOpener */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "navOpener", function() { return navOpener; });
function navOpener() {
  var _getElements = getElements(),
      button = _getElements.button,
      menu = _getElements.menu;

  if (!button) {
    return;
  }

  button.addEventListener('click', function () {
    if (!menu.classList.contains('active')) {
      showMenu(menu);
      blockBody();
    } else {
      hideMenu(menu);
      unblockBody();
    }
  });
  document.body.addEventListener('click', function (e) {
    if (e.target === menu || menu.contains(e.target) || e.target === button || button.contains(e.target)) {
      return;
    }

    if (menu.classList.contains('active')) {
      hideMenu(menu);
      unblockBody();
    }
  });
}

function showMenu() {
  var menu = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

  var _getElements2 = getElements(),
      header = _getElements2.header,
      body = _getElements2.body;

  if (!menu) {
    menu = getElements().menu;
  }

  menu.style.top = "".concat(header.getBoundingClientRect().bottom, "px");
  menu.classList.add('active');
  body.dispatchEvent(new Event('menu-opened'));
}
/**
 *
 * @param {Element|null} menu
 */


function hideMenu() {
  var menu = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

  if (!menu) {
    menu = getElements().menu;
  }

  var submenus = menu.querySelectorAll('.submenu');
  menu.classList.remove('active');

  for (var i = 0; i < submenus.length; i++) {
    submenus[i].classList.remove('active');
  }

  getElements().body.dispatchEvent(new Event('menu-closed'));
}

function blockBody() {
  var _getElements3 = getElements(),
      body = _getElements3.body;

  body.style.overflow = 'hidden';
}

function unblockBody() {
  var _getElements4 = getElements(),
      body = _getElements4.body;

  body.style.overflow = '';
}

function getElements() {
  return {
    menu: document.querySelector('.navbar'),
    button: document.querySelector('.menu-button'),
    header: document.querySelector('.logo-header'),
    body: document.body
  };
}

/***/ }),

/***/ "./assets/scripts/routes/Common.js":
/*!*****************************************!*\
  !*** ./assets/scripts/routes/Common.js ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _lib_cart_add_to_cart__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../lib/cart/add-to-cart */ "./assets/scripts/lib/cart/add-to-cart.js");
/* harmony import */ var _lib_navigation_filterOpener__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../lib/navigation/filterOpener */ "./assets/scripts/lib/navigation/filterOpener.js");
/* harmony import */ var _lib_navigation_opener__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../lib/navigation/opener */ "./assets/scripts/lib/navigation/opener.js");
/* harmony import */ var _services_search_form__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../services/search-form */ "./assets/scripts/services/search-form/index.js");




/* harmony default export */ __webpack_exports__["default"] = ({
  init: function init() {
    // Javascript that fires on all pages.
    Object(_lib_cart_add_to_cart__WEBPACK_IMPORTED_MODULE_0__["addToCart"])();
    Object(_lib_navigation_opener__WEBPACK_IMPORTED_MODULE_2__["navOpener"])();
    Object(_lib_navigation_filterOpener__WEBPACK_IMPORTED_MODULE_1__["filterOpener"])();
    Object(_services_search_form__WEBPACK_IMPORTED_MODULE_3__["renderSearchForm"])();
  },
  finalize: function finalize() {
    // Javascript that fires on all pages. after page specific JS is fires.
    openShortList();
    openMobileSubmenu();
    focusSearchFix();
  }
});

var openShortList = function openShortList() {
  var lists = document.querySelectorAll('.shortened-list');

  if (!lists || lists.length === 0) {
    return;
  }

  var _loop = function _loop(i) {
    lists[i].addEventListener('click', function () {
      return lists[i].classList.add('active');
    });
  };

  for (var i = 0; i < lists.length; i++) {
    _loop(i);
  }
};

var openMobileSubmenu = function openMobileSubmenu() {
  if (window.innerWidth > 767) {
    return;
  }

  var openers = document.querySelectorAll('.menu-w-submenu');

  if (!openers) {
    return;
  }

  var _loop2 = function _loop2(i) {
    var button = openers[i];
    button.addEventListener('click', function (ev) {
      var _target$closest;

      if (button.parentElement.classList.contains('clicked')) {
        return;
      }

      ev.preventDefault();
      button.parentElement.classList.add('clicked');
      var target = ev.target;
      var submenu = (_target$closest = target.closest('.menu-item-submenu')) === null || _target$closest === void 0 ? void 0 : _target$closest.querySelector('.submenu');

      if (submenu) {
        submenu.classList.toggle('active');
      }
    });
  };

  for (var i = 0; i < openers.length; i++) {
    _loop2(i);
  }
};

var focusSearchFix = function focusSearchFix() {
  var form = document.querySelector('.js-search-form');

  if (!form) {
    return;
  }

  form.addEventListener('click', function () {
    var _form$querySelector;

    (_form$querySelector = form.querySelector('#s')) === null || _form$querySelector === void 0 ? void 0 : _form$querySelector.focus();
  });
};

/***/ }),

/***/ "./assets/scripts/services/search-form/index.js":
/*!******************************************************!*\
  !*** ./assets/scripts/services/search-form/index.js ***!
  \******************************************************/
/*! exports provided: renderSearchForm */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "renderSearchForm", function() { return renderSearchForm; });
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
/* harmony import */ var _lib_App__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./lib/App */ "./assets/scripts/services/search-form/lib/App.jsx");


function renderSearchForm() {
  var target = document.querySelector('.js-search-form');

  if (!target) {
    return;
  }

  Object(preact__WEBPACK_IMPORTED_MODULE_0__["render"])(Object(preact__WEBPACK_IMPORTED_MODULE_0__["h"])(_lib_App__WEBPACK_IMPORTED_MODULE_1__["App"]), target);
}

/***/ }),

/***/ "./assets/scripts/services/search-form/lib/App.jsx":
/*!*********************************************************!*\
  !*** ./assets/scripts/services/search-form/lib/App.jsx ***!
  \*********************************************************/
/*! exports provided: App */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "App", function() { return App; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
/* harmony import */ var _fortawesome_react_fontawesome__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @fortawesome/react-fontawesome */ "./node_modules/@fortawesome/react-fontawesome/index.es.js");
/* harmony import */ var _fortawesome_free_solid_svg_icons__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @fortawesome/free-solid-svg-icons */ "./node_modules/@fortawesome/free-solid-svg-icons/index.es.js");
/* harmony import */ var _AutoFill__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./AutoFill */ "./assets/scripts/services/search-form/lib/AutoFill.jsx");
/* harmony import */ var styled_components__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! styled-components */ "./node_modules/styled-components/dist/styled-components.browser.esm.js");


function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _templateObject() {
  var data = _taggedTemplateLiteral(["\n  display: flex;\n  width: 100%;\n  position: relative;\n"]);

  _templateObject = function _templateObject() {
    return data;
  };

  return data;
}

function _taggedTemplateLiteral(strings, raw) { if (!raw) { raw = strings.slice(0); } return Object.freeze(Object.defineProperties(strings, { raw: { value: Object.freeze(raw) } })); }






var SearchApp = styled_components__WEBPACK_IMPORTED_MODULE_5__["default"].div(_templateObject());
var App = /*#__PURE__*/function (_Component) {
  _inherits(App, _Component);

  function App() {
    var _this;

    _classCallCheck(this, App);

    _this = _possibleConstructorReturn(this, _getPrototypeOf(App).call(this));
    _this.abortControllers = [];
    _this.state = {
      loading: false,
      show_results: false,
      results: []
    };
    _this.handleFocusEvent = _this.handleFocusEvent.bind(_assertThisInitialized(_this));
    _this.hideSearchFill = _this.hideSearchFill.bind(_assertThisInitialized(_this));
    _this.handleSearchInput = _this.handleSearchInput.bind(_assertThisInitialized(_this));
    return _this;
  }

  _createClass(App, [{
    key: "handleFocusEvent",
    value: function handleFocusEvent(e) {
      this.setState({
        show_results: true
      });
    }
  }, {
    key: "hideSearchFill",
    value: function hideSearchFill() {
      this.setState({
        show_results: false
      });
    }
  }, {
    key: "handleSearchInput",
    value: function () {
      var _handleSearchInput = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(e) {
        var abortController, value, res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                this.abortControllers.forEach(function (abortController) {
                  return abortController.abort();
                });
                abortController = new AbortController();
                this.abortControllers.push(abortController);
                value = e.target.value;

                if (!('' === value || null === value || !value)) {
                  _context.next = 6;
                  break;
                }

                return _context.abrupt("return", this.hideSearchFill());

              case 6:
                _context.prev = 6;
                _context.next = 9;
                return fetch(window['ajax_url'] + "?action=search_results&s=".concat(value), {
                  signal: abortController.signal
                });

              case 9:
                _context.next = 11;
                return _context.sent.json();

              case 11:
                res = _context.sent;
                _context.next = 17;
                break;

              case 14:
                _context.prev = 14;
                _context.t0 = _context["catch"](6);
                return _context.abrupt("return");

              case 17:
                this.setState({
                  show_results: true,
                  results: res.data.posts
                });

              case 18:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this, [[6, 14]]);
      }));

      function handleSearchInput(_x) {
        return _handleSearchInput.apply(this, arguments);
      }

      return handleSearchInput;
    }()
  }, {
    key: "render",
    value: function render() {
      return Object(preact__WEBPACK_IMPORTED_MODULE_1__["h"])(SearchApp, {
        className: 'search-app'
      }, Object(preact__WEBPACK_IMPORTED_MODULE_1__["h"])("input", {
        placeholder: 'Zoek een product...',
        id: 's',
        name: 's',
        type: 'search',
        autocomplete: 'off',
        className: 'search-form-input',
        onFocus: this.handleFocusEvent,
        onblur: this.hideSearchFill,
        onInput: this.handleSearchInput
      }), Object(preact__WEBPACK_IMPORTED_MODULE_1__["h"])("button", {
        type: 'submit',
        "class": 'search-button'
      }, Object(preact__WEBPACK_IMPORTED_MODULE_1__["h"])(_fortawesome_react_fontawesome__WEBPACK_IMPORTED_MODULE_2__["FontAwesomeIcon"], {
        icon: _fortawesome_free_solid_svg_icons__WEBPACK_IMPORTED_MODULE_3__["faSearch"]
      })), this.state.show_results && Object(preact__WEBPACK_IMPORTED_MODULE_1__["h"])(_AutoFill__WEBPACK_IMPORTED_MODULE_4__["AutoFill"], {
        results: this.state.results,
        className: 'search-auto-fill'
      }));
    }
  }]);

  return App;
}(preact__WEBPACK_IMPORTED_MODULE_1__["Component"]);

/***/ }),

/***/ "./assets/scripts/services/search-form/lib/AutoFill.jsx":
/*!**************************************************************!*\
  !*** ./assets/scripts/services/search-form/lib/AutoFill.jsx ***!
  \**************************************************************/
/*! exports provided: AutoFill */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AutoFill", function() { return AutoFill; });
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
/* harmony import */ var _AutoFillItem__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AutoFillItem */ "./assets/scripts/services/search-form/lib/AutoFillItem.jsx");
/* harmony import */ var styled_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! styled-components */ "./node_modules/styled-components/dist/styled-components.browser.esm.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _templateObject() {
  var data = _taggedTemplateLiteral(["\n  position: absolute;\n  top: calc(100% + .5rem + 1px);\n  left: calc(-.5rem - 1px);\n  right: calc(-.5rem - 1px);\n  background: #ffffff;\n  box-shadow: 0 4px 8px rgba(51, 51, 51, 0.345);\n  z-index: 1;\n  color: #000000;\n  padding: 1rem;\n"]);

  _templateObject = function _templateObject() {
    return data;
  };

  return data;
}

function _taggedTemplateLiteral(strings, raw) { if (!raw) { raw = strings.slice(0); } return Object.freeze(Object.defineProperties(strings, { raw: { value: Object.freeze(raw) } })); }




var AutoFillWrapper = styled_components__WEBPACK_IMPORTED_MODULE_2__["default"].div(_templateObject());
var AutoFill = /*#__PURE__*/function (_Component) {
  _inherits(AutoFill, _Component);

  function AutoFill() {
    _classCallCheck(this, AutoFill);

    return _possibleConstructorReturn(this, _getPrototypeOf(AutoFill).apply(this, arguments));
  }

  _createClass(AutoFill, [{
    key: "render",
    value: function render() {
      if (this.props.results.length === 0) {
        return '';
      }

      return Object(preact__WEBPACK_IMPORTED_MODULE_0__["h"])(AutoFillWrapper, {
        className: 'search-auto-fill'
      }, Object(preact__WEBPACK_IMPORTED_MODULE_0__["h"])("nav", null, this.props.results.map(function (res) {
        return Object(preact__WEBPACK_IMPORTED_MODULE_0__["h"])(_AutoFillItem__WEBPACK_IMPORTED_MODULE_1__["AutoFillItem"], {
          res: res
        });
      })));
    }
  }]);

  return AutoFill;
}(preact__WEBPACK_IMPORTED_MODULE_0__["Component"]);

/***/ }),

/***/ "./assets/scripts/services/search-form/lib/AutoFillItem.jsx":
/*!******************************************************************!*\
  !*** ./assets/scripts/services/search-form/lib/AutoFillItem.jsx ***!
  \******************************************************************/
/*! exports provided: AutoFillItem */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AutoFillItem", function() { return AutoFillItem; });
/* harmony import */ var preact__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! preact */ "./node_modules/preact/dist/preact.module.js");
/* harmony import */ var styled_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! styled-components */ "./node_modules/styled-components/dist/styled-components.browser.esm.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _templateObject() {
  var data = _taggedTemplateLiteral(["\n\tdisplay: block;\n\tmargin: .5rem 0;\n\t\n\t.result-title {\n\t\tfont-weight: bold;\n\t}\n"]);

  _templateObject = function _templateObject() {
    return data;
  };

  return data;
}

function _taggedTemplateLiteral(strings, raw) { if (!raw) { raw = strings.slice(0); } return Object.freeze(Object.defineProperties(strings, { raw: { value: Object.freeze(raw) } })); }



var AutoFillWrapper = styled_components__WEBPACK_IMPORTED_MODULE_1__["default"].a(_templateObject());
var AutoFillItem = /*#__PURE__*/function (_Component) {
  _inherits(AutoFillItem, _Component);

  function AutoFillItem() {
    _classCallCheck(this, AutoFillItem);

    return _possibleConstructorReturn(this, _getPrototypeOf(AutoFillItem).apply(this, arguments));
  }

  _createClass(AutoFillItem, [{
    key: "render",
    value: function render() {
      var res = this.props.res;
      console.dir(res);
      return Object(preact__WEBPACK_IMPORTED_MODULE_0__["h"])(AutoFillWrapper, {
        href: "/?p=".concat(res.ID),
        key: res.ID,
        className: ['search-autofill-result', "".concat(res.post_type, "-result")].join(' ')
      }, Object(preact__WEBPACK_IMPORTED_MODULE_0__["h"])("h3", {
        title: res.post_title,
        className: "result-title"
      }, res.post_title));
    }
  }]);

  return AutoFillItem;
}(preact__WEBPACK_IMPORTED_MODULE_0__["Component"]);

/***/ })

}]);