(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

(function ($) {
  var RavenFrontend = function RavenFrontend() {
    var checkWidgetIsActive = function checkWidgetIsActive(widget) {
      return !!window.ravenTools.activeElements.includes(widget);
    };

    var widgets = {
      'raven-product-add-to-cart.default': checkWidgetIsActive('add-to-cart') && require('./widgets/add-to-cart')["default"],
      'raven-alert.default': checkWidgetIsActive('alert') && require('./widgets/alert')["default"],
      'raven-countdown.default': checkWidgetIsActive('countdown') && require('./widgets/countdown')["default"],
      'raven-counter.default': checkWidgetIsActive('counter') && require('./widgets/counter')["default"],
      'raven-form.default': checkWidgetIsActive('forms') && require('./widgets/form')["default"],
      'raven-reset-password.default': checkWidgetIsActive('forms') && require('./widgets/form')["default"],
      'raven-login.default': checkWidgetIsActive('forms') && require('./widgets/form')["default"],
      'raven-register.default': checkWidgetIsActive('forms') && require('./widgets/form')["default"],
      'raven-social-login.default': checkWidgetIsActive('forms') && require('./widgets/social-login')["default"],
      'raven-photo-roller.default': checkWidgetIsActive('photo-roller') && require('./widgets/photo-roller')["default"],
      'raven-tabs.default': checkWidgetIsActive('tabs') && require('./widgets/tabs')["default"],
      'raven-video.default': checkWidgetIsActive('video') && require('./widgets/video')["default"],
      'raven-categories.outer_content': checkWidgetIsActive('categories') && require('./widgets/categories')["default"],
      'raven-categories.inner_content': checkWidgetIsActive('categories') && require('./widgets/categories')["default"],
      'raven-posts.classic': checkWidgetIsActive('posts') && require('./widgets/posts').classic,
      'raven-posts.cover': checkWidgetIsActive('posts') && require('./widgets/posts').cover,
      'raven-posts-carousel.classic': checkWidgetIsActive('posts') && require('./widgets/posts-carousel').classic,
      'raven-posts-carousel.cover': checkWidgetIsActive('posts') && require('./widgets/posts-carousel').cover,
      'raven-photo-album.cover': checkWidgetIsActive('photo-album') && require('./widgets/photo-album')["default"],
      'raven-photo-album.stack': checkWidgetIsActive('photo-album') && require('./widgets/photo-album')["default"],
      'raven-product-reviews.default': checkWidgetIsActive('product-reviews') && require('./widgets/product-reviews')["default"],
      'raven-search-form.classic': checkWidgetIsActive('search-form') && require('./widgets/search-form').classic,
      'raven-search-form.full': checkWidgetIsActive('search-form') && require('./widgets/search-form').full,
      'raven-nav-menu.default': checkWidgetIsActive('nav-menu') && require('./widgets/nav-menu')["default"],
      'raven-advanced-nav-menu.default': checkWidgetIsActive('advanced-nav-menu') && require('./widgets/advanced-nav-menu')["default"],
      'raven-wc-products.default': checkWidgetIsActive('products') && require('./widgets/wc-products')["default"],
      'raven-content-switch.default': checkWidgetIsActive('content-switch') && require('./widgets/content-switch')["default"],
      'raven-product-gallery.default': checkWidgetIsActive('product-gallery') && require('./widgets/product-gallery')["default"],
      'raven-product-data-tabs.default': checkWidgetIsActive('product-data-tabs') && require('./widgets/product-data-tabs')["default"],
      'raven-my-account.default': checkWidgetIsActive('my-account') && require('./widgets/my-account')["default"],
      'raven-animated-heading.default': checkWidgetIsActive('animated-heading') && require('./widgets/animated-heading')["default"],
      'raven-hotspot.default': checkWidgetIsActive('hotspot') && require('./widgets/hotspot')["default"],
      'raven-media-carousel.default': checkWidgetIsActive('carousel') && require('./widgets/carousel/media-carousel')["default"],
      'raven-testimonial-carousel.default': checkWidgetIsActive('carousel') && require('./widgets/carousel/testimonial-carousel')["default"],
      'raven-slider.default': checkWidgetIsActive('slider') && require('./widgets/slider')["default"],
      'raven-reviews.default': checkWidgetIsActive('carousel') && require('./widgets/carousel/testimonial-carousel')["default"],
      'raven-lottie.default': checkWidgetIsActive('lottie') && require('./widgets/lottie')["default"]
    };

    function elementorInit() {
      for (var widget in widgets) {
        elementorFrontend.hooks.addAction("frontend/element_ready/".concat(widget), widgets[widget]);
      } // Lunch motion effects.


      new (require('./utils/motion-effects/luncher')["default"])();

      if (typeof elementorPro === 'undefined' && typeof window.elementor !== 'undefined' && $('.elementor').length > 0) {
        var fullPageEditor = require('./utils/full-page-editor');

        fullPageEditor.handleFullPageEditorBtn();
        fullPageEditor.handleHeaderBtns();
      }

      require('./widgets/column');

      require('./utils/tooltip');
    }

    this.Module = require('./utils/module');
    this.utils = {
      Masonry: require('./utils/masonry'),
      Sortable: require('./utils/sortable'),
      Pagination: require('./utils/pagination'),
      Detector: require('./utils/detectr'),
      SmoothScroll: require('./utils/smoothscroll-polyfill')
    };

    this.init = function () {
      $(window).on('elementor/frontend/init', elementorInit);
    };

    this.init();
  };

  window.ravenFrontend = new RavenFrontend();
})(jQuery);

},{"./utils/detectr":2,"./utils/full-page-editor":3,"./utils/masonry":4,"./utils/module":5,"./utils/motion-effects/luncher":12,"./utils/pagination":16,"./utils/smoothscroll-polyfill":17,"./utils/sortable":18,"./utils/tooltip":19,"./widgets/add-to-cart":20,"./widgets/advanced-nav-menu":21,"./widgets/alert":22,"./widgets/animated-heading":23,"./widgets/carousel/media-carousel":25,"./widgets/carousel/testimonial-carousel":26,"./widgets/categories":27,"./widgets/column":28,"./widgets/content-switch":29,"./widgets/countdown":30,"./widgets/counter":31,"./widgets/form":32,"./widgets/hotspot":33,"./widgets/lottie":34,"./widgets/my-account":35,"./widgets/nav-menu":36,"./widgets/photo-album":37,"./widgets/photo-roller":38,"./widgets/posts":40,"./widgets/posts-carousel":39,"./widgets/product-data-tabs":41,"./widgets/product-gallery":42,"./widgets/product-reviews":43,"./widgets/search-form":44,"./widgets/slider":45,"./widgets/social-login":46,"./widgets/tabs":47,"./widgets/video":48,"./widgets/wc-products":49}],2:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

/*!
 * Detectr.js
 * @author Rogerio Taques (rogerio.taques@gmail.com)
 * @see http://github.com/rogeriotaques/detectrjs
 *
 * This project is based on the Rafael Lima's work
 * which is called css_browser_selector and seems
 * to be discontinued. (http://rafael.adm.br/css_browser_selector/).
 */
var DetectrJs = function detecterjs($) {
  var version = '1.8.1';
  /**
   * Whenever .trim() isn't supported, makes it be.
   */

  if (typeof String.prototype.trim !== 'function') {
    // eslint-disable-next-line no-extend-native
    String.prototype.trim = function trim() {
      return this.replace(/^\s+|\s+$/g, '');
    };
  }

  var doc = $.document;
  var element = doc.documentElement;

  var detectr = function detectr(userAgent) {
    var ua = userAgent.toLowerCase();
    var winWidth = $.outerWidth || element.clientWidth;
    var winHeight = $.outerHeight || element.clientHeight;
    var gecko = 'gecko';
    var webkit = 'webkit';
    var safari = 'safari';
    var opera = 'opera';
    var mobile = 'mobile';
    /**
     * Checks if given string is present on the userAgent.
     *
     * @param str
     * @param string  str
     * @return {boolean}
     */

    var is = function is(str) {
      return ua.indexOf(str) > -1;
    };
    /**
     * The core feature ...
     */


    var detect = function detect() {
      var rendered = [];
      var implementation = doc.implementation;
      var webkitVersion = /applewebkit\/(\d{1,})/.test(ua) ? RegExp.$1 : false;
      var sysVersion = ''; // *** Detecting browsers ***

      switch (true) {
        // internet explorer
        case is('msie') && !is('opera') && !is('webtv') || is('trident') || is('edge'):
          if (is('edge')) {
            sysVersion = /edge\/(\w+)/.test(ua) ? ' edge ie' + RegExp.$1 : ' ie11';
          } else if (is('msie 8.0') || is('trident/7.0')) {
            sysVersion = ' ie11';
          } else {
            sysVersion = /msie\s(\d+)/.test(ua) ? ' ie' + RegExp.$1 : '';
          }

          rendered.push('ie' + sysVersion);
          break;
        // iron

        case is('iron/') || is('iron'):
          sysVersion = /iron\/(\d+)/.test(ua) ? ' iron' + RegExp.$1 : '';
          rendered.push(webkit + ' iron' + sysVersion);
          break;
        // android

        case is('android') && is('u;') && (!is('chrome') || is('chrome') && webkitVersion && webkitVersion <= 534):
          // according to some researches android stock (native) browsers never went above applewebkit/534.x,
          // then, we can suppose user is using a native browser in android when the UA contains "android",
          // "mobile" and "U;" strings
          // @see: (http://stackoverflow.com/questions/14403766/how-to-detect-the-stock-android-browser)
          rendered.push('android-browser');
          break;
        // google chrome

        case is('chrome/') || is('chrome'):
          sysVersion = /chrome\/(\d+)/.test(ua) ? ' chrome' + RegExp.$1 : '';
          rendered.push(webkit + ' chrome' + sysVersion);
          break;
        // firefox

        case is('firefox/') || is('firefox'):
          sysVersion = /firefox\/(\d+)/.test(ua) ? ' firefox' + RegExp.$1 : '';
          rendered.push(gecko + ' firefox' + sysVersion);
          break;
        // opera

        case is('opera/') || is('opera'):
          sysVersion = /version(\s|\/)(\d+)/.test(ua) || /opera(\s|\/)(\d+)/.test(ua) ? ' ' + opera + RegExp.$2 : '';
          rendered.push(opera + sysVersion);
          break;
        // konqueror

        case is('konqueror'):
          rendered.push(mobile + ' konqueror');
          break;
        // blackberry

        case is('blackberry') || is('bb'):
          rendered.push(mobile + ' blackberry');

          if (is('bb')) {
            sysVersion = /bb(\d{1,2})(;{0,1})/.test(ua) ? 'bb' + RegExp.$1 : '';
            rendered.push(sysVersion);
          }

          break;
        // safari

        case is('safari/') || is('safari'):
          sysVersion = /version\/(\d+)/.test(ua) || /safari\/(\d+)/.test(ua) ? ' ' + safari + RegExp.$1 : '';
          rendered.push(webkit + ' ' + safari + sysVersion);
          break;
        // applewebkit

        case is('applewebkit/') || is('applewebkit'):
          sysVersion = /applewebkit\/(\d+)/.test(ua) ? ' ' + webkit + RegExp.$1 : '';
          rendered.push(webkit + ' ' + sysVersion);
          break;
        // gecko || mozilla

        case is('gecko') || is('mozilla/'):
          rendered.push(gecko);
          break;

        default:
          break;
      } // *** Detecting O.S ***


      switch (true) {
        // ios
        case is('iphone') || is('ios'):
          sysVersion = /iphone\sos\s(\d{1,2})/.test(ua) ? ' ios' + RegExp.$1 : ''; // For some reason when it's iOS8, userAgent comes like OS 10_10
          // what returns a wrong version, then we need to match it against
          // another value

          if (sysVersion === ' ios10') {
            var vv = /(\d{1,2})/.test(sysVersion) ? RegExp.$1 : 0;
            var vd = /\sversion\/(\d{1,2})/.test(ua) ? RegExp.$1 : '';

            if (parseInt(vv, 10) > parseInt(vd, 10)) {
              sysVersion = ' ios' + vd;
            }
          }

          rendered.push('ios' + sysVersion);
          break;
        // macintosh

        case is('mac') || is('macintosh') || is('darwin'):
          sysVersion = /mac\sos\sx\s(\d{1,2}_\d{1,2})/.test(ua) ? ' osx' + RegExp.$1 : '';
          rendered.push('mac' + sysVersion);
          break;
        // windows

        case is('windows') || is('win'):
          sysVersion = /windows\s(nt\s{0,1})(\d{1,2}\.\d)/.test(ua) ? '' + RegExp.$2 : ''; // defining windows version

          switch (sysVersion) {
            case '5.0':
              sysVersion = ' win2k';
              break;

            case '5.01':
              sysVersion = ' win2k sp1';
              break;

            case '5.1':
            case '5.2':
              sysVersion = ' xp';
              break;

            case '6.0':
              sysVersion = ' vista';
              break;

            case '6.1':
              sysVersion = ' win7';
              break;

            case '6.2':
              sysVersion = ' win8';
              break;

            case '6.3':
              sysVersion = ' win8_1';
              break;

            case '6.4':
              sysVersion = ' win10';
              break;

            default:
              sysVersion = ' nt nt' + sysVersion;
          }

          rendered.push('windows' + sysVersion);
          break;
        // webtv

        case is('webtv'):
          rendered.push('webtv');
          break;
        // freebsd

        case is('freebsd'):
          rendered.push('freebsd');
          break;
        // android

        case is('android') || is('linux') && is('mobile'):
          rendered.push('android');
          break;
        // linux

        case is('linux') || is('x11'):
          rendered.push('linux');
          break;

        default:
          break;
      } // *** Detecting platform ***


      switch (true) {
        // 64 bits
        case is('wow64') || is('x64'):
          rendered.push('x64');
          break;
        // arm

        case is('arm'):
          rendered.push('arm');
          break;
        // 32 bits

        default:
          rendered.push('x32');
      } // *** Detecting devices ***


      switch (true) {
        case is('j2me'):
          rendered.push(mobile + ' j2me');
          break;

        case /(iphone|ipad|ipod)/.test(ua):
          rendered.push(mobile + ' ' + RegExp.$1);
          break;

        case is('mobile'):
          rendered.push(mobile);
          break;

        default:
          break;
      } // *** Detecting touchable devices ***


      if (/touch/.test(ua)) {
        rendered.push('touch');
      } // *** Assume that it supports javascript by default ***


      rendered.push('js'); // *** Detect if SVG images are supported ***

      rendered.push(implementation !== undefined && typeof implementation.hasFeature === 'function' && implementation.hasFeature('http://www.w3.org/TR/SVG11/feature#Image', '1.1') ? 'svg' : 'no-svg'); // *** Detect retina display ***

      rendered.push($.devicePixelRatio !== undefined && $.devicePixelRatio > 1 ? 'retina' : 'no-retina'); // *** Detecting orientation ***

      rendered.push(winWidth < winHeight ? 'portrait' : 'landscape');
      return rendered;
    }; // retrieve current classes attached


    var currentClassNames = doc.documentElement.className.split(' '); // convert 'detect' from function to array
    // and avoid unnecessary processing

    detect = detect(); // concat all detected classes to the existing ones and make sure they are unique
    // this prevent wiping pre-existing classes attached by different processes.

    currentClassNames = currentClassNames.concat(detect);
    currentClassNames = currentClassNames.filter(function (v, i) {
      return currentClassNames.indexOf(v) === i;
    }); // inject the new classes set in the HTML tag.

    element.className = currentClassNames.join(' ').trim(); // return what was detected

    return {
      detected: detect.join(' ').trim(),
      version: version
    };
  }; // execute and exposes detectr.js to the browser
  // eslint-disable-next-line


  $.detectr = detectr($.navigator.userAgent);
  /**
   * The listener engine for resize event ...
   */

  var resizing = function resizing() {
    $.detectr = detectr($.navigator.userAgent); // eslint-disable-line
  }; // add an event listener for window resize
  // which will asure that references will be
  // updated in case of browser resizing


  if ($.attachEvent) {
    $.attachEvent('onresize', resizing);
  } else if ($.addEventListener) {
    $.addEventListener('resize', resizing, true);
  }
};

DetectrJs(window);
var _default = DetectrJs;
exports["default"] = _default;

},{}],3:[function(require,module,exports){
'use strict';

var fullPageEditor = {};
var $ = jQuery; // we need this function globally

window.ravenChangeDocument = function changeDocument(elementorId) {
  $('.elementor').find('.raven-document-handle-parent').remove();
  window.elementorCommon.api.internal('panel/state-loading');
  window.elementorCommon.api.run('editor/documents/switch', {
    id: elementorId
  })["finally"](function () {
    fullPageEditor.handleFullPageEditorBtn();
    return window.elementorCommon.api.internal('panel/state-ready');
  });
};

fullPageEditor.handleFullPageEditorBtn = function handleFullPageEditorBtn() {
  $('.elementor').each(function () {
    if ($(this).find('.raven-document-handle-parent').length > 0 && $(this).find('.raven-document-handle-parent').children().length > 0) {
      return;
    }

    if ($(this).hasClass('elementor-edit-area-active')) {
      return;
    }

    var currentTargetName = this.dataset.elementorTitle;

    if (typeof currentTargetName === 'undefined') {
      return;
    }

    var newElementorId = $(this).attr('data-elementor-id');
    var ravenDocumentHandler = '<div class="raven-document-handle" onclick="window.ravenChangeDocument( ' + newElementorId + ' )"><i class="fas fa-edit"></i>Edit ' + currentTargetName + '</div>';
    $(this).prepend('<div class="raven-document-handle-parent" style="display:none;"></div>');
    $(this).find('.raven-document-handle-parent').append(ravenDocumentHandler);
  });
};

fullPageEditor.handleHeaderBtns = function () {
  var elementOffset = 0;

  if ($('main').length) {
    elementOffset = $('main').offset().top;
  }

  $(document).on('mouseenter', 'header', function () {
    if (elementOffset > 0) {
      return;
    }

    var clonedMainBtn = $('main .raven-document-handle-parent .raven-document-handle').clone().addClass('fixed-top-btn');

    if (clonedMainBtn.length === 0) {
      return;
    }

    if ($('header .elementor').find('.raven-document-handle-parent').length === 0) {
      $('header .elementor').prepend('<div class="raven-document-handle-parent"></div>');
      $('header .elementor .raven-document-handle-parent').prepend(clonedMainBtn);
    }

    if ($('header .elementor').find('.raven-document-handle-parent').length > 0) {
      $('header .elementor .raven-document-handle-parent').append(clonedMainBtn);
    }
  });
  $(document).on('mouseleave', 'header', function () {
    if ($('main .raven-document-handle-parent .raven-document-handle').length === 0) {
      return;
    }

    if (elementOffset > 0) {
      return;
    }

    $('header .elementor .raven-document-handle-parent .raven-document-handle.fixed-top-btn').remove();
  });
};

module.exports = fullPageEditor;

},{}],4:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _module = _interopRequireDefault(require("./module"));

var Masonry = _module["default"].extend({
  getDefaultSettings: function getDefaultSettings() {
    return {
      masonryContainer: '.raven-masonry',
      columnClass: 'raven-masonry-column',
      columns: this.getInstanceValue('columns') || 3,
      columnsTablet: this.getInstanceValue('columns_tablet') || 2,
      columnsMobile: this.getInstanceValue('columns_mobile') || 1
    };
  },
  getDefaultElements: function getDefaultElements() {
    return {
      $masonryContainer: this.$element.find(this.getSettings('masonryContainer'))
    };
  },
  run: function run() {
    var settings = this.getSettings();
    var selector = ".elementor-element-".concat(this.getID(), " ").concat(settings.masonryContainer);

    if (savvior.grids[selector]) {
      delete savvior.grids[selector];
    }

    savvior.init(selector, {
      'screen and (min-width: 1025px)': {
        columnClasses: settings.columnClass,
        columns: settings.columns
      },
      'screen and (max-width: 1024px) and (min-width: 768px)': {
        columnClasses: settings.columnClass,
        columns: settings.columnsTablet
      },
      'screen and (max-width: 767px)': {
        columnClasses: settings.columnClass,
        columns: settings.columnsMobile
      }
    });
  },
  push: function push(items) {
    if (!items) {
      return;
    }

    var settings = this.getSettings();
    var selector = ".elementor-element-".concat(this.getID(), " ").concat(settings.masonryContainer);
    var itemsNode = [];
    var savviorOptions = {
      method: 'append',
      clone: false
    };
    items.forEach(function (item) {
      var $item = $(item);
      itemsNode.push($item[0]);
    });

    if (savvior.grids[selector]) {
      savvior.addItems(selector, itemsNode, savviorOptions);
    }
  }
});

var _default = Masonry;
exports["default"] = _default;

},{"./module":5,"@babel/runtime/helpers/interopRequireDefault":60}],5:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;
var Module = elementorModules.frontend.handlers.Base.extend({
  onSectionActivated: null,
  onEditorClosed: null,
  getInstanceValue: function getInstanceValue(key) {
    $ = jQuery;
    return this.getElementSettings(this.getControlID(key));
  },
  getControlID: function getControlID(controlID) {
    var skin = this.getElementSettings('_skin');

    if (!skin) {
      return controlID;
    }

    return "".concat(skin, "_").concat(controlID);
  },
  scrollToContainer: function scrollToContainer($element) {
    var $top = $element.offset().top - 50;
    var headerHeight = $('header').height();
    var bodySelector = document.querySelector('body');

    if (bodySelector.classList.contains('jupiterx-header-fixed') || bodySelector.classList.contains('jupiterx-header-sticked')) {
      $top = $element.offset().top - headerHeight - 50;
    }

    window.scroll({
      top: $top,
      behavior: 'smooth'
    });
  },
  initEditorListeners: function initEditorListeners() {
    var self = this;
    elementorModules.frontend.handlers.Base.prototype.initEditorListeners.apply(this, arguments);

    if (self.onSectionActivated) {
      self.editorListeners.push({
        event: 'section:activated',
        to: elementor.channels.editor,
        callback: function callback(activeSection, section) {
          if (section.model.id !== self.getID()) {
            return;
          }

          self.onSectionActivated(activeSection, section);
        }
      });
    }

    if (self.onEditorClosed) {
      self.editorListeners.push({
        event: 'set:page:editor',
        to: elementor.getPanelView(),
        callback: function callback(currentPageView) {
          if (currentPageView.model.id !== self.getID()) {
            return;
          }

          currentPageView.model.once('editor:close', function () {
            self.onEditorClosed();
          });
        }
      });
    }
  },
  onMobile: function onMobile() {
    var windowWidth = jQuery(window).width();
    return windowWidth <= 575.98;
  },
  onTablet: function onTablet() {
    var windowWidth = jQuery(window).width();
    return windowWidth > 575.98 && windowWidth <= 767.98;
  },
  onDesktop: function onDesktop() {
    var windowWidth = jQuery(window).width();
    return windowWidth > 767.98;
  },
  isRtl: function isRtl() {
    return jQuery('body').hasClass('rtl');
  }
});
var _default = Module;
exports["default"] = _default;

},{}],6:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

/**
 * Gets the action options passed from Effect and calculates changes, then applies them on element style.
 */
var Actions = /*#__PURE__*/function (_elementorModules$Mod) {
  (0, _inherits2["default"])(Actions, _elementorModules$Mod);

  var _super = _createSuper(Actions);

  function Actions() {
    (0, _classCallCheck2["default"])(this, Actions);
    return _super.apply(this, arguments);
  }

  (0, _createClass2["default"])(Actions, [{
    key: "onInit",
    value: function onInit() {
      this.$element = this.getSettings('$targetElement');
      this.refresh();
    }
  }, {
    key: "refresh",
    value: function refresh() {
      this.rulesVariables = {};
      this.CSSTransformVariables = [];
      this.$element.css({
        transform: '',
        filter: '',
        opacity: '',
        'will-change': ''
      });
    } // Interaction: scroll.

  }, {
    key: "translateX",
    value: function translateX(actionData, passedPercents) {
      actionData.axis = 'x';
      actionData.unit = 'px';
      this.transform('translateX', passedPercents, actionData);
    } // Interaction: scroll.

  }, {
    key: "translateY",
    value: function translateY(actionData, passedPercents) {
      actionData.axis = 'y';
      actionData.unit = 'px';
      this.transform('translateY', passedPercents, actionData);
    } // Interaction: mouseMove ("translateXY" is the alias used for "mouseTrack").

  }, {
    key: "translateXY",
    value: function translateXY(actionData, passedPercentsX, passedPercentsY) {
      this.translateX(actionData, passedPercentsX);
      this.translateY(actionData, passedPercentsY);
    } // It is not a direct effect and only used in calculation of "tilt" effect.

  }, {
    key: "rotateX",
    value: function rotateX(actionData, passedPercents) {
      actionData.axis = 'x';
      actionData.unit = 'deg';
      this.transform('rotateX', passedPercents, actionData);
    } // It is not a direct effect and only used in calculation of "tilt" effect.

  }, {
    key: "rotateY",
    value: function rotateY(actionData, passedPercents) {
      actionData.axis = 'y';
      actionData.unit = 'deg';
      this.transform('rotateY', passedPercents, actionData);
    } // Interaction: scroll.

  }, {
    key: "rotateZ",
    value: function rotateZ(actionData, passedPercents) {
      actionData.unit = 'deg';
      this.transform('rotateZ', passedPercents, actionData);
    } // Interaction: mouseMove.

  }, {
    key: "tilt",
    value: function tilt(actionData, passedPercentsX, passedPercentsY) {
      var data = {
        intensity: actionData.intensity / 10,
        direction: actionData.direction
      };
      this.rotateX(data, passedPercentsY);
      this.rotateY(data, 100 - passedPercentsX);
    } // Interaction: scroll.

  }, {
    key: "opacity",
    value: function opacity(actionData, passedPercents) {
      var movePoint = this.getDirectionMovePoint(passedPercents, actionData.direction, actionData.viewport);
      var level = actionData.intensity / 10;
      var opacity = 1 - level + level * movePoint / 100;
      this.$element.css({
        opacity: opacity,
        'will-change': 'opacity'
      });
    } // Interaction: scroll.

  }, {
    key: "blur",
    value: function blur(actionData, passedPercents) {
      var movePoint = this.getDirectionMovePoint(passedPercents, actionData.direction, actionData.viewport);
      var level = actionData.intensity;
      var blur = level - level * movePoint / 100;
      this.updateRulePart('filter', 'blur', blur + 'px');
    } // Interaction: scroll.

  }, {
    key: "scale",
    value: function scale(actionData, passedPercents) {
      var movePoint = this.getDirectionMovePoint(passedPercents, actionData.direction, actionData.viewport);
      this.updateRulePart('transform', 'scale', 1 + actionData.intensity * movePoint / 1000);
    }
  }, {
    key: "transform",
    value: function transform(action, passedPercents, actionData) {
      if (actionData.direction) {
        passedPercents = 100 - passedPercents;
      }

      this.updateRulePart('transform', action, this.getStep(passedPercents, actionData) + actionData.unit);
    }
  }, {
    key: "getDirectionMovePoint",
    value: function getDirectionMovePoint(passedPercents, direction, range) {
      if (passedPercents < range.start) {
        var _movePoint = this.getMovePointFromPassedPercents(range.start, passedPercents);

        switch (direction) {
          case 'out-in':
            return 0;

          case 'in-out':
            return 100;

          case 'out-in-out':
            return _movePoint;

          case 'in-out-in':
            return 100 - _movePoint;
        }
      }

      if (passedPercents < range.end) {
        var _movePoint2 = this.getMovePointFromPassedPercents(range.end - range.start, passedPercents - range.start);

        switch (direction) {
          case 'out-in':
            return _movePoint2;

          case 'in-out':
            return 100 - _movePoint2;

          case 'out-in-out':
            return 100;

          case 'in-out-in':
            return 0;
        }
      }

      var movePoint = this.getMovePointFromPassedPercents(100 - range.end, 100 - passedPercents);

      switch (direction) {
        case 'out-in':
          return 100;

        case 'in-out':
          return 0;

        case 'out-in-out':
          return movePoint;

        case 'in-out-in':
          return 100 - movePoint;
      }
    }
  }, {
    key: "getMovePointFromPassedPercents",
    value: function getMovePointFromPassedPercents(movableRange, passedPercents) {
      var movePoint = passedPercents / movableRange * 100;
      return +movePoint.toFixed(2);
    }
  }, {
    key: "getStep",
    value: function getStep(passedPercents, options) {
      if ('element' === this.getSettings('effectTarget')) {
        return -(passedPercents - 50) * options.intensity;
      }

      var movableRange = this.getSettings('dimensions.movable' + options.axis.toUpperCase());
      return -(movableRange * passedPercents / 100);
    }
  }, {
    key: "updateRulePart",
    value: function updateRulePart(ruleName, key, value) {
      if (!this.rulesVariables[ruleName]) {
        this.rulesVariables[ruleName] = {};
      }

      if (!this.rulesVariables[ruleName][key]) {
        this.rulesVariables[ruleName][key] = true;
        this.updateRule(ruleName);
      }

      var cssVarKey = "--".concat(key);
      this.$element[0].style.setProperty(cssVarKey, value);
    }
  }, {
    key: "updateRule",
    value: function updateRule(ruleName) {
      var value = '';
      value += this.concatTransformCSSProperties(ruleName);
      value += this.concatTransformMotionEffectCSSProperties(ruleName);
      this.$element.css(ruleName, value);
    }
  }, {
    key: "concatTransformCSSProperties",
    value: function concatTransformCSSProperties(ruleName) {
      var value = '';

      if ('transform' === ruleName) {
        jQuery.each(this.CSSTransformVariables, function (_, variableKey) {
          var variableName = variableKey;

          if (variableKey.startsWith('flip')) {
            variableKey = variableKey.replace('flip', 'scale');
          } // Adding default value because of the hover state. if there is no default the transform will break.


          var defaultUnit = variableKey.startsWith('rotate') || variableKey.startsWith('skew') ? 'deg' : 'px';
          var defaultValue = variableKey.startsWith('scale') ? 1 : 0 + defaultUnit;
          value += "".concat(variableKey, "(var(--e-transform-").concat(variableName, ", ").concat(defaultValue, "))");
        });
      }

      return value;
    }
  }, {
    key: "concatTransformMotionEffectCSSProperties",
    value: function concatTransformMotionEffectCSSProperties(ruleName) {
      var value = '';
      jQuery.each(this.rulesVariables[ruleName], function (variableKey) {
        value += "".concat(variableKey, "(var(--").concat(variableKey, "))");
      });
      return value;
    }
  }, {
    key: "setCSSTransformVariables",
    value: function setCSSTransformVariables(elementSettings) {
      var _this = this;

      this.CSSTransformVariables = [];
      jQuery.each(elementSettings, function (settingKey, settingValue) {
        var transformKeyMatches = settingKey.match(/_transform_(.+?)_effect/m);

        if (transformKeyMatches && settingValue) {
          if ('perspective' === transformKeyMatches[1]) {
            _this.CSSTransformVariables.unshift(transformKeyMatches[1]);

            return;
          }

          if (_this.CSSTransformVariables.includes(transformKeyMatches[1])) {
            return;
          }

          _this.CSSTransformVariables.push(transformKeyMatches[1]);
        }
      });
    }
  }, {
    key: "runAction",
    value: function runAction(actionName, actionData, passedPercents) {
      if (['translateX', 'translateY', 'rotateZ'].includes(actionName)) {
        if (actionData.viewport.start > passedPercents) {
          passedPercents = actionData.viewport.start;
        }

        if (actionData.viewport.end < passedPercents) {
          passedPercents = actionData.viewport.end;
        }
      }

      for (var _len = arguments.length, args = new Array(_len > 3 ? _len - 3 : 0), _key = 3; _key < _len; _key++) {
        args[_key - 3] = arguments[_key];
      }

      this[actionName].apply(this, [actionData, passedPercents].concat(args));
    }
  }]);
  return Actions;
}(elementorModules.Module);

var _default = Actions;
exports["default"] = _default;

},{"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/createClass":55,"@babel/runtime/helpers/getPrototypeOf":58,"@babel/runtime/helpers/inherits":59,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/possibleConstructorReturn":63}],7:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _typeof2 = _interopRequireDefault(require("@babel/runtime/helpers/typeof"));

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _get3 = _interopRequireDefault(require("@babel/runtime/helpers/get"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

/**
 * Initializes motion effects by retrieving motion effects settings and
 * instantiates Effect class(in motion-effects.js) with those settings.
 */
var EffectsHandler = /*#__PURE__*/function (_elementorModules$fro) {
  (0, _inherits2["default"])(EffectsHandler, _elementorModules$fro);

  var _super = _createSuper(EffectsHandler);

  function EffectsHandler() {
    (0, _classCallCheck2["default"])(this, EffectsHandler);
    return _super.apply(this, arguments);
  }

  (0, _createClass2["default"])(EffectsHandler, [{
    key: "__construct",
    value: function __construct() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = (0, _get3["default"])((0, _getPrototypeOf2["default"])(EffectsHandler.prototype), "__construct", this)).call.apply(_get2, [this].concat(args));

      this.normalMotion = 'raven_motion_effects';
      this.backgroundMotion = 'background_' + this.normalMotion;
      this.toggle = elementorFrontend.debounce(this.toggle, 200);
    }
  }, {
    key: "onInit",
    value: function onInit() {
      (0, _get3["default"])((0, _getPrototypeOf2["default"])(EffectsHandler.prototype), "onInit", this).call(this);
      this.initEffects();
      this.addCSSTransformEvents();
      this.toggle();
    }
  }, {
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          container: '.elementor-widget-container'
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings('selectors');
      return {
        $container: $(this.$element).find(selectors.container)
      };
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      elementorFrontend.elements.$window.on('resize', this.toggle);
    }
  }, {
    key: "unbindEvents",
    value: function unbindEvents() {
      elementorFrontend.elements.$window.off('resize', this.toggle);
    }
  }, {
    key: "initEffects",
    value: function initEffects() {
      this.effects = {
        translateY: {
          interaction: 'scroll',
          actions: ['translateY']
        },
        translateX: {
          interaction: 'scroll',
          actions: ['translateX']
        },
        rotateZ: {
          interaction: 'scroll',
          actions: ['rotateZ']
        },
        scale: {
          interaction: 'scroll',
          actions: ['scale']
        },
        opacity: {
          interaction: 'scroll',
          actions: ['opacity']
        },
        blur: {
          interaction: 'scroll',
          actions: ['blur']
        },
        mouseTrack: {
          interaction: 'mouseMove',
          actions: ['translateXY']
        },
        tilt: {
          interaction: 'mouseMove',
          actions: ['tilt']
        }
      };
    }
  }, {
    key: "addCSSTransformEvents",
    value: function addCSSTransformEvents() {
      var _this = this;

      // Transform origin is set in two places: <Transform> section and <Motion Effect> section. The former must override the latter.
      // Remove CSS transition variable that assigned from scroll.js in order to allow the transition of the CSS-Transform.
      var motionFxScrolling = this.getElementSettings(this.normalMotion + '_scrolling');

      if (motionFxScrolling && !this.isTransitionEventAdded) {
        this.isTransitionEventAdded = true;
        this.elements.$container.on('mouseenter', function () {
          _this.elements.$container.css('--e-transform-transition-duration', '');
        });
      }
    }
  }, {
    key: "prepareOptions",
    value: function prepareOptions(name) {
      var _this2 = this;

      var elementSettings = this.getElementSettings();
      var effectTarget = this.normalMotion === name ? 'element' : 'background';
      var interactions = {}; // Loop over settings and inspect individual Effects.

      jQuery.each(elementSettings, function (key, value) {
        // Running match() on the following regexp, captures "scale" in "raven_motion_effects_scale_fx" in its second index.
        var keyRegex = new RegExp('^' + name + '_(.+?)_fx');
        var keyMatches = key.match(keyRegex);

        if (!keyMatches || !value) {
          return;
        }

        var options = {};
        var effectName = keyMatches[1]; // Loop over settings again, and extract settings of this specific Effect.

        jQuery.each(elementSettings, function (subKey, subValue) {
          var subKeyRegex = new RegExp(name + '_' + effectName + '_fx_(.+)');
          var subKeyMatches = subKey.match(subKeyRegex);

          if (!subKeyMatches) {
            return;
          } // Will be one of these: "direction"/"viewport"/"intensity".


          var effectSetting = subKeyMatches[1];

          if ('fx' === effectSetting) {
            return;
          }

          if ('object' === (0, _typeof2["default"])(subValue)) {
            // Both Viewport and Intensity settings are of slider type.
            // But Viewport setting contains 'sizes' key as it is a range, while Intensity setting contains 'size'.
            subValue = Object.keys(subValue.sizes).length ? subValue.sizes : subValue.size;
          }

          options[effectSetting] = subValue;
        }); // Fill interactions array.

        var effect = _this2.effects[effectName];
        var interactionName = effect.interaction;

        if (!interactions[interactionName]) {
          interactions[interactionName] = {};
        }

        effect.actions.forEach(function (action) {
          return interactions[interactionName][action] = options;
        });
      });
      var $element = this.$element;
      var $dimensionsElement;
      var elementType = this.getElementType();

      if ('element' === effectTarget && 'section' !== elementType && 'container' !== elementType) {
        $dimensionsElement = $element;
        var childElementSelector;

        if ('column' === elementType) {
          childElementSelector = elementorFrontend.config.legacyMode.elementWrappers ? '.elementor-column-wrap' : '.elementor-widget-wrap';
        } else {
          childElementSelector = '.elementor-widget-container';
        }

        $element = $element.find('> ' + childElementSelector);
      }

      var options = {
        effectTarget: effectTarget,
        interactions: interactions,
        elementSettings: elementSettings,
        $element: $element,
        $dimensionsElement: $dimensionsElement,
        refreshDimensions: this.isEdit,
        range: elementSettings[name + '_range'],
        classes: {
          element: 'raven-motion-effects-element',
          parent: 'raven-motion-effects-parent',
          perspective: 'raven-motion-effects-perspective',
          // The following classes prefix is kept as "elementor" because they inherit styles from Elementor Free
          backgroundType: 'elementor-motion-effects-element-type-background',
          container: 'elementor-motion-effects-container',
          layer: 'elementor-motion-effects-layer'
        }
      };

      if (!options.range && 'fixed' === this.getCurrentDeviceSetting('_position')) {
        options.range = 'page';
      }

      if ('fixed' === this.getCurrentDeviceSetting('_position')) {
        options.isFixedPosition = true;
      }

      if ('background' === effectTarget && 'column' === this.getElementType()) {
        options.addBackgroundLayerTo = ' > .elementor-element-populated';
      }

      return options;
    }
  }, {
    key: "activate",
    value: function activate(name) {
      var options = this.prepareOptions(name);

      if (jQuery.isEmptyObject(options.interactions)) {
        return;
      }

      this[name] = new (require('./motion-effects')["default"])(options);
    }
  }, {
    key: "deactivate",
    value: function deactivate(name) {
      if (this[name]) {
        this[name].destroy();
        delete this[name];
      }
    }
  }, {
    key: "toggle",
    value: function toggle() {
      var _this3 = this;

      var currentDeviceMode = elementorFrontend.getCurrentDeviceMode();
      var elementSettings = this.getElementSettings();
      [this.normalMotion, this.backgroundMotion].forEach(function (name) {
        var devices = elementSettings[name + '_devices'];
        var isCurrentModeActive = !devices || -1 !== devices.indexOf(currentDeviceMode);
        var isMotionEffectsSet = elementSettings[name + '_scrolling'] || elementSettings[name + '_mouse'];

        if (isCurrentModeActive && isMotionEffectsSet) {
          if (_this3[name]) {
            _this3.refreshInstance(name);

            return;
          }

          _this3.activate(name);

          return;
        }

        _this3.deactivate(name);
      });
    }
  }, {
    key: "refreshInstance",
    value: function refreshInstance(instanceName) {
      var instance = this[instanceName];

      if (!instance) {
        return;
      }

      var preparedOptions = this.prepareOptions(instanceName);
      instance.setSettings(preparedOptions);
      instance.refresh();
    }
  }, {
    key: "onElementChange",
    value: function onElementChange(propertyName) {
      var _this4 = this;

      if (/raven_motion_effects_((scrolling)|(mouse)|(devices))$/.test(propertyName)) {
        if (this.normalMotion + '_scrolling' === propertyName) {
          this.addCSSTransformEvents();
        }

        this.toggle();
        return;
      }

      var propertyMatches = propertyName.match(".*?(".concat(this.normalMotion, "|_transform)"));

      if (propertyMatches) {
        var instanceName = propertyMatches[0].match('(_transform)') ? this.normalMotion : propertyMatches[0];
        this.refreshInstance(instanceName);

        if (!this[instanceName]) {
          this.activate(instanceName);
        }
      }

      if (/^_position/.test(propertyName)) {
        [this.normalMotion, this.backgroundMotion].forEach(function (instanceName) {
          _this4.refreshInstance(instanceName);
        });
      }
    }
  }, {
    key: "onDestroy",
    value: function onDestroy() {
      var _this5 = this;

      (0, _get3["default"])((0, _getPrototypeOf2["default"])(EffectsHandler.prototype), "onDestroy", this).call(this);
      [this.normalMotion, this.backgroundMotion].forEach(function (name) {
        _this5.deactivate(name);
      });
    }
  }]);
  return EffectsHandler;
}(elementorModules.frontend.handlers.Base);

var _default = EffectsHandler;
exports["default"] = _default;

},{"./motion-effects":11,"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/createClass":55,"@babel/runtime/helpers/get":57,"@babel/runtime/helpers/getPrototypeOf":58,"@babel/runtime/helpers/inherits":59,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/possibleConstructorReturn":63,"@babel/runtime/helpers/typeof":67}],8:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _assertThisInitialized2 = _interopRequireDefault(require("@babel/runtime/helpers/assertThisInitialized"));

var _get2 = _interopRequireDefault(require("@babel/runtime/helpers/get"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

var BaseInteraction = /*#__PURE__*/function (_elementorModules$Vie) {
  (0, _inherits2["default"])(BaseInteraction, _elementorModules$Vie);

  var _super = _createSuper(BaseInteraction);

  function BaseInteraction() {
    var _this;

    (0, _classCallCheck2["default"])(this, BaseInteraction);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));
    (0, _defineProperty)((0, _assertThisInitialized2["default"])(_this), 'onInsideViewport', function () {
      _this.run();

      _this.animationFrameRequest = window.requestAnimationFrame(_this.onInsideViewport);
    });
    return _this;
  }

  (0, _createClass2["default"])(BaseInteraction, [{
    key: "__construct",
    value: function __construct(options) {
      this.motionFX = options.motionFX;

      if (!this.intersectionObservers) {
        this.setElementInViewportObserver();
      }
    }
  }, {
    key: "setElementInViewportObserver",
    value: function setElementInViewportObserver() {
      var _this2 = this;

      this.intersectionObserver = elementorModules.utils.Scroll.scrollObserver({
        callback: function callback(event) {
          if (event.isInViewport) {
            _this2.onInsideViewport();

            return;
          }

          _this2.removeAnimationFrameRequest();
        }
      }); // Determine which element we should observe.

      var observedElement = 'page' === this.motionFX.getSettings('range') ? elementorFrontend.elements.$body[0] : this.motionFX.elements.$parent[0];
      this.intersectionObserver.observe(observedElement);
    }
  }, {
    key: "runCallback",
    value: function runCallback() {
      var callback = this.getSettings('callback');
      callback.apply(void 0, arguments);
    }
  }, {
    key: "removeIntersectionObserver",
    value: function removeIntersectionObserver() {
      if (this.intersectionObserver) {
        this.intersectionObserver.unobserve(this.motionFX.elements.$parent[0]);
      }
    }
  }, {
    key: "removeAnimationFrameRequest",
    value: function removeAnimationFrameRequest() {
      if (this.animationFrameRequest) {
        window.cancelAnimationFrame(this.animationFrameRequest);
      }
    }
  }, {
    key: "destroy",
    value: function destroy() {
      this.removeAnimationFrameRequest();
      this.removeIntersectionObserver();
    }
  }, {
    key: "onInit",
    value: function onInit() {
      (0, _get2["default"])((0, _getPrototypeOf2["default"])(BaseInteraction.prototype), "onInit", this).call(this);
    }
  }]);
  return BaseInteraction;
}(elementorModules.ViewModule);

var _default = BaseInteraction;
exports["default"] = _default;

function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }

  return obj;
}

},{"@babel/runtime/helpers/assertThisInitialized":52,"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/createClass":55,"@babel/runtime/helpers/get":57,"@babel/runtime/helpers/getPrototypeOf":58,"@babel/runtime/helpers/inherits":59,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/possibleConstructorReturn":63}],9:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _get2 = _interopRequireDefault(require("@babel/runtime/helpers/get"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

var _base = _interopRequireDefault(require("./base"));

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

var MouseMoveInteraction = /*#__PURE__*/function (_BaseInteraction) {
  (0, _inherits2["default"])(MouseMoveInteraction, _BaseInteraction);

  var _super = _createSuper(MouseMoveInteraction);

  function MouseMoveInteraction() {
    (0, _classCallCheck2["default"])(this, MouseMoveInteraction);
    return _super.apply(this, arguments);
  }

  (0, _createClass2["default"])(MouseMoveInteraction, [{
    key: "onInit",
    value: function onInit() {
      this.mousePosition = {};
      this.oldMousePosition = {};
      (0, _get2["default"])((0, _getPrototypeOf2["default"])(MouseMoveInteraction.prototype), "onInit", this).call(this);
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      if (!MouseMoveInteraction.mouseTracked) {
        elementorFrontend.elements.$window.on('mousemove', this.updateMousePosition);
        MouseMoveInteraction.mouseTracked = true;
      }
    }
  }, {
    key: "run",
    value: function run() {
      var mousePosition = MouseMoveInteraction.mousePosition;
      var oldMousePosition = this.oldMousePosition;

      if (oldMousePosition.x === mousePosition.x && oldMousePosition.y === mousePosition.y) {
        return;
      }

      this.oldMousePosition = {
        x: mousePosition.x,
        y: mousePosition.y
      };
      var passedPercentsX = 100 / window.innerWidth * mousePosition.x;
      var passedPercentsY = 100 / window.innerHeight * mousePosition.y;
      this.runCallback(passedPercentsX, passedPercentsY);
    }
  }, {
    key: "updateMousePosition",
    value: function updateMousePosition(event) {
      MouseMoveInteraction.mousePosition = {
        x: event.clientX,
        y: event.clientY
      };
    }
  }]);
  return MouseMoveInteraction;
}(_base["default"]);

MouseMoveInteraction.mousePosition = {};
var _default = MouseMoveInteraction;
exports["default"] = _default;

},{"./base":8,"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/createClass":55,"@babel/runtime/helpers/get":57,"@babel/runtime/helpers/getPrototypeOf":58,"@babel/runtime/helpers/inherits":59,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/possibleConstructorReturn":63}],10:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

var _base = _interopRequireDefault(require("./base"));

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

var ScrollInteraction = /*#__PURE__*/function (_BaseInteraction) {
  (0, _inherits2["default"])(ScrollInteraction, _BaseInteraction);

  var _super = _createSuper(ScrollInteraction);

  function ScrollInteraction() {
    (0, _classCallCheck2["default"])(this, ScrollInteraction);
    return _super.apply(this, arguments);
  }

  (0, _createClass2["default"])(ScrollInteraction, [{
    key: "run",
    value: function run() {
      if (window.scrollY === this.currentScrollFromTop) {
        return false;
      }

      this.onScrollMovement();
      this.currentScrollFromTop = window.scrollY;
    }
  }, {
    key: "onScrollMovement",
    value: function onScrollMovement() {
      this.updateMotionFxDimensions();
      this.updateAnimation();
      this.resetTransitionVariable();
    }
  }, {
    key: "resetTransitionVariable",
    value: function resetTransitionVariable() {
      this.motionFX.$element.css('--e-transform-transition-duration', '100ms');
    }
  }, {
    key: "updateMotionFxDimensions",
    value: function updateMotionFxDimensions() {
      var motionFXSettings = this.motionFX.getSettings();

      if (motionFXSettings.refreshDimensions) {
        this.motionFX.defineDimensions();
      }
    }
  }, {
    key: "updateAnimation",
    value: function updateAnimation() {
      var passedRangePercents;

      if ('page' === this.motionFX.getSettings('range')) {
        passedRangePercents = elementorModules.utils.Scroll.getPageScrollPercentage();
        this.runCallback(passedRangePercents);
        return;
      }

      if (this.motionFX.getSettings('isFixedPosition')) {
        passedRangePercents = elementorModules.utils.Scroll.getPageScrollPercentage({}, window.innerHeight);
        this.runCallback(passedRangePercents);
        return;
      }

      passedRangePercents = elementorModules.utils.Scroll.getElementViewportPercentage(this.motionFX.elements.$parent);
      this.runCallback(passedRangePercents);
    }
  }]);
  return ScrollInteraction;
}(_base["default"]);

var _default = ScrollInteraction;
exports["default"] = _default;

},{"./base":8,"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/createClass":55,"@babel/runtime/helpers/getPrototypeOf":58,"@babel/runtime/helpers/inherits":59,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/possibleConstructorReturn":63}],11:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _get2 = _interopRequireDefault(require("@babel/runtime/helpers/get"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

/**
 * Gets the options passed from handler, inspects the actions and
 * decides which interaction is * needed to calculate the effect
 * outcome, runs them, then instantiates Actions(action.js) to handle them.
 */
var Effects = /*#__PURE__*/function (_elementorModules$Vie) {
  (0, _inherits2["default"])(Effects, _elementorModules$Vie);

  var _super = _createSuper(Effects);

  function Effects() {
    (0, _classCallCheck2["default"])(this, Effects);
    return _super.apply(this, arguments);
  }

  (0, _createClass2["default"])(Effects, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        effectTarget: 'element',
        $element: null,
        $dimensionsElement: null,
        addBackgroundLayerTo: null,
        interactions: {},
        refreshDimensions: false,
        range: 'viewport',
        classes: {
          element: 'raven-motion-effects-element',
          parent: 'raven-motion-effects-parent',
          perspective: 'raven-motion-effects-perspective',
          // The following classes prefix is kept as "elementor" because they inherit styles from Elementor Free
          backgroundType: 'elementor-motion-effects-element-type-background',
          container: 'elementor-motion-effects-container',
          layer: 'elementor-motion-effects-layer'
        }
      };
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      this.onWindowResize = this.onWindowResize.bind(this);
      elementorFrontend.elements.$window.on('resize', this.onWindowResize);
    }
  }, {
    key: "unbindEvents",
    value: function unbindEvents() {
      elementorFrontend.elements.$window.off('resize', this.onWindowResize);
    }
  }, {
    key: "onInit",
    value: function onInit() {
      (0, _get2["default"])((0, _getPrototypeOf2["default"])(Effects.prototype), "onInit", this).call(this);
      var settings = this.getSettings();
      this.$element = settings.$element;
      this.$element.addClass(settings.classes.element);
      this.elements.$parent = this.$element.parent();
      this.elements.$parent.addClass(settings.classes.parent);

      if ('background' === settings.effectTarget) {
        this.$element.addClass(settings.classes.backgroundType);
        this.addBackgroundLayer();
      }

      this.defineDimensions();
      settings.$targetElement = 'element' === settings.effectTarget ? this.$element : this.elements.$motionFXLayer;
      this.interactions = {};
      this.actions = new (require('./actions')["default"])(settings);
      this.initInteractionsTypes();
      this.runInteractions();
    }
  }, {
    key: "defineDimensions",
    value: function defineDimensions() {
      var $dimensionsElement = this.getSettings('$dimensionsElement') || this.$element;
      var elementOffset = $dimensionsElement.offset();
      var dimensions = {
        elementHeight: $dimensionsElement.outerHeight(),
        elementWidth: $dimensionsElement.outerWidth(),
        elementTop: elementOffset.top,
        elementLeft: elementOffset.left,
        elementRange: $dimensionsElement.outerHeight() + window.innerHeight
      };
      this.setSettings('dimensions', dimensions);

      if ('background' === this.getSettings('effectTarget')) {
        this.defineBackgroundLayerDimensions();
      }
    }
  }, {
    key: "initInteractionsTypes",
    value: function initInteractionsTypes() {
      this.interactionsTypes = {
        scroll: require('./interactions/scroll')["default"],
        mouseMove: require('./interactions/mouse')["default"]
      };
    }
  }, {
    key: "runInteractions",
    value: function runInteractions() {
      var _this = this;

      var settings = this.getSettings();
      this.actions.setCSSTransformVariables(settings.elementSettings);
      this.prepareSpecialActions();
      jQuery.each(settings.interactions, function (interactionName, actions) {
        _this.interactions[interactionName] = new _this.interactionsTypes[interactionName]({
          motionFX: _this,
          callback: function callback() {
            for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
              args[_key] = arguments[_key];
            }

            jQuery.each(actions, function (actionName, actionData) {
              var _this$actions;

              return (_this$actions = _this.actions).runAction.apply(_this$actions, [actionName, actionData].concat(args));
            });
          }
        });

        _this.interactions[interactionName].run();
      });
    }
  }, {
    key: "prepareSpecialActions",
    value: function prepareSpecialActions() {
      var settings = this.getSettings();
      var hasTiltEffect = !!(settings.interactions.mouseMove && settings.interactions.mouseMove.tilt);
      this.elements.$parent.toggleClass(settings.classes.perspective, hasTiltEffect);
    }
  }, {
    key: "cleanSpecialActions",
    value: function cleanSpecialActions() {
      var settings = this.getSettings();
      this.elements.$parent.removeClass(settings.classes.perspective);
    }
  }, {
    key: "destroyInteractions",
    value: function destroyInteractions() {
      this.cleanSpecialActions();
      jQuery.each(this.interactions, function (_, interaction) {
        return interaction.destroy();
      });
      this.interactions = {};
    }
  }, {
    key: "refresh",
    value: function refresh() {
      this.actions.setSettings(this.getSettings());

      if ('background' === this.getSettings('effectTarget')) {
        this.updateBackgroundLayerSize();
        this.defineBackgroundLayerDimensions();
      }

      this.actions.refresh();
      this.destroyInteractions();
      this.runInteractions();
    }
  }, {
    key: "destroy",
    value: function destroy() {
      this.destroyInteractions();
      this.actions.refresh();
      var settings = this.getSettings();
      this.$element.removeClass(settings.classes.element);
      this.elements.$parent.removeClass(settings.classes.parent);

      if ('background' === settings.effectTarget) {
        this.$element.removeClass(settings.classes.backgroundType);
        this.removeBackgroundLayer();
      }
    }
  }, {
    key: "onWindowResize",
    value: function onWindowResize() {
      this.defineDimensions();
    } // (For Background).

  }, {
    key: "defineBackgroundLayerDimensions",
    value: function defineBackgroundLayerDimensions() {
      var dimensions = this.getSettings('dimensions');
      dimensions.layerHeight = this.elements.$motionFXLayer.height();
      dimensions.layerWidth = this.elements.$motionFXLayer.width();
      dimensions.movableX = dimensions.layerWidth - dimensions.elementWidth;
      dimensions.movableY = dimensions.layerHeight - dimensions.elementHeight;
      this.setSettings('dimensions', dimensions);
    } // (For Background).

  }, {
    key: "addBackgroundLayer",
    value: function addBackgroundLayer() {
      var settings = this.getSettings();
      this.elements.$motionFXContainer = jQuery('<div>', {
        "class": settings.classes.container
      });
      this.elements.$motionFXLayer = jQuery('<div>', {
        "class": settings.classes.layer
      });
      this.updateBackgroundLayerSize();
      this.elements.$motionFXContainer.prepend(this.elements.$motionFXLayer);
      var $addBackgroundLayerTo = settings.addBackgroundLayerTo ? this.$element.find(settings.addBackgroundLayerTo) : this.$element;
      $addBackgroundLayerTo.prepend(this.elements.$motionFXContainer);
    } // (For Background).

  }, {
    key: "removeBackgroundLayer",
    value: function removeBackgroundLayer() {
      this.elements.$motionFXContainer.remove();
    } // (For Background).

  }, {
    key: "updateBackgroundLayerSize",
    value: function updateBackgroundLayerSize() {
      var settings = this.getSettings();
      var speed = {
        x: 0,
        y: 0
      };
      var mouseInteraction = settings.interactions.mouseMove;
      var scrollInteraction = settings.interactions.scroll;

      if (mouseInteraction && mouseInteraction.translateXY) {
        speed.x = mouseInteraction.translateXY.intensity * 10;
        speed.y = mouseInteraction.translateXY.intensity * 10;
      }

      if (scrollInteraction) {
        if (scrollInteraction.translateX) {
          speed.x = scrollInteraction.translateX.intensity * 10;
        }

        if (scrollInteraction.translateY) {
          speed.y = scrollInteraction.translateY.intensity * 10;
        }
      }

      this.elements.$motionFXLayer.css({
        width: 100 + speed.x + '%',
        height: 100 + speed.y + '%'
      });
    }
  }]);
  return Effects;
}(elementorModules.ViewModule);

var _default = Effects;
exports["default"] = _default;

},{"./actions":6,"./interactions/mouse":9,"./interactions/scroll":10,"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/createClass":55,"@babel/runtime/helpers/get":57,"@babel/runtime/helpers/getPrototypeOf":58,"@babel/runtime/helpers/inherits":59,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/possibleConstructorReturn":63}],12:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

var MotionEffectsLuncher = /*#__PURE__*/function (_elementorModules$Mod) {
  (0, _inherits2["default"])(MotionEffectsLuncher, _elementorModules$Mod);

  var _super = _createSuper(MotionEffectsLuncher);

  function MotionEffectsLuncher() {
    var _this;

    (0, _classCallCheck2["default"])(this, MotionEffectsLuncher);
    _this = _super.call(this); // Hook effects handler to all elements.

    elementorFrontend.elementsHandler.attachHandler('global', require('./effects/handler')["default"], null); // Hook sticky handler to section, widget and container elements.

    elementorFrontend.elementsHandler.attachHandler('section', require('./sticky/handler')["default"], null);
    elementorFrontend.elementsHandler.attachHandler('container', require('./sticky/handler')["default"], null);
    elementorFrontend.elementsHandler.attachHandler('widget', require('./sticky/handler')["default"], null); // Run sticky script

    require('./sticky/sticky-script-manager');

    return _this;
  }

  return MotionEffectsLuncher;
}(elementorModules.Module);

var _default = MotionEffectsLuncher;
exports["default"] = _default;

},{"./effects/handler":7,"./sticky/handler":13,"./sticky/sticky-script-manager":14,"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/getPrototypeOf":58,"@babel/runtime/helpers/inherits":59,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/possibleConstructorReturn":63}],13:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _toConsumableArray2 = _interopRequireDefault(require("@babel/runtime/helpers/toConsumableArray"));

var StickyHandler = elementorModules.frontend.handlers.Base.extend({
  settingPrefix: 'raven_motion_effects',
  // This constant property value must be equal to the name of function which
  // "sticky-script-manager.js" adds to every element with sticky setting.
  stickyFunction: 'ravenSticky',
  bindEvents: function bindEvents() {
    elementorFrontend.addListenerOnce(this.getUniqueHandlerID() + this.stickyFunction, 'resize', this.refresh);
  },
  unbindEvents: function unbindEvents() {
    elementorFrontend.removeListeners(this.getUniqueHandlerID() + this.stickyFunction + 'Sticky', 'resize', this.refresh);
  },
  onInit: function onInit() {
    var _this = this;

    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);

    if (elementorFrontend.isEditMode()) {
      elementor.listenTo(elementor.channels.deviceMode, 'change', function () {
        return _this.onDeviceModeChange();
      });
    }

    this.run();
  },
  run: function run(refresh) {
    if (!this.getElementSettings(this.settingPrefix + 'sticky')) {
      this.deactivate();
      return;
    }

    var currentDeviceMode = elementorFrontend.getCurrentDeviceMode();
    var activeDevices = this.getElementSettings(this.settingPrefix + 'sticky_on');

    if (-1 === activeDevices.indexOf(currentDeviceMode)) {
      this.deactivate();
      return;
    }

    if (true === refresh) {
      this.reactivate();
      return;
    }

    if (!this.isStickyInstanceActive()) {
      this.activate();
    }
  },
  activate: function activate() {
    var elementSettings = this.getElementSettings();
    var stickyOptions = {
      to: elementSettings[this.settingPrefix + 'sticky'],
      offset: this.getResponsiveSetting(this.settingPrefix + 'sticky_offset'),
      effectsOffset: this.getResponsiveSetting(this.settingPrefix + 'sticky_effects_offset'),
      classes: {
        sticky: 'raven-sticky',
        stickyActive: 'raven-sticky--active raven-section--handles-inside',
        stickyEffects: 'raven-sticky--effects',
        spacer: 'raven-sticky__spacer'
      }
    };

    if (elementSettings[this.settingPrefix + 'sticky_parent']) {
      stickyOptions.parent = '.e-container, .elementor-widget-wrap';
    }

    var $wpAdminBar = elementorFrontend.elements.$wpAdminBar; // If admin bar in visible, add its height to sticky offset.

    if ($wpAdminBar.length && 'top' === stickyOptions.to && 'fixed' === $wpAdminBar.css('position')) {
      stickyOptions.offset += $wpAdminBar.height();
    }

    this.$element[this.stickyFunction](stickyOptions);
  },

  /**
   * Get the current active setting value for a responsive control.
   *
   * @param {string} setting
   * @return {any} - Setting value.
   */
  getResponsiveSetting: function getResponsiveSetting(setting) {
    var elementSettings = this.getElementSettings();
    return elementorFrontend.getCurrentDeviceSetting(elementSettings, setting);
  },

  /**
   * Return an array of settings names for responsive control (e.g. `settings`, `setting_tablet`, `setting_mobile` ).
   *
   * @param {string} setting
   * @return {string[]} - List of settings.
   */
  getResponsiveSettingList: function getResponsiveSettingList(setting) {
    var breakpoints = Object.keys(elementorFrontend.config.responsive.activeBreakpoints);
    return [''].concat((0, _toConsumableArray2["default"])(breakpoints)).map(function (suffix) {
      return suffix ? "".concat(setting, "_").concat(suffix) : setting;
    });
  },
  refresh: function refresh() {
    this.run(true);
  },
  reactivate: function reactivate() {
    this.deactivate();
    this.activate();
  },
  deactivate: function deactivate() {
    if (this.isStickyInstanceActive()) {
      // The following method on $element is defined in sticky-script-manager.js
      this.$element[this.stickyFunction]('destroy');
    }
  },
  isStickyInstanceActive: function isStickyInstanceActive() {
    return undefined !== this.$element.data(this.stickyFunction);
  },
  onElementChange: function onElementChange(settingKey) {
    if (-1 !== [this.settingPrefix + 'sticky', this.settingPrefix + 'sticky_on'].indexOf(settingKey)) {
      this.run(true);
    } // Settings that trigger a re-activation when changed.


    var settings = [].concat((0, _toConsumableArray2["default"])(this.getResponsiveSettingList(this.settingPrefix + 'sticky_offset')), (0, _toConsumableArray2["default"])(this.getResponsiveSettingList(this.settingPrefix + 'sticky_effects_offset')), [this.settingPrefix + 'sticky_parent']);

    if (-1 !== settings.indexOf(settingKey)) {
      this.reactivate();
    }
  },
  onDeviceModeChange: function onDeviceModeChange() {
    // setTimeout is used to run refresh() after the call stack gets empty.
    // Because the run() requests the current device mode from the CSS so it's not ready immediately.
    setTimeout(this.refresh);
  },
  onDestroy: function onDestroy() {
    elementorModules.frontend.handlers.Base.prototype.onDestroy.apply(this, arguments);
    this.deactivate();
  }
});
var _default = StickyHandler;
exports["default"] = _default;

},{"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/toConsumableArray":66}],14:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

var _stickyScript = _interopRequireDefault(require("./sticky-script"));

var functionName = 'ravenSticky';

(function ($) {
  // Add sticky manager function to prototype of every element.
  $.fn[functionName] = function (settings) {
    var isCommand = 'string' === typeof settings;
    this.each(function () {
      // If the "settings" is an object of sticky options, instantiate StickyScript with those options to handle sticky.
      if (!isCommand) {
        $(this).data(functionName, new _stickyScript["default"](this, settings));
        return;
      } // If the "settings" is a command, retrieve StickyScript instance.


      var instance = $(this).data(functionName);

      if (!instance) {
        throw Error('Trying to perform the `' + settings + '` method prior to initialization');
      }

      if (!instance[settings]) {
        throw ReferenceError('Method `' + settings + '` not found in sticky instance');
      } // Apply passed "settings" to the StickyScript instance.
      // Mainly used to call destroy() function from StickyScript.


      instance[settings].apply(instance, Array.prototype.slice.call(arguments, 1)); // Delete StickyScript instance from the element upon recieving "destroy" command.

      if ('destroy' === settings) {
        $(this).removeData(functionName);
      }
    });
    return this;
  };

  window[functionName] = _stickyScript["default"];
})(jQuery);

},{"./sticky-script":15,"@babel/runtime/helpers/interopRequireDefault":60}],15:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

/**
 * Manages sticky effects. For each element with sticky setting,
 * an instance of this class will be created.
 */
var StickyScript = /*#__PURE__*/function () {
  function StickyScript(element, userSettings) {
    (0, _classCallCheck2["default"])(this, StickyScript);
    this.prefix = 'raven';
    this.userSettings = userSettings;
    this.element = element;
    this.$element = null;
    this.isSticky = false;
    this.isFollowingParent = false;
    this.isReachedEffectsPoint = false;
    this.elements = {};
    this.settings = null;
    this.defaultSettings = {
      to: 'top',
      offset: 0,
      effectsOffset: 0,
      parent: false,
      classes: {
        sticky: 'raven-sticky',
        stickyActive: 'raven-sticky--active raven-section--handles-inside',
        stickyEffects: 'raven-sticky--effects',
        spacer: 'raven-sticky__spacer'
      }
    };
    this.init();
  }

  (0, _createClass2["default"])(StickyScript, [{
    key: "init",
    value: function init() {
      this.initSettings();
      this.initElements();
      this.bindEvents();
      this.checkPosition();
    }
  }, {
    key: "initSettings",
    value: function initSettings() {
      this.settings = jQuery.extend(true, this.defaultSettings, this.userSettings);
    }
  }, {
    key: "initElements",
    value: function initElements() {
      this.$element = $(this.element).addClass(this.settings.classes.sticky);
      this.elements.$window = $(window);

      if (this.settings.parent) {
        this.elements.$parent = this.$element.parent();

        if ('parent' !== this.settings.parent) {
          this.elements.$parent = this.elements.$parent.closest(this.settings.parent);
        }
      }
    }
  }, {
    key: "checkPosition",
    value: function checkPosition() {
      var offset = this.settings.offset;
      var distanceFromTriggerPoint;

      if (this.isSticky) {
        var spacerViewportOffset = this.getElementViewportOffset(this.elements.$spacer);
        distanceFromTriggerPoint = 'top' === this.settings.to ? spacerViewportOffset.top.fromTop - offset : -spacerViewportOffset.bottom.fromBottom - offset;

        if (this.settings.parent) {
          this.checkParent();
        }

        if (distanceFromTriggerPoint > 0) {
          this.unstick();
        }
      } else {
        var elementViewportOffset = this.getElementViewportOffset(this.$element);
        distanceFromTriggerPoint = 'top' === this.settings.to ? elementViewportOffset.top.fromTop - offset : -elementViewportOffset.bottom.fromBottom - offset;

        if (distanceFromTriggerPoint <= 0) {
          this.stick();

          if (this.settings.parent) {
            this.checkParent();
          }
        }
      }

      this.checkEffectsPoint(distanceFromTriggerPoint);
    }
  }, {
    key: "backupCSS",
    value: function backupCSS($elementBackupCSS, backupState, properties) {
      var elementStyle = $elementBackupCSS[0].style;
      var css = {};
      properties.forEach(function (property) {
        css[property] = undefined !== elementStyle[property] ? elementStyle[property] : '';
      });
      $elementBackupCSS.data(this.prefix + '-css-backup-' + backupState, css);
    }
  }, {
    key: "getCSSBackup",
    value: function getCSSBackup($elementCSSBackup, backupState) {
      return $elementCSSBackup.data(this.prefix + '-css-backup-' + backupState);
    }
  }, {
    key: "addSpacer",
    value: function addSpacer() {
      this.elements.$spacer = this.$element.clone().addClass(this.settings.classes.spacer).css({
        visibility: 'hidden',
        transition: 'none',
        animation: 'none'
      });
      this.$element.after(this.elements.$spacer);
    }
  }, {
    key: "removeSpacer",
    value: function removeSpacer() {
      this.elements.$spacer.remove();
    }
  }, {
    key: "stickElement",
    value: function stickElement() {
      this.backupCSS(this.$element, 'unsticky', ['position', 'width', 'margin-top', 'margin-bottom', 'top', 'bottom']);
      var css = {
        position: 'fixed',
        width: this.getElementOuterSize(this.$element, 'width'),
        marginTop: 0,
        marginBottom: 0
      };
      css[this.settings.to] = this.settings.offset;
      css['top' === this.settings.to ? 'bottom' : 'top'] = '';
      this.$element.css(css).addClass(this.settings.classes.stickyActive);
    }
  }, {
    key: "unstickElement",
    value: function unstickElement() {
      this.$element.css(this.getCSSBackup(this.$element, 'unsticky')).removeClass(this.settings.classes.stickyActive);
    }
  }, {
    key: "followParent",
    value: function followParent() {
      this.backupCSS(this.elements.$parent, 'childNotFollowing', ['position']);
      this.elements.$parent.css('position', 'relative');
      this.backupCSS(this.$element, 'notFollowing', ['position', 'top', 'bottom']);
      var css = {
        position: 'absolute'
      };
      css[this.settings.to] = '';
      css['top' === this.settings.to ? 'bottom' : 'top'] = 0;
      this.$element.css(css);
      this.isFollowingParent = true;
    }
  }, {
    key: "unfollowParent",
    value: function unfollowParent() {
      this.elements.$parent.css(this.getCSSBackup(this.elements.$parent, 'childNotFollowing'));
      this.$element.css(this.getCSSBackup(this.$element, 'notFollowing'));
      this.isFollowingParent = false;
    }
  }, {
    key: "getElementOuterSize",
    value: function getElementOuterSize($elementOuterSize, dimension, includeMargins) {
      var computedStyle = window.getComputedStyle($elementOuterSize[0]);
      var sides = 'height' === dimension ? ['top', 'bottom'] : ['left', 'right'];
      var elementSize = parseFloat(computedStyle[dimension]);
      var propertiesToAdd = [];

      if ('border-box' !== computedStyle.boxSizing) {
        propertiesToAdd.push('border', 'padding');
      }

      if (includeMargins) {
        propertiesToAdd.push('margin');
      }

      propertiesToAdd.forEach(function (property) {
        sides.forEach(function (side) {
          elementSize += parseFloat(computedStyle[property + '-' + side]);
        });
      });
      return elementSize;
    }
  }, {
    key: "getElementViewportOffset",
    value: function getElementViewportOffset($elementViewportOffset) {
      var windowScrollTop = this.elements.$window.scrollTop();
      var elementHeight = this.getElementOuterSize($elementViewportOffset, 'height');
      var viewportHeight = window.innerHeight;
      var elementOffsetFromTop = $elementViewportOffset.offset().top;
      var distanceFromTop = elementOffsetFromTop - windowScrollTop;
      var topFromBottom = distanceFromTop - viewportHeight;
      return {
        top: {
          fromTop: distanceFromTop,
          fromBottom: topFromBottom
        },
        bottom: {
          fromTop: distanceFromTop + elementHeight,
          fromBottom: topFromBottom + elementHeight
        }
      };
    }
  }, {
    key: "stick",
    value: function stick() {
      this.addSpacer();
      this.stickElement();
      this.isSticky = true;
      this.$element.trigger(this.prefix + 'Sticky:stick');
    }
  }, {
    key: "unstick",
    value: function unstick() {
      this.unstickElement();
      this.removeSpacer();
      this.isSticky = false;
      this.$element.trigger(this.prefix + 'Sticky:unstick');
    }
  }, {
    key: "checkParent",
    value: function checkParent() {
      var elementOffset = this.getElementViewportOffset(this.$element);
      var isTop = 'top' === this.settings.to;

      if (this.isFollowingParent) {
        var isNeedUnfollowing = isTop ? elementOffset.top.fromTop > this.settings.offset : elementOffset.bottom.fromBottom < -this.settings.offset;

        if (isNeedUnfollowing) {
          this.unfollowParent();
        }

        return;
      }

      var parentOffset = this.getElementViewportOffset(this.elements.$parent);
      var parentStyle = window.getComputedStyle(this.elements.$parent[0]);
      var borderWidthToDecrease = parseFloat(parentStyle[isTop ? 'borderBottomWidth' : 'borderTopWidth']);
      var parentViewportDistance = isTop ? parentOffset.bottom.fromTop - borderWidthToDecrease : parentOffset.top.fromBottom + borderWidthToDecrease;
      var isNeedFollowing = isTop ? parentViewportDistance <= elementOffset.bottom.fromTop : parentViewportDistance >= elementOffset.top.fromBottom;

      if (isNeedFollowing) {
        this.followParent();
      }
    }
  }, {
    key: "checkEffectsPoint",
    value: function checkEffectsPoint(distanceFromTriggerPoint) {
      if (this.isReachedEffectsPoint && -distanceFromTriggerPoint < this.settings.effectsOffset) {
        this.$element.removeClass(this.settings.classes.stickyEffects);
        this.isReachedEffectsPoint = false;
        return;
      }

      if (!this.isReachedEffectsPoint && -distanceFromTriggerPoint >= this.settings.effectsOffset) {
        this.$element.addClass(this.settings.classes.stickyEffects);
        this.isReachedEffectsPoint = true;
      }
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      this.scrollHandler = this.onWindowScroll.bind(this);
      this.resizeHandler = this.onWindowResize.bind(this);
      this.elements.$window.on({
        scroll: this.scrollHandler,
        resize: this.resizeHandler
      });
    }
  }, {
    key: "unbindEvents",
    value: function unbindEvents() {
      this.elements.$window.off('scroll', this.scrollHandler).off('resize', this.resizeHandler);
    }
  }, {
    key: "onWindowScroll",
    value: function onWindowScroll() {
      this.checkPosition();
    }
  }, {
    key: "onWindowResize",
    value: function onWindowResize() {
      if (!this.isSticky) {
        return;
      }

      this.unstickElement();
      this.stickElement();

      if (this.settings.parent) {
        // Force recalculation of the relation between the element and its parent
        this.isFollowingParent = false;
        this.checkParent();
      }
    }
  }, {
    key: "destroy",
    value: function destroy() {
      if (this.isSticky) {
        this.unstick();
      }

      this.unbindEvents();
      this.$element.removeClass(this.settings.classes.sticky);
    }
  }]);
  return StickyScript;
}();

var _default = StickyScript;
exports["default"] = _default;

},{"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/createClass":55,"@babel/runtime/helpers/interopRequireDefault":60}],16:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _module = _interopRequireDefault(require("./module"));

var PaginationModule = _module["default"].extend({
  $clickedItem: null,
  getDefaultSettings: function getDefaultSettings() {
    return {
      classes: {
        fetching: 'raven-pagination-fetching',
        disabled: 'raven-pagination-disabled',
        reading: 'raven-pagination-reading',
        spinner: 'raven-pagination-spinner',
        activePage: 'raven-pagination-active',
        item: 'raven-pagination-item',
        pageNum: 'raven-pagination-num',
        prevButton: 'raven-pagination-prev',
        nextButton: 'raven-pagination-next'
      },
      selectors: {
        activePage: '.raven-pagination-active',
        pageNum: '.raven-pagination-num',
        prevButton: '.raven-pagination-prev',
        nextButton: '.raven-pagination-next',
        spinner: '.raven-pagination-spinner'
      },
      isEnabled: true,
      activePage: 1,
      totalPages: this.getElementSettings('total_pages'),
      pagesVisible: this.getElementSettings('pages_visible')
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    return {
      $prevButton: this.$element.find(selectors.prevButton),
      $nextButton: this.$element.find(selectors.nextButton)
    };
  },
  bindEvents: function bindEvents() {
    var self = this;
    this.$element.on('click', this.getSettings('selectors.pageNum'), this.handlePageNum);
    self.elements.$prevButton.on('click', this.handlePrev);
    self.elements.$nextButton.on('click', this.handleNext);
  },
  onInit: function onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
  },
  getTotalPages: function getTotalPages() {
    return parseInt(this.getSettings('totalPages'));
  },
  setTotalPages: function setTotalPages(totalPages) {
    this.setSettings('totalPages', parseInt(totalPages));
  },
  getPagesVisible: function getPagesVisible() {
    return parseInt(this.getSettings('pagesVisible'));
  },
  getActivePage: function getActivePage() {
    return parseInt(this.getSettings('activePage'));
  },
  setActivePage: function setActivePage(pageNum) {
    this.setSettings('activePage', parseInt(pageNum));
  },
  setEnabled: function setEnabled(isEnabled) {
    this.setSettings('isEnabled', isEnabled);
  },
  isEnabled: function isEnabled() {
    return this.getSettings('isEnabled');
  },
  recreatePagination: function recreatePagination(totalPages) {
    this.setTotalPages(totalPages);
    this.setActivePage(1);
    this.renderUpdate();
  },
  renderUpdate: function renderUpdate() {
    var classes = this.getSettings('classes');
    var selectors = this.getSettings('selectors');
    this.$element.removeClass(classes.fetching);

    if (this.$clickedItem) {
      this.$clickedItem.find(selectors.spinner).remove();
      this.$clickedItem.removeClass(classes.reading);
      this.$clickedItem = null;
    }

    this.setEnabled(true);
    this.renderNumbers();
    this.updatePrevNext();
  },
  renderNumbers: function renderNumbers() {
    var _this = this;

    var pages = this.getPages();

    if (!pages.length) {
      return;
    }

    var selectors = this.getSettings('selectors');
    var items = [];
    pages.forEach(function (pageNum) {
      items.push(_this.numberTemplate(pageNum));
    });
    this.$element.find(selectors.pageNum).remove();
    this.elements.$prevButton.after(items);
  },
  numberTemplate: function numberTemplate(pageNum) {
    var classes = this.getSettings('classes');
    var item = $('<a></a>');
    item.addClass(classes.pageNum);
    item.addClass(classes.item);
    item.toggleClass(classes.activePage, pageNum === this.getActivePage());
    item.attr('href', '#');
    item.attr('data-page-num', pageNum);
    item.html(pageNum);
    return item;
  },
  updateActivePage: function updateActivePage(pageNum) {
    var classes = this.getSettings('classes');
    this.$element.addClass(classes.fetching);

    if (this.$clickedItem) {
      this.$clickedItem.addClass(classes.reading);
      this.$clickedItem.append("<span class=\"".concat(classes.spinner, "\"></span>"));
    }

    this.setEnabled(false);
    this.setActivePage(pageNum);
  },
  updatePrevNext: function updatePrevNext() {
    var pages = this.getPages();

    if (!pages.length) {
      return;
    }

    var classes = this.getSettings('classes');
    var activePage = this.getActivePage();
    var totalPages = this.getTotalPages();
    this.elements.$prevButton.toggleClass(classes.disabled, activePage <= 1);
    this.elements.$nextButton.toggleClass(classes.disabled, activePage >= totalPages);
  },
  handlePageNum: function handlePageNum(event) {
    event.preventDefault();
    var $this = $(event.target);
    var pageNum = parseInt($this.data('page-num'));

    if (this.getActivePage() !== pageNum) {
      this.triggerPagination($this, pageNum);
    }
  },
  handlePrev: function handlePrev(event) {
    event.preventDefault();
    var classes = this.getSettings('classes');
    var $this = $(event.target);
    var pageNum = this.getActivePage() - 1;

    if (pageNum >= 1 && !$this.hasClass(classes.disabled)) {
      this.triggerPagination($this, pageNum);
    }
  },
  handleNext: function handleNext(event) {
    event.preventDefault();
    var classes = this.getSettings('classes');
    var $this = $(event.target);
    var totalPages = this.getTotalPages();
    var pageNum = this.getActivePage() + 1;

    if (pageNum <= totalPages && !$this.hasClass(classes.disabled)) {
      this.triggerPagination($this, pageNum);
    }
  },
  triggerPagination: function triggerPagination($element, pageNum) {
    if (this.isEnabled()) {
      this.$clickedItem = $element;
      this.updateActivePage(pageNum);
      this.handlePagination(pageNum);
    }
  },
  getPages: function getPages() {
    var activePage = this.getActivePage();
    var pagesVisible = this.getPagesVisible();
    var totalPages = this.getTotalPages();
    var pages = [];
    var half = Math.floor(pagesVisible / 2);
    var start = activePage - half;
    var end = activePage + half;

    if (start <= 0) {
      start = 1;
      end = pagesVisible;
    }

    if (end > totalPages) {
      end = totalPages;
    }

    var i = start;

    while (i <= end) {
      pages.push(i);
      i++;
    }

    return pages;
  },
  handlePagination: function handlePagination() {
    this.renderUpdate();
  }
});

var _default = PaginationModule;
exports["default"] = _default;

},{"./module":5,"@babel/runtime/helpers/interopRequireDefault":60}],17:[function(require,module,exports){
// https://iamdustan.github.io/smoothscroll

/* eslint-disable */
'use strict'; // polyfill

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

var _typeof2 = _interopRequireDefault(require("@babel/runtime/helpers/typeof"));

function polyfill() {
  // aliases
  var w = window;
  var d = document; // return if scroll behavior is supported and polyfill is not forced

  if ('scrollBehavior' in d.documentElement.style && w.__forceSmoothScrollPolyfill__ !== true) {
    return;
  } // globals


  var Element = w.HTMLElement || w.Element;
  var SCROLL_TIME = 468; // object gathering original scroll methods

  var original = {
    scroll: w.scroll || w.scrollTo,
    scrollBy: w.scrollBy,
    elementScroll: Element.prototype.scroll || scrollElement,
    scrollIntoView: Element.prototype.scrollIntoView
  }; // define timing method

  var now = w.performance && w.performance.now ? w.performance.now.bind(w.performance) : Date.now;
  /**
   * indicates if a the current browser is made by Microsoft
   * @method isMicrosoftBrowser
   * @param {String} userAgent
   * @returns {Boolean}
   */

  function isMicrosoftBrowser(userAgent) {
    var userAgentPatterns = ['MSIE ', 'Trident/', 'Edge/'];
    return new RegExp(userAgentPatterns.join('|')).test(userAgent);
  }
  /*
   * IE has rounding bug rounding down clientHeight and clientWidth and
   * rounding up scrollHeight and scrollWidth causing false positives
   * on hasScrollableSpace
   */


  var ROUNDING_TOLERANCE = isMicrosoftBrowser(w.navigator.userAgent) ? 1 : 0;
  /**
   * changes scroll position inside an element
   * @method scrollElement
   * @param {Number} x
   * @param {Number} y
   * @returns {undefined}
   */

  function scrollElement(x, y) {
    this.scrollLeft = x;
    this.scrollTop = y;
  }
  /**
   * returns result of applying ease math function to a number
   * @method ease
   * @param {Number} k
   * @returns {Number}
   */


  function ease(k) {
    return 0.5 * (1 - Math.cos(Math.PI * k));
  }
  /**
   * indicates if a smooth behavior should be applied
   * @method shouldBailOut
   * @param {Number|Object} firstArg
   * @returns {Boolean}
   */


  function shouldBailOut(firstArg) {
    if (firstArg === null || (0, _typeof2["default"])(firstArg) !== 'object' || firstArg.behavior === undefined || firstArg.behavior === 'auto' || firstArg.behavior === 'instant') {
      // first argument is not an object/null
      // or behavior is auto, instant or undefined
      return true;
    }

    if ((0, _typeof2["default"])(firstArg) === 'object' && firstArg.behavior === 'smooth') {
      // first argument is an object and behavior is smooth
      return false;
    } // throw error when behavior is not supported


    throw new TypeError('behavior member of ScrollOptions ' + firstArg.behavior + ' is not a valid value for enumeration ScrollBehavior.');
  }
  /**
   * indicates if an element has scrollable space in the provided axis
   * @method hasScrollableSpace
   * @param {Node} el
   * @param {String} axis
   * @returns {Boolean}
   */


  function hasScrollableSpace(el, axis) {
    if (axis === 'Y') {
      return el.clientHeight + ROUNDING_TOLERANCE < el.scrollHeight;
    }

    if (axis === 'X') {
      return el.clientWidth + ROUNDING_TOLERANCE < el.scrollWidth;
    }
  }
  /**
   * indicates if an element has a scrollable overflow property in the axis
   * @method canOverflow
   * @param {Node} el
   * @param {String} axis
   * @returns {Boolean}
   */


  function canOverflow(el, axis) {
    var overflowValue = w.getComputedStyle(el, null)['overflow' + axis];
    return overflowValue === 'auto' || overflowValue === 'scroll';
  }
  /**
   * indicates if an element can be scrolled in either axis
   * @method isScrollable
   * @param {Node} el
   * @param {String} axis
   * @returns {Boolean}
   */


  function isScrollable(el) {
    var isScrollableY = hasScrollableSpace(el, 'Y') && canOverflow(el, 'Y');
    var isScrollableX = hasScrollableSpace(el, 'X') && canOverflow(el, 'X');
    return isScrollableY || isScrollableX;
  }
  /**
   * finds scrollable parent of an element
   * @method findScrollableParent
   * @param {Node} el
   * @returns {Node} el
   */


  function findScrollableParent(el) {
    var isBody;

    do {
      el = el.parentNode;
      isBody = el === d.body;
    } while (isBody === false && isScrollable(el) === false);

    isBody = null;
    return el;
  }
  /**
   * self invoked function that, given a context, steps through scrolling
   * @method step
   * @param {Object} context
   * @returns {undefined}
   */


  function step(context) {
    var time = now();
    var value;
    var currentX;
    var currentY;
    var elapsed = (time - context.startTime) / SCROLL_TIME; // avoid elapsed times higher than one

    elapsed = elapsed > 1 ? 1 : elapsed; // apply easing to elapsed time

    value = ease(elapsed);
    currentX = context.startX + (context.x - context.startX) * value;
    currentY = context.startY + (context.y - context.startY) * value;
    context.method.call(context.scrollable, currentX, currentY); // scroll more if we have not reached our destination

    if (currentX !== context.x || currentY !== context.y) {
      w.requestAnimationFrame(step.bind(w, context));
    }
  }
  /**
   * scrolls window or element with a smooth behavior
   * @method smoothScroll
   * @param {Object|Node} el
   * @param {Number} x
   * @param {Number} y
   * @returns {undefined}
   */


  function smoothScroll(el, x, y) {
    var scrollable;
    var startX;
    var startY;
    var method;
    var startTime = now(); // define scroll context

    if (el === d.body) {
      scrollable = w;
      startX = w.scrollX || w.pageXOffset;
      startY = w.scrollY || w.pageYOffset;
      method = original.scroll;
    } else {
      scrollable = el;
      startX = el.scrollLeft;
      startY = el.scrollTop;
      method = scrollElement;
    } // scroll looping over a frame


    step({
      scrollable: scrollable,
      method: method,
      startTime: startTime,
      startX: startX,
      startY: startY,
      x: x,
      y: y
    });
  } // ORIGINAL METHODS OVERRIDES
  // w.scroll and w.scrollTo


  w.scroll = w.scrollTo = function () {
    // avoid action when no arguments are passed
    if (arguments[0] === undefined) {
      return;
    } // avoid smooth behavior if not required


    if (shouldBailOut(arguments[0]) === true) {
      original.scroll.call(w, arguments[0].left !== undefined ? arguments[0].left : (0, _typeof2["default"])(arguments[0]) !== 'object' ? arguments[0] : w.scrollX || w.pageXOffset, // use top prop, second argument if present or fallback to scrollY
      arguments[0].top !== undefined ? arguments[0].top : arguments[1] !== undefined ? arguments[1] : w.scrollY || w.pageYOffset);
      return;
    } // LET THE SMOOTHNESS BEGIN!


    smoothScroll.call(w, d.body, arguments[0].left !== undefined ? ~~arguments[0].left : w.scrollX || w.pageXOffset, arguments[0].top !== undefined ? ~~arguments[0].top : w.scrollY || w.pageYOffset);
  }; // w.scrollBy


  w.scrollBy = function () {
    // avoid action when no arguments are passed
    if (arguments[0] === undefined) {
      return;
    } // avoid smooth behavior if not required


    if (shouldBailOut(arguments[0])) {
      original.scrollBy.call(w, arguments[0].left !== undefined ? arguments[0].left : (0, _typeof2["default"])(arguments[0]) !== 'object' ? arguments[0] : 0, arguments[0].top !== undefined ? arguments[0].top : arguments[1] !== undefined ? arguments[1] : 0);
      return;
    } // LET THE SMOOTHNESS BEGIN!


    smoothScroll.call(w, d.body, ~~arguments[0].left + (w.scrollX || w.pageXOffset), ~~arguments[0].top + (w.scrollY || w.pageYOffset));
  }; // Element.prototype.scroll and Element.prototype.scrollTo


  Element.prototype.scroll = Element.prototype.scrollTo = function () {
    // avoid action when no arguments are passed
    if (arguments[0] === undefined) {
      return;
    } // avoid smooth behavior if not required


    if (shouldBailOut(arguments[0]) === true) {
      // if one number is passed, throw error to match Firefox implementation
      if (typeof arguments[0] === 'number' && arguments[1] === undefined) {
        throw new SyntaxError('Value could not be converted');
      }

      original.elementScroll.call(this, // use left prop, first number argument or fallback to scrollLeft
      arguments[0].left !== undefined ? ~~arguments[0].left : (0, _typeof2["default"])(arguments[0]) !== 'object' ? ~~arguments[0] : this.scrollLeft, // use top prop, second argument or fallback to scrollTop
      arguments[0].top !== undefined ? ~~arguments[0].top : arguments[1] !== undefined ? ~~arguments[1] : this.scrollTop);
      return;
    }

    var left = arguments[0].left;
    var top = arguments[0].top; // LET THE SMOOTHNESS BEGIN!

    smoothScroll.call(this, this, typeof left === 'undefined' ? this.scrollLeft : ~~left, typeof top === 'undefined' ? this.scrollTop : ~~top);
  }; // Element.prototype.scrollBy


  Element.prototype.scrollBy = function () {
    // avoid action when no arguments are passed
    if (arguments[0] === undefined) {
      return;
    } // avoid smooth behavior if not required


    if (shouldBailOut(arguments[0]) === true) {
      original.elementScroll.call(this, arguments[0].left !== undefined ? ~~arguments[0].left + this.scrollLeft : ~~arguments[0] + this.scrollLeft, arguments[0].top !== undefined ? ~~arguments[0].top + this.scrollTop : ~~arguments[1] + this.scrollTop);
      return;
    }

    this.scroll({
      left: ~~arguments[0].left + this.scrollLeft,
      top: ~~arguments[0].top + this.scrollTop,
      behavior: arguments[0].behavior
    });
  }; // Element.prototype.scrollIntoView


  Element.prototype.scrollIntoView = function () {
    // avoid smooth behavior if not required
    if (shouldBailOut(arguments[0]) === true) {
      original.scrollIntoView.call(this, arguments[0] === undefined ? true : arguments[0]);
      return;
    } // LET THE SMOOTHNESS BEGIN!


    var scrollableParent = findScrollableParent(this);
    var parentRects = scrollableParent.getBoundingClientRect();
    var clientRects = this.getBoundingClientRect();

    if (scrollableParent !== d.body) {
      // reveal element inside parent
      smoothScroll.call(this, scrollableParent, scrollableParent.scrollLeft + clientRects.left - parentRects.left, scrollableParent.scrollTop + clientRects.top - parentRects.top); // reveal parent in viewport unless is fixed

      if (w.getComputedStyle(scrollableParent).position !== 'fixed') {
        w.scrollBy({
          left: parentRects.left,
          top: parentRects.top,
          behavior: 'smooth'
        });
      }
    } else {
      // reveal element in viewport
      w.scrollBy({
        left: clientRects.left,
        top: clientRects.top,
        behavior: 'smooth'
      });
    }
  };
}

if ((typeof exports === "undefined" ? "undefined" : (0, _typeof2["default"])(exports)) === 'object' && typeof module !== 'undefined') {
  // commonjs
  module.exports = {
    polyfill: polyfill
  };
  polyfill();
} else {
  // global
  polyfill();
}

},{"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/typeof":67}],18:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _module = _interopRequireDefault(require("./module"));

var SortableModule = _module["default"].extend({
  $clickedItem: null,
  getDefaultSettings: function getDefaultSettings() {
    return {
      classes: {
        fetching: 'raven-sortable-fetching',
        reading: 'raven-sortable-reading',
        spinner: 'raven-sortable-spinner',
        activeItem: 'raven-sortable-active'
      },
      selectors: {
        item: '.raven-sortable-item',
        activeItem: '.raven-sortable-active',
        spinner: '.raven-sortable-spinner'
      },
      activeID: -1,
      isEnabled: true
    };
  },
  getDefaultElements: function getDefaultElements() {
    return {};
  },
  bindEvents: function bindEvents() {
    this.$element.on('click', this.getSettings('selectors.item'), this.handleItemClick);
  },
  onInit: function onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
  },
  getActiveID: function getActiveID() {
    return parseInt(this.getSettings('activeID'));
  },
  setActiveID: function setActiveID(activeID) {
    this.setSettings('activeID', parseInt(activeID));
  },
  setEnabled: function setEnabled(isEnabled) {
    this.setSettings('isEnabled', isEnabled);
  },
  isEnabled: function isEnabled() {
    return this.getSettings('isEnabled');
  },
  renderUpdate: function renderUpdate() {
    var classes = this.getSettings('classes');
    var selectors = this.getSettings('selectors');
    this.$element.removeClass(classes.fetching);
    this.$element.find(selectors.activeItem).removeClass(classes.activeItem);

    if (this.$clickedItem) {
      this.$clickedItem.find(selectors.spinner).remove();
      this.$clickedItem.removeClass(classes.reading);
      this.$clickedItem.addClass(classes.activeItem);
      this.$clickedItem = null;
    }

    this.setEnabled(true);
  },
  updateActiveItem: function updateActiveItem(category) {
    var classes = this.getSettings('classes');
    this.$element.addClass(classes.fetching);

    if (this.$clickedItem) {
      this.$clickedItem.addClass(classes.reading);
      this.$clickedItem.append("<span class=\"".concat(classes.spinner, "\"></span>"));
    }

    this.setEnabled(false);
    this.setActiveID(category);
  },
  handleItemClick: function handleItemClick(event) {
    event.preventDefault();
    var $this = $(event.target);
    var category = parseInt($this.data('category'));

    if (this.getActiveID() !== category) {
      this.triggerSort($this, category);
    }
  },
  triggerSort: function triggerSort($element, category) {
    if (this.isEnabled()) {
      this.$clickedItem = $element;
      this.updateActiveItem(category);
      this.handleSort(category);
    }
  },
  handleSort: function handleSort() {
    this.renderUpdate();
  }
});

var _default = SortableModule;
exports["default"] = _default;

},{"./module":5,"@babel/runtime/helpers/interopRequireDefault":60}],19:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

var _tippy = _interopRequireDefault(require("tippy.js"));

var JupiterTooltip = {
  widgetEditorSettings: function widgetEditorSettings(widgetId) {
    var editorElements = null,
        widgetData = {};

    if (!window.elementor.hasOwnProperty('elements')) {
      return false;
    }

    editorElements = window.elementor.elements;

    if (!editorElements.models) {
      return false;
    }

    $.each(editorElements.models, function (indexLevelOne, objLevelOne) {
      $.each(objLevelOne.attributes.elements.models, function (indexLevelTwo, objLevelTwo) {
        $.each(objLevelTwo.attributes.elements.models, function (index, obj) {
          if (widgetId === obj.id) {
            widgetData = obj.attributes.settings.attributes;
          }
        });
      });
    });
    return {
      tooltip: widgetData.jupiter_widget_tooltip || 'false',
      tooltipDescription: widgetData.jupiter_widget_tooltip_description || 'Lorem Ipsum',
      tooltipPlacement: widgetData.jupiter_widget_tooltip_placement || 'top',
      tooltipArrow: 'yes' === widgetData.jupiter_widget_tooltip_arrow,
      xOffset: widgetData.jupiter_widget_tooltip_x_offset || 0,
      yOffset: widgetData.jupiter_widget_tooltip_y_offset || 0,
      tooltipAnimation: widgetData.jupiter_widget_tooltip_animation || 'shift-toward',
      tooltipTrigger: widgetData.jupiter_widget_tooltip_trigger || 'mouseenter',
      customSelector: widgetData.jupiter_widget_tooltip_custom_selector || '',
      zIndex: widgetData.jupiter_widget_tooltip_z_index || '999',
      delay: widgetData.jupiter_widget_tooltip_delay || '0'
    };
  },
  jupiterTooltipInstance: function jupiterTooltipInstance($scope) {
    var widgetId = $scope.data('id'),
        widgetSelector = $scope[0],
        editMode = Boolean(elementorFrontend.isEditMode());
    var tooltipSelector = widgetSelector,
        settings = {};

    if (!editMode) {
      settings = $scope.data('jupiter-tooltip-settings');
    } else {
      settings = JupiterTooltip.widgetEditorSettings(widgetId);
    }

    if (widgetSelector._tippy) {
      widgetSelector._tippy.destroy();
    }

    if (!settings) {
      return false;
    }

    if ('undefined' === typeof settings) {
      return false;
    }

    if ('false' === settings.tooltip || 'undefined' === typeof settings.tooltip || '' === settings.tooltipDescription) {
      return false;
    }

    $scope.addClass('jupiter-tooltip-widget');

    if (settings.customSelector) {
      tooltipSelector = $(settings.customSelector)[0];
    }

    if (editMode && !$('#jupiter-tooltip-content-' + widgetId)[0]) {
      var template = $('<div>', {
        id: 'jupiter-tooltip-content-' + widgetId,
        "class": 'jupiter-tooltip-widget__content'
      });
      template.html(settings.tooltipDescription);
      $scope.append(template);
    }

    (0, _tippy["default"])([tooltipSelector], {
      content: $scope.find('.jupiter-tooltip-widget__content')[0].innerHTML,
      allowHTML: true,
      appendTo: widgetSelector,
      arrow: !!settings.tooltipArrow,
      placement: settings.tooltipPlacement,
      offset: [settings.xOffset, settings.yOffset],
      animation: settings.tooltipAnimation,
      trigger: settings.tooltipTrigger,
      interactive: true,
      zIndex: settings.zIndex,
      maxWidth: 'none',
      delay: settings.delay.size ? settings.delay.size : 0,
      popperOptions: {
        strategy: 'fixed'
      },
      onMount: function onMount(instance) {
        var tippyBottomArrow = $('#tippy-' + instance.id + ' .tippy-box[data-placement^=top]>.tippy-arrow');
        var tippyTopArrow = $('#tippy-' + instance.id + ' .tippy-box[data-placement^=bottom]>.tippy-arrow');
        var tippyRightArrow = $('#tippy-' + instance.id + ' .tippy-box[data-placement^=left]>.tippy-arrow');
        var tippyLeftArrow = $('#tippy-' + instance.id + ' .tippy-box[data-placement^=right]>.tippy-arrow');
        var tippyBox = $('#tippy-' + instance.id + ' .tippy-box');

        switch (settings.tooltipPlacement) {
          case 'top-start':
          case 'top':
          case 'top-end':
            tippyBottomArrow.css('bottom', '-' + tippyBox.css('border-bottom-width'));
            break;

          case 'right-start':
          case 'right':
          case 'right-end':
            tippyLeftArrow.css('left', '-' + tippyBox.css('border-left-width'));
            break;

          case 'bottom-start':
          case 'bottom':
          case 'bottom-end':
            tippyTopArrow.css('top', '-' + tippyBox.css('border-top-width'));
            break;

          case 'left-start':
          case 'left':
          case 'left-end':
            tippyRightArrow.css('right', '-' + tippyBox.css('border-right-width'));
            break;
        }
      }
    });

    if (editMode && widgetSelector._tippy) {
      widgetSelector._tippy.show();
    }
  }
};
elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
  new JupiterTooltip.jupiterTooltipInstance($scope);
});

},{"@babel/runtime/helpers/interopRequireDefault":60,"tippy.js":85}],20:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

$ = jQuery;

var AddToCart = _module["default"].extend({
  getDefaultSettings: function getDefaultSettings() {
    return {
      selectors: {
        cartForm: 'form.cart',
        tableBody: 'tbody',
        singleVariationWrapper: '.single_variation_wrap',
        qty: '.quantity > div',
        plusMinus: '.plus-minus-btn',
        qtyInput: '.quantity .raven-qty-button-holder-inner input[type=number]',
        qtyInputText: '.quantity input[type=text]',
        formResetButton: '.artbees-was-reset-options'
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    return {
      $cartForm: this.$element.find(selectors.cartForm),
      $tableBody: this.$element.find(selectors.tableBody),
      $singleVariationWrapper: this.$element.find(selectors.singleVariationWrapper),
      $qty: this.$element.find(selectors.qty),
      $plusMinus: this.$element.find(selectors.plusMinus),
      $qtyInput: this.$element.find(selectors.qtyInput),
      $qtyInputText: this.$element.find(selectors.qtyInputText),
      $formResetButton: this.$element.find(selectors.formResetButton)
    };
  },
  bindEvents: function bindEvents() {
    var variationForm = $('form.variation_form.cart');
    variationForm.trigger('check_variations');
    variationForm.trigger('reload_product_variations');
    variationForm.trigger('woocommerce_update_variation_values');
    variationForm.trigger('found_variation');
    variationForm.trigger('woocommerce_variation_select_change');
    this.detectSellKitSwatch();
    this.detectPlusMinus();
    this.detectInputFocused();
    this.removeInputSpinner();
    this.moveResetButtonToTableBody();
    this.onResetClearButton();
    this.addDummyPriceToEditor();
  },
  detectSellKitSwatch: function detectSellKitSwatch() {
    var form = $('.variations_form'),
        row = form.find('tr');
    row.each(function (index, current) {
      var selected = $(current).find('select').val(),
          options = form.find('.artbees-was-swatch'),
          wasFields = $(current).find('.artbees-was-swatch'),
          wasSelect = $(current).find('select');

      if ($(wasFields).find('.artbees-was-content').length === 0) {
        $(wasSelect).addClass('enabled-fields');
      }

      options.each(function (indexOption, option) {
        if ($(option).data('term') === selected) {
          $(option).find('.artbees-was-content').addClass('selected-attribute');
        }
      });
    });
  },
  detectPlusMinus: function detectPlusMinus() {
    this.elements.$plusMinus.on('click', function (event) {
      var $target = $(event.currentTarget);
      var qty = $target.closest('form.cart').find('.qty');
      var val = parseFloat(qty.val());
      var max = parseFloat(qty.attr('max'));
      var min = parseFloat(qty.attr('min'));
      var step = parseFloat(qty.attr('step'));

      if ($target.is('.plus')) {
        if (max && max <= val) {
          qty.val(max);
        } else {
          qty.val(val + step);
        }
      } else if ($target.is('.minus')) {
        if (min && min >= val) {
          qty.val(min);
        } else if (val > 1) {
          qty.val(val - step);
        }
      }
    });
  },
  detectInputFocused: function detectInputFocused() {
    this.elements.$qtyInput.on('focus', function (event) {
      var $target = $(event.currentTarget);
      var $btnHolder = $target.closest('.raven-qty-button-holder-inner');
      $btnHolder.addClass('focused');
    });
    this.elements.$qtyInput.on('focusout', function (event) {
      var $target = $(event.currentTarget);
      var $btnHolder = $target.closest('.raven-qty-button-holder-inner');
      $btnHolder.removeClass('focused');
    });
  },
  removeInputSpinner: function removeInputSpinner() {
    this.elements.$qty.removeClass('input-group');
    this.elements.$qty.removeClass('qty');
    this.elements.$qty.find('.input-group-prepend').remove();
    this.elements.$qty.find('.input-group-append').remove();
    this.elements.$qtyInputText.attr('type', 'number');
  },
  moveResetButtonToTableBody: function moveResetButtonToTableBody() {
    var resetButton = this.elements.$formResetButton;
    this.elements.$formResetButton.remove();
    this.elements.$tableBody.append(resetButton);
  },
  onResetClearButton: function onResetClearButton() {
    if (this.elements.$formResetButton.length === 0) {
      return;
    }

    this.elements.$formResetButton[0].addEventListener('click', function () {
      var $swatches = document.getElementsByClassName('artbees-was-content');

      if (!$swatches) {
        return;
      }

      Object.entries($swatches).forEach(function (swatch) {
        swatch[1].classList.remove('selected-attribute');
      });
    });
  },
  addDummyPriceToEditor: function addDummyPriceToEditor() {
    if (!this.isElementorEditor() || !this.isVariableProduct()) {
      return;
    }

    var dummyPriceHTML = '<div class="woocommerce-variation-price"><span class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>20.00</bdi></span></span></div>';
    this.elements.$singleVariationWrapper.prepend(dummyPriceHTML);
  },
  isElementorEditor: function isElementorEditor() {
    return document.body.classList.contains('elementor-editor-active');
  },
  isVariableProduct: function isVariableProduct() {
    if (this.elements.$cartForm.length === 0) {
      return;
    }

    return this.elements.$cartForm[0].classList.contains('variations_form');
  }
});

function _default($scope) {
  new AddToCart({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],21:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _defineProperty2 = _interopRequireDefault(require("@babel/runtime/helpers/defineProperty"));

var _module = _interopRequireDefault(require("../utils/module"));

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { (0, _defineProperty2["default"])(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

var $ = jQuery;

var AdvancedNavMenu = _module["default"].extend({
  mainLayout: null,
  mobileLayout: null,
  isRtl: false,
  widgetParents: {},
  getDefaultSettings: function getDefaultSettings() {
    return {
      selectors: {
        menus: 'ul.raven-adnav-menu',
        mainNav: 'nav.raven-adnav-menu-main',
        mainMenu: 'nav.raven-adnav-menu-main ul.raven-adnav-menu',
        mobileNav: 'nav.raven-adnav-menu-mobile',
        mobileMenu: 'nav.raven-adnav-menu-mobile ul.raven-adnav-menu',
        inPageMenuItems: 'a[href*="#"]',
        toggleButton: '.raven-adnav-menu-toggle-button',
        closeButton: '.raven-adnav-menu-close-button',
        rootListItems: 'ul.raven-adnav-menu > li'
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    var elements = {
      $body: $('body'),
      $menus: this.$element.find(selectors.menus),
      $mainNav: this.$element.find(selectors.mainNav),
      $mainMenu: this.$element.find(selectors.mainMenu),
      $mobileNav: this.$element.find(selectors.mobileNav),
      $mobileMenu: this.$element.find(selectors.mobileMenu),
      $inPageMenuItems: this.$element.find(selectors.inPageMenuItems),
      $toggleButton: this.$element.find(selectors.toggleButton),
      $closeButton: this.$element.find(selectors.closeButton),
      $rootListItems: this.$element.find(selectors.rootListItems),
      $elementorElement: this.$element.closest('.elementor-element'),
      // $parentSegment is only for handling z-indices during side menus push/overlay effects.
      // Possible values: page's header\main\footer.
      $parentSegment: this.$element.parentsUntil('div.jupiterx-site').last()
    };
    return elements;
  },
  onInit: function onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
    this.mainLayout = this.elements.$mainNav.attr('data-layout');
    this.mobileLayout = this.elements.$mobileNav.length ? this.elements.$mobileNav.attr('data-layout') : false;
    this.isRtl = $('body').hasClass('rtl'); // This editor check is placed to trigger "Submenu" section activation when the section is
    // already open, but the widget rerenders without firing of 'section:activated' event.

    if (this.isEdit && 'section_submenu' === elementor.panel.currentView.currentPageView.activeSection) {
      this.onSectionActivated('section_submenu');
    } // Reset styles of push effects.


    this.deactivateMenu();
    $(window).off('resize', this.deactivateMenu.bind(this)).on('resize', this.deactivateMenu.bind(this));
    this.widgetParents = {
      widget: this.$element,
      column: this.getParentColumn(),
      section: this.getParentSection(),
      container: this.getParentContainer()
    };
    this.initMainSmartMenu();
    this.initMobileSmartMenu();
    this.updateActiveListItems();
    this.inPageMenuClick();
    this.mobileMenuScroll();
  },
  bindEvents: function bindEvents() {
    // Main menu events.
    var mainLayout = this.elements.$mainNav.attr('data-layout');

    if ('dropdown' === mainLayout) {
      this.elements.$toggleButton.on('click', this.toggleDropdown.bind(this));
    }

    if ('offcanvas' === mainLayout) {
      this.elements.$toggleButton.on('click', this.toggleMenu.bind(this));
      this.elements.$closeButton.on('click', this.toggleMenu.bind(this));
      this.elements.$menus.on('select.smapi', this.onSideMenuItemClick.bind(this));
      var effect = this.getElementSettings('offcanvas_appear_effect');
      this.elements.$body.addClass("raven-adnav-menu-effect-".concat(effect));
      this.elements.$toggleButton.on('click', this.doSideMenuEffects.bind(this));
      this.elements.$closeButton.on('click', this.doSideMenuEffects.bind(this));
    } // Mobile menu events


    var mobileLayout = this.elements.$mobileNav.attr('data-layout');

    if ('dropdown' === mobileLayout) {
      this.elements.$toggleButton.on('click', this.toggleDropdown.bind(this));
      return;
    }

    if ('side' === mobileLayout) {
      this.elements.$toggleButton.on('click', this.toggleMenu.bind(this));
      this.elements.$closeButton.on('click', this.toggleMenu.bind(this));
      this.elements.$menus.on('select.smapi', this.onSideMenuItemClick.bind(this));

      var _effect = this.getElementSettings('side_menu_effect');

      this.elements.$body.addClass("raven-adnav-menu-effect-".concat(_effect));
      this.elements.$toggleButton.on('click', this.doSideMenuEffects.bind(this));
      this.elements.$closeButton.on('click', this.doSideMenuEffects.bind(this));
      return;
    }

    if ('full-screen' === mobileLayout) {
      this.elements.$toggleButton.on('click', this.toggleMenu.bind(this));
      this.elements.$closeButton.on('click', this.toggleMenu.bind(this));
    }
  },
  initMainSmartMenu: function initMainSmartMenu() {
    var _this = this;

    // Options common between all layout.
    var options = {
      subIndicators: false,
      rightToLeftSubMenus: this.isRtl
    };
    var spaceBetween = parseInt(this.$element.css('--submenu-spacing')) || 0; // Options specific to Horizontal AND Vertical layouts.

    if ('horizontal' === this.mainLayout || 'vertical' === this.mainLayout) {
      options = _objectSpread(_objectSpread({}, options), {}, {
        hideTimeout: 300,
        // To prevent submenus from disappearing right upon mouseout event.
        hideFunction: function hideFunction($ul) {
          $ul.removeClass('submenu-shown');
          setTimeout(function () {
            return $ul.css('display', 'none');
          }, 0);
        },
        showTimeout: 0,
        showFunction: function showFunction($ul) {
          _this.setSubmenuWidth($ul, spaceBetween);

          _this.setSubmenuPosition($ul);

          $ul.css('display', 'block');
          setTimeout(function () {
            return $ul.addClass('submenu-shown');
          });
        },
        showOnClick: 'click' === this.getElementSettings('submenu_trigger'),
        subMenusMinWidth: '0',
        subMenusMaxWidth: '110vw'
      });
    } // Options specific to Horizontal layout.


    if ('horizontal' === this.mainLayout) {
      options = _objectSpread(_objectSpread({}, options), {}, {
        bottomToTopSubMenus: 'top' === this.getElementSettings('submenu_opening_position'),
        mainMenuSubOffsetY: spaceBetween
      });
    } // Vertical layout.


    if ('vertical' === this.mainLayout) {
      this.elements.$mainMenu.addClass('sm-vertical');
    }

    this.elements.$mainMenu.smartmenus(options);
  },
  initMobileSmartMenu: function initMobileSmartMenu() {
    if (!this.elements.$mobileMenu.length) {
      return;
    }

    var options = {
      subIndicators: false,
      subMenusMaxWidth: '1500px',
      rightToLeftSubMenus: this.isRtl
    };
    this.elements.$mobileMenu.smartmenus(options);
  },
  toggleDropdown: function toggleDropdown() {
    this.elements.$toggleButton.find('.hamburger').toggleClass('is-active');

    if ('dropdown' === this.mainLayout) {
      this.elements.$mainNav.slideToggle(250);
      return;
    }

    this.dropdownFullWidth();
    this.elements.$mobileNav.slideToggle(250);
    this.dropdownFullWidth();
  },
  dropdownFullWidth: function dropdownFullWidth() {
    var _mobileNav$;

    var mobileNav = this.elements.$mobileNav;

    if (this.getElementSettings('full_width') !== 'stretch') {
      return;
    }

    var navLeftToBodyDist = (_mobileNav$ = mobileNav[0]) === null || _mobileNav$ === void 0 ? void 0 : _mobileNav$.getBoundingClientRect().x;
    this.elements.$mobileNav.css('width', "".concat(this.$element.closest('body')[0].getBoundingClientRect().width, "px")).css('left', "".concat(-navLeftToBodyDist, "px"));
    var elementorElement = this.elements.$elementorElement;
    var mobileToggle = this.elements.$toggleButton;
    var offset = elementorElement.offset().top + elementorElement.outerHeight() - mobileToggle.offset().top;
    mobileNav.css('top', offset);
  },
  doSideMenuEffects: function doSideMenuEffects() {
    var _this2 = this;

    var isOffCanvas = 'offcanvas' === this.mainLayout;
    var effect = this.getElementSettings(isOffCanvas ? 'offcanvas_appear_effect' : 'side_menu_effect'); // If the effect is "Overlay".

    if ('overlay' === effect) {
      var overlayed = this.elements.$body.hasClass('raven-adnav-menu-effect-overlayed');

      if (!overlayed) {
        this.elements.$body.addClass('raven-adnav-menu-effect-overlayed');
        this.togglePrepareParentForPushEffect();
        return;
      }

      setTimeout(function () {
        _this2.elements.$body.removeClass('raven-adnav-menu-effect-overlayed');

        _this2.togglePrepareParentForPushEffect(false);
      }, 400);
      return;
    } // If the effect is "Push"


    var sideMenuOpenPosition = this.getElementSettings(isOffCanvas ? 'offcanvas_position' : 'side_menu_alignment');
    var width = parseInt(this.$element.css(isOffCanvas ? '--offcanvas-box-width' : '--menu-container-width')) || 250;

    if (sideMenuOpenPosition === 'right') {
      width = "-".concat(width, "px");
    }

    var isPushed = this.elements.$body.hasClass('raven-adnav-menu-effect-pushed');

    if (!isPushed) {
      var marginProp = this.isRtl ? 'margin-right' : 'margin-left';
      this.elements.$body.addClass('raven-adnav-menu-effect-pushed').css(marginProp, width);
      this.togglePrepareParentForPushEffect();
      return;
    }

    this.elements.$body.removeClass('raven-adnav-menu-effect-pushed').removeAttr('style');
    this.togglePrepareParentForPushEffect(false);
  },
  togglePrepareParentForPushEffect: function togglePrepareParentForPushEffect() {
    var state = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

    if (state) {
      this.elements.$parentSegment.addClass('raven-adnav-menu-parent-segment').css('--adnav-menu-overlay-color', this.getElementSettings('offcanvas_overlay_color'));
      return;
    }

    this.elements.$parentSegment.removeClass('raven-adnav-menu-parent-segment');
  },
  toggleMenu: function toggleMenu() {
    var nav = 'offcanvas' === this.mainLayout ? this.elements.$mainNav : this.elements.$mobileNav;
    nav.toggleClass('raven-adnav-menu-active');

    if ('full-screen' === this.mobileLayout) {
      this.elements.$body.toggleClass('raven-adnav-menu-effect-overlayed');
    }

    if (nav.hasClass('raven-adnav-menu-active')) {
      nav.parents('.animated').addClass('raven-adnav-menu-parents-animation');
    } else {
      nav.parents('.animated').removeClass('raven-adnav-menu-parents-animation');
    }

    if (this.elements.$toggleButton.find('.hamburger').length !== 0) {
      this.elements.$toggleButton.find('.hamburger').toggleClass('is-active');
    }
  },
  mobileMenuScroll: function mobileMenuScroll() {
    var overlays = document.querySelectorAll('.raven-adnav-menu-mobile.raven-adnav-menu-dropdown, .raven-adnav-menu-mobile.raven-adnav-menu-full-screen');
    var _clientY = null;

    var _loop = function _loop(i) {
      overlays[i].addEventListener('touchstart', function (event) {
        if (event.targetTouches.length === 1) {
          _clientY = event.targetTouches[0].clientY;
        }
      }, false);
      overlays[i].addEventListener('touchmove', function (event) {
        if (event.targetTouches.length === 1) {
          var clientY = event.targetTouches[0].clientY - _clientY;

          if (overlays[i].scrollTop === 0 && clientY > 0 && event.cancelable) {
            event.preventDefault();
          }

          if (overlays[i].scrollHeight - overlays[i].scrollTop <= overlays[i].clientHeight && clientY < 0 && event.cancelable) {
            event.preventDefault();
          }
        }
      }, false);
    };

    for (var i = 0; i < overlays.length; i++) {
      _loop(i);
    }
  },

  /** Handle clicking on menu links that contian a hash ID to an element inside page */
  inPageMenuClick: function inPageMenuClick() {
    var self = this;
    this.elements.$inPageMenuItems.on('click', function (e) {
      var href = $(e.currentTarget).prop('href');
      var url = null; // URL interface throws error if constructed with incorrect URL.

      try {
        url = new window.URL(href);
      } catch (err) {
        return;
      } // Do nothing if the URL has no hash segment, or its unhashed segment points to another page.


      if (!url.hash || url.pathname !== window.location.pathname) {
        return;
      }

      e.preventDefault(); // Reset menu active states (side push, overlay, etc.).

      self.deactivateMenu();
      self.changeHamburgerState(false);
      window.history.pushState(null, null, url.hash);
      var anchorTarget = $(url.hash); // If the target element of the hash is not present in current document, close the menu and return.

      if (anchorTarget.length === 0) {
        return;
      } // Otherwise, scroll to the target element of the hash (with caution about sticky header, admin bar, etc.).


      var headerSettings = $('.jupiterx-header').data('jupiterx-settings');
      var behavior = headerSettings.behavior,
          overlap = headerSettings.overlap,
          position = headerSettings.position,
          template = headerSettings.template,
          stickyTemplate = headerSettings.stickyTemplate;
      var hasCustomStickyHeader = 'sticky' === behavior && (!stickyTemplate || stickyTemplate !== template);
      var isHeaderSticked = $('.jupiterx-header-sticked').length > 0;
      var tbarHieght = $('.jupiterx-tbar').outerHeight() || 0;
      var adminBarHeight = $('#wpadminbar').height() || 0;
      var bodyBorderWidth = parseInt($('.jupiterx-site-body-border').css('border-width')) || 0;
      var scrollPosition = anchorTarget.offset().top;
      scrollPosition -= adminBarHeight;
      scrollPosition -= bodyBorderWidth;
      scrollPosition -= tbarHieght;

      if (!isHeaderSticked && (!behavior || 'sticky' === behavior && overlap)) {
        scrollPosition -= tbarHieght;
      }

      if (hasCustomStickyHeader) {
        var stickyHeaderHeight = $('.jupiterx-header-custom .elementor:last-of-type').outerHeight() || 0;
        scrollPosition -= stickyHeaderHeight;
      }

      if (!hasCustomStickyHeader && ('sticky' === behavior || 'fixed' === behavior && 'top' === position)) {
        scrollPosition -= self.getHeaderHeight();
      }

      $('html, body').stop().animate({
        scrollTop: scrollPosition
      }, 500, 'swing');
    });
  },
  getHeaderHeight: function getHeaderHeight() {
    var header = $('.jupiterx-header');

    if (header.length === 0) {
      return 0;
    }

    var _header$data = header.data('jupiterx-settings'),
        behavior = _header$data.behavior;

    if (behavior === 'fixed' || behavior === 'sticky' || window.pageYOffset < header.height()) {
      return header.height();
    }

    return 0;
  },
  onElementChange: function onElementChange(propertyName) {
    if ('full_width' === propertyName) {
      this.dropdownFullWidth();
    }

    if ((propertyName.startsWith('menu_container_width') || propertyName.startsWith('offcanvas_box_width')) && this.elements.$body.hasClass('raven-adnav-menu-effect-pushed')) {
      var isOffCanvas = 'offcanvas' === this.mainLayout;
      var sideMenuOpenPosition = this.getElementSettings(isOffCanvas ? 'offcanvas_position' : 'side_menu_alignment');
      var width = parseInt(this.$element.css(isOffCanvas ? '--offcanvas-box-width' : '--menu-container-width')) || 250;

      if (sideMenuOpenPosition === 'right') {
        width = "-".concat(width, "px");
      }

      var marginProp = this.isRtl ? 'margin-right' : 'margin-left';
      this.elements.$body.css(marginProp, width);
    }

    if (propertyName === 'submenu_space_between') {
      this.elements.$menus.smartmenus('destroy');
      this.initMainSmartMenu();
    }
  },
  onSectionActivated: function onSectionActivated(activeSection) {
    if (activeSection === 'section_submenu') {
      this.forceShowSubmenu();
      this.showSubMenuInterval = setInterval(this.forceShowSubmenu, 1000);
      return;
    }

    clearInterval(this.showSubMenuInterval);
  },
  forceShowSubmenu: function forceShowSubmenu() {
    var _subMenuLink;

    var allSubMenus = this.elements.$mainMenu.find('li ul.submenu');
    var subMenuLink;
    allSubMenus.each(function () {
      if (!$(this).find('li:not(.submenu-template)').length) {
        return;
      }

      subMenuLink = $(this).prev('a.raven-menu-item');
    });

    if (!((_subMenuLink = subMenuLink) === null || _subMenuLink === void 0 ? void 0 : _subMenuLink.length) || 'none' !== subMenuLink.next('ul').css('display')) {
      return;
    }

    this.elements.$menus.smartmenus('itemActivate', subMenuLink);
  },
  onSideMenuItemClick: function onSideMenuItemClick(e, item) {
    var $el = $(item);

    if ($el.closest('.raven-adnav-menu-side,.raven-adnav-menu-offcanvas').length === 0) {
      return;
    }

    var href = $el.attr('href');

    if (href.search(/^#/) !== -1 || href.trim().length === 0) {
      return;
    }

    this.elements.$closeButton.trigger('click');
  },
  changeHamburgerState: function changeHamburgerState(active) {
    var $hamburger = this.elements.$toggleButton.find('.hamburger');

    if ($hamburger.length === 0) {
      return;
    }

    if (!active) {
      $hamburger.removeClass('is-active');
      return;
    }

    $hamburger.addClass('is-active');
  },
  updateActiveListItems: function updateActiveListItems() {
    this.elements.$rootListItems.each(function () {
      var hasActiveLink = $(this).children('a.active-link').length > 0;
      $(this).toggleClass('current-menu-item', hasActiveLink);
    });
  },
  setSubmenuWidth: function setSubmenuWidth($ul, spaceBetween) {
    var parentList = $ul.closest('li.menu-item');
    var widthSource = parentList.data('width_type'); // If width type is set to Custom, calculate it and bail out.

    if ('custom' === widthSource) {
      var customWidth = parentList.data('custom_width');
      $ul.css('width', customWidth);
      return;
    } // In vertical layout.


    if ('vertical' === this.mainLayout) {
      if ('default' === widthSource) {
        $ul.css({
          width: 'fit-content',
          'max-width': this.widgetParents.widget.get(0).getBoundingClientRect().width - this.elements.$mainMenu.get(0).getBoundingClientRect().width - spaceBetween + 'px'
        });
        return;
      }

      var _width = this.widgetParents[widthSource].get(0).getBoundingClientRect().width - this.elements.$mainMenu.get(0).getBoundingClientRect().width - spaceBetween;

      $ul.css('width', "".concat(_width, "px"));
      return;
    } // In horizontal layout.


    if ('default' === widthSource) {
      $ul.css({
        width: 'fit-content',
        'max-width': this.widgetParents.widget.get(0).getBoundingClientRect().width + 'px'
      });
      return;
    }

    var width = this.widgetParents[widthSource].get(0).getBoundingClientRect().width;
    $ul.css('width', "".concat(width, "px"));
  },
  setSubmenuPosition: function setSubmenuPosition($ul) {
    var parentList = $ul.closest('li.menu-item'); // In vertical layout.

    if ('vertical' === this.mainLayout) {
      var _posType = parentList.data('submenu_pos');

      if (!_posType || 'center' === _posType) {
        _posType = this.isRtl ? 'left' : 'right';
      }

      var subMenuSpacing = parseInt(this.$element.css('--submenu-spacing')) || 0;
      var parentListWidth = parentList.get(0).getBoundingClientRect().width + subMenuSpacing;

      var _cssRight = 'right' === _posType ? 'unset' : parentListWidth;

      var _cssLeft = 'right' === _posType ? parentListWidth : 'unset';

      $ul.css({
        left: _cssLeft,
        right: _cssRight
      });
      return;
    } // In horizontal layout.


    var widthSource = parentList.data('width_type');

    if (!['default', 'custom'].includes(widthSource)) {
      var parentX = this.widgetParents[widthSource].get(0).getBoundingClientRect().x;
      var listItemX = parentList.get(0).getBoundingClientRect().x;
      $ul.css('left', "".concat(parentX - listItemX, "px"));
      return;
    }

    var posType = parentList.data('submenu_pos');
    var cssRight = 'unset',
        cssLeft = '0';

    if ('right' === posType) {
      cssRight = '0';
      cssLeft = 'unset';
    }

    if ('center' === posType) {
      var listItemWidth = parentList.get(0).getBoundingClientRect().width;
      var submenuWidth = parseInt($ul.css('width'));
      var offset = (listItemWidth - submenuWidth) / 2;
      cssLeft = "".concat(offset, "px");
    }

    $ul.css({
      left: cssLeft,
      right: cssRight
    });
  },
  getParentSection: function getParentSection() {
    var parentSection = this.$element.closest('section[data-element_type="section"]');

    if (parentSection.length) {
      return parentSection;
    }

    var parentRootContainer = this.$element.parents('[data-element_type="container"]').last();

    if (parentRootContainer.length) {
      return parentRootContainer;
    }

    return undefined;
  },
  getParentColumn: function getParentColumn() {
    var parentColumn = this.$element.closest('div[data-element_type="column"]');

    if (parentColumn.length) {
      return parentColumn;
    }

    var nearestParentContainer = this.$element.closest('[data-element_type="container"]');

    if (nearestParentContainer.length) {
      return nearestParentContainer;
    }

    return undefined;
  },
  getParentContainer: function getParentContainer() {
    var parentContainer = this.$element.closest('[data-element_type="container"]');

    if (parentContainer.length) {
      return parentContainer;
    }

    var parentSection = this.$element.closest('section[data-element_type="section"]');

    if (parentSection.length) {
      return parentSection;
    }

    return undefined;
  },
  deactivateMenu: function deactivateMenu() {
    this.elements.$body.removeClass(['raven-adnav-menu-effect-pushed', 'raven-adnav-menu-effect-overlayed']).removeAttr('style');
    this.elements.$parentSegment.removeClass('raven-adnav-menu-parent-segment');
    this.elements.$mainNav.removeClass('raven-adnav-menu-active');
    this.elements.$mobileNav.removeClass('raven-adnav-menu-active');
    this.elements.$toggleButton.find('.hamburger').removeClass('is-active');

    if ('dropdown' === this.mobileLayout) {
      this.elements.$mobileNav.slideUp(250);
    }

    if ('dropdown' === this.mainLayout) {
      this.elements.$mainNav.slideUp(250);
    }
  }
});

function _default($scope) {
  new AdvancedNavMenu({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/defineProperty":56,"@babel/runtime/helpers/interopRequireDefault":60}],22:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

function _default($scope) {
  $scope.find('.raven-alert-dismiss').on('click', function (event) {
    event.preventDefault();
    $scope.fadeOut();
  });
}

},{}],23:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

var $ = jQuery;

var AnimatedHeading = _module["default"].extend({
  svgPaths: {
    circle: ['M325,18C228.7-8.3,118.5,8.3,78,21C22.4,38.4,4.6,54.6,5.6,77.6c1.4,32.4,52.2,54,142.6,63.7 c66.2,7.1,212.2,7.5,273.5-8.3c64.4-16.6,104.3-57.6,33.8-98.2C386.7-4.9,179.4-1.4,126.3,20.7'],
    underline_zigzag: ['M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9'],
    x: ['M497.4,23.9C301.6,40,155.9,80.6,4,144.4', 'M14.1,27.6c204.5,20.3,393.8,74,467.3,111.7'],
    strikethrough: ['M3,75h493.5'],
    curly: ['M3,146.1c17.1-8.8,33.5-17.8,51.4-17.8c15.6,0,17.1,18.1,30.2,18.1c22.9,0,36-18.6,53.9-18.6 c17.1,0,21.3,18.5,37.5,18.5c21.3,0,31.8-18.6,49-18.6c22.1,0,18.8,18.8,36.8,18.8c18.8,0,37.5-18.6,49-18.6c20.4,0,17.1,19,36.8,19 c22.9,0,36.8-20.6,54.7-18.6c17.7,1.4,7.1,19.5,33.5,18.8c17.1,0,47.2-6.5,61.1-15.6'],
    diagonal: ['M13.5,15.5c131,13.7,289.3,55.5,475,125.5'],
    "double": ['M8.4,143.1c14.2-8,97.6-8.8,200.6-9.2c122.3-0.4,287.5,7.2,287.5,7.2', 'M8,19.4c72.3-5.3,162-7.8,216-7.8c54,0,136.2,0,267,7.8'],
    double_underline: ['M5,125.4c30.5-3.8,137.9-7.6,177.3-7.6c117.2,0,252.2,4.7,312.7,7.6', 'M26.9,143.8c55.1-6.1,126-6.3,162.2-6.1c46.5,0.2,203.9,3.2,268.9,6.4'],
    underline: ['M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7']
  },
  onInit: function onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
    this.intersectionObservers = {
      startAnimation: {
        observer: null,
        element: null
      }
    };
    this.isLoopMode = 'yes' === this.getElementSettings('loop');
    this.activateScrollListener();
  },
  getDefaultSettings: function getDefaultSettings() {
    var iterationDelay = this.getElementSettings('rotate_iteration_delay'),
        settings = {
      animationDelay: iterationDelay || 2500,
      // Letters effect.
      lettersDelay: iterationDelay * 0.02 || 50,
      // Typing effect.
      typeLettersDelay: iterationDelay * 0.06 || 150,
      selectionDuration: iterationDelay * 0.2 || 500,
      // Clip effect.
      revealDuration: iterationDelay * 0.24 || 600,
      revealAnimationDelay: iterationDelay * 0.6 || 1500,
      // Highlighted heading.
      highlightAnimationDuration: this.getElementSettings('highlight_animation_duration') || 1200,
      highlightAnimationDelay: this.getElementSettings('highlight_iteration_delay') || 8000
    };
    settings.typeAnimationDelay = settings.selectionDuration + 800;
    settings.selectors = {
      heading: '.raven-heading',
      dynamicWrapper: '.raven-heading-dynamic-wrapper',
      dynamicText: '.raven-heading-dynamic-text'
    };
    settings.classes = {
      dynamicText: 'raven-heading-dynamic-text',
      dynamicLetter: 'raven-heading-dynamic-letter',
      textActive: 'raven-heading-text-active',
      textInactive: 'raven-heading-text-inactive',
      letters: 'raven-heading-letters',
      animationIn: 'raven-heading-animation-in',
      typeSelected: 'raven-heading-typing-selected',
      activateHighlight: 'raven-animated',
      hideHighlight: 'raven-hide-highlight'
    };
    return settings;
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    return {
      $heading: this.$element.find(selectors.heading),
      $dynamicWrapper: this.$element.find(selectors.dynamicWrapper),
      $dynamicText: this.$element.find(selectors.dynamicText)
    };
  },
  getNextWord: function getNextWord($word) {
    return $word.is(':last-child') ? $word.parent().children().eq(0) : $word.next();
  },
  switchWord: function switchWord($oldWord, $newWord) {
    $oldWord.removeClass('raven-heading-text-active').addClass('raven-heading-text-inactive');
    $newWord.removeClass('raven-heading-text-inactive').addClass('raven-heading-text-active');
    this.setDynamicWrapperWidth($newWord);
  },
  singleLetters: function singleLetters() {
    var classes = this.getSettings('classes');
    this.elements.$dynamicText.each(function () {
      var $word = $(this),
          letters = $word.text().split(''),
          isActive = $word.hasClass(classes.textActive);
      $word.empty();
      letters.forEach(function (letter) {
        var $letter = $('<span>', {
          "class": classes.dynamicLetter
        }).text(letter);

        if (isActive) {
          $letter.addClass(classes.animationIn);
        }

        $word.append($letter);
      });
      $word.css('opacity', 1);
    });
  },
  showLetter: function showLetter($letter, $word, thisWordHasBiggerLength, duration) {
    var self = this,
        classes = this.getSettings('classes');
    $letter.addClass(classes.animationIn);

    if (!$letter.is(':last-child')) {
      setTimeout(function () {
        self.showLetter($letter.next(), $word, thisWordHasBiggerLength, duration);
      }, duration);
      return;
    }

    if (!thisWordHasBiggerLength) {
      setTimeout(function () {
        self.hideWord($word);
      }, self.getSettings('animationDelay'));
    }
  },
  hideLetter: function hideLetter($letter, $word, thisWordHasBiggerLength, duration) {
    var self = this,
        settings = this.getSettings();
    $letter.removeClass(settings.classes.animationIn);

    if (!$letter.is(':last-child')) {
      setTimeout(function () {
        self.hideLetter($letter.next(), $word, thisWordHasBiggerLength, duration);
      }, duration);
      return;
    }

    if (thisWordHasBiggerLength) {
      setTimeout(function () {
        self.hideWord(self.getNextWord($word));
      }, self.getSettings('animationDelay'));
    }
  },
  showWord: function showWord($word, $duration) {
    var self = this,
        settings = self.getSettings(),
        animationType = self.getElementSettings('animation_type');

    if ('typing' === animationType) {
      self.showLetter($word.find('.' + settings.classes.dynamicLetter).eq(0), $word, false, $duration);
      $word.addClass(settings.classes.textActive).removeClass(settings.classes.textInactive);
      return;
    }

    if ('clip' === animationType) {
      self.elements.$dynamicWrapper.animate({
        width: $word.width() + 10
      }, settings.revealDuration, function () {
        setTimeout(function () {
          self.hideWord($word);
        }, settings.revealAnimationDelay);
      });
    }
  },
  hideWord: function hideWord($word) {
    var self = this,
        settings = self.getSettings(),
        classes = settings.classes,
        letterSelector = '.' + classes.dynamicLetter,
        animationType = self.getElementSettings('animation_type'),
        nextWord = self.getNextWord($word);

    if (!this.isLoopMode && $word.is(':last-child')) {
      return;
    }

    if ('typing' === animationType) {
      self.elements.$dynamicWrapper.addClass(classes.typeSelected);
      setTimeout(function () {
        self.elements.$dynamicWrapper.removeClass(classes.typeSelected);
        $word.addClass(settings.classes.textInactive).removeClass(classes.textActive).children(letterSelector).removeClass(classes.animationIn);
      }, settings.selectionDuration);
      setTimeout(function () {
        self.showWord(nextWord, settings.typeLettersDelay);
      }, settings.typeAnimationDelay);
      return;
    }

    if (self.elements.$heading.hasClass(classes.letters)) {
      var thisWordHasBiggerLength = $word.children(letterSelector).length >= nextWord.children(letterSelector).length;
      self.hideLetter($word.find(letterSelector).eq(0), $word, thisWordHasBiggerLength, settings.lettersDelay);
      self.showLetter(nextWord.find(letterSelector).eq(0), nextWord, thisWordHasBiggerLength, settings.lettersDelay);
      self.setDynamicWrapperWidth(nextWord);
      return;
    }

    if ('clip' === animationType) {
      self.elements.$dynamicWrapper.animate({
        width: '2px'
      }, settings.revealDuration, function () {
        self.switchWord($word, nextWord);
        self.showWord(nextWord);
      });
      return;
    }

    self.switchWord($word, nextWord);
    setTimeout(function () {
      self.hideWord(nextWord);
    }, settings.animationDelay);
  },
  setDynamicWrapperWidth: function setDynamicWrapperWidth($word) {
    var animationType = this.getElementSettings('animation_type');

    if ('clip' !== animationType && 'typing' !== animationType) {
      this.elements.$dynamicWrapper.css('width', $word.width());
    }
  },
  animateHeading: function animateHeading() {
    var self = this,
        animationType = self.getElementSettings('animation_type'),
        $dynamicWrapper = self.elements.$dynamicWrapper;

    if ('clip' === animationType) {
      $dynamicWrapper.width($dynamicWrapper.width() + 10);
    } else if ('typing' !== animationType) {
      self.setDynamicWrapperWidth(self.elements.$dynamicText);
    } // Trigger animation.


    setTimeout(function () {
      self.hideWord(self.elements.$dynamicText.eq(0));
    }, self.getSettings('animationDelay'));
  },
  getSvgPaths: function getSvgPaths(pathName) {
    var pathsInfo = this.svgPaths[pathName];
    var $paths = $();
    pathsInfo.forEach(function (pathInfo) {
      $paths = $paths.add($('<path>', {
        d: pathInfo
      }));
    });
    return $paths;
  },
  addHighlight: function addHighlight() {
    var elementSettings = this.getElementSettings(),
        $svg = $('<svg>', {
      xmlns: 'http://www.w3.org/2000/svg',
      viewBox: '0 0 500 150',
      preserveAspectRatio: 'none'
    }).html(this.getSvgPaths(elementSettings.marker));
    this.elements.$dynamicWrapper.append($svg[0].outerHTML);
  },
  rotateHeading: function rotateHeading() {
    var settings = this.getSettings(); // Insert <span> for each letter of a changing word.

    if (this.elements.$heading.hasClass(settings.classes.letters)) {
      this.singleLetters();
    } // Initialise heading animation.


    this.animateHeading();
  },
  initHeading: function initHeading() {
    var headingStyle = this.getElementSettings('heading_style');

    if ('rotate' === headingStyle) {
      this.rotateHeading();
    } else if ('highlight' === headingStyle) {
      this.addHighlight();
      this.activateHighlightAnimation();
    }

    this.deactivateScrollListener();
  },
  activateHighlightAnimation: function activateHighlightAnimation() {
    var _this = this;

    var settings = this.getSettings(),
        classes = settings.classes,
        $heading = this.elements.$heading;
    $heading.removeClass(classes.hideHighlight).addClass(classes.activateHighlight);

    if (!this.isLoopMode) {
      return;
    }

    setTimeout(function () {
      $heading.removeClass(classes.activateHighlight).addClass(classes.hideHighlight);
    }, settings.highlightAnimationDuration + settings.highlightAnimationDelay * .8);
    setTimeout(function () {
      _this.activateHighlightAnimation(false);
    }, settings.highlightAnimationDuration + settings.highlightAnimationDelay);
  },
  activateScrollListener: function activateScrollListener() {
    var _this2 = this;

    var scrollBuffer = -100;
    this.intersectionObservers.startAnimation.observer = elementorModules.utils.Scroll.scrollObserver({
      offset: "0px 0px ".concat(scrollBuffer, "px"),
      callback: function callback(event) {
        if (event.isInViewport) {
          _this2.initHeading();
        }
      }
    });
    this.intersectionObservers.startAnimation.element = this.elements.$heading[0];
    this.intersectionObservers.startAnimation.observer.observe(this.intersectionObservers.startAnimation.element);
  },
  deactivateScrollListener: function deactivateScrollListener() {
    this.intersectionObservers.startAnimation.observer.unobserve(this.intersectionObservers.startAnimation.element);
  }
});

function _default($scope) {
  new AnimatedHeading({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],24:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _regenerator = _interopRequireDefault(require("@babel/runtime/regenerator"));

var _asyncToGenerator2 = _interopRequireDefault(require("@babel/runtime/helpers/asyncToGenerator"));

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

var CarouselBase = /*#__PURE__*/function (_elementorModules$fro) {
  (0, _inherits2["default"])(CarouselBase, _elementorModules$fro);

  var _super = _createSuper(CarouselBase);

  function CarouselBase() {
    (0, _classCallCheck2["default"])(this, CarouselBase);
    return _super.apply(this, arguments);
  }

  (0, _createClass2["default"])(CarouselBase, [{
    key: "onInit",
    value: function () {
      var _onInit = (0, _asyncToGenerator2["default"])( /*#__PURE__*/_regenerator["default"].mark(function _callee() {
        var elementSettings,
            Swiper,
            _args = arguments;
        return _regenerator["default"].wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, _args);
                elementSettings = this.getElementSettings();

                if (!(1 >= this.getSlidesCount())) {
                  _context.next = 4;
                  break;
                }

                return _context.abrupt("return");

              case 4:
                Swiper = elementorFrontend.utils.swiper;
                _context.next = 7;
                return new Swiper(this.elements.$swiperContainer, this.getSwiperOptions());

              case 7:
                this.swiper = _context.sent;

                if ('yes' === elementSettings.pause_on_hover) {
                  this.togglePauseOnHover(true);
                } // Expose the swiper instance in the frontend


                this.elements.$swiperContainer.data('swiper', this.swiper);

              case 10:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function onInit() {
        return _onInit.apply(this, arguments);
      }

      return onInit;
    }()
  }, {
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          swiperContainer: '.raven-main-swiper',
          swiperSlide: '.swiper-slide'
        },
        slidesPerView: {
          widescreen: 3,
          desktop: 3,
          laptop: 3,
          tablet_extra: 3,
          tablet: 2,
          mobile_extra: 2,
          mobile: 1
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var selectors = this.getSettings('selectors'),
          elements = {
        $swiperContainer: this.$element.find(selectors.swiperContainer)
      };
      elements.$slides = elements.$swiperContainer.find(selectors.swiperSlide);
      return elements;
    }
  }, {
    key: "getEffect",
    value: function getEffect() {
      return this.getElementSettings('effect');
    }
  }, {
    key: "getDeviceSlidesPerView",
    value: function getDeviceSlidesPerView(device) {
      var slidesPerViewKey = 'slides_per_view' + ('desktop' === device ? '' : '_' + device);
      return Math.min(this.getSlidesCount(), +this.getElementSettings(slidesPerViewKey) || this.getSettings('slidesPerView')[device]);
    }
  }, {
    key: "getSlidesPerView",
    value: function getSlidesPerView(device) {
      if ('slide' === this.getEffect()) {
        return this.getDeviceSlidesPerView(device);
      }

      return 1;
    }
  }, {
    key: "getDeviceSlidesToScroll",
    value: function getDeviceSlidesToScroll(device) {
      var slidesToScrollKey = 'slides_to_scroll' + ('desktop' === device ? '' : '_' + device);
      return Math.min(this.getSlidesCount(), +this.getElementSettings(slidesToScrollKey) || 1);
    }
  }, {
    key: "getSlidesToScroll",
    value: function getSlidesToScroll(device) {
      if ('slide' === this.getEffect() || 'coverflow' === this.getElementSettings('skin')) {
        return this.getDeviceSlidesToScroll(device);
      }

      return 1;
    }
  }, {
    key: "getSpaceBetween",
    value: function getSpaceBetween(device) {
      var propertyName = 'space_between';

      if (device && 'desktop' !== device) {
        propertyName += '_' + device;
      }

      return this.getElementSettings(propertyName).size || 0;
    }
  }, {
    key: "getSwiperOptions",
    value: function getSwiperOptions() {
      var _this = this;

      var elementSettings = this.getElementSettings();
      var swiperOptions = {
        grabCursor: true,
        initialSlide: this.getInitialSlide(),
        slidesPerView: this.getSlidesPerView('desktop'),
        slidesPerGroup: this.getSlidesToScroll('desktop'),
        spaceBetween: this.getSpaceBetween(),
        loop: 'yes' === elementSettings.loop,
        speed: elementSettings.speed,
        effect: this.getEffect(),
        preventClicksPropagation: false,
        slideToClickedSlide: true,
        handleElementorBreakpoints: true
      };

      if ('yes' === elementSettings.lazyload) {
        swiperOptions.lazy = {
          loadPrevNext: true,
          loadPrevNextAmount: 1
        };
      }

      if (elementSettings.show_arrows) {
        swiperOptions.navigation = {
          prevEl: '.elementor-swiper-button-prev',
          nextEl: '.elementor-swiper-button-next'
        };
      }

      if (elementSettings.pagination) {
        swiperOptions.pagination = {
          el: '.swiper-pagination',
          type: elementSettings.pagination,
          clickable: true
        };
      }

      if ('cube' !== this.getEffect()) {
        var breakpointsSettings = {},
            breakpoints = elementorFrontend.config.responsive.activeBreakpoints;
        Object.keys(breakpoints).forEach(function (breakpointName) {
          breakpointsSettings[breakpoints[breakpointName].value] = {
            slidesPerView: _this.getSlidesPerView(breakpointName),
            slidesPerGroup: _this.getSlidesToScroll(breakpointName),
            spaceBetween: _this.getSpaceBetween(breakpointName)
          };
        });
        swiperOptions.breakpoints = breakpointsSettings;
      }

      if (elementSettings.autoplay) {
        swiperOptions.autoplay = {
          delay: elementSettings.autoplay_speed,
          disableOnInteraction: !!elementSettings.pause_on_interaction
        };
      }

      return swiperOptions;
    }
  }, {
    key: "getDeviceBreakpointValue",
    value: function getDeviceBreakpointValue(device) {
      var _this2 = this;

      if (!this.breakpointsDictionary) {
        var breakpoints = elementorFrontend.config.responsive.activeBreakpoints;
        this.breakpointsDictionary = {};
        Object.keys(breakpoints).forEach(function (breakpointName) {
          _this2.breakpointsDictionary[breakpointName] = breakpoints[breakpointName].value;
        });
      }

      return this.breakpointsDictionary[device];
    }
  }, {
    key: "updateSpaceBetween",
    value: function updateSpaceBetween(propertyName) {
      var deviceMatch = propertyName.match('space_between_(.*)'),
          device = deviceMatch ? deviceMatch[1] : 'desktop',
          newSpaceBetween = this.getSpaceBetween(device);

      if ('desktop' !== device) {
        this.swiper.params.breakpoints[this.getDeviceBreakpointValue(device)].spaceBetween = newSpaceBetween;
      }

      this.swiper.params.spaceBetween = newSpaceBetween;
      this.swiper.update();
    }
  }, {
    key: "getChangeableProperties",
    value: function getChangeableProperties() {
      return {
        autoplay: 'autoplay',
        pause_on_hover: 'pauseOnHover',
        pause_on_interaction: 'disableOnInteraction',
        autoplay_speed: 'delay',
        speed: 'speed',
        width: 'width'
      };
    }
  }, {
    key: "updateSwiperOption",
    value: function updateSwiperOption(propertyName) {
      if (0 === propertyName.indexOf('width')) {
        this.swiper.update();
        return;
      }

      var elementSettings = this.getElementSettings(),
          newSettingValue = elementSettings[propertyName],
          changeableProperties = this.getChangeableProperties();
      var propertyToUpdate = changeableProperties[propertyName],
          valueToUpdate = newSettingValue; // Handle special cases where the value to update is not the value that the Swiper library accepts

      switch (propertyName) {
        case 'autoplay':
          valueToUpdate = false;

          if (newSettingValue) {
            valueToUpdate = {
              delay: elementSettings.autoplay_speed,
              disableOnInteraction: 'yes' === elementSettings.pause_on_interaction
            };
          }

          break;

        case 'autoplay_speed':
          propertyToUpdate = 'autoplay';
          valueToUpdate = {
            delay: newSettingValue,
            disableOnInteraction: 'yes' === elementSettings.pause_on_interaction
          };
          break;

        case 'pause_on_hover':
          this.togglePauseOnHover('yes' === newSettingValue);
          break;

        case 'pause_on_interaction':
          valueToUpdate = 'yes' === newSettingValue;
          break;
      } // 'pause_on_hover' is implemented by the handler with event listeners, not the Swiper library


      if ('pause_on_hover' !== propertyName) {
        this.swiper.params[propertyToUpdate] = valueToUpdate;
      }

      this.swiper.update();
    }
  }, {
    key: "onElementChange",
    value: function onElementChange(propertyName) {
      if (1 >= this.getSlidesCount()) {
        return;
      }

      if (0 === propertyName.indexOf('width')) {
        this.swiper.update(); // If there is another thumbs slider, like in the Media Carousel widget.

        if (this.thumbsSwiper) {
          this.thumbsSwiper.update();
        }

        return;
      } // This is for handling the responsive control 'space_between'.


      if (0 === propertyName.indexOf('space_between')) {
        this.updateSpaceBetween(propertyName);
        return;
      }

      var changeableProperties = this.getChangeableProperties();

      if (changeableProperties.hasOwnProperty(propertyName)) {
        this.updateSwiperOption(propertyName);
      }
    }
  }, {
    key: "onEditSettingsChange",
    value: function onEditSettingsChange(propertyName) {
      if (1 >= this.getSlidesCount()) {
        return;
      }

      if ('activeItemIndex' === propertyName) {
        this.swiper.slideToLoop(this.getEditSettings('activeItemIndex') - 1);
      }
    }
  }]);
  return CarouselBase;
}(elementorModules.frontend.handlers.SwiperBase);

var _default = CarouselBase;
exports["default"] = _default;

},{"@babel/runtime/helpers/asyncToGenerator":53,"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/createClass":55,"@babel/runtime/helpers/getPrototypeOf":58,"@babel/runtime/helpers/inherits":59,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/possibleConstructorReturn":63,"@babel/runtime/regenerator":69}],25:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _regenerator = _interopRequireDefault(require("@babel/runtime/regenerator"));

var _asyncToGenerator2 = _interopRequireDefault(require("@babel/runtime/helpers/asyncToGenerator"));

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _get4 = _interopRequireDefault(require("@babel/runtime/helpers/get"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

var _base = _interopRequireDefault(require("../carousel/base"));

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

var MediaCarousel = /*#__PURE__*/function (_CarouselBase) {
  (0, _inherits2["default"])(MediaCarousel, _CarouselBase);

  var _super = _createSuper(MediaCarousel);

  function MediaCarousel() {
    (0, _classCallCheck2["default"])(this, MediaCarousel);
    return _super.apply(this, arguments);
  }

  (0, _createClass2["default"])(MediaCarousel, [{
    key: "onInit",
    value: function () {
      var _onInit = (0, _asyncToGenerator2["default"])( /*#__PURE__*/_regenerator["default"].mark(function _callee() {
        var _this = this;

        var slidesCount, elementSettings, loop, breakpointsSettings, breakpoints, desktopSlidesPerView, thumbsSliderOptions, Swiper;
        return _regenerator["default"].wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.next = 2;
                return (0, _get4["default"])((0, _getPrototypeOf2["default"])(MediaCarousel.prototype), "onInit", this).call(this);

              case 2:
                slidesCount = this.getSlidesCount();

                if (!(!this.isSlideshow() || 1 >= slidesCount)) {
                  _context.next = 5;
                  break;
                }

                return _context.abrupt("return");

              case 5:
                elementSettings = this.getElementSettings(), loop = 'yes' === elementSettings.loop, breakpointsSettings = {}, breakpoints = elementorFrontend.config.responsive.activeBreakpoints, desktopSlidesPerView = this.getDeviceSlidesPerView('desktop');
                Object.keys(breakpoints).forEach(function (breakpointName) {
                  breakpointsSettings[breakpoints[breakpointName].value] = {
                    slidesPerView: _this.getDeviceSlidesPerView(breakpointName),
                    spaceBetween: _this.getSpaceBetween(breakpointName)
                  };
                });
                thumbsSliderOptions = {
                  slidesPerView: desktopSlidesPerView,
                  initialSlide: this.getInitialSlide(),
                  centeredSlides: elementSettings.centered_slides,
                  slideToClickedSlide: true,
                  spaceBetween: this.getSpaceBetween(),
                  loopedSlides: slidesCount,
                  loop: loop,
                  breakpoints: breakpointsSettings,
                  handleElementorBreakpoints: true
                };

                if ('yes' === elementSettings.lazyload) {
                  thumbsSliderOptions.lazy = {
                    loadPrevNext: true,
                    loadPrevNextAmount: 1
                  };
                }

                Swiper = elementorFrontend.utils.swiper;
                _context.next = 12;
                return new Swiper(this.elements.$thumbsSwiper, thumbsSliderOptions);

              case 12:
                this.swiper.controller.control = this.thumbsSwiper = _context.sent;
                // Expose the swiper instance in the frontend
                this.elements.$thumbsSwiper.data('swiper', this.thumbsSwiper);
                this.thumbsSwiper.controller.control = this.swiper;

              case 15:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function onInit() {
        return _onInit.apply(this, arguments);
      }

      return onInit;
    }()
  }, {
    key: "isSlideshow",
    value: function isSlideshow() {
      return 'slideshow' === this.getElementSettings('skin');
    }
  }, {
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      var defaultSettings = (_get2 = (0, _get4["default"])((0, _getPrototypeOf2["default"])(MediaCarousel.prototype), "getDefaultSettings", this)).call.apply(_get2, [this].concat(args));

      if (this.isSlideshow()) {
        defaultSettings.selectors.thumbsSwiper = '.raven-thumbnails-swiper';
        defaultSettings.slidesPerView = {
          widescreen: 5,
          desktop: 5,
          laptop: 5,
          tablet_extra: 5,
          tablet: 4,
          mobile_extra: 4,
          mobile: 3
        };
      }

      return defaultSettings;
    }
  }, {
    key: "getSlidesPerViewSettingNames",
    value: function getSlidesPerViewSettingNames() {
      var _this2 = this;

      if (!this.slideshowElementSettings) {
        this.slideshowElementSettings = ['slides_per_view'];
        var activeBreakpoints = elementorFrontend.config.responsive.activeBreakpoints;
        Object.keys(activeBreakpoints).forEach(function (breakpointName) {
          _this2.slideshowElementSettings.push('slides_per_view_' + breakpointName);
        });
      }

      return this.slideshowElementSettings;
    }
  }, {
    key: "getElementSettings",
    value: function getElementSettings(setting) {
      if (-1 !== this.getSlidesPerViewSettingNames().indexOf(setting) && this.isSlideshow()) {
        setting = 'slideshow_' + setting;
      }

      return (0, _get4["default"])((0, _getPrototypeOf2["default"])(MediaCarousel.prototype), "getElementSettings", this).call(this, setting);
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var _get3;

      for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
        args[_key2] = arguments[_key2];
      }

      var selectors = this.getSettings('selectors'),
          defaultElements = (_get3 = (0, _get4["default"])((0, _getPrototypeOf2["default"])(MediaCarousel.prototype), "getDefaultElements", this)).call.apply(_get3, [this].concat(args));

      if (this.isSlideshow()) {
        defaultElements.$thumbsSwiper = this.$element.find(selectors.thumbsSwiper);
      }

      return defaultElements;
    }
  }, {
    key: "getEffect",
    value: function getEffect() {
      if ('coverflow' === this.getElementSettings('skin')) {
        return 'coverflow';
      }

      return (0, _get4["default"])((0, _getPrototypeOf2["default"])(MediaCarousel.prototype), "getEffect", this).call(this);
    }
  }, {
    key: "getSlidesPerView",
    value: function getSlidesPerView(device) {
      if (this.isSlideshow()) {
        return 1;
      }

      if ('coverflow' === this.getElementSettings('skin')) {
        return this.getDeviceSlidesPerView(device);
      }

      return (0, _get4["default"])((0, _getPrototypeOf2["default"])(MediaCarousel.prototype), "getSlidesPerView", this).call(this, device);
    }
  }, {
    key: "getSwiperOptions",
    value: function getSwiperOptions() {
      var options = (0, _get4["default"])((0, _getPrototypeOf2["default"])(MediaCarousel.prototype), "getSwiperOptions", this).call(this);

      if (this.isSlideshow()) {
        options.loopedSlides = this.getSlidesCount();
        delete options.pagination;
        delete options.breakpoints;
      }

      return options;
    }
  }]);
  return MediaCarousel;
}(_base["default"]);

function _default($scope) {
  new MediaCarousel({
    $element: $scope
  });
}

},{"../carousel/base":24,"@babel/runtime/helpers/asyncToGenerator":53,"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/createClass":55,"@babel/runtime/helpers/get":57,"@babel/runtime/helpers/getPrototypeOf":58,"@babel/runtime/helpers/inherits":59,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/possibleConstructorReturn":63,"@babel/runtime/regenerator":69}],26:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _get2 = _interopRequireDefault(require("@babel/runtime/helpers/get"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

var _base = _interopRequireDefault(require("../carousel/base"));

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

var TestimonialCarousel = /*#__PURE__*/function (_CarouselBase) {
  (0, _inherits2["default"])(TestimonialCarousel, _CarouselBase);

  var _super = _createSuper(TestimonialCarousel);

  function TestimonialCarousel() {
    (0, _classCallCheck2["default"])(this, TestimonialCarousel);
    return _super.apply(this, arguments);
  }

  (0, _createClass2["default"])(TestimonialCarousel, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      var defaultSettings = (0, _get2["default"])((0, _getPrototypeOf2["default"])(TestimonialCarousel.prototype), "getDefaultSettings", this).call(this);
      defaultSettings.slidesPerView = {
        desktop: 1
      };
      Object.keys(elementorFrontend.config.responsive.activeBreakpoints).forEach(function (breakpointName) {
        defaultSettings.slidesPerView[breakpointName] = 1;
      });

      if (defaultSettings.loop) {
        defaultSettings.loopedSlides = this.getSlidesCount();
      }

      return defaultSettings;
    }
  }, {
    key: "getEffect",
    value: function getEffect() {
      return 'slide';
    }
  }]);
  return TestimonialCarousel;
}(_base["default"]);

function _default($scope) {
  new TestimonialCarousel({
    $element: $scope
  });
}

},{"../carousel/base":24,"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/createClass":55,"@babel/runtime/helpers/get":57,"@babel/runtime/helpers/getPrototypeOf":58,"@babel/runtime/helpers/inherits":59,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/possibleConstructorReturn":63}],27:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

var _masonry = _interopRequireDefault(require("../utils/masonry"));

var Categories = _module["default"].extend({
  Masonry: null,
  onInit: function onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);

    if (this.getInstanceValue('layout') === 'masonry') {
      this.createMasonry();
    }
  },
  createMasonry: function createMasonry() {
    this.Masonry = new _masonry["default"]({
      $element: this.$element
    });
    this.Masonry.run();
  }
});

function _default($scope) {
  new Categories({
    $element: $scope
  });
}

},{"../utils/masonry":4,"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],28:[function(require,module,exports){
"use strict";

(function ($) {
  $(document).on('click', '.raven-column-link', function (event) {
    var url = $(this).data('ravenLink');
    var target = $(this).data('ravenLinkTarget');
    handleLink($(this), url, target, event);
  });

  function handleLink($element, url, target, event) {
    if ($(event.target).filter('a, a *, .no-link, .no-link *').length) {
      return true;
    }
    /**
     * Handle popup & lightbox.
     *
     * @todo Find a proper way via Elementor Pro Javascript API.
     */


    if (url.match(/^#elementor-action/)) {
      if (!$element.find('.raven-column-link-dynamic').length) {
        $element.append("<a class=\"raven-column-link-dynamic\" href=\"".concat(url, "\"></a>"));
      }

      return $element.find('.raven-column-link-dynamic').trigger('click');
    } // Handle hash (e.g. #section-id).


    if (url.match(/^#/)) {
      if ($(url).length) {
        return document.querySelector(url).scrollIntoView({
          behavior: 'smooth'
        });
      }

      return;
    } // Handle full url.


    window.open(url, target);
  }
})(jQuery);

},{}],29:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

function _default($scope) {
  var ravenContentSwitch = $scope.find('.raven-content-switch-container'),
      radioSwitch = ravenContentSwitch.find('.raven-content-switch-input'),
      contentList = ravenContentSwitch.find('.raven-content-switch-two-content'),
      defaultState = ravenContentSwitch.data('default_state'),
      primaryContentSide = contentList.find('li[data-type="raven-content-switch-monthly"]'),
      secondaryContentSide = contentList.find('li[data-type="raven-content-switch-yearly"]'),
      sides = {};
  radioSwitch.prop('checked', defaultState === 'primary');
  sides[0] = primaryContentSide;
  sides[1] = secondaryContentSide;
  radioSwitch.on('click', function (event) {
    var selectedFilter = $(event.target).val();

    if ($(this).hasClass('raven-content-switch-input-active')) {
      selectedFilter = 1;
      $('.raven-content-switch-secondary-label').toggleClass('selected');
      $('.raven-content-switch-primary-label').toggleClass('selected');
      $(this).toggleClass('raven-content-switch-input-normal raven-content-switch-input-active');
      $('.raven-content-switch-button').toggleClass('primary secondary');
      hideNotSelectedItems(sides, selectedFilter);
    } else if ($(this).hasClass('raven-content-switch-input-normal')) {
      selectedFilter = 0;
      $('.raven-content-switch-secondary-label').toggleClass('selected');
      $('.raven-content-switch-primary-label').toggleClass('selected');
      $(this).toggleClass('raven-content-switch-input-normal raven-content-switch-input-active');
      $('.raven-content-switch-button').toggleClass('primary secondary');
      hideNotSelectedItems(sides, selectedFilter);
    }
  });

  function hideNotSelectedItems(contentSides, filter) {
    $.each(contentSides, function (key) {
      if (Number.parseInt(key) !== Number.parseInt(filter)) {
        $(this).removeClass('raven-content-switch-is-visible').addClass('raven-content-switch-is-hidden');
      } else {
        $(this).addClass('raven-content-switch-is-visible').removeClass('raven-content-switch-is-hidden');
      }
    });
  }
}

},{}],30:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

function _default($scope) {
  var $el = $scope.find('[data-raven-countdown]');
  var finalDate = $el.data('raven-countdown');
  var daysLabel = $el.data('raven-days') !== undefined ? $el.data('raven-days') : 'Day%!D';
  var hoursLabel = $el.data('raven-hours') !== undefined ? $el.data('raven-hours') : 'Hour%!H';
  var minutesLabel = $el.data('raven-minutes') !== undefined ? $el.data('raven-minutes') : 'Minute%!M';
  var secondsLabel = $el.data('raven-seconds') !== undefined ? $el.data('raven-seconds') : 'Second%!S';
  $el.countdown(finalDate, function (event) {
    $el.html(event.strftime(event.strftime("\n      <div class=\"raven-countdown-box raven-flex-1\">\n        <span class=\"raven-countdown-number\">%D</span>\n        <span class=\"raven-countdown-title\"> ".concat(daysLabel, "</span>\n      </div>\n      <div class=\"raven-countdown-box raven-flex-1\">\n        <span class=\"raven-countdown-number\">%H</span>\n        <span class=\"raven-countdown-title\"> ").concat(hoursLabel, "</span>\n      </div>\n      <div class=\"raven-countdown-box raven-flex-1\">\n        <span class=\"raven-countdown-number\">%M</span>\n        <span class=\"raven-countdown-title\"> ").concat(minutesLabel, "</span>\n      </div>\n      <div class=\"raven-countdown-box raven-flex-1\">\n        <span class=\"raven-countdown-number\">%S</span>\n        <span class=\"raven-countdown-title\"> ").concat(secondsLabel, "</span>\n      </div>\n    "))));
  });
}

},{}],31:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

function _default($scope) {
  $ = jQuery;
  var $counters = $scope.find('[data-raven-counter]');
  $counters.each(function () {
    var $counter = $(this);
    elementorFrontend.waypoint($counter, function () {
      var data = $counter.data();
      var decimalDigits = data.toValue.toString().match(/\.(.*)/);

      if (decimalDigits) {
        data.rounding = decimalDigits[1].length;
      }

      data.fromValue = $.trim($counter.text());
      $counter.numerator(data);
    });
  });
}

},{}],32:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

var _i18n = require("@wordpress/i18n");

var Form = _module["default"].extend({
  form: null,
  captchaV3Ids: [],
  reCaptchaCheckTimeout: null,
  isMultiStep: false,
  itiCountry: null,
  onInit: function onInit() {
    this.form = this.$element.find('.raven-form');
    this.isMultiStep = undefined !== this.form.attr('data-step');

    if (this.isMultiStep) {
      this.handleMultiStep(this.form);
    }

    this.initializeITI();
    var dateField = this.form.find('.flatpickr[type=text]');
    var locale = {
      firstDayOfWeek: 1
    };
    var customLocale = dateField.data('locale');

    if (customLocale !== undefined && customLocale !== 'default') {
      locale = customLocale;
    }

    dateField.flatpickr({
      locale: locale,
      minuteIncrement: 1
    });
    this.initCaptcha();
    this.onSubmit();
    window.onInvalidRavenFormField = this.onInvalidRavenFormField;
  },
  onSubmit: function onSubmit() {
    var _this = this;

    var self = this;
    var form = self.form;
    form.on('submit', function (event) {
      event.preventDefault();

      if (!_this.checkSaveState()) {
        return;
      }

      form.css('opacity', 0.5);

      _this.fixTelBeforeSubmit(); // Prepare form data.


      var formData = new FormData(form[0]);
      formData.append('action', 'raven_form_frontend');
      formData.append('referrer', location.toString()); // Send request.

      jQuery.ajax({
        url: _wpUtilSettings.ajax.url,
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: self.doSuccess
      });
    });
  },
  checkSaveState: function checkSaveState() {
    if (!this.isEdit) {
      return true;
    }

    var btn = jQuery(elementor.panel.el).find('button#elementor-panel-saver-button-publish');

    if (!btn.length || btn.hasClass('elementor-disabled')) {
      this.form.prev('div.elementor-alert.elementor-alert-info').remove();
      return true;
    }

    var adminErrorsNode = "\n\t\t\t<div class=\"elementor-alert elementor-alert-info\" role=\"alert\">\n\t\t\t\t<span class=\"elementor-alert-title\">\n\t\t\t\t\t".concat((0, _i18n.__)('Please first update/publish the changes.', 'jupiterx-core'), "\n\t\t\t\t</span>\n\t\t\t</div>\n\t\t");
    this.form.before(adminErrorsNode);
    return false;
  },
  doSuccess: function doSuccess(response) {
    // Message.
    this.showMessage(response); // Download.

    if (response.data.download_url) {
      window.open(response.data.download_url, '_blank');
    } // Redirect.


    if (!$.isEmptyObject(response.data.redirect_to)) {
      window.location.href = response.data.redirect_to;
    } // Admin errors.


    if (!$.isEmptyObject(response.data.admin_errors)) {
      this.showAdminErrors(response.data.admin_errors);
    } // Reset recaptcha to initial state.


    this.captchaV3Ids.forEach(function (id) {
      return window.grecaptcha.reset(id);
    });
  },
  onInvalidRavenFormField: function onInvalidRavenFormField(event) {
    var target = event.target;
    var type = target.dataset.type;
    var validity = target.validity;
    var i18n = window.ravenFormsTranslations.validation;
    var headerHeight = $('header').height();
    var bodySelector = document.querySelector('body');

    if (validity.valueMissing) {
      target.setCustomValidity(i18n.required);
      var $top = $(target).offset().top - $(target).parent().height() - 50;

      if (bodySelector.classList.contains('jupiterx-header-fixed') || bodySelector.classList.contains('jupiterx-header-sticked')) {
        $top -= headerHeight;
      }

      $(window).scrollTop($top);
      return;
    }

    var message = '';

    switch (type) {
      case 'email':
        if (validity.typeMismatch || validity.patternMismatch) {
          message = i18n.invalidEmail;
        }

        break;

      case 'tel':
        var isITI = target.hasAttribute('data-iti-tel');

        if (isITI) {
          var validationMessages = window.ravenFormsTranslations.itiValidation;
          var inputItiInstance = window.intlTelInputGlobals.getInstance(target);
          var itiValidationCode = inputItiInstance.getValidationError();
          var areaCodeRequired = target.hasAttribute('data-iti-area-required');
          var mustBeTelType = target.getAttribute('data-iti-tel-type');
          var telType = "".concat(inputItiInstance.getNumberType());

          switch (itiValidationCode) {
            case 1:
              message = validationMessages.invalidCountryCode;
              break;

            case 2:
              message = validationMessages.tooShort;
              break;

            case 3:
              message = validationMessages.tooLong;
              break;

            case 4:
              message = areaCodeRequired ? validationMessages.areaCodeMissing : '';
              break;

            case 5:
              message = validationMessages.invalidLength;
              break;

            case -99:
              message = validationMessages.invalidGeneral;
              break;

            case 0:
            default:
              if ('all' !== mustBeTelType && telType !== mustBeTelType) {
                message = validationMessages.typeMismatch[mustBeTelType];
              }

          }

          break;
        }

        if (validity.typeMismatch || validity.patternMismatch) {
          message = i18n.invalidPhone;
        }

        break;

      case 'number':
        if (validity.typeMismatch || validity.patternMismatch) {
          message = i18n.invalidNumber;
        } else if (validity.rangeOverflow) {
          message = i18n.invalidMaxValue.replace('MAX_VALUE', target.max);
        } else if (validity.rangeUnderflow) {
          message = i18n.invalidMinValue.replace('MIN_VALUE', target.min);
        }

        break;
    }

    target.setCustomValidity(message);
  },
  showMessage: function showMessage(response) {
    var form = this.form;
    form.css('opacity', 1);
    $('.raven-form-response').remove();
    form.parent().find('.elementor-alert').remove();
    form.find('small').remove();
    form.find('.raven-field-group').removeClass('raven-field-invalid');
    form.parent().removeClass('raven-form-success');
    form.parent().addClass('raven-form-error');

    if (response.success) {
      form.trigger('reset');
      form.parent().removeClass('raven-form-error');
      form.parent().addClass('raven-form-success');
    }

    $.each(response.data.errors, function (key, value) {
      var field = $('#raven-field-group-' + key);
      field.addClass('raven-field-invalid');
      field.append('<small class="raven-form-text">' + value + '</small>');
    });
    form.after('<div class="raven-form-response">' + response.data.message + '</div>');
  },
  showAdminErrors: function showAdminErrors(adminErrors) {
    var errors = '';
    $.each(adminErrors, function (key, value) {
      errors += "<li>".concat(value, "</li>");
    });
    this.form.before("\n\t\t\t<div class=\"elementor-alert elementor-alert-info\" role=\"alert\">\n\t\t\t\t<span class=\"elementor-alert-title\">\n\t\t\t\t\t".concat((0, _i18n.__)('Following messages are visible only for admin users.', 'jupiterx-core'), "\n\t\t\t\t</span>\n\t\t\t\t<div class=\"elementor-alert-description\">\n\t\t\t\t\t<ul>").concat(errors, "</ul>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t"));
  },
  initCaptcha: function initCaptcha() {
    var _window$grecaptcha;

    var captchav3 = this.form.find('.raven-g-recaptcha:last');

    if (!captchav3.length) {
      return;
    } // If Google Recaptcha API is ready, run addRecaptcha().


    if ((_window$grecaptcha = window.grecaptcha) === null || _window$grecaptcha === void 0 ? void 0 : _window$grecaptcha.render) {
      this.addRecaptcha(captchav3);
      clearTimeout(this.reCaptchaCheckTimeout);
      return;
    } // Otherwise, recheck API availability frequently.


    this.reCaptchaCheckTimeout = setTimeout(this.initCaptcha, 350);
  },
  addRecaptcha: function addRecaptcha(elementRecaptcha) {
    var _this2 = this;

    var settings = elementRecaptcha.data();
    var isV3 = 'v3' === settings.type;
    this.captchaV3Ids.forEach(function (id) {
      return window.grecaptcha.reset(id);
    });
    var widgetId = window.grecaptcha.render(elementRecaptcha[0], settings);
    this.form.on('reset error', function () {
      return window.grecaptcha.reset(widgetId);
    });

    if (!isV3) {
      elementRecaptcha.data('widgetId', widgetId);
      return;
    }

    this.captchaV3Ids.push(widgetId);
    this.form.find('button[type="submit"]').on('click', function (e) {
      e.preventDefault();
      window.grecaptcha.ready(function () {
        window.grecaptcha.execute(widgetId, {
          action: elementRecaptcha.data('action')
        }).then(function (token) {
          _this2.form.find('[name="g-recaptcha-response"]').remove();

          _this2.form.append(jQuery('<input>', {
            type: 'hidden',
            value: token,
            name: 'g-recaptcha-response'
          }));

          _this2.form.submit();
        });
      });
    });
  },
  // Multi step form ►START◄
  steps: [],
  indicators: [],
  buttons: [],
  stepsValidableFields: [],
  isProgressBar: false,
  progressMeter: null,
  handleMultiStep: function handleMultiStep(form) {
    var formStepElements = form.children('.fields-step-wrapper');
    var stepIndicators = form.children('.raven-form__indicators').children().not('.raven-form__indicators__indicator__separator');
    var stepButtons = form.find('.step-button-next,.step-button-prev');
    this.steps = this.jqueryToArray(formStepElements);
    this.indicators = this.jqueryToArray(stepIndicators);
    this.buttons = this.jqueryToArray(stepButtons);
    this.stepsValidableFields = this.getStepsValidableFields();
    this.isProgressBar = this.isIndicatorProgressBar();
    this.progressMeter = this.isProgressBar ? this.indicators[0].find('.raven-form__indicators__indicator__progress__meter') : null;

    if (this.isProgressBar) {
      this.updateProgressMeter(0);
    }

    this.setStepButtonsOnClicks();
  },
  jqueryToArray: function jqueryToArray(jqObj) {
    var result = [];
    jqObj.each(function (_, el) {
      result.push($(el));
    });
    return result;
  },
  getStepsValidableFields: function getStepsValidableFields() {
    var result = Array(this.steps.length);

    _.each(this.steps, function (step, i) {
      result[i] = [];
      var selection = step.find('*[oninvalid]');
      selection.each(function (_, el) {
        result[i].push($(el));
      });
    });

    return result;
  },
  setStepButtonsOnClicks: function setStepButtonsOnClicks() {
    var _this3 = this;

    _.each(this.buttons, function (button) {
      var stepKey = button.attr('data-step-key');
      var isNext = button.hasClass('step-button-next');

      if (!stepKey) {
        return;
      }

      if (isNext) {
        button.click({
          destStep: +stepKey + 1,
          totalSteps: _this3.steps.length,
          inputsToValidate: _this3.stepsValidableFields[+stepKey]
        }, function (e) {
          // Validate fields before going to next step.
          var stepValidityResult = true;

          _.each(e.data.inputsToValidate, function (field) {
            if (!field[0].checkValidity()) {
              stepValidityResult = false; // Show invalidity message.

              if (e.data.destStep - 1 < e.data.totalSteps - 1) {
                field[0].reportValidity();
              }
            }
          });

          if (stepValidityResult) {
            _this3.moveToStep(e.data.destStep);
          }
        });
      }

      if (!isNext) {
        button.click({
          destStep: +stepKey - 1
        }, function (e) {
          _this3.moveToStep(e.data.destStep);
        });
      }
    });
  },
  moveToStep: function moveToStep(stepKey) {
    _.each(this.steps, function (step, i) {
      if (i === stepKey) {
        step.removeClass('elementor-hidden');
      } else {
        step.addClass('elementor-hidden');
      }
    });

    if (this.isProgressBar) {
      this.updateProgressMeter(stepKey);
      return;
    }

    this.updateNormalIndicators(stepKey);
  },
  isIndicatorProgressBar: function isIndicatorProgressBar() {
    return this.indicators[0].hasClass('raven-form__indicators__indicator__progress');
  },
  updateNormalIndicators: function updateNormalIndicators(stepKey) {
    var _this4 = this;

    _.each(this.indicators, function (indicator, i) {
      if (i === stepKey) {
        _this4.stripStateClasses(indicator);

        indicator.addClass('raven-form__indicators__indicator--state-active');
      } else if (i > stepKey) {
        _this4.stripStateClasses(indicator);

        indicator.addClass('raven-form__indicators__indicator--state-inactive');
      } else {
        _this4.stripStateClasses(indicator);

        indicator.addClass('raven-form__indicators__indicator--state-completed');
      }
    });
  },
  stripStateClasses: function stripStateClasses(indicator) {
    indicator.removeClass('raven-form__indicators__indicator--state-active');
    indicator.removeClass('raven-form__indicators__indicator--state-inactive');
    indicator.removeClass('raven-form__indicators__indicator--state-completed');
  },
  updateProgressMeter: function updateProgressMeter(stepKey) {
    var progress = (stepKey + 1) / this.steps.length * 100;
    this.progressMeter.css({
      width: "".concat(progress, "%")
    });
    this.progressMeter.html("".concat(Math.round(progress), "%"));
  },
  // Multi step form ►END◄
  // ITI ►START◄ (ITI plugin: Intelligent Tel Input).
  initializeITI: function initializeITI() {
    var _this5 = this;

    var itiTelFields = this.form.find('input[data-iti-tel]');

    if (!itiTelFields.length) {
      return;
    }

    if (!window.itiCountry) {
      $.get('https://ipwho.is/', function () {}, 'json').always(function (response) {
        window.itiCountry = response && response.country_code ? response.country_code.toLowerCase() : 'us';

        _this5.setupTelFields(itiTelFields);
      });
    } else {
      this.setupTelFields(itiTelFields);
    }
  },
  setupTelFields: function setupTelFields(itiTelFields) {
    var iti = require('intl-tel-input');

    if (!iti) {
      return;
    }

    var allCountries = window.intlTelInputGlobals.getCountryData().map(function (item) {
      return item.iso2;
    });
    var numberTypes = ['FIXED_LINE', 'MOBILE', 'FIXED_LINE_OR_MOBILE', 'TOLL_FREE', 'PREMIUM_RATE', 'SHARED_COST', 'VOIP', 'PERSONAL_NUMBER', 'PAGER', 'UAN', 'VOICEMAIL'];

    _.each(itiTelFields, function (input) {
      var allowDropdown = input.hasAttribute('data-iti-allow-dropdown');
      var countriesAttr = input.getAttribute('data-iti-country-include');
      var countries = countriesAttr ? countriesAttr.split(' ') : null;
      var isCountriesSet = countries && countries.length;
      var ipDetect = input.hasAttribute('data-iti-ip-detect');
      var placeHolderAttr = input.getAttribute('data-iti-tel-type');
      var args = {
        allowDropdown: allowDropdown,
        utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.16/js/utils.min.js',
        separateDialCode: true,
        placeholderNumberType: 'all' === placeHolderAttr ? 'MOBILE' : numberTypes[+placeHolderAttr],
        onlyCountries: isCountriesSet ? countries : allCountries,
        initialCountry: '',
        geoIpLookup: null
      };

      if (ipDetect) {
        args.initialCountry = isCountriesSet && !countries.includes(window.itiCountry) ? countries[0] : 'auto';

        args.geoIpLookup = function (success) {
          return success(window.itiCountry);
        };
      }

      iti(input, args);
    });
  },
  fixTelBeforeSubmit: function fixTelBeforeSubmit() {
    var itiTelFields = this.form.find('input[data-iti-tel]');

    _.each(itiTelFields, function (input) {
      var internationalize = input.hasAttribute('data-iti-internationalize');

      if (internationalize) {
        var itiInstance = window.intlTelInputGlobals.getInstance(input);
        input.value = itiInstance.getNumber();
      }
    });
  } // ITI ►END◄.

});

function _default($scope) {
  new Form({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60,"@wordpress/i18n":76,"intl-tel-input":80}],33:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

var $ = jQuery;

var Hotspot = _module["default"].extend({
  getDefaultSettings: function getDefaultSettings() {
    return {
      selectors: {
        hotspot: '.raven-hotspot',
        tooltip: '.raven-hotspot__tooltip'
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    return {
      $hotspot: this.$element.find(selectors.hotspot),
      $hotspotsExcludesLinks: this.$element.find(selectors.hotspot).filter(':not(.raven-hotspot--no-tooltip)'),
      $tooltip: this.$element.find(selectors.tooltip)
    };
  },
  bindEvents: function bindEvents() {
    var _this = this;

    var tooltipTrigger = this.getCurrentDeviceSetting('tooltip_trigger'),
        tooltipTriggerEvent = 'mouseenter' === tooltipTrigger ? 'mouseleave mouseenter' : tooltipTrigger;

    if (tooltipTriggerEvent !== 'none') {
      this.elements.$hotspotsExcludesLinks.on(tooltipTriggerEvent, function (event) {
        return _this.onHotspotTriggerEvent(event);
      });
    }
  },
  onDeviceModeChange: function onDeviceModeChange() {
    this.elements.$hotspotsExcludesLinks.off();
    this.bindEvents();
  },
  onHotspotTriggerEvent: function onHotspotTriggerEvent(event) {
    var elementTarget = $(event.target),
        isHotspotButtonEvent = elementTarget.closest('.raven-hotspot__button').length,
        isTooltipMouseLeave = 'mouseleave' === event.type && (elementTarget.is('.raven-hotspot--tooltip-position') || elementTarget.parents('.raven-hotspot--tooltip-position').length),
        isMobile = 'mobile' === elementorFrontend.getCurrentDeviceMode(),
        isHotspotLink = elementTarget.closest('.raven-hotspot--link').length,
        triggerTooltip = !(isHotspotLink && isMobile && ('mouseleave' === event.type || 'mouseenter' === event.type));

    if (triggerTooltip && (isHotspotButtonEvent || isTooltipMouseLeave)) {
      var currentHotspot = $(event.currentTarget);
      this.elements.$hotspot.not(currentHotspot).removeClass('raven-hotspot--active');
      currentHotspot.toggleClass('raven-hotspot--active');
    }
  },
  // Fix bad UX of "Sequenced Animation" when editing other controls
  editorAddSequencedAnimation: function editorAddSequencedAnimation() {
    this.elements.$hotspot.toggleClass('raven-hotspot--sequenced', 'yes' === this.getElementSettings('hotspot_sequenced_animation'));
  },
  hotspotSequencedAnimation: function hotspotSequencedAnimation() {
    var _this2 = this;

    var isSequencedAnimation = this.getElementSettings('hotspot_sequenced_animation');
    var sequencedAnimation = this.getElementSettings('hotspot_sequenced_animation_duration');

    if ('no' === isSequencedAnimation) {
      return;
    } //start sequenced animation when element on viewport


    var hotspotObserver = elementorModules.utils.Scroll.scrollObserver({
      callback: function callback(event) {
        if (event.isInViewport) {
          hotspotObserver.unobserve(_this2.$element[0]); //add delay for each hotspot

          _this2.elements.$hotspot.each(function (index, element) {
            if (0 === index) {
              return;
            }

            var sequencedAnimationDuration = sequencedAnimation ? sequencedAnimation.size : 1000;
            var animationDelay = index * (sequencedAnimationDuration / _this2.elements.$hotspot.length);
            element.style.animationDelay = animationDelay + 'ms';
          });
        }
      }
    });
    hotspotObserver.observe(this.$element[0]);
  },
  setTooltipPositionControl: function setTooltipPositionControl() {
    var tooltipAnimation = this.getElementSettings('tooltip_animation');
    var isDirectionAnimation = 'undefined' !== typeof tooltipAnimation && tooltipAnimation.match(/^raven-hotspot--(slide|fade)-direction/);

    if (isDirectionAnimation) {
      var tooltipPosition = this.getElementSettings('tooltip_position');
      this.elements.$tooltip.removeClass('raven-hotspot--tooltip-animation-from-left raven-hotspot--tooltip-animation-from-top raven-hotspot--tooltip-animation-from-right raven-hotspot--tooltip-animation-from-bottom');
      this.elements.$tooltip.addClass('raven-hotspot--tooltip-animation-from-' + tooltipPosition);
    }
  },
  onInit: function onInit() {
    var _this3 = this;

    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
    this.hotspotSequencedAnimation();
    this.setTooltipPositionControl();

    if (window.elementor) {
      elementor.listenTo(elementor.channels.deviceMode, 'change', function () {
        return _this3.onDeviceModeChange();
      });
    }
  },
  onElementChange: function onElementChange(propertyName) {
    if (propertyName.startsWith('tooltip_position')) {
      this.setTooltipPositionControl();
    }

    if (propertyName.startsWith('hotspot_sequenced_animation')) {
      this.editorAddSequencedAnimation();
    }
  }
});

function _default($scope) {
  new Hotspot({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],34:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _defineProperty2 = _interopRequireDefault(require("@babel/runtime/helpers/defineProperty"));

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _get3 = _interopRequireDefault(require("@babel/runtime/helpers/get"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { (0, _defineProperty2["default"])(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

var Lottie = /*#__PURE__*/function (_elementorModules$fro) {
  (0, _inherits2["default"])(Lottie, _elementorModules$fro);

  var _super = _createSuper(Lottie);

  function Lottie() {
    (0, _classCallCheck2["default"])(this, Lottie);
    return _super.apply(this, arguments);
  }

  (0, _createClass2["default"])(Lottie, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          container: '.raven-lottie__container',
          containerLink: '.raven-lottie__container__link',
          animation: '.raven-lottie__animation',
          caption: '.raven-lottie__caption'
        },
        classes: {
          caption: 'raven-lottie__caption'
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var _this$getSettings = this.getSettings(),
          selectors = _this$getSettings.selectors;

      return {
        $widgetWrapper: this.$element,
        $container: this.$element.find(selectors.container),
        $containerLink: this.$element.find(selectors.containerLink),
        $animation: this.$element.find(selectors.animation),
        $caption: this.$element.find(selectors.caption),
        $sectionParent: this.$element.closest('.elementor-section'),
        $columnParent: this.$element.closest('.elementor-column')
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = (0, _get3["default"])((0, _getPrototypeOf2["default"])(Lottie.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.lottie = null;
      this.state = {
        isAnimationScrollUpdateNeededOnFirstLoad: true,
        isNewLoopCycle: false,
        isInViewport: false,
        loop: false,
        animationDirection: 'forward',
        currentAnimationTrigger: '',
        effectsRelativeTo: '',
        hoverOutMode: '',
        hoverArea: '',
        caption: '',
        playAnimationCount: 0,
        animationSpeed: 0,
        linkTimeout: 0,
        viewportOffset: {
          start: 0,
          end: 100
        }
      };
      this.intersectionObservers = {
        animation: {
          observer: null,
          element: null
        },
        lazyload: {
          observer: null,
          element: null
        }
      };
      this.animationFrameRequest = {
        timer: null,
        lastScrollY: 0
      };
      this.listeners = {
        collection: [],
        elements: {
          $widgetArea: {
            triggerAnimationHoverIn: null,
            triggerAnimationHoverOut: null
          },
          $container: {
            triggerAnimationClick: null
          }
        }
      };
      this.initLottie();
    }
  }, {
    key: "initLottie",
    value: function initLottie() {
      var lottieSettings = this.getLottieSettings();

      if (lottieSettings.lazyload) {
        this.lazyloadLottie();
        return;
      }

      this.generateLottie();
    }
  }, {
    key: "lazyloadLottie",
    value: function lazyloadLottie() {
      var _this = this;

      var bufferHeightBeforeTriggerLottie = 200;
      this.intersectionObservers.lazyload.observer = elementorModules.utils.Scroll.scrollObserver({
        offset: "0px 0px ".concat(bufferHeightBeforeTriggerLottie, "px"),
        callback: function callback(event) {
          if (event.isInViewport) {
            _this.generateLottie();

            _this.intersectionObservers.lazyload.observer.unobserve(_this.intersectionObservers.lazyload.element);
          }
        }
      });
      this.intersectionObservers.lazyload.element = this.elements.$container[0];
      this.intersectionObservers.lazyload.observer.observe(this.intersectionObservers.lazyload.element);
    }
  }, {
    key: "generateLottie",
    value: function generateLottie() {
      this.createLottieInstance();
      this.setLottieEvents();
    }
  }, {
    key: "createLottieInstance",
    value: function createLottieInstance() {
      var lottieSettings = this.getLottieSettings();
      this.lottie = window.bodymovin.loadAnimation({
        container: this.elements.$animation[0],
        path: this.getAnimationPath(),
        renderer: lottieSettings.renderer,
        autoplay: false,
        // We always want to trigger the animation manually for considering start/end frame.
        name: 'lottie-widget'
      }); // Expose the lottie instance in the frontend.

      this.elements.$animation.data('lottie', this.lottie);
    }
  }, {
    key: "getAnimationPath",
    value: function getAnimationPath() {
      var _lottieSettings$sourc, _lottieSettings$sourc2;

      var lottieSettings = this.getLottieSettings();

      if (((_lottieSettings$sourc = lottieSettings.source_json) === null || _lottieSettings$sourc === void 0 ? void 0 : _lottieSettings$sourc.url) && 'json' === lottieSettings.source_json.url.toLowerCase().substr(-4)) {
        return lottieSettings.source_json.url;
      }

      if ((_lottieSettings$sourc2 = lottieSettings.source_external_url) === null || _lottieSettings$sourc2 === void 0 ? void 0 : _lottieSettings$sourc2.url) {
        return lottieSettings.source_external_url.url;
      }

      return window.lottie_defaultAnimationUrl.url;
    }
  }, {
    key: "setCaption",
    value: function setCaption() {
      var lottieSettings = this.getLottieSettings();

      if ('external_url' === lottieSettings.source || 'media_file' === lottieSettings.source && 'custom' === lottieSettings.caption_source) {
        var $captionElement = this.getCaptionElement();
        $captionElement.text(lottieSettings.caption);
      }
    }
  }, {
    key: "getCaptionElement",
    value: function getCaptionElement() {
      if (!this.elements.$caption.length) {
        var _this$getSettings2 = this.getSettings(),
            classes = _this$getSettings2.classes;

        this.elements.$caption = jQuery('<p>', {
          "class": classes.caption
        });
        this.elements.$container.append(this.elements.$caption);
        return this.elements.$caption;
      }

      return this.elements.$caption;
    }
  }, {
    key: "setLottieEvents",
    value: function setLottieEvents() {
      var _this2 = this;

      this.lottie.addEventListener('DOMLoaded', function () {
        return _this2.onLottieDomLoaded();
      });
      this.lottie.addEventListener('complete', function () {
        return _this2.onComplete();
      });
    }
  }, {
    key: "saveInitialValues",
    value: function saveInitialValues() {
      var _lottieSettings$play_;

      var lottieSettings = this.getLottieSettings();
      /*
      These values of the animation are being changed during the animation runtime
      and saved in the lottie instance (and not in the state) for the instance expose in the frontend.
       */

      this.lottie.__initialTotalFrames = this.lottie.totalFrames;
      this.lottie.__initialFirstFrame = this.lottie.firstFrame;
      this.state.currentAnimationTrigger = lottieSettings.trigger;
      this.state.effectsRelativeTo = lottieSettings.effects_relative_to;
      this.state.viewportOffset.start = lottieSettings.viewport ? lottieSettings.viewport.sizes.start : 0;
      this.state.viewportOffset.end = lottieSettings.viewport ? lottieSettings.viewport.sizes.end : 100;
      this.state.animationSpeed = (_lottieSettings$play_ = lottieSettings.play_speed) === null || _lottieSettings$play_ === void 0 ? void 0 : _lottieSettings$play_.size;
      this.state.linkTimeout = lottieSettings.link_timeout;
      this.state.caption = lottieSettings.caption;
      this.state.loop = lottieSettings.loop;
    }
  }, {
    key: "setAnimationFirstFrame",
    value: function setAnimationFirstFrame() {
      var frame = this.getAnimationFrames();
      /*
      We need to subtract the initial first frame from the first frame for handling scenarios
      when the animation first frame is not 0, this way we always get the relevant first frame.
      example: when start point is 70 and initial first frame is 60, the animation should start at 10.
       */

      frame.first = frame.first - this.lottie.__initialFirstFrame;
      this.lottie.goToAndStop(frame.first, true);
    }
  }, {
    key: "initAnimationTrigger",
    value: function initAnimationTrigger() {
      var lottieSettings = this.getLottieSettings();

      switch (lottieSettings.trigger) {
        case 'none':
          this.playLottie();
          break;

        case 'arriving_to_viewport':
          this.playAnimationWhenArrivingToViewport();
          break;

        case 'bind_to_scroll':
          this.playAnimationWhenBindToScroll();
          break;

        case 'on_click':
          this.bindAnimationClickEvents();
          break;

        case 'on_hover':
          this.bindAnimationHoverEvents();
          break;
      }
    }
  }, {
    key: "playAnimationWhenArrivingToViewport",
    value: function playAnimationWhenArrivingToViewport() {
      var _this3 = this;

      var offset = this.getOffset();
      this.intersectionObservers.animation.observer = elementorModules.utils.Scroll.scrollObserver({
        offset: "".concat(offset.end, "% 0% ").concat(offset.start, "%"),
        callback: function callback(event) {
          if (event.isInViewport) {
            _this3.state.isInViewport = true;

            _this3.playLottie();

            return;
          }

          _this3.state.isInViewport = false;

          _this3.lottie.pause();
        }
      });
      this.intersectionObservers.animation.element = this.elements.$widgetWrapper[0];
      this.intersectionObservers.animation.observer.observe(this.intersectionObservers.animation.element);
    }
  }, {
    key: "getOffset",
    value: function getOffset() {
      var lottieSettings = this.getLottieSettings(),
          start = -lottieSettings.viewport.sizes.start || 0,
          end = -(100 - lottieSettings.viewport.sizes.end) || 0;
      return {
        start: start,
        end: end
      };
    }
  }, {
    key: "playAnimationWhenBindToScroll",
    value: function playAnimationWhenBindToScroll() {
      var _this4 = this;

      var lottieSettings = this.getLottieSettings(),
          offset = this.getOffset();
      this.intersectionObservers.animation.observer = elementorModules.utils.Scroll.scrollObserver({
        offset: "".concat(offset.end, "% 0% ").concat(offset.start, "%"),
        callback: function callback(event) {
          return _this4.onLottieIntersection(event);
        }
      });
      this.intersectionObservers.animation.element = 'viewport' === lottieSettings.effects_relative_to ? this.elements.$widgetWrapper[0] : document.documentElement;
      this.intersectionObservers.animation.observer.observe(this.intersectionObservers.animation.element);
    }
  }, {
    key: "updateAnimationByScrollPosition",
    value: function updateAnimationByScrollPosition() {
      var lottieSettings = this.getLottieSettings();
      var percentage;

      if ('page' === lottieSettings.effects_relative_to) {
        percentage = this.getLottiePagePercentage();
      } else if ('fixed' === this.getCurrentDeviceSetting('_position')) {
        percentage = this.getLottieViewportHeightPercentage();
      } else {
        percentage = this.getLottieViewportPercentage();
      }

      var nextFrameToPlay = this.getFrameNumberByPercent(percentage);
      nextFrameToPlay = nextFrameToPlay - this.lottie.__initialFirstFrame;
      this.lottie.goToAndStop(nextFrameToPlay, true);
    }
  }, {
    key: "getLottieViewportPercentage",
    value: function getLottieViewportPercentage() {
      return elementorModules.utils.Scroll.getElementViewportPercentage(this.elements.$widgetWrapper, this.getOffset());
    }
  }, {
    key: "getLottiePagePercentage",
    value: function getLottiePagePercentage() {
      return elementorModules.utils.Scroll.getPageScrollPercentage(this.getOffset());
    }
  }, {
    key: "getLottieViewportHeightPercentage",
    value: function getLottieViewportHeightPercentage() {
      return elementorModules.utils.Scroll.getPageScrollPercentage(this.getOffset(), window.innerHeight);
    }
  }, {
    key: "getFrameNumberByPercent",
    value: function getFrameNumberByPercent(percent) {
      var frame = this.getAnimationFrames();
      /*
      In mobile devices the document height can be 'stretched' at the top and bottom points of the document,
      this 'stretched' will make percent to be either negative or larger than 100, therefore we need to limit percent between 0-100.
      */

      percent = Math.min(100, Math.max(0, percent)); // Getting frame number by percent of range, considering start/end frame values if exist.

      return frame.first + (frame.last - frame.first) * (percent / 100);
    }
  }, {
    key: "getAnimationFrames",
    value: function getAnimationFrames() {
      var lottieSettings = this.getLottieSettings(),
          currentFrame = this.getAnimationCurrentFrame(),
          startPoint = this.getAnimationRange().start,
          endPoint = this.getAnimationRange().end;
      var firstFrame = this.lottie.__initialFirstFrame,
          lastFrame = 0 === this.lottie.__initialFirstFrame ? this.lottie.__initialTotalFrames : this.lottie.__initialFirstFrame + this.lottie.__initialTotalFrames; // Limiting min start point to animation first frame.

      if (startPoint && startPoint > firstFrame) {
        firstFrame = startPoint;
      } // limiting max end point to animation last frame.


      if (endPoint && endPoint < lastFrame) {
        lastFrame = endPoint;
      }
      /*
      Getting the relevant first frame after loop complete and when not bind to scroll.
      when the animation is in progress (no when a new loop start), the first frame should be the current frame.
      when the trigger is bind_to_scroll we DON'T need to get this functionality.
      */


      if (!this.state.isNewLoopCycle && 'bind_to_scroll' !== lottieSettings.trigger) {
        // When we have a custom start point, we need to check if the start point is larger than the last pause stop of the animation.
        firstFrame = startPoint && startPoint > currentFrame ? startPoint : currentFrame;
      } // Reverse Mode.


      if ('backward' === this.state.animationDirection && this.isReverseMode()) {
        firstFrame = currentFrame;
        lastFrame = startPoint && startPoint > this.lottie.__initialFirstFrame ? startPoint : this.lottie.__initialFirstFrame;
      }

      return {
        first: firstFrame,
        last: lastFrame,
        current: currentFrame,
        total: this.lottie.__initialTotalFrames
      };
    }
  }, {
    key: "getAnimationRange",
    value: function getAnimationRange() {
      var lottieSettings = this.getLottieSettings();
      return {
        start: this.getInitialFrameNumberByPercent(lottieSettings.start_point.size),
        end: this.getInitialFrameNumberByPercent(lottieSettings.end_point.size)
      };
    }
  }, {
    key: "getInitialFrameNumberByPercent",
    value: function getInitialFrameNumberByPercent(percent) {
      percent = Math.min(100, Math.max(0, percent));
      return this.lottie.__initialFirstFrame + (this.lottie.__initialTotalFrames - this.lottie.__initialFirstFrame) * (percent / 100);
    }
  }, {
    key: "getAnimationCurrentFrame",
    value: function getAnimationCurrentFrame() {
      // When pausing the animation (when out of viewport) the first frame of the animation changes.
      return 0 === this.lottie.firstFrame ? this.lottie.currentFrame : this.lottie.firstFrame + this.lottie.currentFrame;
    }
  }, {
    key: "setLinkTimeout",
    value: function setLinkTimeout() {
      var _lottieSettings$custo,
          _this5 = this;

      var lottieSettings = this.getLottieSettings();

      if ('on_click' === lottieSettings.trigger && ((_lottieSettings$custo = lottieSettings.custom_link) === null || _lottieSettings$custo === void 0 ? void 0 : _lottieSettings$custo.url) && lottieSettings.link_timeout) {
        this.elements.$containerLink.on('click', function (event) {
          event.preventDefault();

          if (!_this5.isEdit) {
            setTimeout(function () {
              var tabTarget = 'on' === lottieSettings.custom_link.is_external ? '_blank' : '_self';
              window.open(lottieSettings.custom_link.url, tabTarget);
            }, lottieSettings.link_timeout);
          }
        });
      }
    }
  }, {
    key: "bindAnimationClickEvents",
    value: function bindAnimationClickEvents() {
      var _this6 = this;

      this.listeners.elements.$container.triggerAnimationClick = function () {
        _this6.playLottie();
      };

      this.addSessionEventListener(this.elements.$container, 'click', this.listeners.elements.$container.triggerAnimationClick);
    }
  }, {
    key: "getLottieSettings",
    value: function getLottieSettings() {
      var lottieSettings = this.getElementSettings();
      return _objectSpread(_objectSpread({}, lottieSettings), {}, {
        lazyload: 'yes' === lottieSettings.lazyload,
        loop: 'yes' === lottieSettings.loop
      });
    }
  }, {
    key: "playLottie",
    value: function playLottie() {
      var frame = this.getAnimationFrames();
      this.lottie.stop();
      this.lottie.playSegments([frame.first, frame.last], true); // We reset the loop cycle state after playing the animation.

      this.state.isNewLoopCycle = false;
    }
  }, {
    key: "bindAnimationHoverEvents",
    value: function bindAnimationHoverEvents() {
      this.createAnimationHoverInEvents();
      this.createAnimationHoverOutEvents();
    }
  }, {
    key: "createAnimationHoverInEvents",
    value: function createAnimationHoverInEvents() {
      var _this7 = this;

      var lottieSettings = this.getLottieSettings(),
          $widgetArea = this.getHoverAreaElement();
      this.state.hoverArea = lottieSettings.hover_area;

      this.listeners.elements.$widgetArea.triggerAnimationHoverIn = function () {
        _this7.state.animationDirection = 'forward';

        _this7.playLottie();
      };

      this.addSessionEventListener($widgetArea, 'mouseenter', this.listeners.elements.$widgetArea.triggerAnimationHoverIn);
    }
  }, {
    key: "addSessionEventListener",
    value: function addSessionEventListener($el, event, callback) {
      $el.on(event, callback);
      this.listeners.collection.push({
        $el: $el,
        event: event,
        callback: callback
      });
    }
  }, {
    key: "createAnimationHoverOutEvents",
    value: function createAnimationHoverOutEvents() {
      var _this8 = this;

      var lottieSettings = this.getLottieSettings(),
          $widgetArea = this.getHoverAreaElement();

      if ('pause' === lottieSettings.on_hover_out || 'reverse' === lottieSettings.on_hover_out) {
        this.state.hoverOutMode = lottieSettings.on_hover_out;

        this.listeners.elements.$widgetArea.triggerAnimationHoverOut = function () {
          if ('pause' === lottieSettings.on_hover_out) {
            _this8.lottie.pause();

            return;
          }

          _this8.state.animationDirection = 'backward';

          _this8.playLottie();
        };

        this.addSessionEventListener($widgetArea, 'mouseleave', this.listeners.elements.$widgetArea.triggerAnimationHoverOut);
      }
    }
  }, {
    key: "getHoverAreaElement",
    value: function getHoverAreaElement() {
      var lottieSettings = this.getLottieSettings();

      if ('section' === lottieSettings.hover_area) {
        return this.elements.$sectionParent;
      } else if ('column' === lottieSettings.hover_area) {
        return this.elements.$columnParent;
      }

      return this.elements.$container;
    }
  }, {
    key: "setLoopOnAnimationComplete",
    value: function setLoopOnAnimationComplete() {
      var lottieSettings = this.getLottieSettings();
      this.state.isNewLoopCycle = true;

      if (lottieSettings.loop && !this.isReverseMode()) {
        this.setLoopWhenNotReverse();
      } else if (lottieSettings.loop && this.isReverseMode()) {
        this.setReverseAnimationOnLoop();
      } else if (!lottieSettings.loop && this.isReverseMode()) {
        this.setReverseAnimationOnSingleTrigger();
      }
    }
  }, {
    key: "isReverseMode",
    value: function isReverseMode() {
      var lottieSettings = this.getLottieSettings();
      return 'yes' === lottieSettings.reverse_animation || 'reverse' === lottieSettings.on_hover_out && 'backward' === this.state.animationDirection;
    }
  }, {
    key: "setLoopWhenNotReverse",
    value: function setLoopWhenNotReverse() {
      var lottieSettings = this.getLottieSettings();

      if (lottieSettings.number_of_times > 0) {
        this.state.playAnimationCount++;

        if (this.state.playAnimationCount < lottieSettings.number_of_times) {
          this.playLottie();
          return;
        }

        this.state.playAnimationCount = 0;
        return;
      }

      this.playLottie();
    }
  }, {
    key: "setReverseAnimationOnLoop",
    value: function setReverseAnimationOnLoop() {
      var lottieSettings = this.getLottieSettings();
      /*
      We trigger the reverse animation:
      either when we don't have any value in the 'Number of Times" field, and then it will be an infinite forward/backward loop,
      or, when we have a value in the 'Number of Times" field and then we need to limit the number of times of the loop cycles.
       */

      if (!lottieSettings.number_of_times || this.state.playAnimationCount < lottieSettings.number_of_times) {
        this.state.animationDirection = 'forward' === this.state.animationDirection ? 'backward' : 'forward';
        this.playLottie();
        /*
        We need to increment the count only on the backward movements,
        because forward movement + backward movement are equal together to one full movement count.
        */

        if ('backward' === this.state.animationDirection) {
          this.state.playAnimationCount++;
        }

        return;
      } // Reset the values for the loop counting for the next trigger.


      this.state.playAnimationCount = 0;
      this.state.animationDirection = 'forward';
    }
  }, {
    key: "setReverseAnimationOnSingleTrigger",
    value: function setReverseAnimationOnSingleTrigger() {
      if (this.state.playAnimationCount < 1) {
        this.state.playAnimationCount++;
        this.state.animationDirection = 'backward';
        this.playLottie();
        return;
      } else if (this.state.playAnimationCount >= 1 && 'forward' === this.state.animationDirection) {
        this.state.animationDirection = 'backward';
        this.playLottie();
        return;
      }

      this.state.playAnimationCount = 0;
      this.state.animationDirection = 'forward';
    }
  }, {
    key: "setAnimationSpeed",
    value: function setAnimationSpeed() {
      var lottieSettings = this.getLottieSettings();

      if (lottieSettings.play_speed) {
        this.lottie.setSpeed(lottieSettings.play_speed.size);
      }
    }
  }, {
    key: "onElementChange",
    value: function onElementChange() {
      this.updateLottieValues();
      this.resetAnimationTrigger();
    }
  }, {
    key: "updateLottieValues",
    value: function updateLottieValues() {
      var _lottieSettings$play_2,
          _this9 = this;

      var lottieSettings = this.getLottieSettings(),
          valuesComparison = [{
        sourceVal: (_lottieSettings$play_2 = lottieSettings.play_speed) === null || _lottieSettings$play_2 === void 0 ? void 0 : _lottieSettings$play_2.size,
        stateProp: 'animationSpeed',
        callback: function callback() {
          return _this9.setAnimationSpeed();
        }
      }, {
        sourceVal: lottieSettings.link_timeout,
        stateProp: 'linkTimeout',
        callback: function callback() {
          return _this9.setLinkTimeout();
        }
      }, {
        sourceVal: lottieSettings.caption,
        stateProp: 'caption',
        callback: function callback() {
          return _this9.setCaption();
        }
      }, {
        sourceVal: lottieSettings.effects_relative_to,
        stateProp: 'effectsRelativeTo',
        callback: function callback() {
          return _this9.updateAnimationByScrollPosition();
        }
      }, {
        sourceVal: lottieSettings.loop,
        stateProp: 'loop',
        callback: function callback() {
          return _this9.onLoopStateChange();
        }
      }];
      valuesComparison.forEach(function (item) {
        if ('undefined' !== typeof item.sourceVal && item.sourceVal !== _this9.state[item.stateProp]) {
          _this9.state[item.stateProp] = item.sourceVal;
          item.callback();
        }
      });
    }
  }, {
    key: "onLoopStateChange",
    value: function onLoopStateChange() {
      var isInActiveViewportMode = 'arriving_to_viewport' === this.state.currentAnimationTrigger && this.state.isInViewport;

      if (this.state.loop && (isInActiveViewportMode || 'none' === this.state.currentAnimationTrigger)) {
        this.playLottie();
      }
    }
  }, {
    key: "resetAnimationTrigger",
    value: function resetAnimationTrigger() {
      var lottieSettings = this.getLottieSettings(),
          isTriggerChange = lottieSettings.trigger !== this.state.currentAnimationTrigger,
          isViewportOffsetChange = lottieSettings.viewport ? this.isViewportOffsetChange() : false,
          isHoverOutModeChange = lottieSettings.on_hover_out ? this.isHoverOutModeChange() : false,
          isHoverAreaChange = lottieSettings.hover_area ? this.isHoverAreaChange() : false;

      if (isTriggerChange || isViewportOffsetChange || isHoverOutModeChange || isHoverAreaChange) {
        this.removeAnimationFrameRequests();
        this.removeObservers();
        this.removeEventListeners();
        this.initAnimationTrigger();
      }
    }
  }, {
    key: "isViewportOffsetChange",
    value: function isViewportOffsetChange() {
      var lottieSettings = this.getLottieSettings(),
          isStartOffsetChange = lottieSettings.viewport.sizes.start !== this.state.viewportOffset.start,
          isEndOffsetChange = lottieSettings.viewport.sizes.end !== this.state.viewportOffset.end;
      return isStartOffsetChange || isEndOffsetChange;
    }
  }, {
    key: "isHoverOutModeChange",
    value: function isHoverOutModeChange() {
      var lottieSettings = this.getLottieSettings();
      return lottieSettings.on_hover_out !== this.state.hoverOutMode;
    }
  }, {
    key: "isHoverAreaChange",
    value: function isHoverAreaChange() {
      var lottieSettings = this.getLottieSettings();
      return lottieSettings.hover_area !== this.state.hoverArea;
    }
  }, {
    key: "removeEventListeners",
    value: function removeEventListeners() {
      this.listeners.collection.forEach(function (listener) {
        listener.$el.off(listener.event, null, listener.callback);
      });
    }
  }, {
    key: "removeObservers",
    value: function removeObservers() {
      // Removing all observers.
      for (var type in this.intersectionObservers) {
        if (this.intersectionObservers[type].observer && this.intersectionObservers[type].element) {
          this.intersectionObservers[type].observer.unobserve(this.intersectionObservers[type].element);
        }
      }
    }
  }, {
    key: "removeAnimationFrameRequests",
    value: function removeAnimationFrameRequests() {
      window.cancelAnimationFrame(this.animationFrameRequest.timer);
    }
  }, {
    key: "onDestroy",
    value: function onDestroy() {
      (0, _get3["default"])((0, _getPrototypeOf2["default"])(Lottie.prototype), "onDestroy", this).call(this);
      this.destroyLottie();
    }
  }, {
    key: "destroyLottie",
    value: function destroyLottie() {
      this.removeAnimationFrameRequests();
      this.removeObservers();
      this.removeEventListeners();
      this.elements.$animation.removeData('lottie');

      if (this.lottie) {
        this.lottie.destroy();
      }
    }
  }, {
    key: "onLottieDomLoaded",
    value: function onLottieDomLoaded() {
      this.saveInitialValues();
      this.setAnimationSpeed();
      this.setLinkTimeout();
      this.setCaption();
      this.setAnimationFirstFrame();
      this.initAnimationTrigger();
    }
  }, {
    key: "onComplete",
    value: function onComplete() {
      this.setLoopOnAnimationComplete();
    }
  }, {
    key: "onLottieIntersection",
    value: function onLottieIntersection(event) {
      var _this10 = this;

      if (event.isInViewport) {
        /*
        It's required to update the animation progress on first load when lottie is inside the viewport on load
        but, there is a problem when the browser is refreshed when the scroll bar is not in 0 position,
        in this scenario, after the refresh the browser will trigger 2 scroll events
        one trigger on immediate load and second after a f ew ms to move the scroll bar to previous position (before refresh)
        therefore, we use the this.state.isAnimationScrollUpdateNeededOnFirstLoad flag
        to make sure that this.updateAnimationByScrollPosition() function will be triggered only once.
         */
        if (this.state.isAnimationScrollUpdateNeededOnFirstLoad) {
          this.state.isAnimationScrollUpdateNeededOnFirstLoad = false;
          this.updateAnimationByScrollPosition();
        }

        this.animationFrameRequest.timer = window.requestAnimationFrame(function () {
          return _this10.onAnimationFrameRequest();
        });
        return;
      }

      var frame = this.getAnimationFrames(),
          finalFrame = 'up' === event.intersectionScrollDirection ? frame.first : frame.last;
      this.state.isAnimationScrollUpdateNeededOnFirstLoad = false;
      window.cancelAnimationFrame(this.animationFrameRequest.timer);
      this.lottie.goToAndStop(finalFrame, true);
    }
  }, {
    key: "onAnimationFrameRequest",
    value: function onAnimationFrameRequest() {
      var _this11 = this;

      // Making calculation only when there is a change with the scroll position.
      if (window.scrollY !== this.animationFrameRequest.lastScrollY) {
        this.updateAnimationByScrollPosition();
        this.animationFrameRequest.lastScrollY = window.scrollY;
      }

      this.animationFrameRequest.timer = window.requestAnimationFrame(function () {
        return _this11.onAnimationFrameRequest();
      });
    }
  }]);
  return Lottie;
}(elementorModules.frontend.handlers.Base);

function _default($scope) {
  new Lottie({
    $element: $scope
  });
}

},{"@babel/runtime/helpers/classCallCheck":54,"@babel/runtime/helpers/createClass":55,"@babel/runtime/helpers/defineProperty":56,"@babel/runtime/helpers/get":57,"@babel/runtime/helpers/getPrototypeOf":58,"@babel/runtime/helpers/inherits":59,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/possibleConstructorReturn":63}],35:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

var MyAccount = _module["default"].extend({
  pageWrapperAttr: 'raven-my-account-page',
  currentPage: null,
  onInit: function onInit() {
    this.initElements();
    this.bindEvents(); // Specific scripts to manage the widget in editor preview.

    if (this.isEdit) {
      this.editorInitTabs();
      this.currentPage = this.$element.attr(this.pageWrapperAttr);

      if (!this.currentPage) {
        this.currentPage = 'dashboard';
      }

      this.editorShowTab();
    } // General scripts for both frontend and editor.


    this.applyButtonsHoverAnimation();
    this.doHeightEqualizations();
    this.setContentMinHeight();
    this.removePaddingBetweenPurchaseNote(this.elements.$purchasenote);
  },
  getDefaultSettings: function getDefaultSettings() {
    return {
      selectors: {
        address: 'address',
        tabLinks: '.woocommerce-MyAccount-navigation-link a',
        viewOrderButtons: '.my_account_orders .woocommerce-button.view',
        viewOrderLinks: '.woocommerce-orders-table__cell-order-number a',
        authForms: 'form.login, form.register',
        tabWrapper: '.raven-my-account-tab',
        tabItem: '.woocommerce-MyAccount-navigation li',
        allPageElements: "[".concat(this.pageWrapperAttr, "]"),
        purchasenote: 'tr.product-purchase-note',
        stickyRightColumn: '.e-sticky-right-column'
      },
      classes: {
        stickyRightColumnActive: 'e-sticky-right-column--active'
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    return {
      $address: this.$element.find(selectors.address),
      $tabLinks: this.$element.find(selectors.tabLinks),
      $viewOrderButtons: this.$element.find(selectors.viewOrderButtons),
      $viewOrderLinks: this.$element.find(selectors.viewOrderLinks),
      $authForms: this.$element.find(selectors.authForms),
      $tabWrapper: this.$element.find(selectors.tabWrapper),
      $tabItem: this.$element.find(selectors.tabItem),
      $allPageElements: this.$element.find(selectors.allPageElements),
      $purchasenote: this.$element.find(selectors.purchasenote),
      $stickyRightColumn: this.$element.find(selectors.stickyRightColumn)
    };
  },
  bindEvents: function bindEvents() {
    // Add our wrapper class around the select2 whenever it is opened.
    elementorFrontend.elements.$document.on('select2:open', this.addSelect2Wrapper); // The heights of the Registration and Login boxes need to be recaclulated and equalized when
    // WooCommerce adds validation messages (such as the password strength meter) into these sections.

    elementorFrontend.elements.$body.on('keyup change', '.register #reg_password', this.doHeightEqualizations);
  },
  editorInitTabs: function editorInitTabs() {
    var _this = this;

    this.elements.$allPageElements.each(function (index, element) {
      var endpoint = element.getAttribute(_this.pageWrapperAttr);
      var linksToEndpoint;
      linksToEndpoint = _this.$element.find('.woocommerce-MyAccount-navigation-link--' + endpoint);

      if ('view-order' === endpoint) {
        linksToEndpoint = _this.elements.$viewOrderLinks.add(_this.elements.$viewOrderButtons);
      }

      linksToEndpoint.on('click', {
        endpoint: endpoint
      }, _this.editorShowTab);
    });
  },
  editorShowTab: function editorShowTab() {
    var event = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

    if (event) {
      this.currentPage = event.data.endpoint;
    }

    if ('customer-logout' === this.currentPage) {
      return;
    }

    var targetPage = this.$element.find("[".concat(this.pageWrapperAttr, "=\"").concat(this.currentPage, "\"]"));
    this.$element.attr(this.pageWrapperAttr, this.currentPage);
    this.elements.$allPageElements.hide();
    targetPage.show();
    this.toggleEndpointClasses();

    if ('view-order' !== this.currentPage) {
      this.elements.$tabItem.removeClass('is-active');
      this.$element.find('.woocommerce-MyAccount-navigation-link--' + this.currentPage).addClass('is-active');
    } // We need to run doHeightEqualizations() again when the 'edit-address' or 'view-order' tab is shown, because jQuery cannot
    // get the height of hidden elements, and this tab was hidden on initial page load in the editor.


    if ('edit-address' === this.currentPage || 'view-order' === this.currentPage) {
      this.doHeightEqualizations();
    }
  },
  toggleEndpointClasses: function toggleEndpointClasses() {
    var wcPages = ['dashboard', 'orders', 'view-order', 'downloads', 'edit-account', 'edit-address', 'payment-methods'];
    this.elements.$tabWrapper.removeClass('raven-my-account-tab__' + wcPages.join(' raven-my-account-tab__'));

    if (wcPages.includes(this.currentPage)) {
      this.elements.$tabWrapper.addClass('raven-my-account-tab__' + this.currentPage);
    }
  },
  applyButtonsHoverAnimation: function applyButtonsHoverAnimation() {
    var elementSettings = this.getElementSettings();

    if (elementSettings.forms_buttons_hover_animation) {
      this.$element.find('.woocommerce button.button').addClass('elementor-animation-' + elementSettings.forms_buttons_hover_animation);
    }

    if (elementSettings.tables_button_hover_animation) {
      this.$element.find('.order-again .button, td .button, .woocommerce-pagination .button').addClass('elementor-animation-' + elementSettings.tables_button_hover_animation);
    }
  },
  doHeightEqualizations: function doHeightEqualizations() {
    // Equalize <address> boxes height.
    this.equalizeElementHeight(this.elements.$address);

    if (!this.isEdit) {
      // Equalize login/reg boxes height, since auth forms do not display in the Editor.
      this.equalizeElementHeight(this.elements.$authForms); //
    }
  },
  equalizeElementHeight: function equalizeElementHeight($element) {
    if ($element.length) {
      // First remove the custom height we added so that the new height can be re-calculated according to the content.
      $element.removeAttr('style');
      var maxHeight = 0;
      $element.each(function (index, element) {
        maxHeight = Math.max(maxHeight, element.offsetHeight);
      });

      if (0 < maxHeight) {
        $element.css('height', maxHeight + 'px');
      }
    }
  },
  // After render, we acquire height of navigation menu and set the minimum height of contents to it, then make it visible.
  setContentMinHeight: function setContentMinHeight() {
    var nav = jQuery('.custom-my-account-nav-vertical');
    var content = jQuery('.woocommerce-MyAccount-content-wrapper');

    if (nav.length) {
      var navHeight = window.getComputedStyle(nav[0]).height;
      content.css('min-height', navHeight);
    }

    content.css('visibility', 'visible');
  },
  removePaddingBetweenPurchaseNote: function removePaddingBetweenPurchaseNote($element) {
    if ($element) {
      $element.each(function (element) {
        jQuery(element).prev().children('td').addClass('product-purchase-note-is-below');
      });
    }
  },
  onElementChange: function onElementChange(propertyName) {
    // When the 'General Text' Typography or 'Section' Padding is changed, the height of the boxes need to update as well.
    if (0 === propertyName.indexOf('general_text_typography') || 0 === propertyName.indexOf('sections_padding')) {
      this.doHeightEqualizations();
    }

    if (0 === propertyName.indexOf('forms_rows_gap')) {
      this.removePaddingBetweenPurchaseNote(this.elements.$purchasenote);
    }
  },
  //----------------Select2s-------------------+
  addSelect2Wrapper: function addSelect2Wrapper(event) {
    // The select element is recaptured every time because the markup can refresh
    var selectElement = jQuery(event.target).data('select2');

    if (selectElement.$dropdown) {
      selectElement.$dropdown.addClass('e-woo-select2-wrapper');
    }
  },
  isStickyRightColumnActive: function isStickyRightColumnActive() {
    var classes = this.getSettings('classes');
    return this.elements.$stickyRightColumn.hasClass(classes.stickyRightColumnActive);
  },
  activateStickyRightColumn: function activateStickyRightColumn() {
    var elementSettings = this.getElementSettings();
    var $wpAdminBar = elementorFrontend.elements.$wpAdminBar;
    var classes = this.getSettings('classes');
    var stickyOptionsOffset = elementSettings.sticky_right_column_offset || 0;

    if ($wpAdminBar.length && 'fixed' === $wpAdminBar.css('position')) {
      stickyOptionsOffset += $wpAdminBar.height();
    }

    if ('yes' === this.getElementSettings('sticky_right_column')) {
      this.elements.$stickyRightColumn.addClass(classes.stickyRightColumnActive);
      this.elements.$stickyRightColumn.css('top', stickyOptionsOffset + 'px');
    }
  },
  deactivateStickyRightColumn: function deactivateStickyRightColumn() {
    if (!this.isStickyRightColumnActive()) {
      return;
    }

    var classes = this.getSettings('classes');
    this.elements.$stickyRightColumn.removeClass(classes.stickyRightColumnActive);
  },
  toggleStickyRightColumn: function toggleStickyRightColumn() {
    if (!this.getElementSettings('sticky_right_column')) {
      this.deactivateStickyRightColumn();
      return;
    }

    if (!this.isStickyRightColumnActive()) {
      this.activateStickyRightColumn();
    }
  }
});

function _default($scope) {
  new MyAccount({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],36:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _typeof2 = _interopRequireDefault(require("@babel/runtime/helpers/typeof"));

var _module = _interopRequireDefault(require("../utils/module"));

var $ = jQuery;

var NavMenu = _module["default"].extend({
  getDefaultSettings: function getDefaultSettings() {
    return {
      selectors: {
        menus: '.raven-nav-menu',
        inPageMenuItems: 'a[href*="#"]',
        toggleButton: '.raven-nav-menu-toggle-button',
        closeButton: '.raven-nav-menu-close-button',
        mobileMenu: '.raven-nav-menu-mobile',
        mobileContainer: '.raven-nav-menu-mobile .raven-container',
        megaMenu: '.submenu .raven-megamenu-wrapper',
        liNavItem: '.raven-nav-menu-main .raven-nav-menu li'
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    var elements = {
      $body: $('body'),
      $menus: this.$element.find(selectors.menus),
      $inPageMenuItems: this.$element.find(selectors.inPageMenuItems),
      $toggleButton: this.$element.find(selectors.toggleButton),
      $closeButton: this.$element.find(selectors.closeButton),
      $mobileMenu: this.$element.find(selectors.mobileMenu),
      $mobileContainer: this.$element.find(selectors.mobileContainer),
      $elementorElement: this.$element.closest('.elementor-element'),
      $elementorContainer: this.$element.parents('.elementor-container').last(),
      $megaMenu: this.$element.find(selectors.megaMenu),
      $navMenuItem: this.$element.find(selectors.$menus).find('li'),
      $liNavItem: this.$element.find(selectors.liNavItem)
    }; // If there is no parent:<.elementor-container> then the container is a Flex Container.

    if (!elements.$elementorContainer.length) {
      elements.$elementorContainer = this.$element.closest('.e-container');
    }

    return elements;
  },
  onInit: function onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
    this.initSmartMenu();
    this.inPageMenuClick();
    this.inPageMenuScroll();
    this.mobileMenuScroll();
    this.setMegaMenuWidth();
    this.stretchElement = new elementorModules.frontend.tools.StretchElement({
      element: this.elements.$mobileMenu,
      selectors: {
        container: this.elements.$mobileMenu.parents('.elementor-top-section')
      }
    });
  },
  bindEvents: function bindEvents() {
    var mobileLayout = this.getElementSettings('mobile_layout');

    switch (mobileLayout) {
      case 'dropdown':
        this.elements.$toggleButton.on('click', this.toggleDropdown.bind(this));
        elementorFrontend.addListenerOnce(this.$element.data('model-cid'), 'resize', this.dropdownFullWidth.bind(this));
        $(window).on('resize', this.setMegaMenuWidth.bind(this));
        break;

      case 'side':
        var sideMenuOpenPosition = this.getElementSettings('side_menu_alignment'),
            sideMenuEffect = this.getElementSettings('side_menu_effect');
        this.elements.$mobileMenu.addClass('raven-side-menu-' + sideMenuOpenPosition);
        this.elements.$mobileMenu.addClass('raven-side-menu-' + sideMenuOpenPosition);
        this.elements.$toggleButton.on('click', this.toggleMobileMenu.bind(this));
        this.elements.$closeButton.on('click', this.toggleMobileMenu.bind(this));

        if (sideMenuEffect === 'push') {
          this.elements.$body.addClass('raven-nav-menu-effect-push');
          this.elements.$toggleButton.on('click', this.sideMenuPush.bind(this));
          this.elements.$closeButton.on('click', this.sideMenuPush.bind(this));
        }

        this.elements.$menus.on('select.smapi', this.onSideMenuItemClick.bind(this));
        break;

      case 'full-screen':
        var isItemFullWidth = this.getElementSettings('mobile_menu_item_full_width');

        if (isItemFullWidth === 'yes') {
          this.elements.$mobileMenu.addClass('raven-nav-menu-item-full-width');
        }

        this.elements.$toggleButton.on('click', this.toggleMobileMenu.bind(this));
        this.elements.$closeButton.on('click', this.toggleMobileMenu.bind(this));
        break;
    }

    this.elements.$liNavItem.on('hover', this.setMegaMenuWidth);
  },
  initSmartMenu: function initSmartMenu() {
    var subIndicatorsContent = this.getElementSettings('submenu_icon');
    var spaceBetween = this.getElementSettings('submenu_space_between'),
        options = {
      subIndicatorsText: subIndicatorsContent,
      subIndicators: '' !== subIndicatorsContent,
      subIndicatorsPos: 'append',
      subMenusMaxWidth: '1500px'
    };

    if (this.elements.$body.hasClass('rtl')) {
      options.rightToLeftSubMenus = true;
    }

    if (this.elements.$megaMenu.length) {
      options.keepInViewport = false;
    }

    if ((0, _typeof2["default"])(spaceBetween) === 'object' && spaceBetween.size !== '') {
      options.mainMenuSubOffsetY = parseInt(spaceBetween.size);
    }

    if (this.getElementSettings('submenu_opening_position') === 'top') {
      options.bottomToTopSubMenus = true;
    }

    this.excludeOtherUl();
    this.elements.$menus.smartmenus(options);
  },
  toggleDropdown: function toggleDropdown() {
    var mobileMenu = this.elements.$mobileMenu;
    this.elements.$toggleButton.find('.hamburger').toggleClass('is-active');
    mobileMenu.slideToggle(250, function () {
      mobileMenu.toggleClass('raven-nav-menu-active').css('display', '');
    });
    this.dropdownFullWidth();
  },
  dropdownFullWidth: function dropdownFullWidth() {
    var mobileMenu = this.elements.$mobileMenu; // Used for scrolling menu in small screens.

    mobileMenu.css('max-height', document.documentElement.clientHeight - mobileMenu.get(0).getBoundingClientRect().top);

    if (this.getElementSettings('full_width') !== 'stretch') {
      return;
    }

    var elementorElement = this.elements.$elementorElement,
        elementorContainer = this.elements.$elementorContainer,
        mobileToggle = this.elements.$toggleButton,
        mobileContainer = this.elements.$mobileContainer,
        windowWidth = window.innerWidth;
    this.stretchElement.stretch();
    mobileMenu.css('top', elementorElement.offset().top + elementorElement.outerHeight() - mobileToggle.offset().top);
    mobileContainer.css('max-width', windowWidth > 1024 ? elementorContainer.outerWidth() : 'none');
  },
  sideMenuPush: function sideMenuPush() {
    var sideMenuOpenPosition = this.getElementSettings('side_menu_alignment');
    var width = parseInt(this.$element.css('--menu-container-width')) || 250;

    if (sideMenuOpenPosition === 'right') {
      width = -width;
    }

    if (!this.elements.$body.hasClass('raven-nav-menu-effect-pushed')) {
      this.elements.$body.addClass('raven-nav-menu-effect-pushed').css('margin-' + (this.isRtl() ? 'right' : 'left'), width);
    } else {
      this.elements.$body.removeClass('raven-nav-menu-effect-pushed').removeAttr('style');
    }
  },
  toggleMobileMenu: function toggleMobileMenu() {
    this.elements.$mobileMenu.toggleClass('raven-nav-menu-active');

    if (this.elements.$mobileMenu.hasClass('raven-nav-menu-active')) {
      this.elements.$mobileMenu.parents('.animated').addClass('raven-nav-menu-parents-animation');
    } else {
      this.elements.$mobileMenu.parents('.animated').removeClass('raven-nav-menu-parents-animation');
    }

    if (this.elements.$toggleButton.find('.hamburger').length !== 0) {
      this.elements.$toggleButton.find('.hamburger').toggleClass('is-active');
    }
  },
  mobileMenuScroll: function mobileMenuScroll() {
    var overlays = document.querySelectorAll('.raven-nav-menu-mobile.raven-nav-menu-dropdown, .raven-nav-menu-mobile.raven-nav-menu-full-screen');
    var _clientY = null;

    var _loop = function _loop(i) {
      overlays[i].addEventListener('touchstart', function (event) {
        if (event.targetTouches.length === 1) {
          _clientY = event.targetTouches[0].clientY;
        }
      }, false);
      overlays[i].addEventListener('touchmove', function (event) {
        if (event.targetTouches.length === 1) {
          var clientY = event.targetTouches[0].clientY - _clientY;

          if (overlays[i].scrollTop === 0 && clientY > 0 && event.cancelable) {
            event.preventDefault();
          }

          if (overlays[i].scrollHeight - overlays[i].scrollTop <= overlays[i].clientHeight && clientY < 0 && event.cancelable) {
            event.preventDefault();
          }
        }
      }, false);
    };

    for (var i = 0; i < overlays.length; i++) {
      _loop(i);
    }
  },
  inPageMenuClick: function inPageMenuClick() {
    var self = this;
    var headerSettings = this.getHeaderSettings();
    var anchorId;
    this.elements.$menus.on('click', function (e) {
      anchorId = e.target.getAttribute('href') || '';
      var url = null;

      try {
        url = new window.URL($(e.target).prop('href'));
      } catch (err) {
        return;
      }

      if (url.href.replace(url.hash, '') !== window.location.href.replace(window.location.hash, '') && anchorId.search(/^#/) === -1) {
        return;
      }

      if (url.hash.search(/^#/) === -1) {
        return;
      }

      anchorId = url.hash;
      e.preventDefault();
      var anchorTarget = $(anchorId);

      if (anchorTarget.length === 0) {
        if (self.elements.$body.hasClass('raven-nav-menu-effect-pushed')) {
          self.sideMenuPush();
        }

        self.elements.$mobileMenu.removeClass('raven-nav-menu-active');
        self.changeHamburgerState(false);
        window.history.pushState(null, null, url.hash);
        return;
      }

      var scrollPosition = anchorTarget.offset().top;
      scrollPosition -= self.getAdminbarHeight();
      scrollPosition -= self.getBodyBorderWidth();

      if (headerSettings && headerSettings.behavior === 'sticky' && headerSettings.overlap) {
        scrollPosition -= self.isHeaderSticked() ? self.tbarHeight() : 2 * self.tbarHeight();
      } else if (headerSettings && !headerSettings.behavior) {
        scrollPosition -= self.isHeaderSticked() ? self.tbarHeight() : 2 * self.tbarHeight();
      } else {
        scrollPosition -= self.tbarHeight();
      }

      if (self.hasCustomStickyHeader()) {
        scrollPosition -= self.getCustomStickyHeaderHeight();
      } else if (headerSettings && headerSettings.behavior === 'fixed' && headerSettings.position === 'top' || headerSettings && headerSettings.behavior === 'sticky') {
        scrollPosition -= self.getHeaderHeight();
      }

      if (self.elements.$body.hasClass('raven-nav-menu-effect-pushed')) {
        self.sideMenuPush();
      }

      self.elements.$mobileMenu.removeClass('raven-nav-menu-active');
      self.changeHamburgerState(false);
      window.history.pushState(null, null, url.hash);
      $('html, body').stop().animate({
        scrollTop: scrollPosition
      }, 500, 'swing');
      return false;
    });
  },
  inPageMenuScroll: function inPageMenuScroll() {
    var self = this;

    if (self.elements.$inPageMenuItems.length) {
      self.elements.$inPageMenuItems.each(function (index, node) {
        // Skip links without fragments.
        if (node.hash < 1) {
          return;
        }

        var section = $('[id="' + node.hash.replace('#', '') + '"]');

        if (!section.length) {
          return;
        }

        node = $(node);

        if (!window.location.hash) {
          self.activateMenuItem(section, node);
        }

        window.addEventListener('scroll', _.throttle(function () {
          self.activateMenuItem(section, node);
        }));
      });
    }
  },
  activateMenuItem: function activateMenuItem(section, element) {
    var self = this,
        threshold = 1;
    var isVisible = false;
    var headerHeight = self.getHeaderHeight() + self.getAdminbarHeight(),
        top = section.offset().top,
        offset = top - threshold - headerHeight,
        maxOffset = top - threshold * 2 + section.outerHeight() - headerHeight,
        scrollOffset = window.pageYOffset;

    if (scrollOffset >= offset && scrollOffset <= maxOffset) {
      isVisible = true;
    }

    element.toggleClass('raven-menu-item-active', isVisible);
  },
  getHeaderHeight: function getHeaderHeight() {
    var header = $('.jupiterx-header');

    if (header.length === 0) {
      return 0;
    }

    var _header$data = header.data('jupiterx-settings'),
        behavior = _header$data.behavior;

    if (behavior === 'fixed' || behavior === 'sticky' || window.pageYOffset < header.height()) {
      return header.height();
    }

    return 0;
  },
  hasCustomStickyHeader: function hasCustomStickyHeader() {
    var settings = this.getHeaderSettings();

    if (!settings) {
      return false;
    }

    if (!settings.behavior || settings.behavior !== 'sticky') {
      return false;
    }

    return !settings.stickyTemplate || settings.stickyTemplate !== settings.template;
  },
  getHeaderSettings: function getHeaderSettings() {
    var $header = $('.jupiterx-header');
    return $header.data('jupiterx-settings');
  },
  getCustomStickyHeaderHeight: function getCustomStickyHeaderHeight() {
    if (!this.hasCustomStickyHeader()) {
      return 0;
    }

    var $stickyHeader = $('.jupiterx-header-custom .elementor:last-of-type');

    if ($stickyHeader.length === 0) {
      return 0;
    }

    return $stickyHeader.outerHeight();
  },
  getBodyBorderWidth: function getBodyBorderWidth() {
    var $bodyBorder = $('.jupiterx-site-body-border');

    if ($bodyBorder.length === 0) {
      return 0;
    }

    var width = $bodyBorder.css('border-width');

    if (!width) {
      return 0;
    }

    return parseInt(width.replace('px', ''));
  },
  getAdminbarHeight: function getAdminbarHeight() {
    var adminbar = $('#wpadminbar');

    if (adminbar.length) {
      return adminbar.height();
    }

    return 0;
  },
  tbarHeight: function tbarHeight() {
    var tbar = $('.jupiterx-tbar');

    if (tbar.length) {
      return tbar.outerHeight();
    }

    return 0;
  },
  onElementChange: function onElementChange(propertyName) {
    if (this.getElementSettings('full_width') !== 'stretch') {
      this.stretchElement.reset();
      this.elements.$mobileMenu.removeAttr('style');
      this.elements.$mobileMenu.find('.raven-container').removeAttr('style');
    } else {
      this.dropdownFullWidth();
    }

    if (propertyName === 'mobile_layout' || propertyName === 'side_menu_effect') {
      this.elements.$body.removeClass('raven-nav-menu-effect-pushed').removeAttr('style');
      this.elements.$mobileMenu.removeClass('raven-nav-menu-active');
    }

    if (this.getElementSettings('mobile_layout') === 'side') {
      if (propertyName.startsWith('menu_container_width') && this.elements.$body.hasClass('raven-nav-menu-effect-pushed')) {
        var sideMenuOpenPosition = this.getElementSettings('side_menu_alignment');
        var width = parseInt(this.$element.css('--menu-container-width')) || 250;
        this.elements.$body.css('margin-left', sideMenuOpenPosition === 'left' ? width : -width);
      }
    }

    if (propertyName === 'submenu_space_between') {
      var spaceBetween = this.getElementSettings('submenu_space_between');

      if ((0, _typeof2["default"])(spaceBetween) === 'object') {
        this.findElement('.raven-submenu').first().css('margin-top', spaceBetween.size === '' ? '0' : "".concat(spaceBetween.size, "px"));
        this.elements.$menus.smartmenus('destroy');
        this.initSmartMenu();
      }
    }
  },
  onSectionActivated: function onSectionActivated(activeSection) {
    this.editShowSubmenu(activeSection === 'section_submenu');
  },
  onEditorClosed: function onEditorClosed() {
    this.editShowSubmenu(false);
  },
  editShowSubmenu: function editShowSubmenu(toggle) {
    var subMenu = this.findElement('.raven-submenu').first(),
        spaceBetween = this.getElementSettings('submenu_space_between');
    subMenu.toggleClass('raven-show-submenu', toggle);

    if ((0, _typeof2["default"])(spaceBetween) === 'object') {
      subMenu.css('margin-top', spaceBetween.size === '' ? '0' : "".concat(spaceBetween.size, "px"));
    }
  },
  onSideMenuItemClick: function onSideMenuItemClick(e, item) {
    var $el = $(item);

    if ($el.closest('.raven-nav-menu-side').length === 0) {
      return;
    }

    var href = $el.attr('href');

    if (href.search(/^#/) !== -1 || href.trim().length === 0) {
      return;
    }

    this.elements.$closeButton.trigger('click');
  },
  isHeaderSticked: function isHeaderSticked() {
    return $('.jupiterx-header-sticked').length > 0;
  },
  setMegaMenuWidth: function setMegaMenuWidth() {
    var megaMenu = this.elements.$liNavItem.find('.submenu .raven-megamenu-wrapper'),
        elementorContainer = this.elements.$elementorContainer,
        elementorContainerLeft = elementorContainer.offset().left,
        containerWidth = elementorContainer.outerWidth();
    megaMenu.each(function () {
      var self = $(this),
          megaMenuLiParent = self.parent().parent(),
          megaMenuLiParentLeft = megaMenuLiParent.offset().left,
          transformValue = -Math.abs(megaMenuLiParentLeft - elementorContainerLeft);
      self.parent().css('transform', "translateX(".concat(transformValue, "px)"));
    });
    megaMenu.css('width', "".concat(containerWidth, "px"));
  },
  excludeOtherUl: function excludeOtherUl() {
    var megaMenu = this.elements.$liNavItem.find('.submenu .raven-megamenu-wrapper');
    megaMenu.each(function () {
      var self = $(this);
      self.find('ul').attr('data-sm-skip', 'true');
    });
  },
  changeHamburgerState: function changeHamburgerState(active) {
    var $hamburger = this.elements.$toggleButton.find('.hamburger');

    if ($hamburger.length === 0) {
      return;
    }

    if (!active) {
      $hamburger.removeClass('is-active');
      return;
    }

    $hamburger.addClass('is-active');
  }
});

function _default($scope) {
  new NavMenu({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/helpers/typeof":67}],37:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

var _masonry = _interopRequireDefault(require("../utils/masonry"));

var PhotoAlbum = _module["default"].extend({
  Masonry: null,
  onInit: function onInit() {
    $(this.$element).on('add-stack-effect', this.addStackEffect);

    if (this.getInstanceValue('layout') === 'masonry') {
      this.createMasonry();
    }

    if (this.getElementSettings('_skin') === 'stack') {
      $(this.$element).trigger('add-stack-effect');
    }
  },
  addStackEffect: function addStackEffect() {
    var effect = this.getElementSettings('stack_hover_effect');
    $.each(this.$element.find('.raven-photo-album-item'), function (key, stackEl) {
      new window[effect + 'Fx']({
        el: stackEl
      });
    });
  },
  createMasonry: function createMasonry() {
    var self = this;
    self.Masonry = new _masonry["default"]({
      $element: self.$element
    });
    self.Masonry.run();

    if (self.getElementSettings('_skin') !== 'stack') {
      return;
    }

    setTimeout(function () {
      $(self.$element).trigger('add-stack-effect');
    }, 50);
  }
});

function _default($scope) {
  new PhotoAlbum({
    $element: $scope
  });
}

},{"../utils/masonry":4,"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],38:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

function _default($scope) {
  var $photoRoller = $scope.find('.raven-photo-roller');

  if (typeof window.safari === 'undefined') {
    return;
  } // Fore redraw for Safari. This is a hack.


  function redraw() {
    $photoRoller.hide().show(0);
  }

  redraw();
  $(window).resize(redraw);
}

},{}],39:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.classic = classic;
exports.cover = cover;

var _module = _interopRequireDefault(require("../utils/module"));

var PostsCarousel = _module["default"].extend({
  getDefaultSettings: function getDefaultSettings() {
    return {
      classes: {
        dots: 'swiper-pager'
      },
      selectors: {
        postImageFit: '.raven-image-fit img',
        carouselWrapper: '.raven-swiper-slider',
        sliderWrapper: '.swiper-container',
        itemsSlider: '.swiper-wrapper'
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    return {
      $carouselWrapper: this.$element.find(selectors.carouselWrapper),
      $sliderWrapper: this.$element.find(selectors.sliderWrapper),
      $itemsSlider: this.$element.find(selectors.itemsSlider)
    };
  },
  getCarouselSettings: function getCarouselSettings() {
    return {
      slides_view: this.getInstanceValue('slides_view'),
      slides_view_tablet: this.getInstanceValue('slides_view_tablet'),
      slides_view_mobile: this.getInstanceValue('slides_view_mobile'),
      slides_scroll: this.getInstanceValue('slides_scroll'),
      slides_scroll_tablet: this.getInstanceValue('slides_scroll_tablet'),
      slides_scroll_mobile: this.getInstanceValue('slides_scroll_mobile'),
      enable_autoplay: this.getInstanceValue('enable_autoplay'),
      autoplay_speed: this.getInstanceValue('autoplay_speed'),
      enable_infinite_loop: this.getInstanceValue('enable_infinite_loop'),
      enable_hover_pause: this.getInstanceValue('enable_hover_pause'),
      transition_speed: this.getInstanceValue('transition_speed'),
      show_navigation: this.getInstanceValue('show_arrows'),
      show_pagination: this.getInstanceValue('show_pagination'),
      pagination_position: this.getInstanceValue('pagination_position'),
      columns_space_between: this.getInstanceValue('columns_space_between'),
      columns_space_between_mobile: this.getInstanceValue('columns_space_between_mobile'),
      columns_space_between_tablet: this.getInstanceValue('columns_space_between_tablet')
    };
  },
  onInit: function onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
    var settings = this.getCarouselSettings();
    var options = {
      draggable: false,
      slidesPerColumn: 0,
      spaceBetween: settings.columns_space_between_mobile.size,
      slidesPerView: settings.slides_view_mobile,
      slidesPerGroup: +settings.slides_scroll_mobile || 1,
      autoplay: settings.enable_autoplay === 'yes' ? {
        delay: settings.autoplay_speed
      } : false,
      loop: settings.enable_infinite_loop === 'yes',
      watchOverflow: settings.enable_hover_pause === 'yes',
      speed: +settings.transition_speed,
      navigation: settings.show_navigation === 'yes' ? {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      } : false,
      appendArrows: this.elements.$sliderWrapper,
      pagination: settings.show_pagination === 'yes' ? {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
      } : false,
      breakpoints: {
        360: {
          slidesPerView: +settings.slides_view_mobile,
          slidesToScroll: settings.slides_scroll_mobile || 1,
          spaceBetween: settings.columns_space_between_mobile.size
        },
        768: {
          slidesPerView: +settings.slides_view_tablet,
          slidesToScroll: settings.slides_scroll_tablet || 1,
          spaceBetween: settings.columns_space_between_tablet.size
        },
        1024: {
          slidesPerView: +settings.slides_view,
          slidesToScroll: settings.slides_scroll || 1,
          spaceBetween: settings.columns_space_between.size
        }
      }
    };
    this.elements.$sliderWrapper.each(function (index, swiperContainer) {
      $(this).parents('.elementor-widget-raven-posts-carousel').find('.raven-posts-carousel').addClass('swiper-' + index);
      $(this).parents('.elementor-widget-raven-posts-carousel').find('.raven-posts-carousel').addClass('swiper-' + index);

      if (options.navigation) {
        options.navigation = {
          nextEl: $(swiperContainer).parents('.raven-posts-carousel').find('.swiper-button-next'),
          prevEl: $(swiperContainer).parents('.raven-posts-carousel').find('.swiper-button-prev')
        };
      }

      var swiperObj = null;

      if ('undefined' === typeof Swiper) {
        var asyncSwiper = elementorFrontend.utils.swiper;
        new asyncSwiper(swiperContainer, options).then(function (newSwiperInstance) {
          swiperObj = newSwiperInstance; // eslint-disable-line
        });
      } else {
        swiperObj = new Swiper(swiperContainer, options); // eslint-disable-line
      }

      if (settings.enable_autoplay === 'yes') {
        $(swiperContainer).on({
          mouseenter: function mouseenter() {
            swiperObj.autoplay.stop();
          },
          mouseleave: function mouseleave() {
            swiperObj.autoplay.start();
          }
        });
      }
    });
  },
  onElementChange: function onElementChange(propertyName) {
    if (propertyName === this.getControlID('columns_space_between')) {
      this.elements.$itemsSlider.slick('setPosition');
    }
  }
});

function classic($scope) {
  new PostsCarousel({
    $element: $scope
  });
}

function cover($scope) {
  new PostsCarousel({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],40:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.classic = classic;
exports.cover = cover;

var _module = _interopRequireDefault(require("../utils/module"));

var _sortable = _interopRequireDefault(require("../utils/sortable"));

var _pagination = _interopRequireDefault(require("../utils/pagination"));

var _masonry = _interopRequireDefault(require("../utils/masonry"));

var Posts = _module["default"].extend({
  Sortable: null,
  Pagination: null,
  Masonry: null,
  getDefaultSettings: function getDefaultSettings() {
    return {
      classes: {
        postMirrored: 'data-mirrored'
      },
      selectors: {
        posts: '.raven-posts',
        postItem: '.raven-post-item',
        postImageFit: '.raven-image-fit img',
        postMirrored: '[data-mirrored]',
        loadMore: '.raven-load-more',
        loadMoreButton: '.raven-load-more-button',
        pagination: '.raven-pagination',
        sortable: '.raven-sortable'
      },
      state: {
        paged: 1,
        category: -1,
        maxNumPages: 1,
        isLoading: false
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    return {
      $postsContainer: this.$element.find(selectors.posts),
      $loadMore: this.$element.find(selectors.loadMore),
      $loadMoreButton: this.$element.find(selectors.loadMoreButton),
      $pagination: this.$element.find(selectors.pagination)
    };
  },
  bindEvents: function bindEvents() {
    if (this.getInstanceValue('mirror_rows') === 'yes') {
      elementorFrontend.addListenerOnce(this.$element.data('model-cid'), 'resize', this.mirrorRows.bind(this));
    }

    if (this.getInstanceValue('pagination_type') === 'load_more' && this.elements.$loadMore.length) {
      var state = this.getSettings('state'),
          settings = this.elements.$loadMore.data('settings');
      this.setPaged({
        paged: state.paged,
        maxNumPages: settings.maxNumPages
      });
      this.elements.$loadMoreButton.on('click', this.handleLoadMore.bind(this));
    }
  },
  onInit: function onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
    this.initializeOnce();
    this.initialize();
  },
  initializeOnce: function initializeOnce() {
    if (this.getInstanceValue('pagination_type') === 'page_based') {
      this.paginationModule();
    }

    if (this.getInstanceValue('show_sortable') === 'yes') {
      this.sortableModule();
    }
  },
  initialize: function initialize() {
    if (this.getInstanceValue('layout') === 'masonry') {
      this.runMasonry();
    }

    if (this.getInstanceValue('mirror_rows') === 'yes') {
      this.mirrorRows();
    }

    if (this.getInstanceValue('pagination_type') === 'infinite_load') {
      this.infiniteLoadWaypoint();
    }

    objectFitPolyfill(this.$element.find(this.getSettings('selectors.postImageFit')));
  },
  paginationModule: function paginationModule() {
    var _Pagination = _pagination["default"].extend({
      handlePagination: this.handlePagination.bind(this)
    });

    this.Pagination = new _Pagination({
      $element: this.$element.find(this.getSettings('selectors.pagination'))
    });
  },
  sortableModule: function sortableModule() {
    var _Sortable = _sortable["default"].extend({
      handleSort: this.handleSort.bind(this)
    });

    this.Sortable = new _Sortable({
      $element: this.$element.find(this.getSettings('selectors.sortable'))
    });
  },
  afterAppend: function afterAppend() {
    if (this.getInstanceValue('mirror_rows') === 'yes') {
      this.mirrorRows();
    }

    if (this.getInstanceValue('pagination_type') === 'infinite_load') {
      this.infiniteLoadWaypoint();
    }
  },
  setColumnsCount: function setColumnsCount() {
    var curDevice = elementorFrontend.getCurrentDeviceMode();
    var columnsKey = "columns_".concat(curDevice);

    if (curDevice === 'desktop') {
      columnsKey = 'columns';
    }

    this.setSettings('columnsCount', parseInt(this.getInstanceValue(columnsKey)));
  },
  runMasonry: function runMasonry() {
    this.Masonry = new _masonry["default"]({
      $element: this.$element
    });
    this.Masonry.run();
  },
  mirrorRows: function mirrorRows() {
    this.setColumnsCount();
    var settings = this.getSettings(),
        $postsItems = this.$element.find(settings.selectors.postItem);
    $postsItems.filter(settings.selectors.postMirrored).removeAttr(settings.classes.postMirrored);

    if ($postsItems.length && $postsItems.length > settings.columnsCount) {
      var totalRows = $postsItems.length / settings.columnsCount;

      for (var i = 1; i < totalRows; i += 2) {
        var startIndex = i * settings.columnsCount;
        $postsItems.slice(startIndex, startIndex + settings.columnsCount).attr(settings.classes.postMirrored, true);
      }
    }
  },
  infiniteLoadWaypoint: function infiniteLoadWaypoint() {
    var _this = this;

    var self = this;
    self.elements.$postsContainer.imagesLoaded().always(function () {
      var options = {
        offset: 'bottom-in-view',
        triggerOnce: true
      };
      elementorFrontend.waypoint(self.elements.$postsContainer, _this.handleInfiniteLoad.bind(_this), options);
    });
  },
  ajaxPosts: function ajaxPosts(data, callback) {
    var ajaxData = {
      action: 'raven_get_render_posts',
      post_id: this.getCurrentPostId(),
      model_id: this.getID(),
      paged: data.paged,
      category: data.category
    };
    var archiveQuery = this.elements.$postsContainer.data('archive-query');

    if (archiveQuery) {
      ajaxData.archive_query = JSON.stringify(archiveQuery);
    }

    var ajaxSuccess = function ajaxSuccess(res) {
      if (!res.success || !res.data.posts) {
        return;
      }

      callback(res);
    };

    var ajaxComplete = function ajaxComplete() {
      this.setSettings('state.isLoading', false);
    };

    this.setSettings('state.isLoading', true);
    $.ajax({
      type: 'POST',
      url: _wpUtilSettings.ajax.url,
      data: ajaxData,
      success: ajaxSuccess,
      complete: ajaxComplete.bind(this)
    });
  },
  addPosts: function addPosts(data) {
    var state = this.getSettings('state');

    if (state.isLoading || state.paged < 1) {
      return false;
    }

    this.ajaxPosts(data, this.appendPosts);
    return true;
  },
  appendPosts: function appendPosts(res) {
    var state = this.getSettings('state');

    switch (this.getInstanceValue('layout')) {
      case 'masonry':
        this.Masonry.push(res.data.posts);
        break;

      default:
        this.elements.$postsContainer.append(res.data.posts);
    }

    this.setPaged({
      paged: state.paged + 1,
      maxNumPages: res.data.max_num_pages
    });
    this.afterAppend();
  },
  setPosts: function setPosts(data) {
    var state = this.getSettings('state');

    if (state.isLoading) {
      return false;
    }

    this.ajaxPosts(data, this.renderPosts);
    return true;
  },
  renderPosts: function renderPosts(res) {
    this.elements.$postsContainer.empty();
    this.elements.$postsContainer.append(res.data.posts);

    if (this.Sortable && !this.Sortable.isEnabled()) {
      this.Sortable.renderUpdate();

      if (this.Pagination && this.Pagination.isEnabled()) {
        this.Pagination.recreatePagination(res.data.max_num_pages);
      }
    }

    if (this.Pagination && !this.Pagination.isEnabled()) {
      this.Pagination.renderUpdate();
    }

    this.setPaged({
      paged: 1,
      maxNumPages: res.data.max_num_pages
    });
    this.initialize();
  },
  handleLoadMore: function handleLoadMore(event) {
    event.preventDefault();
    var state = this.getSettings('state'),
        newPaged = state.paged + 1;
    this.addPosts({
      paged: newPaged,
      category: state.category
    });
  },
  handleInfiniteLoad: function handleInfiniteLoad() {
    var state = this.getSettings('state'),
        newPaged = state.paged + 1;
    this.addPosts({
      paged: newPaged,
      category: state.category
    });
  },
  handlePagination: function handlePagination(pageNum) {
    this.scrollToContainer(this.elements.$postsContainer);
    this.setPosts({
      paged: pageNum,
      category: this.getSettings('state.category')
    });
  },
  handleSort: function handleSort(category) {
    var postOk = this.setPosts({
      paged: 1,
      category: category
    });

    if (postOk) {
      this.setSettings('state.category', category);
    }
  },
  setPaged: function setPaged(params) {
    var paged = params.paged,
        maxNumPages = params.maxNumPages;

    if (paged >= maxNumPages) {
      paged = -1;
    }

    if (paged === -1) {
      this.elements.$loadMore.hide();
    } else {
      this.elements.$loadMore.show();
    }

    this.setSettings('state.paged', paged);
    this.setSettings('state.maxNumPages', maxNumPages);
  },
  getCurrentPostId: function getCurrentPostId() {
    return parseInt(this.elements.$postsContainer.data('post-id'));
  },
  onSectionActivated: function onSectionActivated(activeSection) {
    if (!activeSection) {
      return;
    }

    this.editOverlayIcons(activeSection.indexOf('section_icons') !== -1);
  },
  onEditorClosed: function onEditorClosed() {
    this.editOverlayIcons(false);
  },
  editOverlayIcons: function editOverlayIcons(toggle) {
    this.$element.toggleClass('raven-edit-icons', toggle);
  }
});

function classic($scope) {
  new Posts({
    $element: $scope
  });
}

function cover($scope) {
  new Posts({
    $element: $scope
  });
}

},{"../utils/masonry":4,"../utils/module":5,"../utils/pagination":16,"../utils/sortable":18,"@babel/runtime/helpers/interopRequireDefault":60}],41:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

var ProductDataTabs = _module["default"].extend({
  getDefaultSettings: function getDefaultSettings() {
    return {
      selectors: {
        standardTab: '.raven-product-data-tabs.standard-tab-style .woocommerce-tabs ul.tabs a'
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    return {
      $standardTab: this.$element.find(selectors.standardTab)
    };
  },
  bindEvents: function bindEvents() {
    if (document.body.classList.contains('elementor-editor-active')) {
      $('.wc-tabs-wrapper, .woocommerce-tabs, #rating').trigger('init');
    }

    this.elements.$standardTab.on('click', function (event) {
      $('.raven-product-data-tabs.standard-tab-style .woocommerce-tabs ul.tabs li').removeClass('previous-tab');
      var target = $(event.currentTarget).parent(),
          previousElement = target.prev();
      previousElement.addClass('previous-tab');
    });
  }
});

function _default($scope) {
  new ProductDataTabs({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],42:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

var ProductsGallery = _module["default"].extend({
  getDefaultSettings: function getDefaultSettings() {
    return {
      selectors: {
        gallery: '.raven-product-gallery-wrapper',
        galleryItemsWrapper: '.raven-product-gallery-items',
        galleryItems: '.raven-product-gallery-items li',
        galleryBase: '.woocommerce-product-gallery-raven-widget',
        galleryThumbs: '.flex-control-thumbs'
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    return {
      $gallery: this.$element.find(selectors.gallery),
      $galleryItemsWrapper: this.$element.find(selectors.galleryItemsWrapper),
      $galleryItems: this.$element.find(selectors.galleryItems),
      $galleryBase: this.$element.find(selectors.galleryBase),
      $galleryThumbs: this.$element.find(selectors.galleryThumbs)
    };
  },
  getGallerylSettings: function getGallerylSettings() {
    return {
      layout: this.getInstanceValue('gallery_layout'),
      thumbnails: this.getInstanceValue('thumbnails') || '',
      carousel: this.getInstanceValue('carousel'),
      lightbox: this.getInstanceValue('lightbox'),
      zoom: this.getInstanceValue('zoom'),
      wcZoomDisabled: this.$element.data('wc-disable-zoom') || '',
      wcLighboxDisabled: this.$element.data('wc-disable-lightbox') || '',
      videoIsEnable: this.getInstanceValue('video_enable') === '1' ? true : false
    };
  },
  onInit: function onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
  },
  bindEvents: function bindEvents() {
    this.galleryEvent();
  },
  galleryEvent: function galleryEvent() {
    var $ = jQuery,
        settings = this.getGallerylSettings(),
        slider = this.elements.$galleryBase.find('.raven-product-gallery-slider-wrapper');
    $(slider).removeClass('jupiterx-product-gallery-vertical jupiterx-product-gallery-horizontal jupiterx-product-gallery-none');

    var ProductGallery = function ProductGallery($target) {
      var _this = this;

      this.$target = $target;

      if ('stack' === settings.layout) {
        if (settings.zoom) {
          this.initZoom('li');
        }

        if (settings.zoom) {
          this.lightbox();
        }

        if (settings.videoIsEnable) {
          this.controlVideoOnload();
          this.endedVideo();
          this.handleVideoHeight();
        }
      }

      if ('standard' === settings.layout) {
        this.slider();

        if (!settings.carousel) {
          this.carousel();
        }

        if (settings.zoom) {
          this.zoomIcon();
        }

        if (settings.lightbox) {
          this.standardLightbox();
        }

        if (!settings.lightbox) {
          var $image = this.$target.find('.woocommerce-product-gallery__image');
          $image.find('a').css('pointer-events', 'none');
        }

        if (settings.wcZoomDisabled && settings.zoom) {
          setTimeout(function () {
            _this.initZoom('.woocommerce-product-gallery__image');
          }, 100);
        }

        if (settings.wcLighboxDisabled && settings.lightbox && !settings.videoIsEnable) {
          this.initPhotoswipe();
        }

        this.disableProductElementorLighBox();
        this.createSlickThumbnailsSlider();
        this.repositionDirectionNav();

        if (settings.videoIsEnable) {
          this.handleVideoOnChangeSlide();
          this.handlePhotoswipe();
          this.endedVideo();
        }
      }
    };

    ProductGallery.prototype.endedVideo = function () {
      $('video').on('ended', function (event) {
        var current = $(event.currentTarget),
            iconTag = current.parent().find('i');
        iconTag.removeClass('circle-pause').addClass('circle-play');
      });
    };

    ProductGallery.prototype.handleVideoHeight = function () {
      var $gallery = this.$target.find('.raven-product-gallery-stack-wrapper'),
          videos = $gallery.find('.jupiterx-product-gallery-stack-video'),
          images = $gallery.find('.raven-product-gallery-stack-image'),
          imagesHeight = images.height();

      if (images.length === 0) {
        videos.css('height', 'max-content');
        return;
      }

      videos.height(imagesHeight);
    };

    ProductGallery.prototype.slider = function () {
      var args = {
        flexslider: {
          allowOneSlide: false,
          animation: 'slide',
          animationLoop: false,
          animationSpeed: 500,
          controlNav: 'thumbnails',
          directionNav: true,
          nextText: '<svg fill=\"#333333\" version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" width=\"7.2px\" height=\"12px\" viewBox=\"0 0 7.2 12\" style=\"enable-background:new 0 0 7.2 12;\" xml:space=\"preserve\"><path class=\"st0\" d=\"M4.8,6l-4.5,4.3c-0.4,0.4-0.4,1,0,1.4c0.4,0.4,1,0.4,1.4,0l5.2-5C7.1,6.5,7.2,6.3,7.2,6S7.1,5.5,6.9,5.3l-5.2-5C1.5,0.1,1.2,0,1,0C0.7,0,0.5,0.1,0.3,0.3c-0.4,0.4-0.4,1,0,1.4L4.8,6z\"/></svg>',
          prevText: '<svg fill=\"#333333\" version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" width=\"7.2px\" height=\"12px\" viewBox=\"0 0 7.2 12\" style=\"enable-background:new 0 0 7.2 12;\" xml:space=\"preserve\"><path class=\"st0\" d=\"M2.4,6l4.5-4.3c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0l-5.2,5C0.1,5.5,0,5.7,0,6s0.1,0.5,0.3,0.7l5.2,5\tC5.7,11.9,6,12,6.2,12c0.3,0,0.5-0.1,0.7-0.3c0.4-0.4,0.4-1,0-1.4L2.4,6z\"/></svg>',
          rtl: false,
          slideshow: false,
          smoothHeight: true
        },
        photoswipe_enabled: settings.lightbox && !settings.videoIsEnable ? true : false,
        zoom_enabled: settings.zoom ? true : false
      };
      slider.wc_product_gallery(args);
    };

    ProductGallery.prototype.getGalleryItems = function () {
      var $slides = $('.woocommerce-product-gallery__image'),
          items = [];

      if ($slides.length > 0) {
        $slides.each(function (i, el) {
          var img = $(el).find('img');

          if (img.length > 0) {
            var largeImageSrc = img.attr('data-large_image'),
                largeImageW = img.attr('data-large_image_width'),
                largeImageH = img.attr('data-large_image_height'),
                alt = img.attr('alt'),
                item = {
              alt: alt,
              src: largeImageSrc,
              w: largeImageW,
              h: largeImageH,
              title: img.attr('data-caption') ? img.attr('data-caption') : img.attr('title')
            };
            items.push(item);
          } else {
            $(el).find('.jupiterx-attachment-media-custom-video-icons').css('max-width', 'inherit');
            var iframe = $(el).find('.jupiterx-attachment-media-iframe').parent().html();
            items.push({
              html: '<div class="jupiterx-pswp-attachment-media-iframe">' + iframe + '</div>'
            });
          }
        });
      }

      return items;
    };

    ProductGallery.prototype.handlePhotoswipe = function () {
      if (!settings.lightbox) {
        return;
      } // Disable all default events.


      this.$target.off('click', '.woocommerce-product-gallery__trigger');
      this.$target.off('click', '.woocommerce-product-gallery__image a');
      this.$target.on('click', '.woocommerce-product-gallery__trigger', this.openPhotoswipe);
      this.$target.on('click', '.woocommerce-product-gallery__image a', function (e) {
        e.preventDefault();
      });

      if (settings.zoom) {
        if (this.$target.find('.woocommerce-product-gallery__trigger').length === 0) {
          this.$target.append('<a href="#" class="woocommerce-product-gallery__trigger"></a>');
        }

        var $zoomIcon = $(this.$target).find('.woocommerce-product-gallery__trigger');
        $($zoomIcon).hide();
        $(document).on('click', '.zoomImg, .woocommerce-product-gallery__image a', function () {
          $($zoomIcon).click();
        });
      }
    };
    /**
     * Init PhotoSwipe.
     */


    ProductGallery.prototype.initPhotoswipe = function () {
      var $target = this.$target,
          images = $target.find('img');

      if (images.length > 0) {
        this.$target.prepend('<a href="#" class="woocommerce-product-gallery__trigger"></a>');
        this.$target.on('click', '.woocommerce-product-gallery__trigger', this.openPhotoswipe);
        this.$target.on('click', '.woocommerce-product-gallery__image a', function (event) {
          event.preventDefault();
        });
      }

      if (settings.zoom) {
        var $zoomIcon = $target.find('.woocommerce-product-gallery__trigger');
        $(document).on('click', '.flex-active-slide', function (event) {
          var iframe = $(event.currentTarget).find('.jupiterx-attachment-media-iframe');

          if (iframe.length > 0) {
            return;
          }

          $($zoomIcon).click();
        });
      }
    };

    ProductGallery.prototype.handleVideoOnPhotoSwipe = function (element, photoswipe) {
      if (!$(element).hasClass('pswp--open')) {
        return;
      }

      photoswipe.listen('beforeChange', function () {
        var video = $(element).find('video'),
            iframe = $(element).find('iframe'),
            items = $(element).find('.pswp__item');

        if (video.length > 0) {
          var iconTag = video.parent().find('i');
          iconTag.removeClass('circle-pause').addClass('circle-play');
          video.get(0).pause();
        }

        if (iframe.length > 0) {
          ProductGallery.prototype.resetIframes(iframe);
          $(element).find('iframe').on('load', function (event) {
            $(event.currentTarget).parent().removeClass('iframe-on-load');
            $(event.currentTarget).show();
            $(event.currentTarget).next().hide();
          });
        }

        items.each(function (index, item) {
          if ('block' === $(item).css('display') && typeof $(item).find('video').attr('autoplay') !== 'undefined') {
            var _iconTag = video.parent().find('i');

            _iconTag.removeClass('circle-play').addClass('circle-pause');

            $(item).find('video').get(0).play();
          }
        });
      });
      ProductGallery.prototype.handleVideoOnClick($(element));
    };

    ProductGallery.prototype.openPhotoswipe = function (event) {
      event.preventDefault();
      var pswpElement = $('.pswp')[0],
          items = ProductGallery.prototype.getGalleryItems(),
          eventTarget = $(event.target);
      var clicked;

      if (eventTarget.is('.woocommerce-product-gallery__trigger') || eventTarget.is('.woocommerce-product-gallery__trigger img')) {
        clicked = slider.find('.flex-active-slide');
      } else {
        clicked = eventTarget.closest('.woocommerce-product-gallery__image');
        return;
      }

      var options = $.extend({
        index: $(clicked).index(),
        addCaptionHTMLFn: function addCaptionHTMLFn(item, captionEl) {
          if (!item.title) {
            captionEl.children[0].textContent = '';
            return false;
          }

          captionEl.children[0].textContent = item.title;
          return true;
        } // eslint-disable-line

      }, {
        closeOnScroll: false,
        history: false,
        hideAnimationDuration: 0,
        showAnimationDuration: 0
      }); // Initializes and opens PhotoSwipe.

      var photoswipe = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options); // eslint-disable-line

      photoswipe.init();
      ProductGallery.prototype.handleVideoOnPhotoSwipe(pswpElement, photoswipe);
    };

    ProductGallery.prototype.disableProductElementorLighBox = function () {
      var $imageLinks = $(this.$target).find('a');

      if (settings.lightbox && document.body.classList.contains('elementor-editor-active')) {
        $($imageLinks).attr('data-elementor-open-lightbox', 'yes');
        return;
      }

      $($imageLinks).attr('data-elementor-open-lightbox', 'no');
    };

    ProductGallery.prototype.initZoom = function (item) {
      if (!$.isFunction($.fn.zoom)) {
        return;
      }

      var $target = this.$target,
          zoomTarget = $target.find(item);
      $(zoomTarget).each(function (index, target) {
        var image = $(target).find('img'),
            itemWidth = $(target).width();

        if (image.data('large_image_width') > itemWidth) {
          var zoomOptions = {
            touch: false
          };

          if ('ontouchstart' in window) {
            zoomOptions.on = 'click';
          }

          $(target).trigger('zoom.destroy');
          $(target).zoom(zoomOptions);
        }
      });
    };

    ProductGallery.prototype.carousel = function () {
      var $target = this.$target,
          nav = $target.find('.flex-direction-nav');
      $(nav).remove();
    };

    ProductGallery.prototype.lightbox = function () {
      var self = this;
      setTimeout(function () {
        var $target = self.$target;
        $target.on('click', '.zoomImg', function (event) {
          $(event.currentTarget).prev().click();
        });
      }, 100);
    };

    ProductGallery.prototype.standardLightbox = function () {
      if (settings.zoom) {
        return;
      }

      var $target = this.$target;

      if ($target.find('.woocommerce-product-gallery__trigger').length === 0) {
        this.$target.append('<a href="#" class="woocommerce-product-gallery__trigger"></a>');
      }

      var $zoomIcon = null;
      $zoomIcon = $target.find('.woocommerce-product-gallery__trigger');
      $($zoomIcon).hide();
      $(document).on('click', '.zoomImg, .woocommerce-product-gallery__image a', function () {
        $($zoomIcon).click();
      });
    };

    ProductGallery.prototype.zoomIcon = function () {
      var $target = this.$target,
          $zoomIcon = $target.find('.woocommerce-product-gallery__trigger');
      $($zoomIcon).hide();

      if (settings.lightbox) {
        $target.on('click', '.zoomImg, .woocommerce-product-gallery__image a', function () {
          $($zoomIcon).click();
        });
      }
    };

    ProductGallery.prototype.createSlickThumbnailsSlider = function () {
      var $gallery = this.$target.find('.raven-product-gallery-slider-wrapper');
      var options = {
        infinite: false,
        draggable: false,
        slidesToShow: 7,
        slidesToScroll: 1,
        prevArrow: '<button class="slick-prev" aria-label="Prev" type="button"><svg fill="#333333" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.2px" height="12px" viewBox="0 0 7.2 12" style="enable-background:new 0 0 7.2 12;" xml:space="preserve"><path class="st0" d="M2.4,6l4.5-4.3c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0l-5.2,5C0.1,5.5,0,5.7,0,6s0.1,0.5,0.3,0.7l5.2,5	C5.7,11.9,6,12,6.2,12c0.3,0,0.5-0.1,0.7-0.3c0.4-0.4,0.4-1,0-1.4L2.4,6z"/></svg></button>',
        nextArrow: '<button class="slick-next" aria-label="Next" type="button"><svg fill="#333333" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="7.2px" height="12px" viewBox="0 0 7.2 12" style="enable-background:new 0 0 7.2 12;" xml:space="preserve"><path class="st0" d="M4.8,6l-4.5,4.3c-0.4,0.4-0.4,1,0,1.4c0.4,0.4,1,0.4,1.4,0l5.2-5C7.1,6.5,7.2,6.3,7.2,6S7.1,5.5,6.9,5.3l-5.2-5C1.5,0.1,1.2,0,1,0C0.7,0,0.5,0.1,0.3,0.3c-0.4,0.4-0.4,1,0,1.4L4.8,6z"/></svg></button>'
      };

      if (['left', 'right'].includes(settings.thumbnails)) {
        options = $.extend(options, {
          vertical: true,
          slidesToShow: 5
        });
        setTimeout(function () {
          var activeItems = $gallery.find('.slick-active'),
              count = activeItems.length;
          var height = activeItems.height() * count;

          if (parseInt(activeItems.css('margin-bottom')) > 0) {
            height += parseInt(activeItems.css('margin-bottom')) * count;
          }

          if (parseInt(activeItems.css('border-bottom-width')) > 0) {
            height += parseInt(activeItems.css('border-bottom-width')) * count;
          }

          if (parseInt(activeItems.css('border-top-width')) > 0) {
            height += parseInt(activeItems.css('border-top-width')) * count;
          }

          $gallery.find('.slick-track, .slick-list').css('height', height + 'px');
        }, 100);
      }

      $gallery.find('.flex-control-thumbs').slick(options);

      if (settings.videoIsEnable) {
        var galleryItems = $gallery.find('.woocommerce-product-gallery__image');
        galleryItems.each(function (index, element) {
          if (typeof $(element).data('poster') !== 'undefined') {
            $('.flex-control-nav').find('li[data-slick-index=' + index + ']').prepend('<i class="jupiterx-product-single-play-icon"></i>');
          }
        });
      }

      $gallery.on('click', '.flex-direction-nav a', function () {
        $gallery.find('.flex-control-nav').slick('slickGoTo', $gallery.find('.flex-active-slide').index());
      });
    };

    ProductGallery.prototype.repositionDirectionNav = function () {
      var $gallery = this.$target.find('.raven-product-gallery-slider-wrapper');

      var positionNav = function positionNav() {
        var $nav = $gallery.find('.flex-direction-nav'),
            $thumbs = $gallery.find('.flex-control-thumbs'),
            $videoIcon = $gallery.find('.jupiterx-attachment-media-custom-video-icons'),
            $viewport = $gallery.find('.flex-viewport');
        var width = $thumbs.outerWidth(true);

        if (settings.thumbnails === 'right') {
          $nav.css('right', width);
        }

        if (settings.thumbnails === 'left') {
          $nav.css('left', width);
        }

        $videoIcon.css('max-width', $viewport.width());
      };

      $(window).resize(positionNav);
      positionNav();
    };

    ProductGallery.prototype.handleVideoOnClick = function ($gallery) {
      $gallery.on('click', '.jupiterx-attachment-media-custom-video-icons', function (event) {
        var current = $(event.currentTarget),
            iconTag = $(event.currentTarget).find('i'),
            video = current.prev(),
            wrapper = $gallery.find('.jupiterx-attachment-media-iframe'),
            videos = $gallery.find('video'),
            iframe = $gallery.find('iframe');

        if (iframe.length > 0) {
          ProductGallery.prototype.resetIframes(iframe);
        }

        if (!video.get(0).paused) {
          iconTag.removeClass('circle-pause').addClass('circle-play');
          video.get(0).pause();
          return;
        }

        wrapper.find('i').removeClass('circle-pause').addClass('circle-play');
        videos.trigger('pause');
        iconTag.removeClass('circle-play').addClass('circle-pause');
        video.get(0).play();
      });
    };

    ProductGallery.prototype.controlVideoOnload = function () {
      var $gallery = this.$target.find('.raven-product-gallery-stack-wrapper'),
          videos = $gallery.find('video'),
          iframe = $gallery.find('iframe');
      var active = $gallery.find('li:first-child');

      if ($gallery.length === 0) {
        return;
      }

      if (videos.length > 0) {
        videos.each(function () {
          var iconTag = $(this).parent().find('i');
          iconTag.removeClass('circle-pause').addClass('circle-play');
          $(this).get(0).pause();
        });
      }

      if (iframe.length > 0) {
        ProductGallery.prototype.resetIframes(iframe);
        iframe.on('load', function (event) {
          $(event.currentTarget).parent().removeClass('iframe-on-load');
          $(event.currentTarget).show();
          $(event.currentTarget).next().hide();
        });
      }

      if (videos.length > 0 && active.find('video').length === 0) {
        var firstVideo = videos[0];
        active = $(firstVideo).parent();
      }

      if (active.length > 0 && active.find('video').length > 0 && typeof active.find('video').attr('autoplay') !== 'undefined') {
        var iconTag = active.find('video').parent().find('i');
        iconTag.removeClass('circle-play').addClass('circle-pause');
        active.find('video').get(0).play();
      }

      ProductGallery.prototype.handleVideoOnClick($gallery);
    };

    ProductGallery.prototype.handleVideoOnChangeSlide = function () {
      var $gallery = this.$target,
          selectors = '.flex-direction-nav a, .flex-control-thumbs li, .woocommerce-product-gallery__image a, .woocommerce-product-gallery__trigger';
      $gallery.on('click', selectors, function () {
        var video = $gallery.find('video'),
            iframe = $gallery.find('iframe'),
            active = $gallery.find('.flex-active-slide');

        if (video.length > 0) {
          var iconTag = video.parent().find('i');
          iconTag.removeClass('circle-pause').addClass('circle-play');
          video.each(function (index, item) {
            $(item).get(0).pause();
          });
        }

        if (iframe.length > 0) {
          ProductGallery.prototype.resetIframes(iframe);
          iframe.on('load', function (event) {
            $(event.currentTarget).parent().removeClass('iframe-on-load');
            $(event.currentTarget).show();
            $(event.currentTarget).next().hide();
          });
        }

        if (active.length > 0 && typeof active.find('video').attr('autoplay') !== 'undefined') {
          var _iconTag2 = video.parent().find('i');

          _iconTag2.removeClass('circle-play').addClass('circle-pause');

          active.find('video').get(0).play();
        }
      });
      ProductGallery.prototype.handleVideoOnClick($gallery);
    };

    ProductGallery.prototype.resetIframes = function (iframe) {
      iframe.each(function (index, element) {
        var src = $(element).attr('src');
        $(element).attr('src', src);
      });
    };

    new ProductGallery(jQuery('.raven-product-gallery-wrapper'));
  }
});

function _default($scope) {
  new ProductsGallery({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],43:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

/* eslint no-undef: 0 */
var $ = jQuery;

function _default() {
  loadFromBrowser();
  ratingSelector();
  submitNewReview();
}

var submitNewReview = function submitNewReview() {
  $('.jupiterx-product-review-submit-new').on('click', function () {
    $('.jupiterx-product-review-alarm').css('display', 'none');
    $('.jupiterx-product-review-global-error').css('display', 'none');
    var rate = $('#jupiterx-product-review-input-rating');
    var content = $('.jupiterx-product-review-textarea');
    var name = $('.jupiterx-product-review-name');
    var email = $('.jupiterx-product-review-email');
    var related = $('#jupiterx-product-review-related');
    var requiredFields = [rate, content, name, email];
    var error = false;
    requiredFields.forEach(function (item) {
      if ('' === item.val()) {
        error = true;
        item.parent().find('.jupiterx-product-review-alarm').css('display', 'block');
      }
    });

    if (true === error) {
      return;
    }

    if ($('#jupiterx-product-review-acceptance').length > 0 && $('#jupiterx-product-review-acceptance').is(':checked')) {
      saveToBrowser(name.val(), email.val());
    }

    wp.ajax.post({
      beforeSend: function beforeSend() {
        $('.jupiterx-product-review-form-wrapper').css('opacity', 0.5);
      },
      action: 'jupiterx_product_review_submitter',
      score: rate.val(),
      content: content.val(),
      name: name.val(),
      email: email.val(),
      post_id: related.val(),
      nonce: ravenTools.nonce
    }).always(function () {
      $('.jupiterx-product-review-form-wrapper').css('opacity', 1.0);
    }).done(function () {
      location.reload();
    }).fail(function () {
      $('.jupiterx-product-review-global-error').css('display', 'block');
    });
  });
};

var ratingSelector = function ratingSelector() {
  var elements = document.querySelectorAll('.jupiterx-product-review-rating-selector'); // Elementor editor mode.

  var selector = 'jupiterx-product-review-rating-selector ',
      marked = selector + ' jupiterx-product-review-marked',
      unmarked = selector + ' jupiterx-product-review-unmarked';
  var checker = true; // On click;

  elements.forEach(function (el) {
    return el.addEventListener('click', function () {
      $('.jupiterx-product-review-rating-selector').attr('class', unmarked);
      $(el).attr('class', marked);
      $(el).prevAll().attr('class', marked);
      $('#jupiterx-product-review-input-rating').val($(el).attr('data-rate'));
      checker = false;
    });
  });
  elements.forEach(function (el) {
    return el.addEventListener('mouseover', function () {
      if (false === checker) {
        return;
      }

      $(el).attr('class', marked);
      $(el).prevAll().attr('class', marked);
    });
  }); // On mouseout.

  elements.forEach(function (el) {
    return el.addEventListener('mouseout', function () {
      if (false === checker) {
        return;
      }

      $(el).attr('class', unmarked);
      $(el).prevAll().attr('class', unmarked);
    });
  });
};

var loadFromBrowser = function loadFromBrowser() {
  if (null !== localStorage.getItem('jupiterx-product-review-name')) {
    $('.jupiterx-product-review-name').val(localStorage.getItem('jupiterx-product-review-name'));
  }

  if (null !== localStorage.getItem('jupiterx-product-review-email')) {
    $('.jupiterx-product-review-email').val(localStorage.getItem('jupiterx-product-review-email'));
  }
};

var saveToBrowser = function saveToBrowser(name, email) {
  localStorage.setItem('jupiterx-product-review-name', name);
  localStorage.setItem('jupiterx-product-review-email', email);
};

},{}],44:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.classic = classic;
exports.full = full;

function classic($scope) {
  var form = $scope.find('.raven-search-form');
  $scope.on('focus', '.raven-search-form-input', function () {
    form.addClass('raven-search-form-focus');
  });
  $scope.on('blur', '.raven-search-form-input', function () {
    form.removeClass('raven-search-form-focus');
  });
}

function full($scope) {
  var elements = {
    lightbox: $scope.find('.raven-search-form-lightbox'),
    inputSearch: $scope.find('.raven-search-form-input')
  };
  $scope.on('click', '.raven-search-form-button', function (event) {
    event.preventDefault();
    elements.lightbox.addClass('raven-search-form-lightbox-open');
    window.setTimeout(function () {
      elements.inputSearch.focus();
    }, 100);
  });
  $scope.on('click', '.raven-search-form-close', function (event) {
    event.preventDefault();
    elements.lightbox.removeClass('raven-search-form-lightbox-open');
  });
  jQuery(document).keyup(function (event) {
    if (event.keyCode === 27) {
      elements.lightbox.removeClass('raven-search-form-lightbox-open');
    }
  });
}

},{}],45:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _regenerator = _interopRequireDefault(require("@babel/runtime/regenerator"));

var _asyncToGenerator2 = _interopRequireDefault(require("@babel/runtime/helpers/asyncToGenerator"));

var _module = _interopRequireDefault(require("../utils/module"));

var $ = jQuery;

var ravenSlider = _module["default"].extend({
  getDefaultSettings: function getDefaultSettings() {
    return {
      selectors: {
        slider: '.raven-slider-wrapper',
        slide: '.swiper-slide',
        slideInnerContents: '.swiper-slide-contents',
        activeSlide: '.swiper-slide-active',
        activeDuplicate: '.swiper-slide-duplicate-active'
      },
      classes: {
        animated: 'animated',
        kenBurnsActive: 'elementor-ken-burns--active',
        slideBackground: 'swiper-slide-bg'
      },
      attributes: {
        dataSliderOptions: 'slider_options',
        dataAnimation: 'animation'
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors'),
        elements = {
      $swiperContainer: this.$element.find(selectors.slider)
    };
    elements.$slides = elements.$swiperContainer.find(selectors.slide);
    return elements;
  },
  getSwiperOptions: function getSwiperOptions() {
    var _this = this;

    var swiperOptions = {
      autoplay: this.getAutoplayConfig(),
      grabCursor: true,
      initialSlide: this.getInitialSlide(),
      slidesPerView: 1,
      slidesPerGroup: 1,
      loop: 'yes' === this.getElementSettings('infinite'),
      speed: this.getElementSettings('transition_speed'),
      effect: this.getElementSettings('transition'),
      observeParents: true,
      observer: true,
      handleElementorBreakpoints: true,
      on: {
        slideChange: function slideChange() {
          _this.handleKenBurns();
        }
      }
    };
    var elementSettingsNavigation = this.getElementSettings('navigation');
    var showArrows = 'arrows' === elementSettingsNavigation || 'both' === elementSettingsNavigation,
        pagination = 'dots' === elementSettingsNavigation || 'both' === elementSettingsNavigation;

    if (showArrows) {
      swiperOptions.navigation = {
        prevEl: '.elementor-swiper-button-prev',
        nextEl: '.elementor-swiper-button-next'
      };
    }

    if (pagination) {
      swiperOptions.pagination = {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
      };
    }

    if (true === swiperOptions.loop) {
      swiperOptions.loopedSlides = this.getSlidesCount();
    }

    if ('fade' === swiperOptions.effect) {
      swiperOptions.fadeEffect = {
        crossFade: true
      };
    }

    return swiperOptions;
  },
  getAutoplayConfig: function getAutoplayConfig() {
    if ('yes' !== this.getElementSettings('autoplay')) {
      return false;
    }

    return {
      stopOnLastSlide: true,
      // Has no effect in infinite mode by default.
      delay: this.getElementSettings('autoplay_speed'),
      disableOnInteraction: 'yes' === this.getElementSettings('pause_on_interaction')
    };
  },
  initSingleSlideAnimations: function initSingleSlideAnimations() {
    var settings = this.getSettings(),
        animation = this.elements.$swiperContainer.data(settings.attributes.dataAnimation);
    this.elements.$swiperContainer.find('.' + settings.classes.slideBackground).addClass(settings.classes.kenBurnsActive); // If there is an animation, get the container of the slide's inner contents and add the animation classes to it

    if (animation) {
      this.elements.$swiperContainer.find(settings.selectors.slideInnerContents).addClass(settings.classes.animated + ' ' + animation);
    }
  },
  initSlider: function initSlider() {
    var _this2 = this;

    return (0, _asyncToGenerator2["default"])( /*#__PURE__*/_regenerator["default"].mark(function _callee() {
      var $slider, settings, animation, Swiper;
      return _regenerator["default"].wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              $slider = _this2.elements.$swiperContainer, settings = _this2.getSettings(), animation = $slider.data(settings.attributes.dataAnimation);

              if ($slider.length) {
                _context.next = 3;
                break;
              }

              return _context.abrupt("return");

            case 3:
              if (!(1 >= _this2.getSlidesCount())) {
                _context.next = 5;
                break;
              }

              return _context.abrupt("return");

            case 5:
              Swiper = elementorFrontend.utils.swiper;
              _context.next = 8;
              return new Swiper($slider, _this2.getSwiperOptions());

            case 8:
              _this2.swiper = _context.sent;
              // Expose the swiper instance in the frontend
              $slider.data('swiper', _this2.swiper); // The Ken Burns effect will only apply on the specific slides that toggled the effect ON,
              // since it depends on an additional class besides 'elementor-ken-burns--active'

              _this2.handleKenBurns();

              if (_this2.getElementSettings('pause_on_hover')) {
                _this2.togglePauseOnHover(true);
              }

              if (animation) {
                _context.next = 14;
                break;
              }

              return _context.abrupt("return");

            case 14:
              _this2.swiper.on('slideChangeTransitionStart', function () {
                var $sliderContent = $slider.find(settings.selectors.slideInnerContents);
                $sliderContent.removeClass(settings.classes.animated + ' ' + animation).hide();
              });

              _this2.swiper.on('slideChangeTransitionEnd', function () {
                var $currentSlide = $slider.find(settings.selectors.slideInnerContents);
                $currentSlide.show().addClass(settings.classes.animated + ' ' + animation);
              });

            case 16:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }))();
  },
  onInit: function onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);

    if (2 > this.getSlidesCount()) {
      this.initSingleSlideAnimations();
      return;
    }

    this.initSlider();
  },
  getChangeableProperties: function getChangeableProperties() {
    return {
      pause_on_hover: 'pauseOnHover',
      pause_on_interaction: 'disableOnInteraction',
      autoplay_speed: 'delay',
      transition_speed: 'speed'
    };
  },
  updateSwiperOption: function updateSwiperOption(propertyName) {
    if (0 === propertyName.indexOf('width')) {
      this.swiper.update();
      return;
    }

    var newSettingValue = this.getElementSettings(propertyName),
        changeableProperties = this.getChangeableProperties();
    var propertyToUpdate = changeableProperties[propertyName],
        valueToUpdate = newSettingValue; // Handle special cases where the value to update is not the value that the Swiper library accepts.

    switch (propertyName) {
      case 'autoplay_speed':
        propertyToUpdate = 'autoplay';
        valueToUpdate = {
          delay: newSettingValue,
          disableOnInteraction: 'yes' === this.getElementSettings('pause_on_interaction')
        };
        break;

      case 'pause_on_hover':
        this.togglePauseOnHover('yes' === newSettingValue);
        break;

      case 'pause_on_interaction':
        valueToUpdate = 'yes' === newSettingValue;
        break;
    } // 'pause_on_hover' is implemented by the handler with event listeners, not the Swiper library.


    if ('pause_on_hover' !== propertyName) {
      this.swiper.params[propertyToUpdate] = valueToUpdate;
    }

    this.swiper.update();
  },
  getSlidesCount: function getSlidesCount() {
    return this.elements.$slides.length;
  },
  getInitialSlide: function getInitialSlide() {
    var editSettings = this.getEditSettings();
    return editSettings.activeItemIndex ? editSettings.activeItemIndex - 1 : 0;
  },
  handleKenBurns: function handleKenBurns() {
    var settings = this.getSettings();

    if (this.$activeImageBg) {
      this.$activeImageBg.removeClass(settings.classes.kenBurnsActive);
    }

    this.activeItemIndex = this.swiper ? this.swiper.activeIndex : this.getInitialSlide();

    if (this.swiper) {
      this.$activeImageBg = $(this.swiper.slides[this.activeItemIndex]).children('.' + settings.classes.slideBackground);
    } else {
      this.$activeImageBg = $(this.elements.$slides[0]).children('.' + settings.classes.slideBackground);
    }

    this.$activeImageBg.addClass(settings.classes.kenBurnsActive);
  },
  // This method live-handles the 'Pause On Hover' control's value being changed in the Editor Panel
  togglePauseOnHover: function togglePauseOnHover(toggleOn) {
    var _this3 = this;

    if (toggleOn) {
      this.elements.$swiperContainer.on({
        mouseenter: function mouseenter() {
          _this3.swiper.autoplay.stop();
        },
        mouseleave: function mouseleave() {
          _this3.swiper.autoplay.start();
        }
      });
    } else {
      this.elements.$swiperContainer.off('mouseenter mouseleave');
    }
  },
  onElementChange: function onElementChange(propertyName) {
    if (1 >= this.getSlidesCount()) {
      return;
    }

    var changeableProperties = this.getChangeableProperties();

    if (changeableProperties.hasOwnProperty(propertyName)) {
      this.updateSwiperOption(propertyName);
    }
  },
  onEditSettingsChange: function onEditSettingsChange(propertyName) {
    if (1 >= this.getSlidesCount()) {
      return;
    }

    if ('activeItemIndex' === propertyName) {
      this.swiper.slideToLoop(this.getEditSettings('activeItemIndex') - 1);
    }
  }
});

function _default($scope) {
  new ravenSlider({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/asyncToGenerator":53,"@babel/runtime/helpers/interopRequireDefault":60,"@babel/runtime/regenerator":69}],46:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _i18n = require("@wordpress/i18n");

/* eslint no-undef: "off", no-unused-vars: "off", no-shadow: "off", no-var: "off" */
var $ = jQuery;

function _default($scope) {
  if ($('#jupiterx-raven-social-login-widget-facebook').length > 0) {
    jxRavenSocialLoginfacebook();
  }

  if ($('#jupiterx-raven-social-login-widget-google').length > 0) {
    jxRavenSocialLoginGoogle();
  }

  if ($('#jupiterx-raven-social-login-widget-twitter').length > 0) {
    jxRavenSocialLoginTwitter();
  }
}

var jxRavenSocialLoginfacebook = function jxRavenSocialLoginfacebook() {
  // Facebook event.
  window.fbAsyncInit = function () {
    FB.init({
      appId: jxRavenFacebookAppId,
      // Passed to page from JupiterX_Core\Raven\Modules\Forms\Classes\Social_Login_Handler\facebook::html.
      cookie: true,
      // Enable cookies to allow the server to access the session.
      xfbml: true,
      // Parse social plugins on this webpage.
      version: 'v10.0'
    });
  };

  var facebookBtn = document.getElementById('jupiterx-raven-social-login-widget-facebook');
  facebookBtn.addEventListener('click', function () {
    FB.login(function (response) {
      if (response.authResponse) {
        if ('connected' === response.status) {
          FB.api('/me', {
            fields: 'name, email'
          }, function (data) {
            var email = data.email;
            var name = data.name;
            var fbId = data.id;
            jxRavenSocialFacebookSignIn(email, name, fbId);
          });
        }
      } else {//user hit cancel button
      }
    });
  }, false);

  var jxRavenSocialFacebookSignIn = function jxRavenSocialFacebookSignIn(emailUser, nameUser, fbId) {
    $.ajax({
      url: _wpUtilSettings.ajax.url,
      type: 'POST',
      beforeSend: function beforeSend() {
        jQuery('.raven-social-login-wrap .facebook').css('opacity', '0.5');
        $('.jx-social-login-errors-wrapper').hide().text('');
      },
      data: {
        action: 'raven_form_frontend',
        email: emailUser,
        name: nameUser,
        fbid: fbId,
        post_id: document.getElementById('jx-raven-social-widget-post').value,
        form_id: document.getElementById('jx-raven-social-widget-form').value,
        social_network: 'Facebook'
      }
    }).always(function (data) {
      $('.raven-social-login-wrap .facebook').css('opacity', '1.0');

      if (true === data.success) {
        if (data.data.redirect_url) {
          window.location.href = data.data.login_url + '&redirect=' + data.data.redirect_url;
        } else {
          window.location.href = data.data.login_url;
        }
      } else {
        $('.jx-social-login-errors-wrapper').show().text(data.data);
      }
    });
  };
};

var jxRavenSocialLoginGoogle = function jxRavenSocialLoginGoogle() {
  var googleUser = {};
  var auth2;
  $('#jupiterx-raven-social-login-widget-google span').on('click', function () {
    if (_.isEmpty(jxRavenSocialWidgetGoogleClient)) {
      $('.jx-social-login-errors-wrapper').show().text((0, _i18n.__)('Google client id is empty.', 'jupiterx-core'));
    }
  });

  var startRavenGoogleConnector = function startRavenGoogleConnector() {
    gapi.load('auth2', function () {
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: jxRavenSocialWidgetGoogleClient,
        cookiepolicy: 'single_host_origin'
      });
      jxAssignSignInToElement(document.getElementById('jupiterx-raven-social-login-widget-google'));
    });
  };

  var jxAssignSignInToElement = function jxAssignSignInToElement(element) {
    auth2.attachClickHandler(element, {}, function (googleUser) {
      var token = googleUser.getAuthResponse().id_token; // send to

      checkToken(token);
    }, function (error) {
      $('.jx-social-login-errors-wrapper').show().text(error.message);
    });
  };

  var checkToken = function checkToken(Token) {
    $.ajax({
      url: _wpUtilSettings.ajax.url,
      type: 'POST',
      beforeSend: function beforeSend() {
        $('.raven-social-login-wrap .google').css('opacity', '0.5');
        $('.jx-social-login-errors-wrapper').hide().text('');
      },
      data: {
        token: Token,
        action: 'raven_form_frontend',
        post_id: document.getElementById('jx-raven-social-widget-post').value,
        form_id: document.getElementById('jx-raven-social-widget-form').value,
        social_network: 'Google'
      }
    }).always(function (data) {
      $('.raven-social-login-wrap .google').css('opacity', '1.0');

      if (true === data.success) {
        if (data.data.redirect_url) {
          window.location.href = data.data.login_url + '&redirect=' + data.data.redirect_url;
        } else {
          window.location.href = data.data.login_url;
        }
      } else {
        $('.jx-social-login-errors-wrapper').show().text(data.data);
      }
    });
  };

  startRavenGoogleConnector();
};

var jxRavenSocialLoginTwitter = function jxRavenSocialLoginTwitter() {
  var twitterBtn = document.getElementById('jupiterx-raven-social-login-widget-twitter');
  twitterBtn.addEventListener('click', function () {
    $.ajax({
      url: _wpUtilSettings.ajax.url,
      type: 'POST',
      beforeSend: function beforeSend() {
        $('.raven-social-login-wrap .twitter').css('opacity', '0.5');
        $('.jx-social-login-errors-wrapper').hide().text('');
      },
      data: {
        action: 'raven_form_frontend',
        post_id: document.getElementById('jx-raven-social-widget-post').value,
        form_id: document.getElementById('jx-raven-social-widget-form').value,
        social_network: 'Twitter'
      }
    }).always(function (data) {
      $('.raven-social-login-wrap .twitter').css('opacity', '1.0');

      if (true === data.success) {
        win = window.open(data.data, '_blank');
        win.focus();
      } else {
        $('.jx-social-login-errors-wrapper').show().text(data.data);
      }
    });
  }, false);
};

},{"@wordpress/i18n":76}],47:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

var Tabs = _module["default"].extend({
  $activeContent: null,
  interval: null,
  getDefaultSettings: function getDefaultSettings() {
    return {
      selectors: {
        tabTitle: '.raven-tabs-title',
        tabContent: '.raven-tabs-content'
      },
      classes: {
        active: 'raven-tabs-active'
      },
      showTabFn: 'show',
      hideTabFn: 'hide',
      toggleSelf: true,
      hidePrevious: true,
      autoExpand: true
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    return {
      $tabTitles: this.findElement(selectors.tabTitle),
      $tabContents: this.findElement(selectors.tabContent)
    };
  },
  activateDefaultTab: function activateDefaultTab() {
    var settings = this.getSettings();

    if ((!settings.autoExpand || settings.autoExpand === 'editor') && !this.isEdit) {
      return;
    }

    var defaultActiveTab = this.getEditSettings('activeItemIndex') || 1;
    var originalToggleMethods = {
      showTabFn: settings.showTabFn,
      hideTabFn: settings.hideTabFn
    };
    this.setSettings({
      showTabFn: 'show',
      hideTabFn: 'hide'
    });
    this.changeActiveTab(defaultActiveTab);
    this.setSettings(originalToggleMethods);
  },
  deactivateActiveTab: function deactivateActiveTab(tabIndex) {
    var settings = this.getSettings();
    var activeClass = settings.classes.active;
    var activeFilter = tabIndex ? '[data-tab="' + tabIndex + '"]' : '.' + activeClass;
    var $activeTitle = this.elements.$tabTitles.filter(activeFilter);
    var $activeContent = this.elements.$tabContents.filter(activeFilter);
    $activeTitle.add($activeContent).removeClass(activeClass);
    $activeContent[settings.hideTabFn]();
  },
  activateTab: function activateTab(tabIndex) {
    var settings = this.getSettings();
    var activeClass = settings.classes.active;
    var $requestedTitle = this.elements.$tabTitles.filter('[data-tab="' + tabIndex + '"]');
    var $requestedContent = this.elements.$tabContents.filter('[data-tab="' + tabIndex + '"]');
    $requestedTitle.add($requestedContent).addClass(activeClass);
    $requestedContent[settings.showTabFn]();

    if ($requestedTitle.hasClass('raven-tabs-mobile-title') && window.innerWidth < 1025) {
      var headerHeight = $('header').outerHeight();
      window.scroll({
        top: $requestedContent.offset().top - headerHeight - 100,
        behavior: 'smooth'
      });
    }
  },
  isActiveTab: function isActiveTab(tabIndex) {
    return this.elements.$tabTitles.filter('[data-tab="' + tabIndex + '"]').hasClass(this.getSettings('classes.active'));
  },
  useAjax: function useAjax() {
    var useAjaxLoading = this.getElementSettings('use_ajax_loading');

    if ('yes' === useAjaxLoading) {
      var templateWrapper = $('.raven-tabs-content.raven-tabs-active .raven-ajax-content-template');
      var templateId = templateWrapper.attr('data-id');
      wp.ajax.post({
        action: 'jupiterx_load_content_template',
        // eslint-disable-next-line no-undef
        nonce: ravenTools.nonce,
        template_id: templateId
      }).done(function (response) {
        templateWrapper.html(response);
      }).fail(function () {
        templateWrapper.html('Oops! Something went wrong');
      });
    }
  },
  bindEvents: function bindEvents() {
    var self = this;
    var tabsEvent = self.getElementSettings('tabs_event');
    self.elements.$tabTitles.on(tabsEvent, function (event) {
      self.changeActiveTab(event.currentTarget.dataset.tab);
      self.useAjax();
      clearInterval(self.interval);
    });
  },
  onInit: function onInit() {
    var _this = this;

    var self = this;
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(self, arguments);
    self.activateDefaultTab();
    var autoSwitch = self.getElementSettings('auto_switch');

    if ('yes' === autoSwitch) {
      var delay = self.getElementSettings('auto_swtich_delay');
      var indexNumber = 1;
      var tabsContents = self.getDefaultElements();
      var tabsLength = tabsContents.$tabContents.length;
      self.interval = setInterval(function () {
        indexNumber++;

        if (indexNumber > tabsLength) {
          indexNumber = 1;
        }

        _this.changeActiveTab(indexNumber);
      }, delay);
    }
  },
  onEditSettingsChange: function onEditSettingsChange(propertyName) {
    if (propertyName === 'activeItemIndex') {
      this.activateDefaultTab();
    }
  },
  changeActiveTab: function changeActiveTab(tabIndex) {
    var isActiveTab = this.isActiveTab(tabIndex);
    var settings = this.getSettings();

    if ((settings.toggleSelf || !isActiveTab) && settings.hidePrevious) {
      this.deactivateActiveTab();
    }

    if (!settings.hidePrevious && isActiveTab) {
      this.deactivateActiveTab(tabIndex);
    }

    if (!isActiveTab) {
      this.activateTab(tabIndex);
    }
  }
});

function _default($scope) {
  new Tabs({
    $element: $scope,
    toggleSelf: false
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],48:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

var Video = _module["default"].extend({
  getDefaultSettings: function getDefaultSettings() {
    return {
      selectors: {
        imageOverlay: '.raven-video-thumbnail',
        videoWrapper: '.raven-video',
        videoFrame: 'iframe'
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    var elements = {
      $imageOverlay: this.$element.find(selectors.imageOverlay),
      $videoWrapper: this.$element.find(selectors.videoWrapper)
    };
    elements.$videoFrame = elements.$videoWrapper.find(selectors.videoFrame);
    return elements;
  },
  onInit: function onInit() {
    var _this = this;

    elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);

    if (!this.getElementSettings('use_lightbox')) {
      return;
    }

    if (this.getLightBox() instanceof Promise) {
      this.getLightBox().then(function (lightBox) {
        lightBox.getModal().on('show', _this.handleLightbox);
      });
      return;
    }

    this.getLightBox().getModal().on('show', this.handleLightbox);
  },
  getLightBox: function getLightBox() {
    return elementorFrontend.utils.lightbox;
  },
  handleLightbox: function handleLightbox() {
    if (this.getElementSettings('video_type') === 'hosted') {
      this.handleAspectRatio();
      var message = jQuery(this.getLightBox().getModal().getElements('message')),
          $video = message.find('video');

      if ($video.length) {
        $video.get(0).play();
      }
    }
  },
  handleVideo: function handleVideo() {
    if (!this.getElementSettings('use_lightbox')) {
      this.elements.$imageOverlay.remove();
      this.playVideo();
    }
  },
  playVideo: function playVideo() {
    var $videoFrame = this.elements.$videoFrame;

    if (this.getElementSettings('video_type') === 'youtube') {
      var tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      window.onYouTubeIframeAPIReady = function onYouTubeIframeAPIReady() {
        new YT.Player($videoFrame[0], {
          // eslint-disable-line
          events: {
            onReady: function onPlayerReady(event) {
              event.target.playVideo();
            }
          }
        });
      };
    }

    if (this.getElementSettings('video_type') === 'vimeo') {
      var newSourceUrl = $videoFrame[0].src.replace('autoplay=0', 'autoplay=1');
      $videoFrame[0].src = newSourceUrl;
    }

    if (this.getElementSettings('video_type') === 'hosted') {
      var $video = this.elements.$videoWrapper.find('video');

      if ($video.length) {
        $video.get(0).play();
      }
    }
  },
  handleAspectRatio: function handleAspectRatio() {
    this.getLightBox().setVideoAspectRatio(this.getElementSettings('video_aspect_ratio'));
  },
  bindEvents: function bindEvents() {
    this.elements.$imageOverlay.on('click', this.handleVideo);
  },
  onElementChange: function onElementChange(propertyName) {
    var isLightBoxEnabled = this.getElementSettings('use_lightbox');

    if (!isLightBoxEnabled && propertyName === 'use_lightbox') {
      this.getLightBox().getModal().hide();
      return;
    }

    if (isLightBoxEnabled && propertyName === 'video_aspect_ratio') {
      this.handleAspectRatio();
    }
  }
});

function _default($scope) {
  new Video({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],49:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = _default;

var _module = _interopRequireDefault(require("../utils/module"));

var Products = _module["default"].extend({
  getDefaultSettings: function getDefaultSettings() {
    return {
      selectors: {
        productsWrapper: '.raven-wc-products-wrapper',
        productsContainer: '.products',
        paginationContainer: '.woocommerce-pagination',
        loadMoreButton: '.raven-load-more-button'
      },
      state: {
        isLoading: false,
        paged: 2
      }
    };
  },
  getDefaultElements: function getDefaultElements() {
    var selectors = this.getSettings('selectors');
    return {
      $productsWrapper: this.$element.find(selectors.productsWrapper),
      $productsContainer: this.$element.find(selectors.productsContainer),
      $paginationContainer: this.$element.find(selectors.paginationContainer),
      $loadMoreButton: this.$element.find(selectors.loadMoreButton)
    };
  },
  bindEvents: function bindEvents() {
    if (this.getInstanceValue('pagination_type') === 'load_more') {
      this.loadMore();
    }

    if (this.getInstanceValue('pagination_type') === 'infinite_load') {
      this.infiniteLoad();
    }

    this.zoom();
    this.flexslider();

    if (this.getInstanceValue('wishlist') === 'show') {
      this.wishlist();
    }
  },
  zoom: function zoom() {
    if (this.getInstanceValue('swap_effect') !== 'zoom_hover') {
      return;
    }

    this.elements.$productsWrapper.find('.jupiterx-wc-loop-product-image').zoom();
  },
  flexslider: function flexslider() {
    if (typeof this.getInstanceValue('swap_effect') === 'undefined') {
      return;
    }

    if (!this.getInstanceValue('swap_effect').includes('gallery')) {
      return;
    }

    var self = this;
    var controlNav = false;
    var directionNav = false;

    if (this.getInstanceValue('swap_effect') === 'gallery_arrows') {
      directionNav = true;
    }

    if (this.getInstanceValue('swap_effect') === 'gallery_pagination') {
      controlNav = true;
    }

    self.elements.$productsWrapper.find('.jupiterx-wc-loop-product-image').flexslider({
      selector: '.raven-swap-effect-gallery-slides > li',
      animation: 'slide',
      slideshow: false,
      controlNav: controlNav,
      directionNav: directionNav,
      prevText: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 7.2 12" style="enable-background:new 0 0 7.2 12;" xml:space="preserve"><path class="st0" d="M2.4,6l4.5-4.3c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0l-5.2,5C0.1,5.5,0,5.7,0,6s0.1,0.5,0.3,0.7l5.2,5	C5.7,11.9,6,12,6.2,12c0.3,0,0.5-0.1,0.7-0.3c0.4-0.4,0.4-1,0-1.4L2.4,6z"></path></svg>',
      nextText: '<svg version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 7.2 12" style="enable-background:new 0 0 7.2 12;" xml:space="preserve"><path class="st0" d="M4.8,6l-4.5,4.3c-0.4,0.4-0.4,1,0,1.4c0.4,0.4,1,0.4,1.4,0l5.2-5C7.1,6.5,7.2,6.3,7.2,6S7.1,5.5,6.9,5.3l-5.2-5C1.5,0.1,1.2,0,1,0C0.7,0,0.5,0.1,0.3,0.3c-0.4,0.4-0.4,1,0,1.4L4.8,6z"></path></svg>',
      init: function init() {
        self.elements.$productsWrapper.addClass('raven-swap-effect-gallery-loaded');
      }
    });
  },
  loadMore: function loadMore() {
    var self = this;
    self.elements.$loadMoreButton.on('click', function (event) {
      event.preventDefault();
      self.fetch();
    });
  },
  infiniteLoad: function infiniteLoad() {
    var self = this;

    if (self.elements.$paginationContainer.length) {
      return;
    }

    self.elements.$productsContainer.imagesLoaded().always(function () {
      elementorFrontend.waypoint(self.elements.$productsContainer, self.fetch.bind(self), {
        offset: 'bottom-in-view',
        triggerOnce: true
      });
    });
  },
  fetch: function fetch() {
    var self = this;

    if (self.getSettings('state.isLoading')) {
      return;
    }

    self.setSettings('state.isLoading', true);
    var data = {
      post_id: elementorFrontend.config.post.id,
      model_id: this.getID(),
      'product-page': self.getSettings('state.paged')
    }; // Orderby filter.

    var urlParams = new URLSearchParams(window.location.search);

    if (null !== urlParams.get('orderby') && urlParams.get('orderby').length) {
      data.orderby = urlParams.get('orderby');
    }

    wp.ajax.send('raven_products_query', {
      type: 'GET',
      data: data,
      success: function success(res) {
        self.setSettings('state.paged', self.getSettings('state.paged') + 1);
        self.elements.$productsContainer.append(res.products);
        self.elements.$productsContainer.siblings('.woocommerce-result-count').html(res.result_count);

        if (self.getInstanceValue('pagination_type') === 'load_more' && res.query_results.current_page === res.query_results.total_pages) {
          self.elements.$loadMoreButton.hide();
        }

        if (self.getInstanceValue('pagination_type') === 'infinite_load' && res.query_results.current_page !== res.query_results.total_pages) {
          self.infiniteLoad();
        }

        self.zoom();
        self.flexslider();
      },
      error: function error(res) {
        // eslint-disable-next-line no-console
        console.error(res);
      },
      complete: function complete() {
        self.setSettings('state.isLoading', false);
      }
    });
  },
  wishlist: function wishlist() {
    $(document).on('click', '.jupiterx-wishlist', function (event) {
      event.preventDefault();
      var $this = $(this);
      var action = 'add_to_wishlist';
      var data = {};
      var state = $this.data('state');
      var productId = $this.data('productId');
      var nonceAdd = $this.data('nonceAdd');
      var nonceRemove = $this.data('nonceRemove');
      data.nonce = nonceAdd;
      data.add_to_wishlist = productId;
      data.remove_from_wishlist = productId;

      if (state === 'remove') {
        action = 'remove_from_wishlist';
        data.nonce = nonceRemove;
      }

      wp.ajax.send(action, {
        type: 'GET',
        data: data
      }).always(function (res) {
        if (action === 'add_to_wishlist' && res.result === 'true') {
          $this.addClass('jupiterx-wishlist-remove');
          $this.data('state', 'remove');
        }

        if (action === 'remove_from_wishlist' && res.fragments.length === 0) {
          $this.removeClass('jupiterx-wishlist-remove');
          $this.data('state', 'add');
        }
      });
    });
  }
});

function _default($scope) {
  new Products({
    $element: $scope
  });
}

},{"../utils/module":5,"@babel/runtime/helpers/interopRequireDefault":60}],50:[function(require,module,exports){
function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;

  for (var i = 0, arr2 = new Array(len); i < len; i++) {
    arr2[i] = arr[i];
  }

  return arr2;
}

module.exports = _arrayLikeToArray;
},{}],51:[function(require,module,exports){
var arrayLikeToArray = require("./arrayLikeToArray");

function _arrayWithoutHoles(arr) {
  if (Array.isArray(arr)) return arrayLikeToArray(arr);
}

module.exports = _arrayWithoutHoles;
},{"./arrayLikeToArray":50}],52:[function(require,module,exports){
function _assertThisInitialized(self) {
  if (self === void 0) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return self;
}

module.exports = _assertThisInitialized;
},{}],53:[function(require,module,exports){
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
  try {
    var info = gen[key](arg);
    var value = info.value;
  } catch (error) {
    reject(error);
    return;
  }

  if (info.done) {
    resolve(value);
  } else {
    Promise.resolve(value).then(_next, _throw);
  }
}

function _asyncToGenerator(fn) {
  return function () {
    var self = this,
        args = arguments;
    return new Promise(function (resolve, reject) {
      var gen = fn.apply(self, args);

      function _next(value) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);
      }

      function _throw(err) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);
      }

      _next(undefined);
    });
  };
}

module.exports = _asyncToGenerator;
},{}],54:[function(require,module,exports){
function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

module.exports = _classCallCheck;
},{}],55:[function(require,module,exports){
function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  return Constructor;
}

module.exports = _createClass;
},{}],56:[function(require,module,exports){
function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }

  return obj;
}

module.exports = _defineProperty;
},{}],57:[function(require,module,exports){
var superPropBase = require("./superPropBase");

function _get(target, property, receiver) {
  if (typeof Reflect !== "undefined" && Reflect.get) {
    module.exports = _get = Reflect.get;
  } else {
    module.exports = _get = function _get(target, property, receiver) {
      var base = superPropBase(target, property);
      if (!base) return;
      var desc = Object.getOwnPropertyDescriptor(base, property);

      if (desc.get) {
        return desc.get.call(receiver);
      }

      return desc.value;
    };
  }

  return _get(target, property, receiver || target);
}

module.exports = _get;
},{"./superPropBase":65}],58:[function(require,module,exports){
function _getPrototypeOf(o) {
  module.exports = _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {
    return o.__proto__ || Object.getPrototypeOf(o);
  };
  return _getPrototypeOf(o);
}

module.exports = _getPrototypeOf;
},{}],59:[function(require,module,exports){
var setPrototypeOf = require("./setPrototypeOf");

function _inherits(subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function");
  }

  subClass.prototype = Object.create(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      writable: true,
      configurable: true
    }
  });
  if (superClass) setPrototypeOf(subClass, superClass);
}

module.exports = _inherits;
},{"./setPrototypeOf":64}],60:[function(require,module,exports){
function _interopRequireDefault(obj) {
  return obj && obj.__esModule ? obj : {
    "default": obj
  };
}

module.exports = _interopRequireDefault;
},{}],61:[function(require,module,exports){
function _iterableToArray(iter) {
  if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter);
}

module.exports = _iterableToArray;
},{}],62:[function(require,module,exports){
function _nonIterableSpread() {
  throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

module.exports = _nonIterableSpread;
},{}],63:[function(require,module,exports){
var _typeof = require("../helpers/typeof");

var assertThisInitialized = require("./assertThisInitialized");

function _possibleConstructorReturn(self, call) {
  if (call && (_typeof(call) === "object" || typeof call === "function")) {
    return call;
  }

  return assertThisInitialized(self);
}

module.exports = _possibleConstructorReturn;
},{"../helpers/typeof":67,"./assertThisInitialized":52}],64:[function(require,module,exports){
function _setPrototypeOf(o, p) {
  module.exports = _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
    o.__proto__ = p;
    return o;
  };

  return _setPrototypeOf(o, p);
}

module.exports = _setPrototypeOf;
},{}],65:[function(require,module,exports){
var getPrototypeOf = require("./getPrototypeOf");

function _superPropBase(object, property) {
  while (!Object.prototype.hasOwnProperty.call(object, property)) {
    object = getPrototypeOf(object);
    if (object === null) break;
  }

  return object;
}

module.exports = _superPropBase;
},{"./getPrototypeOf":58}],66:[function(require,module,exports){
var arrayWithoutHoles = require("./arrayWithoutHoles");

var iterableToArray = require("./iterableToArray");

var unsupportedIterableToArray = require("./unsupportedIterableToArray");

var nonIterableSpread = require("./nonIterableSpread");

function _toConsumableArray(arr) {
  return arrayWithoutHoles(arr) || iterableToArray(arr) || unsupportedIterableToArray(arr) || nonIterableSpread();
}

module.exports = _toConsumableArray;
},{"./arrayWithoutHoles":51,"./iterableToArray":61,"./nonIterableSpread":62,"./unsupportedIterableToArray":68}],67:[function(require,module,exports){
function _typeof(obj) {
  "@babel/helpers - typeof";

  if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
    module.exports = _typeof = function _typeof(obj) {
      return typeof obj;
    };
  } else {
    module.exports = _typeof = function _typeof(obj) {
      return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
    };
  }

  return _typeof(obj);
}

module.exports = _typeof;
},{}],68:[function(require,module,exports){
var arrayLikeToArray = require("./arrayLikeToArray");

function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return arrayLikeToArray(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return arrayLikeToArray(o, minLen);
}

module.exports = _unsupportedIterableToArray;
},{"./arrayLikeToArray":50}],69:[function(require,module,exports){
module.exports = require("regenerator-runtime");

},{"regenerator-runtime":83}],70:[function(require,module,exports){
'use strict';

function _interopDefault (ex) { return (ex && (typeof ex === 'object') && 'default' in ex) ? ex['default'] : ex; }

var postfix = _interopDefault(require('@tannin/postfix'));
var evaluate = _interopDefault(require('@tannin/evaluate'));

/**
 * Given a C expression, returns a function which can be called to evaluate its
 * result.
 *
 * @example
 *
 * ```js
 * import compile from '@tannin/compile';
 *
 * const evaluate = compile( 'n > 1' );
 *
 * evaluate( { n: 2 } );
 * // ⇒ true
 * ```
 *
 * @param {string} expression C expression.
 *
 * @return {(variables?:{[variable:string]:*})=>*} Compiled evaluator.
 */
function compile( expression ) {
	var terms = postfix( expression );

	return function( variables ) {
		return evaluate( terms, variables );
	};
}

module.exports = compile;

},{"@tannin/evaluate":71,"@tannin/postfix":73}],71:[function(require,module,exports){
'use strict';

/**
 * Operator callback functions.
 *
 * @type {Object}
 */
var OPERATORS = {
	'!': function( a ) {
		return ! a;
	},
	'*': function( a, b ) {
		return a * b;
	},
	'/': function( a, b ) {
		return a / b;
	},
	'%': function( a, b ) {
		return a % b;
	},
	'+': function( a, b ) {
		return a + b;
	},
	'-': function( a, b ) {
		return a - b;
	},
	'<': function( a, b ) {
		return a < b;
	},
	'<=': function( a, b ) {
		return a <= b;
	},
	'>': function( a, b ) {
		return a > b;
	},
	'>=': function( a, b ) {
		return a >= b;
	},
	'==': function( a, b ) {
		return a === b;
	},
	'!=': function( a, b ) {
		return a !== b;
	},
	'&&': function( a, b ) {
		return a && b;
	},
	'||': function( a, b ) {
		return a || b;
	},
	'?:': function( a, b, c ) {
		if ( a ) {
			throw b;
		}

		return c;
	},
};

/**
 * Given an array of postfix terms and operand variables, returns the result of
 * the postfix evaluation.
 *
 * @example
 *
 * ```js
 * import evaluate from '@tannin/evaluate';
 *
 * // 3 + 4 * 5 / 6 ⇒ '3 4 5 * 6 / +'
 * const terms = [ '3', '4', '5', '*', '6', '/', '+' ];
 *
 * evaluate( terms, {} );
 * // ⇒ 6.333333333333334
 * ```
 *
 * @param {string[]} postfix   Postfix terms.
 * @param {Object}   variables Operand variables.
 *
 * @return {*} Result of evaluation.
 */
function evaluate( postfix, variables ) {
	var stack = [],
		i, j, args, getOperatorResult, term, value;

	for ( i = 0; i < postfix.length; i++ ) {
		term = postfix[ i ];

		getOperatorResult = OPERATORS[ term ];
		if ( getOperatorResult ) {
			// Pop from stack by number of function arguments.
			j = getOperatorResult.length;
			args = Array( j );
			while ( j-- ) {
				args[ j ] = stack.pop();
			}

			try {
				value = getOperatorResult.apply( null, args );
			} catch ( earlyReturn ) {
				return earlyReturn;
			}
		} else if ( variables.hasOwnProperty( term ) ) {
			value = variables[ term ];
		} else {
			value = +term;
		}

		stack.push( value );
	}

	return stack[ 0 ];
}

module.exports = evaluate;

},{}],72:[function(require,module,exports){
'use strict';

function _interopDefault (ex) { return (ex && (typeof ex === 'object') && 'default' in ex) ? ex['default'] : ex; }

var compile = _interopDefault(require('@tannin/compile'));

/**
 * Given a C expression, returns a function which, when called with a value,
 * evaluates the result with the value assumed to be the "n" variable of the
 * expression. The result will be coerced to its numeric equivalent.
 *
 * @param {string} expression C expression.
 *
 * @return {Function} Evaluator function.
 */
function pluralForms( expression ) {
	var evaluate = compile( expression );

	return function( n ) {
		return +evaluate( { n: n } );
	};
}

module.exports = pluralForms;

},{"@tannin/compile":70}],73:[function(require,module,exports){
'use strict';

var PRECEDENCE, OPENERS, TERMINATORS, PATTERN;

/**
 * Operator precedence mapping.
 *
 * @type {Object}
 */
PRECEDENCE = {
	'(': 9,
	'!': 8,
	'*': 7,
	'/': 7,
	'%': 7,
	'+': 6,
	'-': 6,
	'<': 5,
	'<=': 5,
	'>': 5,
	'>=': 5,
	'==': 4,
	'!=': 4,
	'&&': 3,
	'||': 2,
	'?': 1,
	'?:': 1,
};

/**
 * Characters which signal pair opening, to be terminated by terminators.
 *
 * @type {string[]}
 */
OPENERS = [ '(', '?' ];

/**
 * Characters which signal pair termination, the value an array with the
 * opener as its first member. The second member is an optional operator
 * replacement to push to the stack.
 *
 * @type {string[]}
 */
TERMINATORS = {
	')': [ '(' ],
	':': [ '?', '?:' ],
};

/**
 * Pattern matching operators and openers.
 *
 * @type {RegExp}
 */
PATTERN = /<=|>=|==|!=|&&|\|\||\?:|\(|!|\*|\/|%|\+|-|<|>|\?|\)|:/;

/**
 * Given a C expression, returns the equivalent postfix (Reverse Polish)
 * notation terms as an array.
 *
 * If a postfix string is desired, simply `.join( ' ' )` the result.
 *
 * @example
 *
 * ```js
 * import postfix from '@tannin/postfix';
 *
 * postfix( 'n > 1' );
 * // ⇒ [ 'n', '1', '>' ]
 * ```
 *
 * @param {string} expression C expression.
 *
 * @return {string[]} Postfix terms.
 */
function postfix( expression ) {
	var terms = [],
		stack = [],
		match, operator, term, element;

	while ( ( match = expression.match( PATTERN ) ) ) {
		operator = match[ 0 ];

		// Term is the string preceding the operator match. It may contain
		// whitespace, and may be empty (if operator is at beginning).
		term = expression.substr( 0, match.index ).trim();
		if ( term ) {
			terms.push( term );
		}

		while ( ( element = stack.pop() ) ) {
			if ( TERMINATORS[ operator ] ) {
				if ( TERMINATORS[ operator ][ 0 ] === element ) {
					// Substitution works here under assumption that because
					// the assigned operator will no longer be a terminator, it
					// will be pushed to the stack during the condition below.
					operator = TERMINATORS[ operator ][ 1 ] || operator;
					break;
				}
			} else if ( OPENERS.indexOf( element ) >= 0 || PRECEDENCE[ element ] < PRECEDENCE[ operator ] ) {
				// Push to stack if either an opener or when pop reveals an
				// element of lower precedence.
				stack.push( element );
				break;
			}

			// For each popped from stack, push to terms.
			terms.push( element );
		}

		if ( ! TERMINATORS[ operator ] ) {
			stack.push( operator );
		}

		// Slice matched fragment from expression to continue match.
		expression = expression.substr( match.index + operator.length );
	}

	// Push remainder of operand, if exists, to terms.
	expression = expression.trim();
	if ( expression ) {
		terms.push( expression );
	}

	// Pop remaining items from stack into terms.
	return terms.concat( stack.reverse() );
}

module.exports = postfix;

},{}],74:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.createI18n = void 0;

var _defineProperty2 = _interopRequireDefault(require("@babel/runtime/helpers/defineProperty"));

var _tannin = _interopRequireDefault(require("tannin"));

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { (0, _defineProperty2.default)(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

/**
 * @typedef {Record<string,any>} LocaleData
 */

/**
 * Default locale data to use for Tannin domain when not otherwise provided.
 * Assumes an English plural forms expression.
 *
 * @type {LocaleData}
 */
var DEFAULT_LOCALE_DATA = {
  '': {
    /** @param {number} n */
    plural_forms: function plural_forms(n) {
      return n === 1 ? 0 : 1;
    }
  }
};
/**
 * An i18n instance
 *
 * @typedef {Object} I18n
 * @property {Function} setLocaleData Merges locale data into the Tannin instance by domain. Accepts data in a
 *                                    Jed-formatted JSON object shape.
 * @property {Function} __            Retrieve the translation of text.
 * @property {Function} _x            Retrieve translated string with gettext context.
 * @property {Function} _n            Translates and retrieves the singular or plural form based on the supplied
 *                                    number.
 * @property {Function} _nx           Translates and retrieves the singular or plural form based on the supplied
 *                                    number, with gettext context.
 * @property {Function} isRTL         Check if current locale is RTL.
 */

/**
 * Create an i18n instance
 *
 * @param {LocaleData} [initialData]    Locale data configuration.
 * @param {string}     [initialDomain]  Domain for which configuration applies.
 * @return {I18n}                       I18n instance
 */

var createI18n = function createI18n(initialData, initialDomain) {
  /**
   * The underlying instance of Tannin to which exported functions interface.
   *
   * @type {Tannin}
   */
  var tannin = new _tannin.default({});
  /**
   * Merges locale data into the Tannin instance by domain. Accepts data in a
   * Jed-formatted JSON object shape.
   *
   * @see http://messageformat.github.io/Jed/
   *
   * @param {LocaleData} [data]   Locale data configuration.
   * @param {string}     [domain] Domain for which configuration applies.
   */

  var setLocaleData = function setLocaleData(data) {
    var domain = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'default';
    tannin.data[domain] = _objectSpread({}, DEFAULT_LOCALE_DATA, {}, tannin.data[domain], {}, data); // Populate default domain configuration (supported locale date which omits
    // a plural forms expression).

    tannin.data[domain][''] = _objectSpread({}, DEFAULT_LOCALE_DATA[''], {}, tannin.data[domain]['']);
  };
  /**
   * Wrapper for Tannin's `dcnpgettext`. Populates default locale data if not
   * otherwise previously assigned.
   *
   * @param {string|undefined} domain   Domain to retrieve the translated text.
   * @param {string|undefined} context  Context information for the translators.
   * @param {string}           single   Text to translate if non-plural. Used as
   *                                    fallback return value on a caught error.
   * @param {string}           [plural] The text to be used if the number is
   *                                    plural.
   * @param {number}           [number] The number to compare against to use
   *                                    either the singular or plural form.
   *
   * @return {string} The translated string.
   */


  var dcnpgettext = function dcnpgettext() {
    var domain = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'default';
    var context = arguments.length > 1 ? arguments[1] : undefined;
    var single = arguments.length > 2 ? arguments[2] : undefined;
    var plural = arguments.length > 3 ? arguments[3] : undefined;
    var number = arguments.length > 4 ? arguments[4] : undefined;

    if (!tannin.data[domain]) {
      setLocaleData(undefined, domain);
    }

    return tannin.dcnpgettext(domain, context, single, plural, number);
  };
  /**
   * Retrieve the translation of text.
   *
   * @see https://developer.wordpress.org/reference/functions/__/
   *
   * @param {string} text     Text to translate.
   * @param {string} [domain] Domain to retrieve the translated text.
   *
   * @return {string} Translated text.
   */


  var __ = function __(text, domain) {
    return dcnpgettext(domain, undefined, text);
  };
  /**
   * Retrieve translated string with gettext context.
   *
   * @see https://developer.wordpress.org/reference/functions/_x/
   *
   * @param {string} text     Text to translate.
   * @param {string} context  Context information for the translators.
   * @param {string} [domain] Domain to retrieve the translated text.
   *
   * @return {string} Translated context string without pipe.
   */


  var _x = function _x(text, context, domain) {
    return dcnpgettext(domain, context, text);
  };
  /**
   * Translates and retrieves the singular or plural form based on the supplied
   * number.
   *
   * @see https://developer.wordpress.org/reference/functions/_n/
   *
   * @param {string} single   The text to be used if the number is singular.
   * @param {string} plural   The text to be used if the number is plural.
   * @param {number} number   The number to compare against to use either the
   *                          singular or plural form.
   * @param {string} [domain] Domain to retrieve the translated text.
   *
   * @return {string} The translated singular or plural form.
   */


  var _n = function _n(single, plural, number, domain) {
    return dcnpgettext(domain, undefined, single, plural, number);
  };
  /**
   * Translates and retrieves the singular or plural form based on the supplied
   * number, with gettext context.
   *
   * @see https://developer.wordpress.org/reference/functions/_nx/
   *
   * @param {string} single   The text to be used if the number is singular.
   * @param {string} plural   The text to be used if the number is plural.
   * @param {number} number   The number to compare against to use either the
   *                          singular or plural form.
   * @param {string} context  Context information for the translators.
   * @param {string} [domain] Domain to retrieve the translated text.
   *
   * @return {string} The translated singular or plural form.
   */


  var _nx = function _nx(single, plural, number, context, domain) {
    return dcnpgettext(domain, context, single, plural, number);
  };
  /**
   * Check if current locale is RTL.
   *
   * **RTL (Right To Left)** is a locale property indicating that text is written from right to left.
   * For example, the `he` locale (for Hebrew) specifies right-to-left. Arabic (ar) is another common
   * language written RTL. The opposite of RTL, LTR (Left To Right) is used in other languages,
   * including English (`en`, `en-US`, `en-GB`, etc.), Spanish (`es`), and French (`fr`).
   *
   * @return {boolean} Whether locale is RTL.
   */


  var isRTL = function isRTL() {
    return 'rtl' === _x('ltr', 'text direction');
  };

  if (initialData) {
    setLocaleData(initialData, initialDomain);
  }

  return {
    setLocaleData: setLocaleData,
    __: __,
    _x: _x,
    _n: _n,
    _nx: _nx,
    isRTL: isRTL
  };
};

exports.createI18n = createI18n;

},{"@babel/runtime/helpers/defineProperty":56,"@babel/runtime/helpers/interopRequireDefault":60,"tannin":84}],75:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.isRTL = exports._nx = exports._n = exports._x = exports.__ = exports.setLocaleData = void 0;

var _createI18n = require("./create-i18n");

/**
 * Internal dependencies
 */
var i18n = (0, _createI18n.createI18n)();
/*
 * Comments in this file are duplicated from ./i18n due to
 * https://github.com/WordPress/gutenberg/pull/20318#issuecomment-590837722
 */

/**
 * @typedef {import('./create-i18n').LocaleData} LocaleData
 */

/**
 * Merges locale data into the Tannin instance by domain. Accepts data in a
 * Jed-formatted JSON object shape.
 *
 * @see http://messageformat.github.io/Jed/
 *
 * @param {LocaleData} [data]   Locale data configuration.
 * @param {string}     [domain] Domain for which configuration applies.
 */

var setLocaleData = i18n.setLocaleData.bind(i18n);
/**
 * Retrieve the translation of text.
 *
 * @see https://developer.wordpress.org/reference/functions/__/
 *
 * @param {string} text     Text to translate.
 * @param {string} [domain] Domain to retrieve the translated text.
 *
 * @return {string} Translated text.
 */

exports.setLocaleData = setLocaleData;

var __ = i18n.__.bind(i18n);
/**
 * Retrieve translated string with gettext context.
 *
 * @see https://developer.wordpress.org/reference/functions/_x/
 *
 * @param {string} text     Text to translate.
 * @param {string} context  Context information for the translators.
 * @param {string} [domain] Domain to retrieve the translated text.
 *
 * @return {string} Translated context string without pipe.
 */


exports.__ = __;

var _x = i18n._x.bind(i18n);
/**
 * Translates and retrieves the singular or plural form based on the supplied
 * number.
 *
 * @see https://developer.wordpress.org/reference/functions/_n/
 *
 * @param {string} single   The text to be used if the number is singular.
 * @param {string} plural   The text to be used if the number is plural.
 * @param {number} number   The number to compare against to use either the
 *                          singular or plural form.
 * @param {string} [domain] Domain to retrieve the translated text.
 *
 * @return {string} The translated singular or plural form.
 */


exports._x = _x;

var _n = i18n._n.bind(i18n);
/**
 * Translates and retrieves the singular or plural form based on the supplied
 * number, with gettext context.
 *
 * @see https://developer.wordpress.org/reference/functions/_nx/
 *
 * @param {string} single   The text to be used if the number is singular.
 * @param {string} plural   The text to be used if the number is plural.
 * @param {number} number   The number to compare against to use either the
 *                          singular or plural form.
 * @param {string} context  Context information for the translators.
 * @param {string} [domain] Domain to retrieve the translated text.
 *
 * @return {string} The translated singular or plural form.
 */


exports._n = _n;

var _nx = i18n._nx.bind(i18n);
/**
 * Check if current locale is RTL.
 *
 * **RTL (Right To Left)** is a locale property indicating that text is written from right to left.
 * For example, the `he` locale (for Hebrew) specifies right-to-left. Arabic (ar) is another common
 * language written RTL. The opposite of RTL, LTR (Left To Right) is used in other languages,
 * including English (`en`, `en-US`, `en-GB`, etc.), Spanish (`es`), and French (`fr`).
 *
 * @return {boolean} Whether locale is RTL.
 */


exports._nx = _nx;
var isRTL = i18n.isRTL.bind(i18n);
exports.isRTL = isRTL;

},{"./create-i18n":74}],76:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
var _exportNames = {
  sprintf: true,
  setLocaleData: true,
  __: true,
  _x: true,
  _n: true,
  _nx: true,
  isRTL: true
};
Object.defineProperty(exports, "sprintf", {
  enumerable: true,
  get: function get() {
    return _sprintf.sprintf;
  }
});
Object.defineProperty(exports, "setLocaleData", {
  enumerable: true,
  get: function get() {
    return _defaultI18n.setLocaleData;
  }
});
Object.defineProperty(exports, "__", {
  enumerable: true,
  get: function get() {
    return _defaultI18n.__;
  }
});
Object.defineProperty(exports, "_x", {
  enumerable: true,
  get: function get() {
    return _defaultI18n._x;
  }
});
Object.defineProperty(exports, "_n", {
  enumerable: true,
  get: function get() {
    return _defaultI18n._n;
  }
});
Object.defineProperty(exports, "_nx", {
  enumerable: true,
  get: function get() {
    return _defaultI18n._nx;
  }
});
Object.defineProperty(exports, "isRTL", {
  enumerable: true,
  get: function get() {
    return _defaultI18n.isRTL;
  }
});

var _sprintf = require("./sprintf");

var _createI18n = require("./create-i18n");

Object.keys(_createI18n).forEach(function (key) {
  if (key === "default" || key === "__esModule") return;
  if (Object.prototype.hasOwnProperty.call(_exportNames, key)) return;
  Object.defineProperty(exports, key, {
    enumerable: true,
    get: function get() {
      return _createI18n[key];
    }
  });
});

var _defaultI18n = require("./default-i18n");

},{"./create-i18n":74,"./default-i18n":75,"./sprintf":77}],77:[function(require,module,exports){
"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.sprintf = sprintf;

var _memize = _interopRequireDefault(require("memize"));

var _sprintfJs = _interopRequireDefault(require("sprintf-js"));

/**
 * External dependencies
 */

/**
 * Log to console, once per message; or more precisely, per referentially equal
 * argument set. Because Jed throws errors, we log these to the console instead
 * to avoid crashing the application.
 *
 * @param {...*} args Arguments to pass to `console.error`
 */
var logErrorOnce = (0, _memize.default)(console.error); // eslint-disable-line no-console

/**
 * Returns a formatted string. If an error occurs in applying the format, the
 * original format string is returned.
 *
 * @param {string}    format The format of the string to generate.
 * @param {...*} args Arguments to apply to the format.
 *
 * @see http://www.diveintojavascript.com/projects/javascript-sprintf
 *
 * @return {string} The formatted string.
 */

function sprintf(format) {
  try {
    for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
      args[_key - 1] = arguments[_key];
    }

    return _sprintfJs.default.sprintf.apply(_sprintfJs.default, [format].concat(args));
  } catch (error) {
    logErrorOnce('sprintf error: \n\n' + error.toString());
    return format;
  }
}

},{"@babel/runtime/helpers/interopRequireDefault":60,"memize":81,"sprintf-js":78}],78:[function(require,module,exports){
/* global window, exports, define */

!function() {
    'use strict'

    var re = {
        not_string: /[^s]/,
        not_bool: /[^t]/,
        not_type: /[^T]/,
        not_primitive: /[^v]/,
        number: /[diefg]/,
        numeric_arg: /[bcdiefguxX]/,
        json: /[j]/,
        not_json: /[^j]/,
        text: /^[^\x25]+/,
        modulo: /^\x25{2}/,
        placeholder: /^\x25(?:([1-9]\d*)\$|\(([^)]+)\))?(\+)?(0|'[^$])?(-)?(\d+)?(?:\.(\d+))?([b-gijostTuvxX])/,
        key: /^([a-z_][a-z_\d]*)/i,
        key_access: /^\.([a-z_][a-z_\d]*)/i,
        index_access: /^\[(\d+)\]/,
        sign: /^[+-]/
    }

    function sprintf(key) {
        // `arguments` is not an array, but should be fine for this call
        return sprintf_format(sprintf_parse(key), arguments)
    }

    function vsprintf(fmt, argv) {
        return sprintf.apply(null, [fmt].concat(argv || []))
    }

    function sprintf_format(parse_tree, argv) {
        var cursor = 1, tree_length = parse_tree.length, arg, output = '', i, k, ph, pad, pad_character, pad_length, is_positive, sign
        for (i = 0; i < tree_length; i++) {
            if (typeof parse_tree[i] === 'string') {
                output += parse_tree[i]
            }
            else if (typeof parse_tree[i] === 'object') {
                ph = parse_tree[i] // convenience purposes only
                if (ph.keys) { // keyword argument
                    arg = argv[cursor]
                    for (k = 0; k < ph.keys.length; k++) {
                        if (arg == undefined) {
                            throw new Error(sprintf('[sprintf] Cannot access property "%s" of undefined value "%s"', ph.keys[k], ph.keys[k-1]))
                        }
                        arg = arg[ph.keys[k]]
                    }
                }
                else if (ph.param_no) { // positional argument (explicit)
                    arg = argv[ph.param_no]
                }
                else { // positional argument (implicit)
                    arg = argv[cursor++]
                }

                if (re.not_type.test(ph.type) && re.not_primitive.test(ph.type) && arg instanceof Function) {
                    arg = arg()
                }

                if (re.numeric_arg.test(ph.type) && (typeof arg !== 'number' && isNaN(arg))) {
                    throw new TypeError(sprintf('[sprintf] expecting number but found %T', arg))
                }

                if (re.number.test(ph.type)) {
                    is_positive = arg >= 0
                }

                switch (ph.type) {
                    case 'b':
                        arg = parseInt(arg, 10).toString(2)
                        break
                    case 'c':
                        arg = String.fromCharCode(parseInt(arg, 10))
                        break
                    case 'd':
                    case 'i':
                        arg = parseInt(arg, 10)
                        break
                    case 'j':
                        arg = JSON.stringify(arg, null, ph.width ? parseInt(ph.width) : 0)
                        break
                    case 'e':
                        arg = ph.precision ? parseFloat(arg).toExponential(ph.precision) : parseFloat(arg).toExponential()
                        break
                    case 'f':
                        arg = ph.precision ? parseFloat(arg).toFixed(ph.precision) : parseFloat(arg)
                        break
                    case 'g':
                        arg = ph.precision ? String(Number(arg.toPrecision(ph.precision))) : parseFloat(arg)
                        break
                    case 'o':
                        arg = (parseInt(arg, 10) >>> 0).toString(8)
                        break
                    case 's':
                        arg = String(arg)
                        arg = (ph.precision ? arg.substring(0, ph.precision) : arg)
                        break
                    case 't':
                        arg = String(!!arg)
                        arg = (ph.precision ? arg.substring(0, ph.precision) : arg)
                        break
                    case 'T':
                        arg = Object.prototype.toString.call(arg).slice(8, -1).toLowerCase()
                        arg = (ph.precision ? arg.substring(0, ph.precision) : arg)
                        break
                    case 'u':
                        arg = parseInt(arg, 10) >>> 0
                        break
                    case 'v':
                        arg = arg.valueOf()
                        arg = (ph.precision ? arg.substring(0, ph.precision) : arg)
                        break
                    case 'x':
                        arg = (parseInt(arg, 10) >>> 0).toString(16)
                        break
                    case 'X':
                        arg = (parseInt(arg, 10) >>> 0).toString(16).toUpperCase()
                        break
                }
                if (re.json.test(ph.type)) {
                    output += arg
                }
                else {
                    if (re.number.test(ph.type) && (!is_positive || ph.sign)) {
                        sign = is_positive ? '+' : '-'
                        arg = arg.toString().replace(re.sign, '')
                    }
                    else {
                        sign = ''
                    }
                    pad_character = ph.pad_char ? ph.pad_char === '0' ? '0' : ph.pad_char.charAt(1) : ' '
                    pad_length = ph.width - (sign + arg).length
                    pad = ph.width ? (pad_length > 0 ? pad_character.repeat(pad_length) : '') : ''
                    output += ph.align ? sign + arg + pad : (pad_character === '0' ? sign + pad + arg : pad + sign + arg)
                }
            }
        }
        return output
    }

    var sprintf_cache = Object.create(null)

    function sprintf_parse(fmt) {
        if (sprintf_cache[fmt]) {
            return sprintf_cache[fmt]
        }

        var _fmt = fmt, match, parse_tree = [], arg_names = 0
        while (_fmt) {
            if ((match = re.text.exec(_fmt)) !== null) {
                parse_tree.push(match[0])
            }
            else if ((match = re.modulo.exec(_fmt)) !== null) {
                parse_tree.push('%')
            }
            else if ((match = re.placeholder.exec(_fmt)) !== null) {
                if (match[2]) {
                    arg_names |= 1
                    var field_list = [], replacement_field = match[2], field_match = []
                    if ((field_match = re.key.exec(replacement_field)) !== null) {
                        field_list.push(field_match[1])
                        while ((replacement_field = replacement_field.substring(field_match[0].length)) !== '') {
                            if ((field_match = re.key_access.exec(replacement_field)) !== null) {
                                field_list.push(field_match[1])
                            }
                            else if ((field_match = re.index_access.exec(replacement_field)) !== null) {
                                field_list.push(field_match[1])
                            }
                            else {
                                throw new SyntaxError('[sprintf] failed to parse named argument key')
                            }
                        }
                    }
                    else {
                        throw new SyntaxError('[sprintf] failed to parse named argument key')
                    }
                    match[2] = field_list
                }
                else {
                    arg_names |= 2
                }
                if (arg_names === 3) {
                    throw new Error('[sprintf] mixing positional and named placeholders is not (yet) supported')
                }

                parse_tree.push(
                    {
                        placeholder: match[0],
                        param_no:    match[1],
                        keys:        match[2],
                        sign:        match[3],
                        pad_char:    match[4],
                        align:       match[5],
                        width:       match[6],
                        precision:   match[7],
                        type:        match[8]
                    }
                )
            }
            else {
                throw new SyntaxError('[sprintf] unexpected placeholder')
            }
            _fmt = _fmt.substring(match[0].length)
        }
        return sprintf_cache[fmt] = parse_tree
    }

    /**
     * export to either browser or node.js
     */
    /* eslint-disable quote-props */
    if (typeof exports !== 'undefined') {
        exports['sprintf'] = sprintf
        exports['vsprintf'] = vsprintf
    }
    if (typeof window !== 'undefined') {
        window['sprintf'] = sprintf
        window['vsprintf'] = vsprintf

        if (typeof define === 'function' && define['amd']) {
            define(function() {
                return {
                    'sprintf': sprintf,
                    'vsprintf': vsprintf
                }
            })
        }
    }
    /* eslint-enable quote-props */
}(); // eslint-disable-line

},{}],79:[function(require,module,exports){
/*
 * International Telephone Input v17.0.18
 * https://github.com/jackocnr/intl-tel-input.git
 * Licensed under the MIT license
 */

// wrap in UMD
(function(factory) {
    if (typeof module === "object" && module.exports) module.exports = factory(); else window.intlTelInput = factory();
})(function(undefined) {
    "use strict";
    return function() {
        // Array of country objects for the flag dropdown.
        // Here is the criteria for the plugin to support a given country/territory
        // - It has an iso2 code: https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
        // - It has it's own country calling code (it is not a sub-region of another country): https://en.wikipedia.org/wiki/List_of_country_calling_codes
        // - It has a flag in the region-flags project: https://github.com/behdad/region-flags/tree/gh-pages/png
        // - It is supported by libphonenumber (it must be listed on this page): https://github.com/googlei18n/libphonenumber/blob/master/resources/ShortNumberMetadata.xml
        // Each country array has the following information:
        // [
        //    Country name,
        //    iso2 code,
        //    International dial code,
        //    Order (if >1 country with same dial code),
        //    Area codes
        // ]
        var allCountries = [ [ "Afghanistan (‫افغانستان‬‎)", "af", "93" ], [ "Albania (Shqipëri)", "al", "355" ], [ "Algeria (‫الجزائر‬‎)", "dz", "213" ], [ "American Samoa", "as", "1", 5, [ "684" ] ], [ "Andorra", "ad", "376" ], [ "Angola", "ao", "244" ], [ "Anguilla", "ai", "1", 6, [ "264" ] ], [ "Antigua and Barbuda", "ag", "1", 7, [ "268" ] ], [ "Argentina", "ar", "54" ], [ "Armenia (Հայաստան)", "am", "374" ], [ "Aruba", "aw", "297" ], [ "Ascension Island", "ac", "247" ], [ "Australia", "au", "61", 0 ], [ "Austria (Österreich)", "at", "43" ], [ "Azerbaijan (Azərbaycan)", "az", "994" ], [ "Bahamas", "bs", "1", 8, [ "242" ] ], [ "Bahrain (‫البحرين‬‎)", "bh", "973" ], [ "Bangladesh (বাংলাদেশ)", "bd", "880" ], [ "Barbados", "bb", "1", 9, [ "246" ] ], [ "Belarus (Беларусь)", "by", "375" ], [ "Belgium (België)", "be", "32" ], [ "Belize", "bz", "501" ], [ "Benin (Bénin)", "bj", "229" ], [ "Bermuda", "bm", "1", 10, [ "441" ] ], [ "Bhutan (འབྲུག)", "bt", "975" ], [ "Bolivia", "bo", "591" ], [ "Bosnia and Herzegovina (Босна и Херцеговина)", "ba", "387" ], [ "Botswana", "bw", "267" ], [ "Brazil (Brasil)", "br", "55" ], [ "British Indian Ocean Territory", "io", "246" ], [ "British Virgin Islands", "vg", "1", 11, [ "284" ] ], [ "Brunei", "bn", "673" ], [ "Bulgaria (България)", "bg", "359" ], [ "Burkina Faso", "bf", "226" ], [ "Burundi (Uburundi)", "bi", "257" ], [ "Cambodia (កម្ពុជា)", "kh", "855" ], [ "Cameroon (Cameroun)", "cm", "237" ], [ "Canada", "ca", "1", 1, [ "204", "226", "236", "249", "250", "289", "306", "343", "365", "387", "403", "416", "418", "431", "437", "438", "450", "506", "514", "519", "548", "579", "581", "587", "604", "613", "639", "647", "672", "705", "709", "742", "778", "780", "782", "807", "819", "825", "867", "873", "902", "905" ] ], [ "Cape Verde (Kabu Verdi)", "cv", "238" ], [ "Caribbean Netherlands", "bq", "599", 1, [ "3", "4", "7" ] ], [ "Cayman Islands", "ky", "1", 12, [ "345" ] ], [ "Central African Republic (République centrafricaine)", "cf", "236" ], [ "Chad (Tchad)", "td", "235" ], [ "Chile", "cl", "56" ], [ "China (中国)", "cn", "86" ], [ "Christmas Island", "cx", "61", 2, [ "89164" ] ], [ "Cocos (Keeling) Islands", "cc", "61", 1, [ "89162" ] ], [ "Colombia", "co", "57" ], [ "Comoros (‫جزر القمر‬‎)", "km", "269" ], [ "Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)", "cd", "243" ], [ "Congo (Republic) (Congo-Brazzaville)", "cg", "242" ], [ "Cook Islands", "ck", "682" ], [ "Costa Rica", "cr", "506" ], [ "Côte d’Ivoire", "ci", "225" ], [ "Croatia (Hrvatska)", "hr", "385" ], [ "Cuba", "cu", "53" ], [ "Curaçao", "cw", "599", 0 ], [ "Cyprus (Κύπρος)", "cy", "357" ], [ "Czech Republic (Česká republika)", "cz", "420" ], [ "Denmark (Danmark)", "dk", "45" ], [ "Djibouti", "dj", "253" ], [ "Dominica", "dm", "1", 13, [ "767" ] ], [ "Dominican Republic (República Dominicana)", "do", "1", 2, [ "809", "829", "849" ] ], [ "Ecuador", "ec", "593" ], [ "Egypt (‫مصر‬‎)", "eg", "20" ], [ "El Salvador", "sv", "503" ], [ "Equatorial Guinea (Guinea Ecuatorial)", "gq", "240" ], [ "Eritrea", "er", "291" ], [ "Estonia (Eesti)", "ee", "372" ], [ "Eswatini", "sz", "268" ], [ "Ethiopia", "et", "251" ], [ "Falkland Islands (Islas Malvinas)", "fk", "500" ], [ "Faroe Islands (Føroyar)", "fo", "298" ], [ "Fiji", "fj", "679" ], [ "Finland (Suomi)", "fi", "358", 0 ], [ "France", "fr", "33" ], [ "French Guiana (Guyane française)", "gf", "594" ], [ "French Polynesia (Polynésie française)", "pf", "689" ], [ "Gabon", "ga", "241" ], [ "Gambia", "gm", "220" ], [ "Georgia (საქართველო)", "ge", "995" ], [ "Germany (Deutschland)", "de", "49" ], [ "Ghana (Gaana)", "gh", "233" ], [ "Gibraltar", "gi", "350" ], [ "Greece (Ελλάδα)", "gr", "30" ], [ "Greenland (Kalaallit Nunaat)", "gl", "299" ], [ "Grenada", "gd", "1", 14, [ "473" ] ], [ "Guadeloupe", "gp", "590", 0 ], [ "Guam", "gu", "1", 15, [ "671" ] ], [ "Guatemala", "gt", "502" ], [ "Guernsey", "gg", "44", 1, [ "1481", "7781", "7839", "7911" ] ], [ "Guinea (Guinée)", "gn", "224" ], [ "Guinea-Bissau (Guiné Bissau)", "gw", "245" ], [ "Guyana", "gy", "592" ], [ "Haiti", "ht", "509" ], [ "Honduras", "hn", "504" ], [ "Hong Kong (香港)", "hk", "852" ], [ "Hungary (Magyarország)", "hu", "36" ], [ "Iceland (Ísland)", "is", "354" ], [ "India (भारत)", "in", "91" ], [ "Indonesia", "id", "62" ], [ "Iran (‫ایران‬‎)", "ir", "98" ], [ "Iraq (‫العراق‬‎)", "iq", "964" ], [ "Ireland", "ie", "353" ], [ "Isle of Man", "im", "44", 2, [ "1624", "74576", "7524", "7924", "7624" ] ], [ "Israel (‫ישראל‬‎)", "il", "972" ], [ "Italy (Italia)", "it", "39", 0 ], [ "Jamaica", "jm", "1", 4, [ "876", "658" ] ], [ "Japan (日本)", "jp", "81" ], [ "Jersey", "je", "44", 3, [ "1534", "7509", "7700", "7797", "7829", "7937" ] ], [ "Jordan (‫الأردن‬‎)", "jo", "962" ], [ "Kazakhstan (Казахстан)", "kz", "7", 1, [ "33", "7" ] ], [ "Kenya", "ke", "254" ], [ "Kiribati", "ki", "686" ], [ "Kosovo", "xk", "383" ], [ "Kuwait (‫الكويت‬‎)", "kw", "965" ], [ "Kyrgyzstan (Кыргызстан)", "kg", "996" ], [ "Laos (ລາວ)", "la", "856" ], [ "Latvia (Latvija)", "lv", "371" ], [ "Lebanon (‫لبنان‬‎)", "lb", "961" ], [ "Lesotho", "ls", "266" ], [ "Liberia", "lr", "231" ], [ "Libya (‫ليبيا‬‎)", "ly", "218" ], [ "Liechtenstein", "li", "423" ], [ "Lithuania (Lietuva)", "lt", "370" ], [ "Luxembourg", "lu", "352" ], [ "Macau (澳門)", "mo", "853" ], [ "North Macedonia (Македонија)", "mk", "389" ], [ "Madagascar (Madagasikara)", "mg", "261" ], [ "Malawi", "mw", "265" ], [ "Malaysia", "my", "60" ], [ "Maldives", "mv", "960" ], [ "Mali", "ml", "223" ], [ "Malta", "mt", "356" ], [ "Marshall Islands", "mh", "692" ], [ "Martinique", "mq", "596" ], [ "Mauritania (‫موريتانيا‬‎)", "mr", "222" ], [ "Mauritius (Moris)", "mu", "230" ], [ "Mayotte", "yt", "262", 1, [ "269", "639" ] ], [ "Mexico (México)", "mx", "52" ], [ "Micronesia", "fm", "691" ], [ "Moldova (Republica Moldova)", "md", "373" ], [ "Monaco", "mc", "377" ], [ "Mongolia (Монгол)", "mn", "976" ], [ "Montenegro (Crna Gora)", "me", "382" ], [ "Montserrat", "ms", "1", 16, [ "664" ] ], [ "Morocco (‫المغرب‬‎)", "ma", "212", 0 ], [ "Mozambique (Moçambique)", "mz", "258" ], [ "Myanmar (Burma) (မြန်မာ)", "mm", "95" ], [ "Namibia (Namibië)", "na", "264" ], [ "Nauru", "nr", "674" ], [ "Nepal (नेपाल)", "np", "977" ], [ "Netherlands (Nederland)", "nl", "31" ], [ "New Caledonia (Nouvelle-Calédonie)", "nc", "687" ], [ "New Zealand", "nz", "64" ], [ "Nicaragua", "ni", "505" ], [ "Niger (Nijar)", "ne", "227" ], [ "Nigeria", "ng", "234" ], [ "Niue", "nu", "683" ], [ "Norfolk Island", "nf", "672" ], [ "North Korea (조선 민주주의 인민 공화국)", "kp", "850" ], [ "Northern Mariana Islands", "mp", "1", 17, [ "670" ] ], [ "Norway (Norge)", "no", "47", 0 ], [ "Oman (‫عُمان‬‎)", "om", "968" ], [ "Pakistan (‫پاکستان‬‎)", "pk", "92" ], [ "Palau", "pw", "680" ], [ "Palestine (‫فلسطين‬‎)", "ps", "970" ], [ "Panama (Panamá)", "pa", "507" ], [ "Papua New Guinea", "pg", "675" ], [ "Paraguay", "py", "595" ], [ "Peru (Perú)", "pe", "51" ], [ "Philippines", "ph", "63" ], [ "Poland (Polska)", "pl", "48" ], [ "Portugal", "pt", "351" ], [ "Puerto Rico", "pr", "1", 3, [ "787", "939" ] ], [ "Qatar (‫قطر‬‎)", "qa", "974" ], [ "Réunion (La Réunion)", "re", "262", 0 ], [ "Romania (România)", "ro", "40" ], [ "Russia (Россия)", "ru", "7", 0 ], [ "Rwanda", "rw", "250" ], [ "Saint Barthélemy", "bl", "590", 1 ], [ "Saint Helena", "sh", "290" ], [ "Saint Kitts and Nevis", "kn", "1", 18, [ "869" ] ], [ "Saint Lucia", "lc", "1", 19, [ "758" ] ], [ "Saint Martin (Saint-Martin (partie française))", "mf", "590", 2 ], [ "Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)", "pm", "508" ], [ "Saint Vincent and the Grenadines", "vc", "1", 20, [ "784" ] ], [ "Samoa", "ws", "685" ], [ "San Marino", "sm", "378" ], [ "São Tomé and Príncipe (São Tomé e Príncipe)", "st", "239" ], [ "Saudi Arabia (‫المملكة العربية السعودية‬‎)", "sa", "966" ], [ "Senegal (Sénégal)", "sn", "221" ], [ "Serbia (Србија)", "rs", "381" ], [ "Seychelles", "sc", "248" ], [ "Sierra Leone", "sl", "232" ], [ "Singapore", "sg", "65" ], [ "Sint Maarten", "sx", "1", 21, [ "721" ] ], [ "Slovakia (Slovensko)", "sk", "421" ], [ "Slovenia (Slovenija)", "si", "386" ], [ "Solomon Islands", "sb", "677" ], [ "Somalia (Soomaaliya)", "so", "252" ], [ "South Africa", "za", "27" ], [ "South Korea (대한민국)", "kr", "82" ], [ "South Sudan (‫جنوب السودان‬‎)", "ss", "211" ], [ "Spain (España)", "es", "34" ], [ "Sri Lanka (ශ්‍රී ලංකාව)", "lk", "94" ], [ "Sudan (‫السودان‬‎)", "sd", "249" ], [ "Suriname", "sr", "597" ], [ "Svalbard and Jan Mayen", "sj", "47", 1, [ "79" ] ], [ "Sweden (Sverige)", "se", "46" ], [ "Switzerland (Schweiz)", "ch", "41" ], [ "Syria (‫سوريا‬‎)", "sy", "963" ], [ "Taiwan (台灣)", "tw", "886" ], [ "Tajikistan", "tj", "992" ], [ "Tanzania", "tz", "255" ], [ "Thailand (ไทย)", "th", "66" ], [ "Timor-Leste", "tl", "670" ], [ "Togo", "tg", "228" ], [ "Tokelau", "tk", "690" ], [ "Tonga", "to", "676" ], [ "Trinidad and Tobago", "tt", "1", 22, [ "868" ] ], [ "Tunisia (‫تونس‬‎)", "tn", "216" ], [ "Turkey (Türkiye)", "tr", "90" ], [ "Turkmenistan", "tm", "993" ], [ "Turks and Caicos Islands", "tc", "1", 23, [ "649" ] ], [ "Tuvalu", "tv", "688" ], [ "U.S. Virgin Islands", "vi", "1", 24, [ "340" ] ], [ "Uganda", "ug", "256" ], [ "Ukraine (Україна)", "ua", "380" ], [ "United Arab Emirates (‫الإمارات العربية المتحدة‬‎)", "ae", "971" ], [ "United Kingdom", "gb", "44", 0 ], [ "United States", "us", "1", 0 ], [ "Uruguay", "uy", "598" ], [ "Uzbekistan (Oʻzbekiston)", "uz", "998" ], [ "Vanuatu", "vu", "678" ], [ "Vatican City (Città del Vaticano)", "va", "39", 1, [ "06698" ] ], [ "Venezuela", "ve", "58" ], [ "Vietnam (Việt Nam)", "vn", "84" ], [ "Wallis and Futuna (Wallis-et-Futuna)", "wf", "681" ], [ "Western Sahara (‫الصحراء الغربية‬‎)", "eh", "212", 1, [ "5288", "5289" ] ], [ "Yemen (‫اليمن‬‎)", "ye", "967" ], [ "Zambia", "zm", "260" ], [ "Zimbabwe", "zw", "263" ], [ "Åland Islands", "ax", "358", 1, [ "18" ] ] ];
        // loop over all of the countries above, restructuring the data to be objects with named keys
        for (var i = 0; i < allCountries.length; i++) {
            var c = allCountries[i];
            allCountries[i] = {
                name: c[0],
                iso2: c[1],
                dialCode: c[2],
                priority: c[3] || 0,
                areaCodes: c[4] || null
            };
        }
        "use strict";
        function _classCallCheck(instance, Constructor) {
            if (!(instance instanceof Constructor)) {
                throw new TypeError("Cannot call a class as a function");
            }
        }
        function _defineProperties(target, props) {
            for (var i = 0; i < props.length; i++) {
                var descriptor = props[i];
                descriptor.enumerable = descriptor.enumerable || false;
                descriptor.configurable = true;
                if ("value" in descriptor) descriptor.writable = true;
                Object.defineProperty(target, descriptor.key, descriptor);
            }
        }
        function _createClass(Constructor, protoProps, staticProps) {
            if (protoProps) _defineProperties(Constructor.prototype, protoProps);
            if (staticProps) _defineProperties(Constructor, staticProps);
            return Constructor;
        }
        var intlTelInputGlobals = {
            getInstance: function getInstance(input) {
                var id = input.getAttribute("data-intl-tel-input-id");
                return window.intlTelInputGlobals.instances[id];
            },
            instances: {},
            // using a global like this allows us to mock it in the tests
            documentReady: function documentReady() {
                return document.readyState === "complete";
            }
        };
        if (typeof window === "object") window.intlTelInputGlobals = intlTelInputGlobals;
        // these vars persist through all instances of the plugin
        var id = 0;
        var defaults = {
            // whether or not to allow the dropdown
            allowDropdown: true,
            // if there is just a dial code in the input: remove it on blur
            autoHideDialCode: true,
            // add a placeholder in the input with an example number for the selected country
            autoPlaceholder: "polite",
            // modify the parentClass
            customContainer: "",
            // modify the auto placeholder
            customPlaceholder: null,
            // append menu to specified element
            dropdownContainer: null,
            // don't display these countries
            excludeCountries: [],
            // format the input value during initialisation and on setNumber
            formatOnDisplay: true,
            // geoIp lookup function
            geoIpLookup: null,
            // inject a hidden input with this name, and on submit, populate it with the result of getNumber
            hiddenInput: "",
            // initial country
            initialCountry: "",
            // localized country names e.g. { 'de': 'Deutschland' }
            localizedCountries: null,
            // don't insert international dial codes
            nationalMode: true,
            // display only these countries
            onlyCountries: [],
            // number type to use for placeholders
            placeholderNumberType: "MOBILE",
            // the countries at the top of the list. defaults to united states and united kingdom
            preferredCountries: [ "us", "gb" ],
            // display the country dial code next to the selected flag so it's not part of the typed number
            separateDialCode: false,
            // specify the path to the libphonenumber script to enable validation/formatting
            utilsScript: ""
        };
        // https://en.wikipedia.org/wiki/List_of_North_American_Numbering_Plan_area_codes#Non-geographic_area_codes
        var regionlessNanpNumbers = [ "800", "822", "833", "844", "855", "866", "877", "880", "881", "882", "883", "884", "885", "886", "887", "888", "889" ];
        // utility function to iterate over an object. can't use Object.entries or native forEach because
        // of IE11
        var forEachProp = function forEachProp(obj, callback) {
            var keys = Object.keys(obj);
            for (var i = 0; i < keys.length; i++) {
                callback(keys[i], obj[keys[i]]);
            }
        };
        // run a method on each instance of the plugin
        var forEachInstance = function forEachInstance(method) {
            forEachProp(window.intlTelInputGlobals.instances, function(key) {
                window.intlTelInputGlobals.instances[key][method]();
            });
        };
        // this is our plugin class that we will create an instance of
        // eslint-disable-next-line no-unused-vars
        var Iti = /*#__PURE__*/
        function() {
            function Iti(input, options) {
                var _this = this;
                _classCallCheck(this, Iti);
                this.id = id++;
                this.telInput = input;
                this.activeItem = null;
                this.highlightedItem = null;
                // process specified options / defaults
                // alternative to Object.assign, which isn't supported by IE11
                var customOptions = options || {};
                this.options = {};
                forEachProp(defaults, function(key, value) {
                    _this.options[key] = customOptions.hasOwnProperty(key) ? customOptions[key] : value;
                });
                this.hadInitialPlaceholder = Boolean(input.getAttribute("placeholder"));
            }
            _createClass(Iti, [ {
                key: "_init",
                value: function _init() {
                    var _this2 = this;
                    // if in nationalMode, disable options relating to dial codes
                    if (this.options.nationalMode) this.options.autoHideDialCode = false;
                    // if separateDialCode then doesn't make sense to A) insert dial code into input
                    // (autoHideDialCode), and B) display national numbers (because we're displaying the country
                    // dial code next to them)
                    if (this.options.separateDialCode) {
                        this.options.autoHideDialCode = this.options.nationalMode = false;
                    }
                    // we cannot just test screen size as some smartphones/website meta tags will report desktop
                    // resolutions
                    // Note: for some reason jasmine breaks if you put this in the main Plugin function with the
                    // rest of these declarations
                    // Note: to target Android Mobiles (and not Tablets), we must find 'Android' and 'Mobile'
                    this.isMobile = /Android.+Mobile|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                    if (this.isMobile) {
                        // trigger the mobile dropdown css
                        document.body.classList.add("iti-mobile");
                        // on mobile, we want a full screen dropdown, so we must append it to the body
                        if (!this.options.dropdownContainer) this.options.dropdownContainer = document.body;
                    }
                    // these promises get resolved when their individual requests complete
                    // this way the dev can do something like iti.promise.then(...) to know when all requests are
                    // complete
                    if (typeof Promise !== "undefined") {
                        var autoCountryPromise = new Promise(function(resolve, reject) {
                            _this2.resolveAutoCountryPromise = resolve;
                            _this2.rejectAutoCountryPromise = reject;
                        });
                        var utilsScriptPromise = new Promise(function(resolve, reject) {
                            _this2.resolveUtilsScriptPromise = resolve;
                            _this2.rejectUtilsScriptPromise = reject;
                        });
                        this.promise = Promise.all([ autoCountryPromise, utilsScriptPromise ]);
                    } else {
                        // prevent errors when Promise doesn't exist
                        this.resolveAutoCountryPromise = this.rejectAutoCountryPromise = function() {};
                        this.resolveUtilsScriptPromise = this.rejectUtilsScriptPromise = function() {};
                    }
                    // in various situations there could be no country selected initially, but we need to be able
                    // to assume this variable exists
                    this.selectedCountryData = {};
                    // process all the data: onlyCountries, excludeCountries, preferredCountries etc
                    this._processCountryData();
                    // generate the markup
                    this._generateMarkup();
                    // set the initial state of the input value and the selected flag
                    this._setInitialState();
                    // start all of the event listeners: autoHideDialCode, input keydown, selectedFlag click
                    this._initListeners();
                    // utils script, and auto country
                    this._initRequests();
                }
            }, {
                key: "_processCountryData",
                value: function _processCountryData() {
                    // process onlyCountries or excludeCountries array if present
                    this._processAllCountries();
                    // process the countryCodes map
                    this._processCountryCodes();
                    // process the preferredCountries
                    this._processPreferredCountries();
                    // translate countries according to localizedCountries option
                    if (this.options.localizedCountries) this._translateCountriesByLocale();
                    // sort countries by name
                    if (this.options.onlyCountries.length || this.options.localizedCountries) {
                        this.countries.sort(this._countryNameSort);
                    }
                }
            }, {
                key: "_addCountryCode",
                value: function _addCountryCode(iso2, countryCode, priority) {
                    if (countryCode.length > this.countryCodeMaxLen) {
                        this.countryCodeMaxLen = countryCode.length;
                    }
                    if (!this.countryCodes.hasOwnProperty(countryCode)) {
                        this.countryCodes[countryCode] = [];
                    }
                    // bail if we already have this country for this countryCode
                    for (var i = 0; i < this.countryCodes[countryCode].length; i++) {
                        if (this.countryCodes[countryCode][i] === iso2) return;
                    }
                    // check for undefined as 0 is falsy
                    var index = priority !== undefined ? priority : this.countryCodes[countryCode].length;
                    this.countryCodes[countryCode][index] = iso2;
                }
            }, {
                key: "_processAllCountries",
                value: function _processAllCountries() {
                    if (this.options.onlyCountries.length) {
                        var lowerCaseOnlyCountries = this.options.onlyCountries.map(function(country) {
                            return country.toLowerCase();
                        });
                        this.countries = allCountries.filter(function(country) {
                            return lowerCaseOnlyCountries.indexOf(country.iso2) > -1;
                        });
                    } else if (this.options.excludeCountries.length) {
                        var lowerCaseExcludeCountries = this.options.excludeCountries.map(function(country) {
                            return country.toLowerCase();
                        });
                        this.countries = allCountries.filter(function(country) {
                            return lowerCaseExcludeCountries.indexOf(country.iso2) === -1;
                        });
                    } else {
                        this.countries = allCountries;
                    }
                }
            }, {
                key: "_translateCountriesByLocale",
                value: function _translateCountriesByLocale() {
                    for (var i = 0; i < this.countries.length; i++) {
                        var iso = this.countries[i].iso2.toLowerCase();
                        if (this.options.localizedCountries.hasOwnProperty(iso)) {
                            this.countries[i].name = this.options.localizedCountries[iso];
                        }
                    }
                }
            }, {
                key: "_countryNameSort",
                value: function _countryNameSort(a, b) {
                    return a.name.localeCompare(b.name);
                }
            }, {
                key: "_processCountryCodes",
                value: function _processCountryCodes() {
                    this.countryCodeMaxLen = 0;
                    // here we store just dial codes
                    this.dialCodes = {};
                    // here we store "country codes" (both dial codes and their area codes)
                    this.countryCodes = {};
                    // first: add dial codes
                    for (var i = 0; i < this.countries.length; i++) {
                        var c = this.countries[i];
                        if (!this.dialCodes[c.dialCode]) this.dialCodes[c.dialCode] = true;
                        this._addCountryCode(c.iso2, c.dialCode, c.priority);
                    }
                    // next: add area codes
                    // this is a second loop over countries, to make sure we have all of the "root" countries
                    // already in the map, so that we can access them, as each time we add an area code substring
                    // to the map, we also need to include the "root" country's code, as that also matches
                    for (var _i = 0; _i < this.countries.length; _i++) {
                        var _c = this.countries[_i];
                        // area codes
                        if (_c.areaCodes) {
                            var rootCountryCode = this.countryCodes[_c.dialCode][0];
                            // for each area code
                            for (var j = 0; j < _c.areaCodes.length; j++) {
                                var areaCode = _c.areaCodes[j];
                                // for each digit in the area code to add all partial matches as well
                                for (var k = 1; k < areaCode.length; k++) {
                                    var partialDialCode = _c.dialCode + areaCode.substr(0, k);
                                    // start with the root country, as that also matches this dial code
                                    this._addCountryCode(rootCountryCode, partialDialCode);
                                    this._addCountryCode(_c.iso2, partialDialCode);
                                }
                                // add the full area code
                                this._addCountryCode(_c.iso2, _c.dialCode + areaCode);
                            }
                        }
                    }
                }
            }, {
                key: "_processPreferredCountries",
                value: function _processPreferredCountries() {
                    this.preferredCountries = [];
                    for (var i = 0; i < this.options.preferredCountries.length; i++) {
                        var countryCode = this.options.preferredCountries[i].toLowerCase();
                        var countryData = this._getCountryData(countryCode, false, true);
                        if (countryData) this.preferredCountries.push(countryData);
                    }
                }
            }, {
                key: "_createEl",
                value: function _createEl(name, attrs, container) {
                    var el = document.createElement(name);
                    if (attrs) forEachProp(attrs, function(key, value) {
                        return el.setAttribute(key, value);
                    });
                    if (container) container.appendChild(el);
                    return el;
                }
            }, {
                key: "_generateMarkup",
                value: function _generateMarkup() {
                    // if autocomplete does not exist on the element and its form, then
                    // prevent autocomplete as there's no safe, cross-browser event we can react to, so it can
                    // easily put the plugin in an inconsistent state e.g. the wrong flag selected for the
                    // autocompleted number, which on submit could mean wrong number is saved (esp in nationalMode)
                    if (!this.telInput.hasAttribute("autocomplete") && !(this.telInput.form && this.telInput.form.hasAttribute("autocomplete"))) {
                        this.telInput.setAttribute("autocomplete", "off");
                    }
                    // containers (mostly for positioning)
                    var parentClass = "iti";
                    if (this.options.allowDropdown) parentClass += " iti--allow-dropdown";
                    if (this.options.separateDialCode) parentClass += " iti--separate-dial-code";
                    if (this.options.customContainer) {
                        parentClass += " ";
                        parentClass += this.options.customContainer;
                    }
                    var wrapper = this._createEl("div", {
                        "class": parentClass
                    });
                    this.telInput.parentNode.insertBefore(wrapper, this.telInput);
                    this.flagsContainer = this._createEl("div", {
                        "class": "iti__flag-container"
                    }, wrapper);
                    wrapper.appendChild(this.telInput);
                    // selected flag (displayed to left of input)
                    this.selectedFlag = this._createEl("div", {
                        "class": "iti__selected-flag",
                        role: "combobox",
                        "aria-controls": "iti-".concat(this.id, "__country-listbox"),
                        "aria-owns": "iti-".concat(this.id, "__country-listbox"),
                        "aria-expanded": "false"
                    }, this.flagsContainer);
                    this.selectedFlagInner = this._createEl("div", {
                        "class": "iti__flag"
                    }, this.selectedFlag);
                    if (this.options.separateDialCode) {
                        this.selectedDialCode = this._createEl("div", {
                            "class": "iti__selected-dial-code"
                        }, this.selectedFlag);
                    }
                    if (this.options.allowDropdown) {
                        // make element focusable and tab navigable
                        this.selectedFlag.setAttribute("tabindex", "0");
                        this.dropdownArrow = this._createEl("div", {
                            "class": "iti__arrow"
                        }, this.selectedFlag);
                        // country dropdown: preferred countries, then divider, then all countries
                        this.countryList = this._createEl("ul", {
                            "class": "iti__country-list iti__hide",
                            id: "iti-".concat(this.id, "__country-listbox"),
                            role: "listbox",
                            "aria-label": "List of countries"
                        });
                        if (this.preferredCountries.length) {
                            this._appendListItems(this.preferredCountries, "iti__preferred", true);
                            this._createEl("li", {
                                "class": "iti__divider",
                                role: "separator",
                                "aria-disabled": "true"
                            }, this.countryList);
                        }
                        this._appendListItems(this.countries, "iti__standard");
                        // create dropdownContainer markup
                        if (this.options.dropdownContainer) {
                            this.dropdown = this._createEl("div", {
                                "class": "iti iti--container"
                            });
                            this.dropdown.appendChild(this.countryList);
                        } else {
                            this.flagsContainer.appendChild(this.countryList);
                        }
                    }
                    if (this.options.hiddenInput) {
                        var hiddenInputName = this.options.hiddenInput;
                        var name = this.telInput.getAttribute("name");
                        if (name) {
                            var i = name.lastIndexOf("[");
                            // if input name contains square brackets, then give the hidden input the same name,
                            // replacing the contents of the last set of brackets with the given hiddenInput name
                            if (i !== -1) hiddenInputName = "".concat(name.substr(0, i), "[").concat(hiddenInputName, "]");
                        }
                        this.hiddenInput = this._createEl("input", {
                            type: "hidden",
                            name: hiddenInputName
                        });
                        wrapper.appendChild(this.hiddenInput);
                    }
                }
            }, {
                key: "_appendListItems",
                value: function _appendListItems(countries, className, preferred) {
                    // we create so many DOM elements, it is faster to build a temp string
                    // and then add everything to the DOM in one go at the end
                    var tmp = "";
                    // for each country
                    for (var i = 0; i < countries.length; i++) {
                        var c = countries[i];
                        var idSuffix = preferred ? "-preferred" : "";
                        // open the list item
                        tmp += "<li class='iti__country ".concat(className, "' tabIndex='-1' id='iti-").concat(this.id, "__item-").concat(c.iso2).concat(idSuffix, "' role='option' data-dial-code='").concat(c.dialCode, "' data-country-code='").concat(c.iso2, "' aria-selected='false'>");
                        // add the flag
                        tmp += "<div class='iti__flag-box'><div class='iti__flag iti__".concat(c.iso2, "'></div></div>");
                        // and the country name and dial code
                        tmp += "<span class='iti__country-name'>".concat(c.name, "</span>");
                        tmp += "<span class='iti__dial-code'>+".concat(c.dialCode, "</span>");
                        // close the list item
                        tmp += "</li>";
                    }
                    this.countryList.insertAdjacentHTML("beforeend", tmp);
                }
            }, {
                key: "_setInitialState",
                value: function _setInitialState() {
                    // fix firefox bug: when first load page (with input with value set to number with intl dial
                    // code) and initialising plugin removes the dial code from the input, then refresh page,
                    // and we try to init plugin again but this time on number without dial code so get grey flag
                    var attributeValue = this.telInput.getAttribute("value");
                    var inputValue = this.telInput.value;
                    var useAttribute = attributeValue && attributeValue.charAt(0) === "+" && (!inputValue || inputValue.charAt(0) !== "+");
                    var val = useAttribute ? attributeValue : inputValue;
                    var dialCode = this._getDialCode(val);
                    var isRegionlessNanp = this._isRegionlessNanp(val);
                    var _this$options = this.options, initialCountry = _this$options.initialCountry, nationalMode = _this$options.nationalMode, autoHideDialCode = _this$options.autoHideDialCode, separateDialCode = _this$options.separateDialCode;
                    // if we already have a dial code, and it's not a regionlessNanp, we can go ahead and set the
                    // flag, else fall back to the default country
                    if (dialCode && !isRegionlessNanp) {
                        this._updateFlagFromNumber(val);
                    } else if (initialCountry !== "auto") {
                        // see if we should select a flag
                        if (initialCountry) {
                            this._setFlag(initialCountry.toLowerCase());
                        } else {
                            if (dialCode && isRegionlessNanp) {
                                // has intl dial code, is regionless nanp, and no initialCountry, so default to US
                                this._setFlag("us");
                            } else {
                                // no dial code and no initialCountry, so default to first in list
                                this.defaultCountry = this.preferredCountries.length ? this.preferredCountries[0].iso2 : this.countries[0].iso2;
                                if (!val) {
                                    this._setFlag(this.defaultCountry);
                                }
                            }
                        }
                        // if empty and no nationalMode and no autoHideDialCode then insert the default dial code
                        if (!val && !nationalMode && !autoHideDialCode && !separateDialCode) {
                            this.telInput.value = "+".concat(this.selectedCountryData.dialCode);
                        }
                    }
                    // NOTE: if initialCountry is set to auto, that will be handled separately
                    // format - note this wont be run after _updateDialCode as that's only called if no val
                    if (val) this._updateValFromNumber(val);
                }
            }, {
                key: "_initListeners",
                value: function _initListeners() {
                    this._initKeyListeners();
                    if (this.options.autoHideDialCode) this._initBlurListeners();
                    if (this.options.allowDropdown) this._initDropdownListeners();
                    if (this.hiddenInput) this._initHiddenInputListener();
                }
            }, {
                key: "_initHiddenInputListener",
                value: function _initHiddenInputListener() {
                    var _this3 = this;
                    this._handleHiddenInputSubmit = function() {
                        _this3.hiddenInput.value = _this3.getNumber();
                    };
                    if (this.telInput.form) this.telInput.form.addEventListener("submit", this._handleHiddenInputSubmit);
                }
            }, {
                key: "_getClosestLabel",
                value: function _getClosestLabel() {
                    var el = this.telInput;
                    while (el && el.tagName !== "LABEL") {
                        el = el.parentNode;
                    }
                    return el;
                }
            }, {
                key: "_initDropdownListeners",
                value: function _initDropdownListeners() {
                    var _this4 = this;
                    // hack for input nested inside label (which is valid markup): clicking the selected-flag to
                    // open the dropdown would then automatically trigger a 2nd click on the input which would
                    // close it again
                    this._handleLabelClick = function(e) {
                        // if the dropdown is closed, then focus the input, else ignore the click
                        if (_this4.countryList.classList.contains("iti__hide")) _this4.telInput.focus(); else e.preventDefault();
                    };
                    var label = this._getClosestLabel();
                    if (label) label.addEventListener("click", this._handleLabelClick);
                    // toggle country dropdown on click
                    this._handleClickSelectedFlag = function() {
                        // only intercept this event if we're opening the dropdown
                        // else let it bubble up to the top ("click-off-to-close" listener)
                        // we cannot just stopPropagation as it may be needed to close another instance
                        if (_this4.countryList.classList.contains("iti__hide") && !_this4.telInput.disabled && !_this4.telInput.readOnly) {
                            _this4._showDropdown();
                        }
                    };
                    this.selectedFlag.addEventListener("click", this._handleClickSelectedFlag);
                    // open dropdown list if currently focused
                    this._handleFlagsContainerKeydown = function(e) {
                        var isDropdownHidden = _this4.countryList.classList.contains("iti__hide");
                        if (isDropdownHidden && [ "ArrowUp", "Up", "ArrowDown", "Down", " ", "Enter" ].indexOf(e.key) !== -1) {
                            // prevent form from being submitted if "ENTER" was pressed
                            e.preventDefault();
                            // prevent event from being handled again by document
                            e.stopPropagation();
                            _this4._showDropdown();
                        }
                        // allow navigation from dropdown to input on TAB
                        if (e.key === "Tab") _this4._closeDropdown();
                    };
                    this.flagsContainer.addEventListener("keydown", this._handleFlagsContainerKeydown);
                }
            }, {
                key: "_initRequests",
                value: function _initRequests() {
                    var _this5 = this;
                    // if the user has specified the path to the utils script, fetch it on window.load, else resolve
                    if (this.options.utilsScript && !window.intlTelInputUtils) {
                        // if the plugin is being initialised after the window.load event has already been fired
                        if (window.intlTelInputGlobals.documentReady()) {
                            window.intlTelInputGlobals.loadUtils(this.options.utilsScript);
                        } else {
                            // wait until the load event so we don't block any other requests e.g. the flags image
                            window.addEventListener("load", function() {
                                window.intlTelInputGlobals.loadUtils(_this5.options.utilsScript);
                            });
                        }
                    } else this.resolveUtilsScriptPromise();
                    if (this.options.initialCountry === "auto") this._loadAutoCountry(); else this.resolveAutoCountryPromise();
                }
            }, {
                key: "_loadAutoCountry",
                value: function _loadAutoCountry() {
                    // 3 options:
                    // 1) already loaded (we're done)
                    // 2) not already started loading (start)
                    // 3) already started loading (do nothing - just wait for loading callback to fire)
                    if (window.intlTelInputGlobals.autoCountry) {
                        this.handleAutoCountry();
                    } else if (!window.intlTelInputGlobals.startedLoadingAutoCountry) {
                        // don't do this twice!
                        window.intlTelInputGlobals.startedLoadingAutoCountry = true;
                        if (typeof this.options.geoIpLookup === "function") {
                            this.options.geoIpLookup(function(countryCode) {
                                window.intlTelInputGlobals.autoCountry = countryCode.toLowerCase();
                                // tell all instances the auto country is ready
                                // TODO: this should just be the current instances
                                // UPDATE: use setTimeout in case their geoIpLookup function calls this callback straight
                                // away (e.g. if they have already done the geo ip lookup somewhere else). Using
                                // setTimeout means that the current thread of execution will finish before executing
                                // this, which allows the plugin to finish initialising.
                                setTimeout(function() {
                                    return forEachInstance("handleAutoCountry");
                                });
                            }, function() {
                                return forEachInstance("rejectAutoCountryPromise");
                            });
                        }
                    }
                }
            }, {
                key: "_initKeyListeners",
                value: function _initKeyListeners() {
                    var _this6 = this;
                    // update flag on keyup
                    this._handleKeyupEvent = function() {
                        if (_this6._updateFlagFromNumber(_this6.telInput.value)) {
                            _this6._triggerCountryChange();
                        }
                    };
                    this.telInput.addEventListener("keyup", this._handleKeyupEvent);
                    // update flag on cut/paste events (now supported in all major browsers)
                    this._handleClipboardEvent = function() {
                        // hack because "paste" event is fired before input is updated
                        setTimeout(_this6._handleKeyupEvent);
                    };
                    this.telInput.addEventListener("cut", this._handleClipboardEvent);
                    this.telInput.addEventListener("paste", this._handleClipboardEvent);
                }
            }, {
                key: "_cap",
                value: function _cap(number) {
                    var max = this.telInput.getAttribute("maxlength");
                    return max && number.length > max ? number.substr(0, max) : number;
                }
            }, {
                key: "_initBlurListeners",
                value: function _initBlurListeners() {
                    var _this7 = this;
                    // on blur or form submit: if just a dial code then remove it
                    this._handleSubmitOrBlurEvent = function() {
                        _this7._removeEmptyDialCode();
                    };
                    if (this.telInput.form) this.telInput.form.addEventListener("submit", this._handleSubmitOrBlurEvent);
                    this.telInput.addEventListener("blur", this._handleSubmitOrBlurEvent);
                }
            }, {
                key: "_removeEmptyDialCode",
                value: function _removeEmptyDialCode() {
                    if (this.telInput.value.charAt(0) === "+") {
                        var numeric = this._getNumeric(this.telInput.value);
                        // if just a plus, or if just a dial code
                        if (!numeric || this.selectedCountryData.dialCode === numeric) {
                            this.telInput.value = "";
                        }
                    }
                }
            }, {
                key: "_getNumeric",
                value: function _getNumeric(s) {
                    return s.replace(/\D/g, "");
                }
            }, {
                key: "_trigger",
                value: function _trigger(name) {
                    // have to use old school document.createEvent as IE11 doesn't support `new Event()` syntax
                    var e = document.createEvent("Event");
                    e.initEvent(name, true, true);
                    // can bubble, and is cancellable
                    this.telInput.dispatchEvent(e);
                }
            }, {
                key: "_showDropdown",
                value: function _showDropdown() {
                    this.countryList.classList.remove("iti__hide");
                    this.selectedFlag.setAttribute("aria-expanded", "true");
                    this._setDropdownPosition();
                    // update highlighting and scroll to active list item
                    if (this.activeItem) {
                        this._highlightListItem(this.activeItem, false);
                        this._scrollTo(this.activeItem, true);
                    }
                    // bind all the dropdown-related listeners: mouseover, click, click-off, keydown
                    this._bindDropdownListeners();
                    // update the arrow
                    this.dropdownArrow.classList.add("iti__arrow--up");
                    this._trigger("open:countrydropdown");
                }
            }, {
                key: "_toggleClass",
                value: function _toggleClass(el, className, shouldHaveClass) {
                    if (shouldHaveClass && !el.classList.contains(className)) el.classList.add(className); else if (!shouldHaveClass && el.classList.contains(className)) el.classList.remove(className);
                }
            }, {
                key: "_setDropdownPosition",
                value: function _setDropdownPosition() {
                    var _this8 = this;
                    if (this.options.dropdownContainer) {
                        this.options.dropdownContainer.appendChild(this.dropdown);
                    }
                    if (!this.isMobile) {
                        var pos = this.telInput.getBoundingClientRect();
                        // windowTop from https://stackoverflow.com/a/14384091/217866
                        var windowTop = window.pageYOffset || document.documentElement.scrollTop;
                        var inputTop = pos.top + windowTop;
                        var dropdownHeight = this.countryList.offsetHeight;
                        // dropdownFitsBelow = (dropdownBottom < windowBottom)
                        var dropdownFitsBelow = inputTop + this.telInput.offsetHeight + dropdownHeight < windowTop + window.innerHeight;
                        var dropdownFitsAbove = inputTop - dropdownHeight > windowTop;
                        // by default, the dropdown will be below the input. If we want to position it above the
                        // input, we add the dropup class.
                        this._toggleClass(this.countryList, "iti__country-list--dropup", !dropdownFitsBelow && dropdownFitsAbove);
                        // if dropdownContainer is enabled, calculate postion
                        if (this.options.dropdownContainer) {
                            // by default the dropdown will be directly over the input because it's not in the flow.
                            // If we want to position it below, we need to add some extra top value.
                            var extraTop = !dropdownFitsBelow && dropdownFitsAbove ? 0 : this.telInput.offsetHeight;
                            // calculate placement
                            this.dropdown.style.top = "".concat(inputTop + extraTop, "px");
                            this.dropdown.style.left = "".concat(pos.left + document.body.scrollLeft, "px");
                            // close menu on window scroll
                            this._handleWindowScroll = function() {
                                return _this8._closeDropdown();
                            };
                            window.addEventListener("scroll", this._handleWindowScroll);
                        }
                    }
                }
            }, {
                key: "_getClosestListItem",
                value: function _getClosestListItem(target) {
                    var el = target;
                    while (el && el !== this.countryList && !el.classList.contains("iti__country")) {
                        el = el.parentNode;
                    }
                    // if we reached the countryList element, then return null
                    return el === this.countryList ? null : el;
                }
            }, {
                key: "_bindDropdownListeners",
                value: function _bindDropdownListeners() {
                    var _this9 = this;
                    // when mouse over a list item, just highlight that one
                    // we add the class "highlight", so if they hit "enter" we know which one to select
                    this._handleMouseoverCountryList = function(e) {
                        // handle event delegation, as we're listening for this event on the countryList
                        var listItem = _this9._getClosestListItem(e.target);
                        if (listItem) _this9._highlightListItem(listItem, false);
                    };
                    this.countryList.addEventListener("mouseover", this._handleMouseoverCountryList);
                    // listen for country selection
                    this._handleClickCountryList = function(e) {
                        var listItem = _this9._getClosestListItem(e.target);
                        if (listItem) _this9._selectListItem(listItem);
                    };
                    this.countryList.addEventListener("click", this._handleClickCountryList);
                    // click off to close
                    // (except when this initial opening click is bubbling up)
                    // we cannot just stopPropagation as it may be needed to close another instance
                    var isOpening = true;
                    this._handleClickOffToClose = function() {
                        if (!isOpening) _this9._closeDropdown();
                        isOpening = false;
                    };
                    document.documentElement.addEventListener("click", this._handleClickOffToClose);
                    // listen for up/down scrolling, enter to select, or letters to jump to country name.
                    // use keydown as keypress doesn't fire for non-char keys and we want to catch if they
                    // just hit down and hold it to scroll down (no keyup event).
                    // listen on the document because that's where key events are triggered if no input has focus
                    var query = "";
                    var queryTimer = null;
                    this._handleKeydownOnDropdown = function(e) {
                        // prevent down key from scrolling the whole page,
                        // and enter key from submitting a form etc
                        e.preventDefault();
                        // up and down to navigate
                        if (e.key === "ArrowUp" || e.key === "Up" || e.key === "ArrowDown" || e.key === "Down") _this9._handleUpDownKey(e.key); else if (e.key === "Enter") _this9._handleEnterKey(); else if (e.key === "Escape") _this9._closeDropdown(); else if (/^[a-zA-ZÀ-ÿа-яА-Я ]$/.test(e.key)) {
                            // jump to countries that start with the query string
                            if (queryTimer) clearTimeout(queryTimer);
                            query += e.key.toLowerCase();
                            _this9._searchForCountry(query);
                            // if the timer hits 1 second, reset the query
                            queryTimer = setTimeout(function() {
                                query = "";
                            }, 1e3);
                        }
                    };
                    document.addEventListener("keydown", this._handleKeydownOnDropdown);
                }
            }, {
                key: "_handleUpDownKey",
                value: function _handleUpDownKey(key) {
                    var next = key === "ArrowUp" || key === "Up" ? this.highlightedItem.previousElementSibling : this.highlightedItem.nextElementSibling;
                    if (next) {
                        // skip the divider
                        if (next.classList.contains("iti__divider")) {
                            next = key === "ArrowUp" || key === "Up" ? next.previousElementSibling : next.nextElementSibling;
                        }
                        this._highlightListItem(next, true);
                    }
                }
            }, {
                key: "_handleEnterKey",
                value: function _handleEnterKey() {
                    if (this.highlightedItem) this._selectListItem(this.highlightedItem);
                }
            }, {
                key: "_searchForCountry",
                value: function _searchForCountry(query) {
                    for (var i = 0; i < this.countries.length; i++) {
                        if (this._startsWith(this.countries[i].name, query)) {
                            var listItem = this.countryList.querySelector("#iti-".concat(this.id, "__item-").concat(this.countries[i].iso2));
                            // update highlighting and scroll
                            this._highlightListItem(listItem, false);
                            this._scrollTo(listItem, true);
                            break;
                        }
                    }
                }
            }, {
                key: "_startsWith",
                value: function _startsWith(a, b) {
                    return a.substr(0, b.length).toLowerCase() === b;
                }
            }, {
                key: "_updateValFromNumber",
                value: function _updateValFromNumber(originalNumber) {
                    var number = originalNumber;
                    if (this.options.formatOnDisplay && window.intlTelInputUtils && this.selectedCountryData) {
                        var useNational = !this.options.separateDialCode && (this.options.nationalMode || number.charAt(0) !== "+");
                        var _intlTelInputUtils$nu = intlTelInputUtils.numberFormat, NATIONAL = _intlTelInputUtils$nu.NATIONAL, INTERNATIONAL = _intlTelInputUtils$nu.INTERNATIONAL;
                        var format = useNational ? NATIONAL : INTERNATIONAL;
                        number = intlTelInputUtils.formatNumber(number, this.selectedCountryData.iso2, format);
                    }
                    number = this._beforeSetNumber(number);
                    this.telInput.value = number;
                }
            }, {
                key: "_updateFlagFromNumber",
                value: function _updateFlagFromNumber(originalNumber) {
                    // if we're in nationalMode and we already have US/Canada selected, make sure the number starts
                    // with a +1 so _getDialCode will be able to extract the area code
                    // update: if we dont yet have selectedCountryData, but we're here (trying to update the flag
                    // from the number), that means we're initialising the plugin with a number that already has a
                    // dial code, so fine to ignore this bit
                    var number = originalNumber;
                    var selectedDialCode = this.selectedCountryData.dialCode;
                    var isNanp = selectedDialCode === "1";
                    if (number && this.options.nationalMode && isNanp && number.charAt(0) !== "+") {
                        if (number.charAt(0) !== "1") number = "1".concat(number);
                        number = "+".concat(number);
                    }
                    // update flag if user types area code for another country
                    if (this.options.separateDialCode && selectedDialCode && number.charAt(0) !== "+") {
                        number = "+".concat(selectedDialCode).concat(number);
                    }
                    // try and extract valid dial code from input
                    var dialCode = this._getDialCode(number, true);
                    var numeric = this._getNumeric(number);
                    var countryCode = null;
                    if (dialCode) {
                        var countryCodes = this.countryCodes[this._getNumeric(dialCode)];
                        // check if the right country is already selected. this should be false if the number is
                        // longer than the matched dial code because in this case we need to make sure that if
                        // there are multiple country matches, that the first one is selected (note: we could
                        // just check that here, but it requires the same loop that we already have later)
                        var alreadySelected = countryCodes.indexOf(this.selectedCountryData.iso2) !== -1 && numeric.length <= dialCode.length - 1;
                        var isRegionlessNanpNumber = selectedDialCode === "1" && this._isRegionlessNanp(numeric);
                        // only update the flag if:
                        // A) NOT (we currently have a NANP flag selected, and the number is a regionlessNanp)
                        // AND
                        // B) the right country is not already selected
                        if (!isRegionlessNanpNumber && !alreadySelected) {
                            // if using onlyCountries option, countryCodes[0] may be empty, so we must find the first
                            // non-empty index
                            for (var j = 0; j < countryCodes.length; j++) {
                                if (countryCodes[j]) {
                                    countryCode = countryCodes[j];
                                    break;
                                }
                            }
                        }
                    } else if (number.charAt(0) === "+" && numeric.length) {
                        // invalid dial code, so empty
                        // Note: use getNumeric here because the number has not been formatted yet, so could contain
                        // bad chars
                        countryCode = "";
                    } else if (!number || number === "+") {
                        // empty, or just a plus, so default
                        countryCode = this.defaultCountry;
                    }
                    if (countryCode !== null) {
                        return this._setFlag(countryCode);
                    }
                    return false;
                }
            }, {
                key: "_isRegionlessNanp",
                value: function _isRegionlessNanp(number) {
                    var numeric = this._getNumeric(number);
                    if (numeric.charAt(0) === "1") {
                        var areaCode = numeric.substr(1, 3);
                        return regionlessNanpNumbers.indexOf(areaCode) !== -1;
                    }
                    return false;
                }
            }, {
                key: "_highlightListItem",
                value: function _highlightListItem(listItem, shouldFocus) {
                    var prevItem = this.highlightedItem;
                    if (prevItem) prevItem.classList.remove("iti__highlight");
                    this.highlightedItem = listItem;
                    this.highlightedItem.classList.add("iti__highlight");
                    if (shouldFocus) this.highlightedItem.focus();
                }
            }, {
                key: "_getCountryData",
                value: function _getCountryData(countryCode, ignoreOnlyCountriesOption, allowFail) {
                    var countryList = ignoreOnlyCountriesOption ? allCountries : this.countries;
                    for (var i = 0; i < countryList.length; i++) {
                        if (countryList[i].iso2 === countryCode) {
                            return countryList[i];
                        }
                    }
                    if (allowFail) {
                        return null;
                    }
                    throw new Error("No country data for '".concat(countryCode, "'"));
                }
            }, {
                key: "_setFlag",
                value: function _setFlag(countryCode) {
                    var prevCountry = this.selectedCountryData.iso2 ? this.selectedCountryData : {};
                    // do this first as it will throw an error and stop if countryCode is invalid
                    this.selectedCountryData = countryCode ? this._getCountryData(countryCode, false, false) : {};
                    // update the defaultCountry - we only need the iso2 from now on, so just store that
                    if (this.selectedCountryData.iso2) {
                        this.defaultCountry = this.selectedCountryData.iso2;
                    }
                    this.selectedFlagInner.setAttribute("class", "iti__flag iti__".concat(countryCode));
                    // update the selected country's title attribute
                    var title = countryCode ? "".concat(this.selectedCountryData.name, ": +").concat(this.selectedCountryData.dialCode) : "Unknown";
                    this.selectedFlag.setAttribute("title", title);
                    if (this.options.separateDialCode) {
                        var dialCode = this.selectedCountryData.dialCode ? "+".concat(this.selectedCountryData.dialCode) : "";
                        this.selectedDialCode.innerHTML = dialCode;
                        // offsetWidth is zero if input is in a hidden container during initialisation
                        var selectedFlagWidth = this.selectedFlag.offsetWidth || this._getHiddenSelectedFlagWidth();
                        // add 6px of padding after the grey selected-dial-code box, as this is what we use in the css
                        this.telInput.style.paddingLeft = "".concat(selectedFlagWidth + 6, "px");
                    }
                    // and the input's placeholder
                    this._updatePlaceholder();
                    // update the active list item
                    if (this.options.allowDropdown) {
                        var prevItem = this.activeItem;
                        if (prevItem) {
                            prevItem.classList.remove("iti__active");
                            prevItem.setAttribute("aria-selected", "false");
                        }
                        if (countryCode) {
                            // check if there is a preferred item first, else fall back to standard
                            var nextItem = this.countryList.querySelector("#iti-".concat(this.id, "__item-").concat(countryCode, "-preferred")) || this.countryList.querySelector("#iti-".concat(this.id, "__item-").concat(countryCode));
                            nextItem.setAttribute("aria-selected", "true");
                            nextItem.classList.add("iti__active");
                            this.activeItem = nextItem;
                            this.selectedFlag.setAttribute("aria-activedescendant", nextItem.getAttribute("id"));
                        }
                    }
                    // return if the flag has changed or not
                    return prevCountry.iso2 !== countryCode;
                }
            }, {
                key: "_getHiddenSelectedFlagWidth",
                value: function _getHiddenSelectedFlagWidth() {
                    // to get the right styling to apply, all we need is a shallow clone of the container,
                    // and then to inject a deep clone of the selectedFlag element
                    var containerClone = this.telInput.parentNode.cloneNode();
                    containerClone.style.visibility = "hidden";
                    document.body.appendChild(containerClone);
                    var flagsContainerClone = this.flagsContainer.cloneNode();
                    containerClone.appendChild(flagsContainerClone);
                    var selectedFlagClone = this.selectedFlag.cloneNode(true);
                    flagsContainerClone.appendChild(selectedFlagClone);
                    var width = selectedFlagClone.offsetWidth;
                    containerClone.parentNode.removeChild(containerClone);
                    return width;
                }
            }, {
                key: "_updatePlaceholder",
                value: function _updatePlaceholder() {
                    var shouldSetPlaceholder = this.options.autoPlaceholder === "aggressive" || !this.hadInitialPlaceholder && this.options.autoPlaceholder === "polite";
                    if (window.intlTelInputUtils && shouldSetPlaceholder) {
                        var numberType = intlTelInputUtils.numberType[this.options.placeholderNumberType];
                        var placeholder = this.selectedCountryData.iso2 ? intlTelInputUtils.getExampleNumber(this.selectedCountryData.iso2, this.options.nationalMode, numberType) : "";
                        placeholder = this._beforeSetNumber(placeholder);
                        if (typeof this.options.customPlaceholder === "function") {
                            placeholder = this.options.customPlaceholder(placeholder, this.selectedCountryData);
                        }
                        this.telInput.setAttribute("placeholder", placeholder);
                    }
                }
            }, {
                key: "_selectListItem",
                value: function _selectListItem(listItem) {
                    // update selected flag and active list item
                    var flagChanged = this._setFlag(listItem.getAttribute("data-country-code"));
                    this._closeDropdown();
                    this._updateDialCode(listItem.getAttribute("data-dial-code"), true);
                    // focus the input
                    this.telInput.focus();
                    // put cursor at end - this fix is required for FF and IE11 (with nationalMode=false i.e. auto
                    // inserting dial code), who try to put the cursor at the beginning the first time
                    var len = this.telInput.value.length;
                    this.telInput.setSelectionRange(len, len);
                    if (flagChanged) {
                        this._triggerCountryChange();
                    }
                }
            }, {
                key: "_closeDropdown",
                value: function _closeDropdown() {
                    this.countryList.classList.add("iti__hide");
                    this.selectedFlag.setAttribute("aria-expanded", "false");
                    // update the arrow
                    this.dropdownArrow.classList.remove("iti__arrow--up");
                    // unbind key events
                    document.removeEventListener("keydown", this._handleKeydownOnDropdown);
                    document.documentElement.removeEventListener("click", this._handleClickOffToClose);
                    this.countryList.removeEventListener("mouseover", this._handleMouseoverCountryList);
                    this.countryList.removeEventListener("click", this._handleClickCountryList);
                    // remove menu from container
                    if (this.options.dropdownContainer) {
                        if (!this.isMobile) window.removeEventListener("scroll", this._handleWindowScroll);
                        if (this.dropdown.parentNode) this.dropdown.parentNode.removeChild(this.dropdown);
                    }
                    this._trigger("close:countrydropdown");
                }
            }, {
                key: "_scrollTo",
                value: function _scrollTo(element, middle) {
                    var container = this.countryList;
                    // windowTop from https://stackoverflow.com/a/14384091/217866
                    var windowTop = window.pageYOffset || document.documentElement.scrollTop;
                    var containerHeight = container.offsetHeight;
                    var containerTop = container.getBoundingClientRect().top + windowTop;
                    var containerBottom = containerTop + containerHeight;
                    var elementHeight = element.offsetHeight;
                    var elementTop = element.getBoundingClientRect().top + windowTop;
                    var elementBottom = elementTop + elementHeight;
                    var newScrollTop = elementTop - containerTop + container.scrollTop;
                    var middleOffset = containerHeight / 2 - elementHeight / 2;
                    if (elementTop < containerTop) {
                        // scroll up
                        if (middle) newScrollTop -= middleOffset;
                        container.scrollTop = newScrollTop;
                    } else if (elementBottom > containerBottom) {
                        // scroll down
                        if (middle) newScrollTop += middleOffset;
                        var heightDifference = containerHeight - elementHeight;
                        container.scrollTop = newScrollTop - heightDifference;
                    }
                }
            }, {
                key: "_updateDialCode",
                value: function _updateDialCode(newDialCodeBare, hasSelectedListItem) {
                    var inputVal = this.telInput.value;
                    // save having to pass this every time
                    var newDialCode = "+".concat(newDialCodeBare);
                    var newNumber;
                    if (inputVal.charAt(0) === "+") {
                        // there's a plus so we're dealing with a replacement (doesn't matter if nationalMode or not)
                        var prevDialCode = this._getDialCode(inputVal);
                        if (prevDialCode) {
                            // current number contains a valid dial code, so replace it
                            newNumber = inputVal.replace(prevDialCode, newDialCode);
                        } else {
                            // current number contains an invalid dial code, so ditch it
                            // (no way to determine where the invalid dial code ends and the rest of the number begins)
                            newNumber = newDialCode;
                        }
                    } else if (this.options.nationalMode || this.options.separateDialCode) {
                        // don't do anything
                        return;
                    } else {
                        // nationalMode is disabled
                        if (inputVal) {
                            // there is an existing value with no dial code: prefix the new dial code
                            newNumber = newDialCode + inputVal;
                        } else if (hasSelectedListItem || !this.options.autoHideDialCode) {
                            // no existing value and either they've just selected a list item, or autoHideDialCode is
                            // disabled: insert new dial code
                            newNumber = newDialCode;
                        } else {
                            return;
                        }
                    }
                    this.telInput.value = newNumber;
                }
            }, {
                key: "_getDialCode",
                value: function _getDialCode(number, includeAreaCode) {
                    var dialCode = "";
                    // only interested in international numbers (starting with a plus)
                    if (number.charAt(0) === "+") {
                        var numericChars = "";
                        // iterate over chars
                        for (var i = 0; i < number.length; i++) {
                            var c = number.charAt(i);
                            // if char is number (https://stackoverflow.com/a/8935649/217866)
                            if (!isNaN(parseInt(c, 10))) {
                                numericChars += c;
                                // if current numericChars make a valid dial code
                                if (includeAreaCode) {
                                    if (this.countryCodes[numericChars]) {
                                        // store the actual raw string (useful for matching later)
                                        dialCode = number.substr(0, i + 1);
                                    }
                                } else {
                                    if (this.dialCodes[numericChars]) {
                                        dialCode = number.substr(0, i + 1);
                                        // if we're just looking for a dial code, we can break as soon as we find one
                                        break;
                                    }
                                }
                                // stop searching as soon as we can - in this case when we hit max len
                                if (numericChars.length === this.countryCodeMaxLen) {
                                    break;
                                }
                            }
                        }
                    }
                    return dialCode;
                }
            }, {
                key: "_getFullNumber",
                value: function _getFullNumber() {
                    var val = this.telInput.value.trim();
                    var dialCode = this.selectedCountryData.dialCode;
                    var prefix;
                    var numericVal = this._getNumeric(val);
                    if (this.options.separateDialCode && val.charAt(0) !== "+" && dialCode && numericVal) {
                        // when using separateDialCode, it is visible so is effectively part of the typed number
                        prefix = "+".concat(dialCode);
                    } else {
                        prefix = "";
                    }
                    return prefix + val;
                }
            }, {
                key: "_beforeSetNumber",
                value: function _beforeSetNumber(originalNumber) {
                    var number = originalNumber;
                    if (this.options.separateDialCode) {
                        var dialCode = this._getDialCode(number);
                        // if there is a valid dial code
                        if (dialCode) {
                            // in case _getDialCode returned an area code as well
                            dialCode = "+".concat(this.selectedCountryData.dialCode);
                            // a lot of numbers will have a space separating the dial code and the main number, and
                            // some NANP numbers will have a hyphen e.g. +1 684-733-1234 - in both cases we want to get
                            // rid of it
                            // NOTE: don't just trim all non-numerics as may want to preserve an open parenthesis etc
                            var start = number[dialCode.length] === " " || number[dialCode.length] === "-" ? dialCode.length + 1 : dialCode.length;
                            number = number.substr(start);
                        }
                    }
                    return this._cap(number);
                }
            }, {
                key: "_triggerCountryChange",
                value: function _triggerCountryChange() {
                    this._trigger("countrychange");
                }
            }, {
                key: "handleAutoCountry",
                value: function handleAutoCountry() {
                    if (this.options.initialCountry === "auto") {
                        // we must set this even if there is an initial val in the input: in case the initial val is
                        // invalid and they delete it - they should see their auto country
                        this.defaultCountry = window.intlTelInputGlobals.autoCountry;
                        // if there's no initial value in the input, then update the flag
                        if (!this.telInput.value) {
                            this.setCountry(this.defaultCountry);
                        }
                        this.resolveAutoCountryPromise();
                    }
                }
            }, {
                key: "handleUtils",
                value: function handleUtils() {
                    // if the request was successful
                    if (window.intlTelInputUtils) {
                        // if there's an initial value in the input, then format it
                        if (this.telInput.value) {
                            this._updateValFromNumber(this.telInput.value);
                        }
                        this._updatePlaceholder();
                    }
                    this.resolveUtilsScriptPromise();
                }
            }, {
                key: "destroy",
                value: function destroy() {
                    var form = this.telInput.form;
                    if (this.options.allowDropdown) {
                        // make sure the dropdown is closed (and unbind listeners)
                        this._closeDropdown();
                        this.selectedFlag.removeEventListener("click", this._handleClickSelectedFlag);
                        this.flagsContainer.removeEventListener("keydown", this._handleFlagsContainerKeydown);
                        // label click hack
                        var label = this._getClosestLabel();
                        if (label) label.removeEventListener("click", this._handleLabelClick);
                    }
                    // unbind hiddenInput listeners
                    if (this.hiddenInput && form) form.removeEventListener("submit", this._handleHiddenInputSubmit);
                    // unbind autoHideDialCode listeners
                    if (this.options.autoHideDialCode) {
                        if (form) form.removeEventListener("submit", this._handleSubmitOrBlurEvent);
                        this.telInput.removeEventListener("blur", this._handleSubmitOrBlurEvent);
                    }
                    // unbind key events, and cut/paste events
                    this.telInput.removeEventListener("keyup", this._handleKeyupEvent);
                    this.telInput.removeEventListener("cut", this._handleClipboardEvent);
                    this.telInput.removeEventListener("paste", this._handleClipboardEvent);
                    // remove attribute of id instance: data-intl-tel-input-id
                    this.telInput.removeAttribute("data-intl-tel-input-id");
                    // remove markup (but leave the original input)
                    var wrapper = this.telInput.parentNode;
                    wrapper.parentNode.insertBefore(this.telInput, wrapper);
                    wrapper.parentNode.removeChild(wrapper);
                    delete window.intlTelInputGlobals.instances[this.id];
                }
            }, {
                key: "getExtension",
                value: function getExtension() {
                    if (window.intlTelInputUtils) {
                        return intlTelInputUtils.getExtension(this._getFullNumber(), this.selectedCountryData.iso2);
                    }
                    return "";
                }
            }, {
                key: "getNumber",
                value: function getNumber(format) {
                    if (window.intlTelInputUtils) {
                        var iso2 = this.selectedCountryData.iso2;
                        return intlTelInputUtils.formatNumber(this._getFullNumber(), iso2, format);
                    }
                    return "";
                }
            }, {
                key: "getNumberType",
                value: function getNumberType() {
                    if (window.intlTelInputUtils) {
                        return intlTelInputUtils.getNumberType(this._getFullNumber(), this.selectedCountryData.iso2);
                    }
                    return -99;
                }
            }, {
                key: "getSelectedCountryData",
                value: function getSelectedCountryData() {
                    return this.selectedCountryData;
                }
            }, {
                key: "getValidationError",
                value: function getValidationError() {
                    if (window.intlTelInputUtils) {
                        var iso2 = this.selectedCountryData.iso2;
                        return intlTelInputUtils.getValidationError(this._getFullNumber(), iso2);
                    }
                    return -99;
                }
            }, {
                key: "isValidNumber",
                value: function isValidNumber() {
                    var val = this._getFullNumber().trim();
                    var countryCode = this.options.nationalMode ? this.selectedCountryData.iso2 : "";
                    return window.intlTelInputUtils ? intlTelInputUtils.isValidNumber(val, countryCode) : null;
                }
            }, {
                key: "setCountry",
                value: function setCountry(originalCountryCode) {
                    var countryCode = originalCountryCode.toLowerCase();
                    // check if already selected
                    if (!this.selectedFlagInner.classList.contains("iti__".concat(countryCode))) {
                        this._setFlag(countryCode);
                        this._updateDialCode(this.selectedCountryData.dialCode, false);
                        this._triggerCountryChange();
                    }
                }
            }, {
                key: "setNumber",
                value: function setNumber(number) {
                    // we must update the flag first, which updates this.selectedCountryData, which is used for
                    // formatting the number before displaying it
                    var flagChanged = this._updateFlagFromNumber(number);
                    this._updateValFromNumber(number);
                    if (flagChanged) {
                        this._triggerCountryChange();
                    }
                }
            }, {
                key: "setPlaceholderNumberType",
                value: function setPlaceholderNumberType(type) {
                    this.options.placeholderNumberType = type;
                    this._updatePlaceholder();
                }
            } ]);
            return Iti;
        }();
        /********************
 *  STATIC METHODS
 ********************/
        // get the country data object
        intlTelInputGlobals.getCountryData = function() {
            return allCountries;
        };
        // inject a <script> element to load utils.js
        var injectScript = function injectScript(path, handleSuccess, handleFailure) {
            // inject a new script element into the page
            var script = document.createElement("script");
            script.onload = function() {
                forEachInstance("handleUtils");
                if (handleSuccess) handleSuccess();
            };
            script.onerror = function() {
                forEachInstance("rejectUtilsScriptPromise");
                if (handleFailure) handleFailure();
            };
            script.className = "iti-load-utils";
            script.async = true;
            script.src = path;
            document.body.appendChild(script);
        };
        // load the utils script
        intlTelInputGlobals.loadUtils = function(path) {
            // 2 options:
            // 1) not already started loading (start)
            // 2) already started loading (do nothing - just wait for the onload callback to fire, which will
            // trigger handleUtils on all instances, invoking their resolveUtilsScriptPromise functions)
            if (!window.intlTelInputUtils && !window.intlTelInputGlobals.startedLoadingUtilsScript) {
                // only do this once
                window.intlTelInputGlobals.startedLoadingUtilsScript = true;
                // if we have promises, then return a promise
                if (typeof Promise !== "undefined") {
                    return new Promise(function(resolve, reject) {
                        return injectScript(path, resolve, reject);
                    });
                }
                injectScript(path);
            }
            return null;
        };
        // default options
        intlTelInputGlobals.defaults = defaults;
        // version
        intlTelInputGlobals.version = "17.0.18";
        // convenience wrapper
        return function(input, options) {
            var iti = new Iti(input, options);
            iti._init();
            input.setAttribute("data-intl-tel-input-id", iti.id);
            window.intlTelInputGlobals.instances[iti.id] = iti;
            return iti;
        };
    }();
});
},{}],80:[function(require,module,exports){
/**
 * Exposing intl-tel-input as a component
 */
module.exports = require("./build/js/intlTelInput");

},{"./build/js/intlTelInput":79}],81:[function(require,module,exports){
(function (process){
/**
 * Memize options object.
 *
 * @typedef MemizeOptions
 *
 * @property {number} [maxSize] Maximum size of the cache.
 */

/**
 * Internal cache entry.
 *
 * @typedef MemizeCacheNode
 *
 * @property {?MemizeCacheNode|undefined} [prev] Previous node.
 * @property {?MemizeCacheNode|undefined} [next] Next node.
 * @property {Array<*>}                   args   Function arguments for cache
 *                                               entry.
 * @property {*}                          val    Function result.
 */

/**
 * Properties of the enhanced function for controlling cache.
 *
 * @typedef MemizeMemoizedFunction
 *
 * @property {()=>void} clear Clear the cache.
 */

/**
 * Accepts a function to be memoized, and returns a new memoized function, with
 * optional options.
 *
 * @template {Function} F
 *
 * @param {F}             fn        Function to memoize.
 * @param {MemizeOptions} [options] Options object.
 *
 * @return {F & MemizeMemoizedFunction} Memoized function.
 */
function memize( fn, options ) {
	var size = 0;

	/** @type {?MemizeCacheNode|undefined} */
	var head;

	/** @type {?MemizeCacheNode|undefined} */
	var tail;

	options = options || {};

	function memoized( /* ...args */ ) {
		var node = head,
			len = arguments.length,
			args, i;

		searchCache: while ( node ) {
			// Perform a shallow equality test to confirm that whether the node
			// under test is a candidate for the arguments passed. Two arrays
			// are shallowly equal if their length matches and each entry is
			// strictly equal between the two sets. Avoid abstracting to a
			// function which could incur an arguments leaking deoptimization.

			// Check whether node arguments match arguments length
			if ( node.args.length !== arguments.length ) {
				node = node.next;
				continue;
			}

			// Check whether node arguments match arguments values
			for ( i = 0; i < len; i++ ) {
				if ( node.args[ i ] !== arguments[ i ] ) {
					node = node.next;
					continue searchCache;
				}
			}

			// At this point we can assume we've found a match

			// Surface matched node to head if not already
			if ( node !== head ) {
				// As tail, shift to previous. Must only shift if not also
				// head, since if both head and tail, there is no previous.
				if ( node === tail ) {
					tail = node.prev;
				}

				// Adjust siblings to point to each other. If node was tail,
				// this also handles new tail's empty `next` assignment.
				/** @type {MemizeCacheNode} */ ( node.prev ).next = node.next;
				if ( node.next ) {
					node.next.prev = node.prev;
				}

				node.next = head;
				node.prev = null;
				/** @type {MemizeCacheNode} */ ( head ).prev = node;
				head = node;
			}

			// Return immediately
			return node.val;
		}

		// No cached value found. Continue to insertion phase:

		// Create a copy of arguments (avoid leaking deoptimization)
		args = new Array( len );
		for ( i = 0; i < len; i++ ) {
			args[ i ] = arguments[ i ];
		}

		node = {
			args: args,

			// Generate the result from original function
			val: fn.apply( null, args ),
		};

		// Don't need to check whether node is already head, since it would
		// have been returned above already if it was

		// Shift existing head down list
		if ( head ) {
			head.prev = node;
			node.next = head;
		} else {
			// If no head, follows that there's no tail (at initial or reset)
			tail = node;
		}

		// Trim tail if we're reached max size and are pending cache insertion
		if ( size === /** @type {MemizeOptions} */ ( options ).maxSize ) {
			tail = /** @type {MemizeCacheNode} */ ( tail ).prev;
			/** @type {MemizeCacheNode} */ ( tail ).next = null;
		} else {
			size++;
		}

		head = node;

		return node.val;
	}

	memoized.clear = function() {
		head = null;
		tail = null;
		size = 0;
	};

	if ( process.env.NODE_ENV === 'test' ) {
		// Cache is not exposed in the public API, but used in tests to ensure
		// expected list progression
		memoized.getCache = function() {
			return [ head, tail, size ];
		};
	}

	// Ignore reason: There's not a clear solution to create an intersection of
	// the function with additional properties, where the goal is to retain the
	// function signature of the incoming argument and add control properties
	// on the return value.

	// @ts-ignore
	return memoized;
}

module.exports = memize;

}).call(this,require('_process'))
},{"_process":82}],82:[function(require,module,exports){
// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;
process.prependListener = noop;
process.prependOnceListener = noop;

process.listeners = function (name) { return [] }

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };

},{}],83:[function(require,module,exports){
/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

var runtime = (function (exports) {
  "use strict";

  var Op = Object.prototype;
  var hasOwn = Op.hasOwnProperty;
  var undefined; // More compressible than void 0.
  var $Symbol = typeof Symbol === "function" ? Symbol : {};
  var iteratorSymbol = $Symbol.iterator || "@@iterator";
  var asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator";
  var toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

  function wrap(innerFn, outerFn, self, tryLocsList) {
    // If outerFn provided and outerFn.prototype is a Generator, then outerFn.prototype instanceof Generator.
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator;
    var generator = Object.create(protoGenerator.prototype);
    var context = new Context(tryLocsList || []);

    // The ._invoke method unifies the implementations of the .next,
    // .throw, and .return methods.
    generator._invoke = makeInvokeMethod(innerFn, self, context);

    return generator;
  }
  exports.wrap = wrap;

  // Try/catch helper to minimize deoptimizations. Returns a completion
  // record like context.tryEntries[i].completion. This interface could
  // have been (and was previously) designed to take a closure to be
  // invoked without arguments, but in all the cases we care about we
  // already have an existing method we want to call, so there's no need
  // to create a new function object. We can even get away with assuming
  // the method takes exactly one argument, since that happens to be true
  // in every case, so we don't have to touch the arguments object. The
  // only additional allocation required is the completion record, which
  // has a stable shape and so hopefully should be cheap to allocate.
  function tryCatch(fn, obj, arg) {
    try {
      return { type: "normal", arg: fn.call(obj, arg) };
    } catch (err) {
      return { type: "throw", arg: err };
    }
  }

  var GenStateSuspendedStart = "suspendedStart";
  var GenStateSuspendedYield = "suspendedYield";
  var GenStateExecuting = "executing";
  var GenStateCompleted = "completed";

  // Returning this object from the innerFn has the same effect as
  // breaking out of the dispatch switch statement.
  var ContinueSentinel = {};

  // Dummy constructor functions that we use as the .constructor and
  // .constructor.prototype properties for functions that return Generator
  // objects. For full spec compliance, you may wish to configure your
  // minifier not to mangle the names of these two functions.
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}

  // This is a polyfill for %IteratorPrototype% for environments that
  // don't natively support it.
  var IteratorPrototype = {};
  IteratorPrototype[iteratorSymbol] = function () {
    return this;
  };

  var getProto = Object.getPrototypeOf;
  var NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  if (NativeIteratorPrototype &&
      NativeIteratorPrototype !== Op &&
      hasOwn.call(NativeIteratorPrototype, iteratorSymbol)) {
    // This environment has a native %IteratorPrototype%; use it instead
    // of the polyfill.
    IteratorPrototype = NativeIteratorPrototype;
  }

  var Gp = GeneratorFunctionPrototype.prototype =
    Generator.prototype = Object.create(IteratorPrototype);
  GeneratorFunction.prototype = Gp.constructor = GeneratorFunctionPrototype;
  GeneratorFunctionPrototype.constructor = GeneratorFunction;
  GeneratorFunctionPrototype[toStringTagSymbol] =
    GeneratorFunction.displayName = "GeneratorFunction";

  // Helper for defining the .next, .throw, and .return methods of the
  // Iterator interface in terms of a single ._invoke method.
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function(method) {
      prototype[method] = function(arg) {
        return this._invoke(method, arg);
      };
    });
  }

  exports.isGeneratorFunction = function(genFun) {
    var ctor = typeof genFun === "function" && genFun.constructor;
    return ctor
      ? ctor === GeneratorFunction ||
        // For the native GeneratorFunction constructor, the best we can
        // do is to check its .name property.
        (ctor.displayName || ctor.name) === "GeneratorFunction"
      : false;
  };

  exports.mark = function(genFun) {
    if (Object.setPrototypeOf) {
      Object.setPrototypeOf(genFun, GeneratorFunctionPrototype);
    } else {
      genFun.__proto__ = GeneratorFunctionPrototype;
      if (!(toStringTagSymbol in genFun)) {
        genFun[toStringTagSymbol] = "GeneratorFunction";
      }
    }
    genFun.prototype = Object.create(Gp);
    return genFun;
  };

  // Within the body of any async function, `await x` is transformed to
  // `yield regeneratorRuntime.awrap(x)`, so that the runtime can test
  // `hasOwn.call(value, "__await")` to determine if the yielded value is
  // meant to be awaited.
  exports.awrap = function(arg) {
    return { __await: arg };
  };

  function AsyncIterator(generator, PromiseImpl) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if (record.type === "throw") {
        reject(record.arg);
      } else {
        var result = record.arg;
        var value = result.value;
        if (value &&
            typeof value === "object" &&
            hasOwn.call(value, "__await")) {
          return PromiseImpl.resolve(value.__await).then(function(value) {
            invoke("next", value, resolve, reject);
          }, function(err) {
            invoke("throw", err, resolve, reject);
          });
        }

        return PromiseImpl.resolve(value).then(function(unwrapped) {
          // When a yielded Promise is resolved, its final value becomes
          // the .value of the Promise<{value,done}> result for the
          // current iteration.
          result.value = unwrapped;
          resolve(result);
        }, function(error) {
          // If a rejected Promise was yielded, throw the rejection back
          // into the async generator function so it can be handled there.
          return invoke("throw", error, resolve, reject);
        });
      }
    }

    var previousPromise;

    function enqueue(method, arg) {
      function callInvokeWithMethodAndArg() {
        return new PromiseImpl(function(resolve, reject) {
          invoke(method, arg, resolve, reject);
        });
      }

      return previousPromise =
        // If enqueue has been called before, then we want to wait until
        // all previous Promises have been resolved before calling invoke,
        // so that results are always delivered in the correct order. If
        // enqueue has not been called before, then it is important to
        // call invoke immediately, without waiting on a callback to fire,
        // so that the async generator function has the opportunity to do
        // any necessary setup in a predictable way. This predictability
        // is why the Promise constructor synchronously invokes its
        // executor callback, and why async functions synchronously
        // execute code before the first await. Since we implement simple
        // async functions in terms of async generators, it is especially
        // important to get this right, even though it requires care.
        previousPromise ? previousPromise.then(
          callInvokeWithMethodAndArg,
          // Avoid propagating failures to Promises returned by later
          // invocations of the iterator.
          callInvokeWithMethodAndArg
        ) : callInvokeWithMethodAndArg();
    }

    // Define the unified helper method that is used to implement .next,
    // .throw, and .return (see defineIteratorMethods).
    this._invoke = enqueue;
  }

  defineIteratorMethods(AsyncIterator.prototype);
  AsyncIterator.prototype[asyncIteratorSymbol] = function () {
    return this;
  };
  exports.AsyncIterator = AsyncIterator;

  // Note that simple async functions are implemented on top of
  // AsyncIterator objects; they just return a Promise for the value of
  // the final result produced by the iterator.
  exports.async = function(innerFn, outerFn, self, tryLocsList, PromiseImpl) {
    if (PromiseImpl === void 0) PromiseImpl = Promise;

    var iter = new AsyncIterator(
      wrap(innerFn, outerFn, self, tryLocsList),
      PromiseImpl
    );

    return exports.isGeneratorFunction(outerFn)
      ? iter // If outerFn is a generator, return the full iterator.
      : iter.next().then(function(result) {
          return result.done ? result.value : iter.next();
        });
  };

  function makeInvokeMethod(innerFn, self, context) {
    var state = GenStateSuspendedStart;

    return function invoke(method, arg) {
      if (state === GenStateExecuting) {
        throw new Error("Generator is already running");
      }

      if (state === GenStateCompleted) {
        if (method === "throw") {
          throw arg;
        }

        // Be forgiving, per 25.3.3.3.3 of the spec:
        // https://people.mozilla.org/~jorendorff/es6-draft.html#sec-generatorresume
        return doneResult();
      }

      context.method = method;
      context.arg = arg;

      while (true) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }

        if (context.method === "next") {
          // Setting context._sent for legacy support of Babel's
          // function.sent implementation.
          context.sent = context._sent = context.arg;

        } else if (context.method === "throw") {
          if (state === GenStateSuspendedStart) {
            state = GenStateCompleted;
            throw context.arg;
          }

          context.dispatchException(context.arg);

        } else if (context.method === "return") {
          context.abrupt("return", context.arg);
        }

        state = GenStateExecuting;

        var record = tryCatch(innerFn, self, context);
        if (record.type === "normal") {
          // If an exception is thrown from innerFn, we leave state ===
          // GenStateExecuting and loop back for another invocation.
          state = context.done
            ? GenStateCompleted
            : GenStateSuspendedYield;

          if (record.arg === ContinueSentinel) {
            continue;
          }

          return {
            value: record.arg,
            done: context.done
          };

        } else if (record.type === "throw") {
          state = GenStateCompleted;
          // Dispatch the exception by looping back around to the
          // context.dispatchException(context.arg) call above.
          context.method = "throw";
          context.arg = record.arg;
        }
      }
    };
  }

  // Call delegate.iterator[context.method](context.arg) and handle the
  // result, either by returning a { value, done } result from the
  // delegate iterator, or by modifying context.method and context.arg,
  // setting context.delegate to null, and returning the ContinueSentinel.
  function maybeInvokeDelegate(delegate, context) {
    var method = delegate.iterator[context.method];
    if (method === undefined) {
      // A .throw or .return when the delegate iterator has no .throw
      // method always terminates the yield* loop.
      context.delegate = null;

      if (context.method === "throw") {
        // Note: ["return"] must be used for ES3 parsing compatibility.
        if (delegate.iterator["return"]) {
          // If the delegate iterator has a return method, give it a
          // chance to clean up.
          context.method = "return";
          context.arg = undefined;
          maybeInvokeDelegate(delegate, context);

          if (context.method === "throw") {
            // If maybeInvokeDelegate(context) changed context.method from
            // "return" to "throw", let that override the TypeError below.
            return ContinueSentinel;
          }
        }

        context.method = "throw";
        context.arg = new TypeError(
          "The iterator does not provide a 'throw' method");
      }

      return ContinueSentinel;
    }

    var record = tryCatch(method, delegate.iterator, context.arg);

    if (record.type === "throw") {
      context.method = "throw";
      context.arg = record.arg;
      context.delegate = null;
      return ContinueSentinel;
    }

    var info = record.arg;

    if (! info) {
      context.method = "throw";
      context.arg = new TypeError("iterator result is not an object");
      context.delegate = null;
      return ContinueSentinel;
    }

    if (info.done) {
      // Assign the result of the finished delegate to the temporary
      // variable specified by delegate.resultName (see delegateYield).
      context[delegate.resultName] = info.value;

      // Resume execution at the desired location (see delegateYield).
      context.next = delegate.nextLoc;

      // If context.method was "throw" but the delegate handled the
      // exception, let the outer generator proceed normally. If
      // context.method was "next", forget context.arg since it has been
      // "consumed" by the delegate iterator. If context.method was
      // "return", allow the original .return call to continue in the
      // outer generator.
      if (context.method !== "return") {
        context.method = "next";
        context.arg = undefined;
      }

    } else {
      // Re-yield the result returned by the delegate method.
      return info;
    }

    // The delegate iterator is finished, so forget it and continue with
    // the outer generator.
    context.delegate = null;
    return ContinueSentinel;
  }

  // Define Generator.prototype.{next,throw,return} in terms of the
  // unified ._invoke helper method.
  defineIteratorMethods(Gp);

  Gp[toStringTagSymbol] = "Generator";

  // A Generator should always return itself as the iterator object when the
  // @@iterator function is called on it. Some browsers' implementations of the
  // iterator prototype chain incorrectly implement this, causing the Generator
  // object to not be returned from this call. This ensures that doesn't happen.
  // See https://github.com/facebook/regenerator/issues/274 for more details.
  Gp[iteratorSymbol] = function() {
    return this;
  };

  Gp.toString = function() {
    return "[object Generator]";
  };

  function pushTryEntry(locs) {
    var entry = { tryLoc: locs[0] };

    if (1 in locs) {
      entry.catchLoc = locs[1];
    }

    if (2 in locs) {
      entry.finallyLoc = locs[2];
      entry.afterLoc = locs[3];
    }

    this.tryEntries.push(entry);
  }

  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal";
    delete record.arg;
    entry.completion = record;
  }

  function Context(tryLocsList) {
    // The root entry object (effectively a try statement without a catch
    // or a finally block) gives us a place to store values thrown from
    // locations where there is no enclosing try statement.
    this.tryEntries = [{ tryLoc: "root" }];
    tryLocsList.forEach(pushTryEntry, this);
    this.reset(true);
  }

  exports.keys = function(object) {
    var keys = [];
    for (var key in object) {
      keys.push(key);
    }
    keys.reverse();

    // Rather than returning an object with a next method, we keep
    // things simple and return the next function itself.
    return function next() {
      while (keys.length) {
        var key = keys.pop();
        if (key in object) {
          next.value = key;
          next.done = false;
          return next;
        }
      }

      // To avoid creating an additional object, we just hang the .value
      // and .done properties off the next function object itself. This
      // also ensures that the minifier will not anonymize the function.
      next.done = true;
      return next;
    };
  };

  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) {
        return iteratorMethod.call(iterable);
      }

      if (typeof iterable.next === "function") {
        return iterable;
      }

      if (!isNaN(iterable.length)) {
        var i = -1, next = function next() {
          while (++i < iterable.length) {
            if (hasOwn.call(iterable, i)) {
              next.value = iterable[i];
              next.done = false;
              return next;
            }
          }

          next.value = undefined;
          next.done = true;

          return next;
        };

        return next.next = next;
      }
    }

    // Return an iterator with no values.
    return { next: doneResult };
  }
  exports.values = values;

  function doneResult() {
    return { value: undefined, done: true };
  }

  Context.prototype = {
    constructor: Context,

    reset: function(skipTempReset) {
      this.prev = 0;
      this.next = 0;
      // Resetting context._sent for legacy support of Babel's
      // function.sent implementation.
      this.sent = this._sent = undefined;
      this.done = false;
      this.delegate = null;

      this.method = "next";
      this.arg = undefined;

      this.tryEntries.forEach(resetTryEntry);

      if (!skipTempReset) {
        for (var name in this) {
          // Not sure about the optimal order of these conditions:
          if (name.charAt(0) === "t" &&
              hasOwn.call(this, name) &&
              !isNaN(+name.slice(1))) {
            this[name] = undefined;
          }
        }
      }
    },

    stop: function() {
      this.done = true;

      var rootEntry = this.tryEntries[0];
      var rootRecord = rootEntry.completion;
      if (rootRecord.type === "throw") {
        throw rootRecord.arg;
      }

      return this.rval;
    },

    dispatchException: function(exception) {
      if (this.done) {
        throw exception;
      }

      var context = this;
      function handle(loc, caught) {
        record.type = "throw";
        record.arg = exception;
        context.next = loc;

        if (caught) {
          // If the dispatched exception was caught by a catch block,
          // then let that catch block handle the exception normally.
          context.method = "next";
          context.arg = undefined;
        }

        return !! caught;
      }

      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        var record = entry.completion;

        if (entry.tryLoc === "root") {
          // Exception thrown outside of any try block that could handle
          // it, so set the completion value of the entire function to
          // throw the exception.
          return handle("end");
        }

        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc");
          var hasFinally = hasOwn.call(entry, "finallyLoc");

          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            } else if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            }

          } else if (hasFinally) {
            if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else {
            throw new Error("try statement without catch or finally");
          }
        }
      }
    },

    abrupt: function(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev &&
            hasOwn.call(entry, "finallyLoc") &&
            this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }

      if (finallyEntry &&
          (type === "break" ||
           type === "continue") &&
          finallyEntry.tryLoc <= arg &&
          arg <= finallyEntry.finallyLoc) {
        // Ignore the finally entry if control is not jumping to a
        // location outside the try/catch block.
        finallyEntry = null;
      }

      var record = finallyEntry ? finallyEntry.completion : {};
      record.type = type;
      record.arg = arg;

      if (finallyEntry) {
        this.method = "next";
        this.next = finallyEntry.finallyLoc;
        return ContinueSentinel;
      }

      return this.complete(record);
    },

    complete: function(record, afterLoc) {
      if (record.type === "throw") {
        throw record.arg;
      }

      if (record.type === "break" ||
          record.type === "continue") {
        this.next = record.arg;
      } else if (record.type === "return") {
        this.rval = this.arg = record.arg;
        this.method = "return";
        this.next = "end";
      } else if (record.type === "normal" && afterLoc) {
        this.next = afterLoc;
      }

      return ContinueSentinel;
    },

    finish: function(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) {
          this.complete(entry.completion, entry.afterLoc);
          resetTryEntry(entry);
          return ContinueSentinel;
        }
      }
    },

    "catch": function(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if (record.type === "throw") {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }

      // The context.catch method must only be called with a location
      // argument that corresponds to a known catch block.
      throw new Error("illegal catch attempt");
    },

    delegateYield: function(iterable, resultName, nextLoc) {
      this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      };

      if (this.method === "next") {
        // Deliberately forget the last sent value so that we don't
        // accidentally pass it on to the delegate.
        this.arg = undefined;
      }

      return ContinueSentinel;
    }
  };

  // Regardless of whether this script is executing as a CommonJS module
  // or not, return the runtime object so that we can declare the variable
  // regeneratorRuntime in the outer scope, which allows this module to be
  // injected easily by `bin/regenerator --include-runtime script.js`.
  return exports;

}(
  // If this script is executing as a CommonJS module, use module.exports
  // as the regeneratorRuntime namespace. Otherwise create a new empty
  // object. Either way, the resulting object will be used to initialize
  // the regeneratorRuntime variable at the top of this file.
  typeof module === "object" ? module.exports : {}
));

try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  // This module should not be running in strict mode, so the above
  // assignment should always work unless something is misconfigured. Just
  // in case runtime.js accidentally runs in strict mode, we can escape
  // strict mode using a global Function call. This could conceivably fail
  // if a Content Security Policy forbids using Function, but in that case
  // the proper solution is to fix the accidental strict mode problem. If
  // you've misconfigured your bundler to force strict mode and applied a
  // CSP to forbid Function, and you're not willing to fix either of those
  // problems, please detail your unique predicament in a GitHub issue.
  Function("r", "regeneratorRuntime = r")(runtime);
}

},{}],84:[function(require,module,exports){
'use strict';

function _interopDefault (ex) { return (ex && (typeof ex === 'object') && 'default' in ex) ? ex['default'] : ex; }

var pluralForms = _interopDefault(require('@tannin/plural-forms'));

/**
 * Tannin constructor options.
 *
 * @typedef {Object} TanninOptions
 *
 * @property {string}   [contextDelimiter] Joiner in string lookup with context.
 * @property {Function} [onMissingKey]     Callback to invoke when key missing.
 */

/**
 * Domain metadata.
 *
 * @typedef {Object} TanninDomainMetadata
 *
 * @property {string}            [domain]       Domain name.
 * @property {string}            [lang]         Language code.
 * @property {(string|Function)} [plural_forms] Plural forms expression or
 *                                              function evaluator.
 */

/**
 * Domain translation pair respectively representing the singular and plural
 * translation.
 *
 * @typedef {[string,string]} TanninTranslation
 */

/**
 * Locale data domain. The key is used as reference for lookup, the value an
 * array of two string entries respectively representing the singular and plural
 * translation.
 *
 * @typedef {{[key:string]:TanninDomainMetadata|TanninTranslation,'':TanninDomainMetadata|TanninTranslation}} TanninLocaleDomain
 */

/**
 * Jed-formatted locale data.
 *
 * @see http://messageformat.github.io/Jed/
 *
 * @typedef {{[domain:string]:TanninLocaleDomain}} TanninLocaleData
 */

/**
 * Default Tannin constructor options.
 *
 * @type {TanninOptions}
 */
var DEFAULT_OPTIONS = {
	contextDelimiter: '\u0004',
	onMissingKey: null,
};

/**
 * Given a specific locale data's config `plural_forms` value, returns the
 * expression.
 *
 * @example
 *
 * ```
 * getPluralExpression( 'nplurals=2; plural=(n != 1);' ) === '(n != 1)'
 * ```
 *
 * @param {string} pf Locale data plural forms.
 *
 * @return {string} Plural forms expression.
 */
function getPluralExpression( pf ) {
	var parts, i, part;

	parts = pf.split( ';' );

	for ( i = 0; i < parts.length; i++ ) {
		part = parts[ i ].trim();
		if ( part.indexOf( 'plural=' ) === 0 ) {
			return part.substr( 7 );
		}
	}
}

/**
 * Tannin constructor.
 *
 * @class
 *
 * @param {TanninLocaleData} data      Jed-formatted locale data.
 * @param {TanninOptions}    [options] Tannin options.
 */
function Tannin( data, options ) {
	var key;

	/**
	 * Jed-formatted locale data.
	 *
	 * @name Tannin#data
	 * @type {TanninLocaleData}
	 */
	this.data = data;

	/**
	 * Plural forms function cache, keyed by plural forms string.
	 *
	 * @name Tannin#pluralForms
	 * @type {Object<string,Function>}
	 */
	this.pluralForms = {};

	/**
	 * Effective options for instance, including defaults.
	 *
	 * @name Tannin#options
	 * @type {TanninOptions}
	 */
	this.options = {};

	for ( key in DEFAULT_OPTIONS ) {
		this.options[ key ] = options !== undefined && key in options
			? options[ key ]
			: DEFAULT_OPTIONS[ key ];
	}
}

/**
 * Returns the plural form index for the given domain and value.
 *
 * @param {string} domain Domain on which to calculate plural form.
 * @param {number} n      Value for which plural form is to be calculated.
 *
 * @return {number} Plural form index.
 */
Tannin.prototype.getPluralForm = function( domain, n ) {
	var getPluralForm = this.pluralForms[ domain ],
		config, plural, pf;

	if ( ! getPluralForm ) {
		config = this.data[ domain ][ '' ];

		pf = (
			config[ 'Plural-Forms' ] ||
			config[ 'plural-forms' ] ||
			// Ignore reason: As known, there's no way to document the empty
			// string property on a key to guarantee this as metadata.
			// @ts-ignore
			config.plural_forms
		);

		if ( typeof pf !== 'function' ) {
			plural = getPluralExpression(
				config[ 'Plural-Forms' ] ||
				config[ 'plural-forms' ] ||
				// Ignore reason: As known, there's no way to document the empty
				// string property on a key to guarantee this as metadata.
				// @ts-ignore
				config.plural_forms
			);

			pf = pluralForms( plural );
		}

		getPluralForm = this.pluralForms[ domain ] = pf;
	}

	return getPluralForm( n );
};

/**
 * Translate a string.
 *
 * @param {string}      domain   Translation domain.
 * @param {string|void} context  Context distinguishing terms of the same name.
 * @param {string}      singular Primary key for translation lookup.
 * @param {string=}     plural   Fallback value used for non-zero plural
 *                               form index.
 * @param {number=}     n        Value to use in calculating plural form.
 *
 * @return {string} Translated string.
 */
Tannin.prototype.dcnpgettext = function( domain, context, singular, plural, n ) {
	var index, key, entry;

	if ( n === undefined ) {
		// Default to singular.
		index = 0;
	} else {
		// Find index by evaluating plural form for value.
		index = this.getPluralForm( domain, n );
	}

	key = singular;

	// If provided, context is prepended to key with delimiter.
	if ( context ) {
		key = context + this.options.contextDelimiter + singular;
	}

	entry = this.data[ domain ][ key ];

	// Verify not only that entry exists, but that the intended index is within
	// range and non-empty.
	if ( entry && entry[ index ] ) {
		return entry[ index ];
	}

	if ( this.options.onMissingKey ) {
		this.options.onMissingKey( singular, domain );
	}

	// If entry not found, fall back to singular vs. plural with zero index
	// representing the singular value.
	return index === 0 ? singular : plural;
};

module.exports = Tannin;

},{"@tannin/plural-forms":72}],85:[function(require,module,exports){
(function (process){
/**!
* tippy.js v6.3.7
* (c) 2017-2021 atomiks
* MIT License
*/
'use strict';

Object.defineProperty(exports, '__esModule', { value: true });

var core = require('@popperjs/core');

var ROUND_ARROW = '<svg width="16" height="6" xmlns="http://www.w3.org/2000/svg"><path d="M0 6s1.796-.013 4.67-3.615C5.851.9 6.93.006 8 0c1.07-.006 2.148.887 3.343 2.385C14.233 6.005 16 6 16 6H0z"></svg>';
var BOX_CLASS = "tippy-box";
var CONTENT_CLASS = "tippy-content";
var BACKDROP_CLASS = "tippy-backdrop";
var ARROW_CLASS = "tippy-arrow";
var SVG_ARROW_CLASS = "tippy-svg-arrow";
var TOUCH_OPTIONS = {
  passive: true,
  capture: true
};
var TIPPY_DEFAULT_APPEND_TO = function TIPPY_DEFAULT_APPEND_TO() {
  return document.body;
};

function hasOwnProperty(obj, key) {
  return {}.hasOwnProperty.call(obj, key);
}
function getValueAtIndexOrReturn(value, index, defaultValue) {
  if (Array.isArray(value)) {
    var v = value[index];
    return v == null ? Array.isArray(defaultValue) ? defaultValue[index] : defaultValue : v;
  }

  return value;
}
function isType(value, type) {
  var str = {}.toString.call(value);
  return str.indexOf('[object') === 0 && str.indexOf(type + "]") > -1;
}
function invokeWithArgsOrReturn(value, args) {
  return typeof value === 'function' ? value.apply(void 0, args) : value;
}
function debounce(fn, ms) {
  // Avoid wrapping in `setTimeout` if ms is 0 anyway
  if (ms === 0) {
    return fn;
  }

  var timeout;
  return function (arg) {
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      fn(arg);
    }, ms);
  };
}
function removeProperties(obj, keys) {
  var clone = Object.assign({}, obj);
  keys.forEach(function (key) {
    delete clone[key];
  });
  return clone;
}
function splitBySpaces(value) {
  return value.split(/\s+/).filter(Boolean);
}
function normalizeToArray(value) {
  return [].concat(value);
}
function pushIfUnique(arr, value) {
  if (arr.indexOf(value) === -1) {
    arr.push(value);
  }
}
function unique(arr) {
  return arr.filter(function (item, index) {
    return arr.indexOf(item) === index;
  });
}
function getBasePlacement(placement) {
  return placement.split('-')[0];
}
function arrayFrom(value) {
  return [].slice.call(value);
}
function removeUndefinedProps(obj) {
  return Object.keys(obj).reduce(function (acc, key) {
    if (obj[key] !== undefined) {
      acc[key] = obj[key];
    }

    return acc;
  }, {});
}

function div() {
  return document.createElement('div');
}
function isElement(value) {
  return ['Element', 'Fragment'].some(function (type) {
    return isType(value, type);
  });
}
function isNodeList(value) {
  return isType(value, 'NodeList');
}
function isMouseEvent(value) {
  return isType(value, 'MouseEvent');
}
function isReferenceElement(value) {
  return !!(value && value._tippy && value._tippy.reference === value);
}
function getArrayOfElements(value) {
  if (isElement(value)) {
    return [value];
  }

  if (isNodeList(value)) {
    return arrayFrom(value);
  }

  if (Array.isArray(value)) {
    return value;
  }

  return arrayFrom(document.querySelectorAll(value));
}
function setTransitionDuration(els, value) {
  els.forEach(function (el) {
    if (el) {
      el.style.transitionDuration = value + "ms";
    }
  });
}
function setVisibilityState(els, state) {
  els.forEach(function (el) {
    if (el) {
      el.setAttribute('data-state', state);
    }
  });
}
function getOwnerDocument(elementOrElements) {
  var _element$ownerDocumen;

  var _normalizeToArray = normalizeToArray(elementOrElements),
      element = _normalizeToArray[0]; // Elements created via a <template> have an ownerDocument with no reference to the body


  return element != null && (_element$ownerDocumen = element.ownerDocument) != null && _element$ownerDocumen.body ? element.ownerDocument : document;
}
function isCursorOutsideInteractiveBorder(popperTreeData, event) {
  var clientX = event.clientX,
      clientY = event.clientY;
  return popperTreeData.every(function (_ref) {
    var popperRect = _ref.popperRect,
        popperState = _ref.popperState,
        props = _ref.props;
    var interactiveBorder = props.interactiveBorder;
    var basePlacement = getBasePlacement(popperState.placement);
    var offsetData = popperState.modifiersData.offset;

    if (!offsetData) {
      return true;
    }

    var topDistance = basePlacement === 'bottom' ? offsetData.top.y : 0;
    var bottomDistance = basePlacement === 'top' ? offsetData.bottom.y : 0;
    var leftDistance = basePlacement === 'right' ? offsetData.left.x : 0;
    var rightDistance = basePlacement === 'left' ? offsetData.right.x : 0;
    var exceedsTop = popperRect.top - clientY + topDistance > interactiveBorder;
    var exceedsBottom = clientY - popperRect.bottom - bottomDistance > interactiveBorder;
    var exceedsLeft = popperRect.left - clientX + leftDistance > interactiveBorder;
    var exceedsRight = clientX - popperRect.right - rightDistance > interactiveBorder;
    return exceedsTop || exceedsBottom || exceedsLeft || exceedsRight;
  });
}
function updateTransitionEndListener(box, action, listener) {
  var method = action + "EventListener"; // some browsers apparently support `transition` (unprefixed) but only fire
  // `webkitTransitionEnd`...

  ['transitionend', 'webkitTransitionEnd'].forEach(function (event) {
    box[method](event, listener);
  });
}
/**
 * Compared to xxx.contains, this function works for dom structures with shadow
 * dom
 */

function actualContains(parent, child) {
  var target = child;

  while (target) {
    var _target$getRootNode;

    if (parent.contains(target)) {
      return true;
    }

    target = target.getRootNode == null ? void 0 : (_target$getRootNode = target.getRootNode()) == null ? void 0 : _target$getRootNode.host;
  }

  return false;
}

var currentInput = {
  isTouch: false
};
var lastMouseMoveTime = 0;
/**
 * When a `touchstart` event is fired, it's assumed the user is using touch
 * input. We'll bind a `mousemove` event listener to listen for mouse input in
 * the future. This way, the `isTouch` property is fully dynamic and will handle
 * hybrid devices that use a mix of touch + mouse input.
 */

function onDocumentTouchStart() {
  if (currentInput.isTouch) {
    return;
  }

  currentInput.isTouch = true;

  if (window.performance) {
    document.addEventListener('mousemove', onDocumentMouseMove);
  }
}
/**
 * When two `mousemove` event are fired consecutively within 20ms, it's assumed
 * the user is using mouse input again. `mousemove` can fire on touch devices as
 * well, but very rarely that quickly.
 */

function onDocumentMouseMove() {
  var now = performance.now();

  if (now - lastMouseMoveTime < 20) {
    currentInput.isTouch = false;
    document.removeEventListener('mousemove', onDocumentMouseMove);
  }

  lastMouseMoveTime = now;
}
/**
 * When an element is in focus and has a tippy, leaving the tab/window and
 * returning causes it to show again. For mouse users this is unexpected, but
 * for keyboard use it makes sense.
 * TODO: find a better technique to solve this problem
 */

function onWindowBlur() {
  var activeElement = document.activeElement;

  if (isReferenceElement(activeElement)) {
    var instance = activeElement._tippy;

    if (activeElement.blur && !instance.state.isVisible) {
      activeElement.blur();
    }
  }
}
function bindGlobalEventListeners() {
  document.addEventListener('touchstart', onDocumentTouchStart, TOUCH_OPTIONS);
  window.addEventListener('blur', onWindowBlur);
}

var isBrowser = typeof window !== 'undefined' && typeof document !== 'undefined';
var isIE11 = isBrowser ? // @ts-ignore
!!window.msCrypto : false;

function createMemoryLeakWarning(method) {
  var txt = method === 'destroy' ? 'n already-' : ' ';
  return [method + "() was called on a" + txt + "destroyed instance. This is a no-op but", 'indicates a potential memory leak.'].join(' ');
}
function clean(value) {
  var spacesAndTabs = /[ \t]{2,}/g;
  var lineStartWithSpaces = /^[ \t]*/gm;
  return value.replace(spacesAndTabs, ' ').replace(lineStartWithSpaces, '').trim();
}

function getDevMessage(message) {
  return clean("\n  %ctippy.js\n\n  %c" + clean(message) + "\n\n  %c\uD83D\uDC77\u200D This is a development-only message. It will be removed in production.\n  ");
}

function getFormattedMessage(message) {
  return [getDevMessage(message), // title
  'color: #00C584; font-size: 1.3em; font-weight: bold;', // message
  'line-height: 1.5', // footer
  'color: #a6a095;'];
} // Assume warnings and errors never have the same message

var visitedMessages;

if (process.env.NODE_ENV !== "production") {
  resetVisitedMessages();
}

function resetVisitedMessages() {
  visitedMessages = new Set();
}
function warnWhen(condition, message) {
  if (condition && !visitedMessages.has(message)) {
    var _console;

    visitedMessages.add(message);

    (_console = console).warn.apply(_console, getFormattedMessage(message));
  }
}
function errorWhen(condition, message) {
  if (condition && !visitedMessages.has(message)) {
    var _console2;

    visitedMessages.add(message);

    (_console2 = console).error.apply(_console2, getFormattedMessage(message));
  }
}
function validateTargets(targets) {
  var didPassFalsyValue = !targets;
  var didPassPlainObject = Object.prototype.toString.call(targets) === '[object Object]' && !targets.addEventListener;
  errorWhen(didPassFalsyValue, ['tippy() was passed', '`' + String(targets) + '`', 'as its targets (first) argument. Valid types are: String, Element,', 'Element[], or NodeList.'].join(' '));
  errorWhen(didPassPlainObject, ['tippy() was passed a plain object which is not supported as an argument', 'for virtual positioning. Use props.getReferenceClientRect instead.'].join(' '));
}

var pluginProps = {
  animateFill: false,
  followCursor: false,
  inlinePositioning: false,
  sticky: false
};
var renderProps = {
  allowHTML: false,
  animation: 'fade',
  arrow: true,
  content: '',
  inertia: false,
  maxWidth: 350,
  role: 'tooltip',
  theme: '',
  zIndex: 9999
};
var defaultProps = Object.assign({
  appendTo: TIPPY_DEFAULT_APPEND_TO,
  aria: {
    content: 'auto',
    expanded: 'auto'
  },
  delay: 0,
  duration: [300, 250],
  getReferenceClientRect: null,
  hideOnClick: true,
  ignoreAttributes: false,
  interactive: false,
  interactiveBorder: 2,
  interactiveDebounce: 0,
  moveTransition: '',
  offset: [0, 10],
  onAfterUpdate: function onAfterUpdate() {},
  onBeforeUpdate: function onBeforeUpdate() {},
  onCreate: function onCreate() {},
  onDestroy: function onDestroy() {},
  onHidden: function onHidden() {},
  onHide: function onHide() {},
  onMount: function onMount() {},
  onShow: function onShow() {},
  onShown: function onShown() {},
  onTrigger: function onTrigger() {},
  onUntrigger: function onUntrigger() {},
  onClickOutside: function onClickOutside() {},
  placement: 'top',
  plugins: [],
  popperOptions: {},
  render: null,
  showOnCreate: false,
  touch: true,
  trigger: 'mouseenter focus',
  triggerTarget: null
}, pluginProps, renderProps);
var defaultKeys = Object.keys(defaultProps);
var setDefaultProps = function setDefaultProps(partialProps) {
  /* istanbul ignore else */
  if (process.env.NODE_ENV !== "production") {
    validateProps(partialProps, []);
  }

  var keys = Object.keys(partialProps);
  keys.forEach(function (key) {
    defaultProps[key] = partialProps[key];
  });
};
function getExtendedPassedProps(passedProps) {
  var plugins = passedProps.plugins || [];
  var pluginProps = plugins.reduce(function (acc, plugin) {
    var name = plugin.name,
        defaultValue = plugin.defaultValue;

    if (name) {
      var _name;

      acc[name] = passedProps[name] !== undefined ? passedProps[name] : (_name = defaultProps[name]) != null ? _name : defaultValue;
    }

    return acc;
  }, {});
  return Object.assign({}, passedProps, pluginProps);
}
function getDataAttributeProps(reference, plugins) {
  var propKeys = plugins ? Object.keys(getExtendedPassedProps(Object.assign({}, defaultProps, {
    plugins: plugins
  }))) : defaultKeys;
  var props = propKeys.reduce(function (acc, key) {
    var valueAsString = (reference.getAttribute("data-tippy-" + key) || '').trim();

    if (!valueAsString) {
      return acc;
    }

    if (key === 'content') {
      acc[key] = valueAsString;
    } else {
      try {
        acc[key] = JSON.parse(valueAsString);
      } catch (e) {
        acc[key] = valueAsString;
      }
    }

    return acc;
  }, {});
  return props;
}
function evaluateProps(reference, props) {
  var out = Object.assign({}, props, {
    content: invokeWithArgsOrReturn(props.content, [reference])
  }, props.ignoreAttributes ? {} : getDataAttributeProps(reference, props.plugins));
  out.aria = Object.assign({}, defaultProps.aria, out.aria);
  out.aria = {
    expanded: out.aria.expanded === 'auto' ? props.interactive : out.aria.expanded,
    content: out.aria.content === 'auto' ? props.interactive ? null : 'describedby' : out.aria.content
  };
  return out;
}
function validateProps(partialProps, plugins) {
  if (partialProps === void 0) {
    partialProps = {};
  }

  if (plugins === void 0) {
    plugins = [];
  }

  var keys = Object.keys(partialProps);
  keys.forEach(function (prop) {
    var nonPluginProps = removeProperties(defaultProps, Object.keys(pluginProps));
    var didPassUnknownProp = !hasOwnProperty(nonPluginProps, prop); // Check if the prop exists in `plugins`

    if (didPassUnknownProp) {
      didPassUnknownProp = plugins.filter(function (plugin) {
        return plugin.name === prop;
      }).length === 0;
    }

    warnWhen(didPassUnknownProp, ["`" + prop + "`", "is not a valid prop. You may have spelled it incorrectly, or if it's", 'a plugin, forgot to pass it in an array as props.plugins.', '\n\n', 'All props: https://atomiks.github.io/tippyjs/v6/all-props/\n', 'Plugins: https://atomiks.github.io/tippyjs/v6/plugins/'].join(' '));
  });
}

var innerHTML = function innerHTML() {
  return 'innerHTML';
};

function dangerouslySetInnerHTML(element, html) {
  element[innerHTML()] = html;
}

function createArrowElement(value) {
  var arrow = div();

  if (value === true) {
    arrow.className = ARROW_CLASS;
  } else {
    arrow.className = SVG_ARROW_CLASS;

    if (isElement(value)) {
      arrow.appendChild(value);
    } else {
      dangerouslySetInnerHTML(arrow, value);
    }
  }

  return arrow;
}

function setContent(content, props) {
  if (isElement(props.content)) {
    dangerouslySetInnerHTML(content, '');
    content.appendChild(props.content);
  } else if (typeof props.content !== 'function') {
    if (props.allowHTML) {
      dangerouslySetInnerHTML(content, props.content);
    } else {
      content.textContent = props.content;
    }
  }
}
function getChildren(popper) {
  var box = popper.firstElementChild;
  var boxChildren = arrayFrom(box.children);
  return {
    box: box,
    content: boxChildren.find(function (node) {
      return node.classList.contains(CONTENT_CLASS);
    }),
    arrow: boxChildren.find(function (node) {
      return node.classList.contains(ARROW_CLASS) || node.classList.contains(SVG_ARROW_CLASS);
    }),
    backdrop: boxChildren.find(function (node) {
      return node.classList.contains(BACKDROP_CLASS);
    })
  };
}
function render(instance) {
  var popper = div();
  var box = div();
  box.className = BOX_CLASS;
  box.setAttribute('data-state', 'hidden');
  box.setAttribute('tabindex', '-1');
  var content = div();
  content.className = CONTENT_CLASS;
  content.setAttribute('data-state', 'hidden');
  setContent(content, instance.props);
  popper.appendChild(box);
  box.appendChild(content);
  onUpdate(instance.props, instance.props);

  function onUpdate(prevProps, nextProps) {
    var _getChildren = getChildren(popper),
        box = _getChildren.box,
        content = _getChildren.content,
        arrow = _getChildren.arrow;

    if (nextProps.theme) {
      box.setAttribute('data-theme', nextProps.theme);
    } else {
      box.removeAttribute('data-theme');
    }

    if (typeof nextProps.animation === 'string') {
      box.setAttribute('data-animation', nextProps.animation);
    } else {
      box.removeAttribute('data-animation');
    }

    if (nextProps.inertia) {
      box.setAttribute('data-inertia', '');
    } else {
      box.removeAttribute('data-inertia');
    }

    box.style.maxWidth = typeof nextProps.maxWidth === 'number' ? nextProps.maxWidth + "px" : nextProps.maxWidth;

    if (nextProps.role) {
      box.setAttribute('role', nextProps.role);
    } else {
      box.removeAttribute('role');
    }

    if (prevProps.content !== nextProps.content || prevProps.allowHTML !== nextProps.allowHTML) {
      setContent(content, instance.props);
    }

    if (nextProps.arrow) {
      if (!arrow) {
        box.appendChild(createArrowElement(nextProps.arrow));
      } else if (prevProps.arrow !== nextProps.arrow) {
        box.removeChild(arrow);
        box.appendChild(createArrowElement(nextProps.arrow));
      }
    } else if (arrow) {
      box.removeChild(arrow);
    }
  }

  return {
    popper: popper,
    onUpdate: onUpdate
  };
} // Runtime check to identify if the render function is the default one; this
// way we can apply default CSS transitions logic and it can be tree-shaken away

render.$$tippy = true;

var idCounter = 1;
var mouseMoveListeners = []; // Used by `hideAll()`

var mountedInstances = [];
function createTippy(reference, passedProps) {
  var props = evaluateProps(reference, Object.assign({}, defaultProps, getExtendedPassedProps(removeUndefinedProps(passedProps)))); // ===========================================================================
  // 🔒 Private members
  // ===========================================================================

  var showTimeout;
  var hideTimeout;
  var scheduleHideAnimationFrame;
  var isVisibleFromClick = false;
  var didHideDueToDocumentMouseDown = false;
  var didTouchMove = false;
  var ignoreOnFirstUpdate = false;
  var lastTriggerEvent;
  var currentTransitionEndListener;
  var onFirstUpdate;
  var listeners = [];
  var debouncedOnMouseMove = debounce(onMouseMove, props.interactiveDebounce);
  var currentTarget; // ===========================================================================
  // 🔑 Public members
  // ===========================================================================

  var id = idCounter++;
  var popperInstance = null;
  var plugins = unique(props.plugins);
  var state = {
    // Is the instance currently enabled?
    isEnabled: true,
    // Is the tippy currently showing and not transitioning out?
    isVisible: false,
    // Has the instance been destroyed?
    isDestroyed: false,
    // Is the tippy currently mounted to the DOM?
    isMounted: false,
    // Has the tippy finished transitioning in?
    isShown: false
  };
  var instance = {
    // properties
    id: id,
    reference: reference,
    popper: div(),
    popperInstance: popperInstance,
    props: props,
    state: state,
    plugins: plugins,
    // methods
    clearDelayTimeouts: clearDelayTimeouts,
    setProps: setProps,
    setContent: setContent,
    show: show,
    hide: hide,
    hideWithInteractivity: hideWithInteractivity,
    enable: enable,
    disable: disable,
    unmount: unmount,
    destroy: destroy
  }; // TODO: Investigate why this early return causes a TDZ error in the tests —
  // it doesn't seem to happen in the browser

  /* istanbul ignore if */

  if (!props.render) {
    if (process.env.NODE_ENV !== "production") {
      errorWhen(true, 'render() function has not been supplied.');
    }

    return instance;
  } // ===========================================================================
  // Initial mutations
  // ===========================================================================


  var _props$render = props.render(instance),
      popper = _props$render.popper,
      onUpdate = _props$render.onUpdate;

  popper.setAttribute('data-tippy-root', '');
  popper.id = "tippy-" + instance.id;
  instance.popper = popper;
  reference._tippy = instance;
  popper._tippy = instance;
  var pluginsHooks = plugins.map(function (plugin) {
    return plugin.fn(instance);
  });
  var hasAriaExpanded = reference.hasAttribute('aria-expanded');
  addListeners();
  handleAriaExpandedAttribute();
  handleStyles();
  invokeHook('onCreate', [instance]);

  if (props.showOnCreate) {
    scheduleShow();
  } // Prevent a tippy with a delay from hiding if the cursor left then returned
  // before it started hiding


  popper.addEventListener('mouseenter', function () {
    if (instance.props.interactive && instance.state.isVisible) {
      instance.clearDelayTimeouts();
    }
  });
  popper.addEventListener('mouseleave', function () {
    if (instance.props.interactive && instance.props.trigger.indexOf('mouseenter') >= 0) {
      getDocument().addEventListener('mousemove', debouncedOnMouseMove);
    }
  });
  return instance; // ===========================================================================
  // 🔒 Private methods
  // ===========================================================================

  function getNormalizedTouchSettings() {
    var touch = instance.props.touch;
    return Array.isArray(touch) ? touch : [touch, 0];
  }

  function getIsCustomTouchBehavior() {
    return getNormalizedTouchSettings()[0] === 'hold';
  }

  function getIsDefaultRenderFn() {
    var _instance$props$rende;

    // @ts-ignore
    return !!((_instance$props$rende = instance.props.render) != null && _instance$props$rende.$$tippy);
  }

  function getCurrentTarget() {
    return currentTarget || reference;
  }

  function getDocument() {
    var parent = getCurrentTarget().parentNode;
    return parent ? getOwnerDocument(parent) : document;
  }

  function getDefaultTemplateChildren() {
    return getChildren(popper);
  }

  function getDelay(isShow) {
    // For touch or keyboard input, force `0` delay for UX reasons
    // Also if the instance is mounted but not visible (transitioning out),
    // ignore delay
    if (instance.state.isMounted && !instance.state.isVisible || currentInput.isTouch || lastTriggerEvent && lastTriggerEvent.type === 'focus') {
      return 0;
    }

    return getValueAtIndexOrReturn(instance.props.delay, isShow ? 0 : 1, defaultProps.delay);
  }

  function handleStyles(fromHide) {
    if (fromHide === void 0) {
      fromHide = false;
    }

    popper.style.pointerEvents = instance.props.interactive && !fromHide ? '' : 'none';
    popper.style.zIndex = "" + instance.props.zIndex;
  }

  function invokeHook(hook, args, shouldInvokePropsHook) {
    if (shouldInvokePropsHook === void 0) {
      shouldInvokePropsHook = true;
    }

    pluginsHooks.forEach(function (pluginHooks) {
      if (pluginHooks[hook]) {
        pluginHooks[hook].apply(pluginHooks, args);
      }
    });

    if (shouldInvokePropsHook) {
      var _instance$props;

      (_instance$props = instance.props)[hook].apply(_instance$props, args);
    }
  }

  function handleAriaContentAttribute() {
    var aria = instance.props.aria;

    if (!aria.content) {
      return;
    }

    var attr = "aria-" + aria.content;
    var id = popper.id;
    var nodes = normalizeToArray(instance.props.triggerTarget || reference);
    nodes.forEach(function (node) {
      var currentValue = node.getAttribute(attr);

      if (instance.state.isVisible) {
        node.setAttribute(attr, currentValue ? currentValue + " " + id : id);
      } else {
        var nextValue = currentValue && currentValue.replace(id, '').trim();

        if (nextValue) {
          node.setAttribute(attr, nextValue);
        } else {
          node.removeAttribute(attr);
        }
      }
    });
  }

  function handleAriaExpandedAttribute() {
    if (hasAriaExpanded || !instance.props.aria.expanded) {
      return;
    }

    var nodes = normalizeToArray(instance.props.triggerTarget || reference);
    nodes.forEach(function (node) {
      if (instance.props.interactive) {
        node.setAttribute('aria-expanded', instance.state.isVisible && node === getCurrentTarget() ? 'true' : 'false');
      } else {
        node.removeAttribute('aria-expanded');
      }
    });
  }

  function cleanupInteractiveMouseListeners() {
    getDocument().removeEventListener('mousemove', debouncedOnMouseMove);
    mouseMoveListeners = mouseMoveListeners.filter(function (listener) {
      return listener !== debouncedOnMouseMove;
    });
  }

  function onDocumentPress(event) {
    // Moved finger to scroll instead of an intentional tap outside
    if (currentInput.isTouch) {
      if (didTouchMove || event.type === 'mousedown') {
        return;
      }
    }

    var actualTarget = event.composedPath && event.composedPath()[0] || event.target; // Clicked on interactive popper

    if (instance.props.interactive && actualContains(popper, actualTarget)) {
      return;
    } // Clicked on the event listeners target


    if (normalizeToArray(instance.props.triggerTarget || reference).some(function (el) {
      return actualContains(el, actualTarget);
    })) {
      if (currentInput.isTouch) {
        return;
      }

      if (instance.state.isVisible && instance.props.trigger.indexOf('click') >= 0) {
        return;
      }
    } else {
      invokeHook('onClickOutside', [instance, event]);
    }

    if (instance.props.hideOnClick === true) {
      instance.clearDelayTimeouts();
      instance.hide(); // `mousedown` event is fired right before `focus` if pressing the
      // currentTarget. This lets a tippy with `focus` trigger know that it
      // should not show

      didHideDueToDocumentMouseDown = true;
      setTimeout(function () {
        didHideDueToDocumentMouseDown = false;
      }); // The listener gets added in `scheduleShow()`, but this may be hiding it
      // before it shows, and hide()'s early bail-out behavior can prevent it
      // from being cleaned up

      if (!instance.state.isMounted) {
        removeDocumentPress();
      }
    }
  }

  function onTouchMove() {
    didTouchMove = true;
  }

  function onTouchStart() {
    didTouchMove = false;
  }

  function addDocumentPress() {
    var doc = getDocument();
    doc.addEventListener('mousedown', onDocumentPress, true);
    doc.addEventListener('touchend', onDocumentPress, TOUCH_OPTIONS);
    doc.addEventListener('touchstart', onTouchStart, TOUCH_OPTIONS);
    doc.addEventListener('touchmove', onTouchMove, TOUCH_OPTIONS);
  }

  function removeDocumentPress() {
    var doc = getDocument();
    doc.removeEventListener('mousedown', onDocumentPress, true);
    doc.removeEventListener('touchend', onDocumentPress, TOUCH_OPTIONS);
    doc.removeEventListener('touchstart', onTouchStart, TOUCH_OPTIONS);
    doc.removeEventListener('touchmove', onTouchMove, TOUCH_OPTIONS);
  }

  function onTransitionedOut(duration, callback) {
    onTransitionEnd(duration, function () {
      if (!instance.state.isVisible && popper.parentNode && popper.parentNode.contains(popper)) {
        callback();
      }
    });
  }

  function onTransitionedIn(duration, callback) {
    onTransitionEnd(duration, callback);
  }

  function onTransitionEnd(duration, callback) {
    var box = getDefaultTemplateChildren().box;

    function listener(event) {
      if (event.target === box) {
        updateTransitionEndListener(box, 'remove', listener);
        callback();
      }
    } // Make callback synchronous if duration is 0
    // `transitionend` won't fire otherwise


    if (duration === 0) {
      return callback();
    }

    updateTransitionEndListener(box, 'remove', currentTransitionEndListener);
    updateTransitionEndListener(box, 'add', listener);
    currentTransitionEndListener = listener;
  }

  function on(eventType, handler, options) {
    if (options === void 0) {
      options = false;
    }

    var nodes = normalizeToArray(instance.props.triggerTarget || reference);
    nodes.forEach(function (node) {
      node.addEventListener(eventType, handler, options);
      listeners.push({
        node: node,
        eventType: eventType,
        handler: handler,
        options: options
      });
    });
  }

  function addListeners() {
    if (getIsCustomTouchBehavior()) {
      on('touchstart', onTrigger, {
        passive: true
      });
      on('touchend', onMouseLeave, {
        passive: true
      });
    }

    splitBySpaces(instance.props.trigger).forEach(function (eventType) {
      if (eventType === 'manual') {
        return;
      }

      on(eventType, onTrigger);

      switch (eventType) {
        case 'mouseenter':
          on('mouseleave', onMouseLeave);
          break;

        case 'focus':
          on(isIE11 ? 'focusout' : 'blur', onBlurOrFocusOut);
          break;

        case 'focusin':
          on('focusout', onBlurOrFocusOut);
          break;
      }
    });
  }

  function removeListeners() {
    listeners.forEach(function (_ref) {
      var node = _ref.node,
          eventType = _ref.eventType,
          handler = _ref.handler,
          options = _ref.options;
      node.removeEventListener(eventType, handler, options);
    });
    listeners = [];
  }

  function onTrigger(event) {
    var _lastTriggerEvent;

    var shouldScheduleClickHide = false;

    if (!instance.state.isEnabled || isEventListenerStopped(event) || didHideDueToDocumentMouseDown) {
      return;
    }

    var wasFocused = ((_lastTriggerEvent = lastTriggerEvent) == null ? void 0 : _lastTriggerEvent.type) === 'focus';
    lastTriggerEvent = event;
    currentTarget = event.currentTarget;
    handleAriaExpandedAttribute();

    if (!instance.state.isVisible && isMouseEvent(event)) {
      // If scrolling, `mouseenter` events can be fired if the cursor lands
      // over a new target, but `mousemove` events don't get fired. This
      // causes interactive tooltips to get stuck open until the cursor is
      // moved
      mouseMoveListeners.forEach(function (listener) {
        return listener(event);
      });
    } // Toggle show/hide when clicking click-triggered tooltips


    if (event.type === 'click' && (instance.props.trigger.indexOf('mouseenter') < 0 || isVisibleFromClick) && instance.props.hideOnClick !== false && instance.state.isVisible) {
      shouldScheduleClickHide = true;
    } else {
      scheduleShow(event);
    }

    if (event.type === 'click') {
      isVisibleFromClick = !shouldScheduleClickHide;
    }

    if (shouldScheduleClickHide && !wasFocused) {
      scheduleHide(event);
    }
  }

  function onMouseMove(event) {
    var target = event.target;
    var isCursorOverReferenceOrPopper = getCurrentTarget().contains(target) || popper.contains(target);

    if (event.type === 'mousemove' && isCursorOverReferenceOrPopper) {
      return;
    }

    var popperTreeData = getNestedPopperTree().concat(popper).map(function (popper) {
      var _instance$popperInsta;

      var instance = popper._tippy;
      var state = (_instance$popperInsta = instance.popperInstance) == null ? void 0 : _instance$popperInsta.state;

      if (state) {
        return {
          popperRect: popper.getBoundingClientRect(),
          popperState: state,
          props: props
        };
      }

      return null;
    }).filter(Boolean);

    if (isCursorOutsideInteractiveBorder(popperTreeData, event)) {
      cleanupInteractiveMouseListeners();
      scheduleHide(event);
    }
  }

  function onMouseLeave(event) {
    var shouldBail = isEventListenerStopped(event) || instance.props.trigger.indexOf('click') >= 0 && isVisibleFromClick;

    if (shouldBail) {
      return;
    }

    if (instance.props.interactive) {
      instance.hideWithInteractivity(event);
      return;
    }

    scheduleHide(event);
  }

  function onBlurOrFocusOut(event) {
    if (instance.props.trigger.indexOf('focusin') < 0 && event.target !== getCurrentTarget()) {
      return;
    } // If focus was moved to within the popper


    if (instance.props.interactive && event.relatedTarget && popper.contains(event.relatedTarget)) {
      return;
    }

    scheduleHide(event);
  }

  function isEventListenerStopped(event) {
    return currentInput.isTouch ? getIsCustomTouchBehavior() !== event.type.indexOf('touch') >= 0 : false;
  }

  function createPopperInstance() {
    destroyPopperInstance();
    var _instance$props2 = instance.props,
        popperOptions = _instance$props2.popperOptions,
        placement = _instance$props2.placement,
        offset = _instance$props2.offset,
        getReferenceClientRect = _instance$props2.getReferenceClientRect,
        moveTransition = _instance$props2.moveTransition;
    var arrow = getIsDefaultRenderFn() ? getChildren(popper).arrow : null;
    var computedReference = getReferenceClientRect ? {
      getBoundingClientRect: getReferenceClientRect,
      contextElement: getReferenceClientRect.contextElement || getCurrentTarget()
    } : reference;
    var tippyModifier = {
      name: '$$tippy',
      enabled: true,
      phase: 'beforeWrite',
      requires: ['computeStyles'],
      fn: function fn(_ref2) {
        var state = _ref2.state;

        if (getIsDefaultRenderFn()) {
          var _getDefaultTemplateCh = getDefaultTemplateChildren(),
              box = _getDefaultTemplateCh.box;

          ['placement', 'reference-hidden', 'escaped'].forEach(function (attr) {
            if (attr === 'placement') {
              box.setAttribute('data-placement', state.placement);
            } else {
              if (state.attributes.popper["data-popper-" + attr]) {
                box.setAttribute("data-" + attr, '');
              } else {
                box.removeAttribute("data-" + attr);
              }
            }
          });
          state.attributes.popper = {};
        }
      }
    };
    var modifiers = [{
      name: 'offset',
      options: {
        offset: offset
      }
    }, {
      name: 'preventOverflow',
      options: {
        padding: {
          top: 2,
          bottom: 2,
          left: 5,
          right: 5
        }
      }
    }, {
      name: 'flip',
      options: {
        padding: 5
      }
    }, {
      name: 'computeStyles',
      options: {
        adaptive: !moveTransition
      }
    }, tippyModifier];

    if (getIsDefaultRenderFn() && arrow) {
      modifiers.push({
        name: 'arrow',
        options: {
          element: arrow,
          padding: 3
        }
      });
    }

    modifiers.push.apply(modifiers, (popperOptions == null ? void 0 : popperOptions.modifiers) || []);
    instance.popperInstance = core.createPopper(computedReference, popper, Object.assign({}, popperOptions, {
      placement: placement,
      onFirstUpdate: onFirstUpdate,
      modifiers: modifiers
    }));
  }

  function destroyPopperInstance() {
    if (instance.popperInstance) {
      instance.popperInstance.destroy();
      instance.popperInstance = null;
    }
  }

  function mount() {
    var appendTo = instance.props.appendTo;
    var parentNode; // By default, we'll append the popper to the triggerTargets's parentNode so
    // it's directly after the reference element so the elements inside the
    // tippy can be tabbed to
    // If there are clipping issues, the user can specify a different appendTo
    // and ensure focus management is handled correctly manually

    var node = getCurrentTarget();

    if (instance.props.interactive && appendTo === TIPPY_DEFAULT_APPEND_TO || appendTo === 'parent') {
      parentNode = node.parentNode;
    } else {
      parentNode = invokeWithArgsOrReturn(appendTo, [node]);
    } // The popper element needs to exist on the DOM before its position can be
    // updated as Popper needs to read its dimensions


    if (!parentNode.contains(popper)) {
      parentNode.appendChild(popper);
    }

    instance.state.isMounted = true;
    createPopperInstance();
    /* istanbul ignore else */

    if (process.env.NODE_ENV !== "production") {
      // Accessibility check
      warnWhen(instance.props.interactive && appendTo === defaultProps.appendTo && node.nextElementSibling !== popper, ['Interactive tippy element may not be accessible via keyboard', 'navigation because it is not directly after the reference element', 'in the DOM source order.', '\n\n', 'Using a wrapper <div> or <span> tag around the reference element', 'solves this by creating a new parentNode context.', '\n\n', 'Specifying `appendTo: document.body` silences this warning, but it', 'assumes you are using a focus management solution to handle', 'keyboard navigation.', '\n\n', 'See: https://atomiks.github.io/tippyjs/v6/accessibility/#interactivity'].join(' '));
    }
  }

  function getNestedPopperTree() {
    return arrayFrom(popper.querySelectorAll('[data-tippy-root]'));
  }

  function scheduleShow(event) {
    instance.clearDelayTimeouts();

    if (event) {
      invokeHook('onTrigger', [instance, event]);
    }

    addDocumentPress();
    var delay = getDelay(true);

    var _getNormalizedTouchSe = getNormalizedTouchSettings(),
        touchValue = _getNormalizedTouchSe[0],
        touchDelay = _getNormalizedTouchSe[1];

    if (currentInput.isTouch && touchValue === 'hold' && touchDelay) {
      delay = touchDelay;
    }

    if (delay) {
      showTimeout = setTimeout(function () {
        instance.show();
      }, delay);
    } else {
      instance.show();
    }
  }

  function scheduleHide(event) {
    instance.clearDelayTimeouts();
    invokeHook('onUntrigger', [instance, event]);

    if (!instance.state.isVisible) {
      removeDocumentPress();
      return;
    } // For interactive tippies, scheduleHide is added to a document.body handler
    // from onMouseLeave so must intercept scheduled hides from mousemove/leave
    // events when trigger contains mouseenter and click, and the tip is
    // currently shown as a result of a click.


    if (instance.props.trigger.indexOf('mouseenter') >= 0 && instance.props.trigger.indexOf('click') >= 0 && ['mouseleave', 'mousemove'].indexOf(event.type) >= 0 && isVisibleFromClick) {
      return;
    }

    var delay = getDelay(false);

    if (delay) {
      hideTimeout = setTimeout(function () {
        if (instance.state.isVisible) {
          instance.hide();
        }
      }, delay);
    } else {
      // Fixes a `transitionend` problem when it fires 1 frame too
      // late sometimes, we don't want hide() to be called.
      scheduleHideAnimationFrame = requestAnimationFrame(function () {
        instance.hide();
      });
    }
  } // ===========================================================================
  // 🔑 Public methods
  // ===========================================================================


  function enable() {
    instance.state.isEnabled = true;
  }

  function disable() {
    // Disabling the instance should also hide it
    // https://github.com/atomiks/tippy.js-react/issues/106
    instance.hide();
    instance.state.isEnabled = false;
  }

  function clearDelayTimeouts() {
    clearTimeout(showTimeout);
    clearTimeout(hideTimeout);
    cancelAnimationFrame(scheduleHideAnimationFrame);
  }

  function setProps(partialProps) {
    /* istanbul ignore else */
    if (process.env.NODE_ENV !== "production") {
      warnWhen(instance.state.isDestroyed, createMemoryLeakWarning('setProps'));
    }

    if (instance.state.isDestroyed) {
      return;
    }

    invokeHook('onBeforeUpdate', [instance, partialProps]);
    removeListeners();
    var prevProps = instance.props;
    var nextProps = evaluateProps(reference, Object.assign({}, prevProps, removeUndefinedProps(partialProps), {
      ignoreAttributes: true
    }));
    instance.props = nextProps;
    addListeners();

    if (prevProps.interactiveDebounce !== nextProps.interactiveDebounce) {
      cleanupInteractiveMouseListeners();
      debouncedOnMouseMove = debounce(onMouseMove, nextProps.interactiveDebounce);
    } // Ensure stale aria-expanded attributes are removed


    if (prevProps.triggerTarget && !nextProps.triggerTarget) {
      normalizeToArray(prevProps.triggerTarget).forEach(function (node) {
        node.removeAttribute('aria-expanded');
      });
    } else if (nextProps.triggerTarget) {
      reference.removeAttribute('aria-expanded');
    }

    handleAriaExpandedAttribute();
    handleStyles();

    if (onUpdate) {
      onUpdate(prevProps, nextProps);
    }

    if (instance.popperInstance) {
      createPopperInstance(); // Fixes an issue with nested tippies if they are all getting re-rendered,
      // and the nested ones get re-rendered first.
      // https://github.com/atomiks/tippyjs-react/issues/177
      // TODO: find a cleaner / more efficient solution(!)

      getNestedPopperTree().forEach(function (nestedPopper) {
        // React (and other UI libs likely) requires a rAF wrapper as it flushes
        // its work in one
        requestAnimationFrame(nestedPopper._tippy.popperInstance.forceUpdate);
      });
    }

    invokeHook('onAfterUpdate', [instance, partialProps]);
  }

  function setContent(content) {
    instance.setProps({
      content: content
    });
  }

  function show() {
    /* istanbul ignore else */
    if (process.env.NODE_ENV !== "production") {
      warnWhen(instance.state.isDestroyed, createMemoryLeakWarning('show'));
    } // Early bail-out


    var isAlreadyVisible = instance.state.isVisible;
    var isDestroyed = instance.state.isDestroyed;
    var isDisabled = !instance.state.isEnabled;
    var isTouchAndTouchDisabled = currentInput.isTouch && !instance.props.touch;
    var duration = getValueAtIndexOrReturn(instance.props.duration, 0, defaultProps.duration);

    if (isAlreadyVisible || isDestroyed || isDisabled || isTouchAndTouchDisabled) {
      return;
    } // Normalize `disabled` behavior across browsers.
    // Firefox allows events on disabled elements, but Chrome doesn't.
    // Using a wrapper element (i.e. <span>) is recommended.


    if (getCurrentTarget().hasAttribute('disabled')) {
      return;
    }

    invokeHook('onShow', [instance], false);

    if (instance.props.onShow(instance) === false) {
      return;
    }

    instance.state.isVisible = true;

    if (getIsDefaultRenderFn()) {
      popper.style.visibility = 'visible';
    }

    handleStyles();
    addDocumentPress();

    if (!instance.state.isMounted) {
      popper.style.transition = 'none';
    } // If flipping to the opposite side after hiding at least once, the
    // animation will use the wrong placement without resetting the duration


    if (getIsDefaultRenderFn()) {
      var _getDefaultTemplateCh2 = getDefaultTemplateChildren(),
          box = _getDefaultTemplateCh2.box,
          content = _getDefaultTemplateCh2.content;

      setTransitionDuration([box, content], 0);
    }

    onFirstUpdate = function onFirstUpdate() {
      var _instance$popperInsta2;

      if (!instance.state.isVisible || ignoreOnFirstUpdate) {
        return;
      }

      ignoreOnFirstUpdate = true; // reflow

      void popper.offsetHeight;
      popper.style.transition = instance.props.moveTransition;

      if (getIsDefaultRenderFn() && instance.props.animation) {
        var _getDefaultTemplateCh3 = getDefaultTemplateChildren(),
            _box = _getDefaultTemplateCh3.box,
            _content = _getDefaultTemplateCh3.content;

        setTransitionDuration([_box, _content], duration);
        setVisibilityState([_box, _content], 'visible');
      }

      handleAriaContentAttribute();
      handleAriaExpandedAttribute();
      pushIfUnique(mountedInstances, instance); // certain modifiers (e.g. `maxSize`) require a second update after the
      // popper has been positioned for the first time

      (_instance$popperInsta2 = instance.popperInstance) == null ? void 0 : _instance$popperInsta2.forceUpdate();
      invokeHook('onMount', [instance]);

      if (instance.props.animation && getIsDefaultRenderFn()) {
        onTransitionedIn(duration, function () {
          instance.state.isShown = true;
          invokeHook('onShown', [instance]);
        });
      }
    };

    mount();
  }

  function hide() {
    /* istanbul ignore else */
    if (process.env.NODE_ENV !== "production") {
      warnWhen(instance.state.isDestroyed, createMemoryLeakWarning('hide'));
    } // Early bail-out


    var isAlreadyHidden = !instance.state.isVisible;
    var isDestroyed = instance.state.isDestroyed;
    var isDisabled = !instance.state.isEnabled;
    var duration = getValueAtIndexOrReturn(instance.props.duration, 1, defaultProps.duration);

    if (isAlreadyHidden || isDestroyed || isDisabled) {
      return;
    }

    invokeHook('onHide', [instance], false);

    if (instance.props.onHide(instance) === false) {
      return;
    }

    instance.state.isVisible = false;
    instance.state.isShown = false;
    ignoreOnFirstUpdate = false;
    isVisibleFromClick = false;

    if (getIsDefaultRenderFn()) {
      popper.style.visibility = 'hidden';
    }

    cleanupInteractiveMouseListeners();
    removeDocumentPress();
    handleStyles(true);

    if (getIsDefaultRenderFn()) {
      var _getDefaultTemplateCh4 = getDefaultTemplateChildren(),
          box = _getDefaultTemplateCh4.box,
          content = _getDefaultTemplateCh4.content;

      if (instance.props.animation) {
        setTransitionDuration([box, content], duration);
        setVisibilityState([box, content], 'hidden');
      }
    }

    handleAriaContentAttribute();
    handleAriaExpandedAttribute();

    if (instance.props.animation) {
      if (getIsDefaultRenderFn()) {
        onTransitionedOut(duration, instance.unmount);
      }
    } else {
      instance.unmount();
    }
  }

  function hideWithInteractivity(event) {
    /* istanbul ignore else */
    if (process.env.NODE_ENV !== "production") {
      warnWhen(instance.state.isDestroyed, createMemoryLeakWarning('hideWithInteractivity'));
    }

    getDocument().addEventListener('mousemove', debouncedOnMouseMove);
    pushIfUnique(mouseMoveListeners, debouncedOnMouseMove);
    debouncedOnMouseMove(event);
  }

  function unmount() {
    /* istanbul ignore else */
    if (process.env.NODE_ENV !== "production") {
      warnWhen(instance.state.isDestroyed, createMemoryLeakWarning('unmount'));
    }

    if (instance.state.isVisible) {
      instance.hide();
    }

    if (!instance.state.isMounted) {
      return;
    }

    destroyPopperInstance(); // If a popper is not interactive, it will be appended outside the popper
    // tree by default. This seems mainly for interactive tippies, but we should
    // find a workaround if possible

    getNestedPopperTree().forEach(function (nestedPopper) {
      nestedPopper._tippy.unmount();
    });

    if (popper.parentNode) {
      popper.parentNode.removeChild(popper);
    }

    mountedInstances = mountedInstances.filter(function (i) {
      return i !== instance;
    });
    instance.state.isMounted = false;
    invokeHook('onHidden', [instance]);
  }

  function destroy() {
    /* istanbul ignore else */
    if (process.env.NODE_ENV !== "production") {
      warnWhen(instance.state.isDestroyed, createMemoryLeakWarning('destroy'));
    }

    if (instance.state.isDestroyed) {
      return;
    }

    instance.clearDelayTimeouts();
    instance.unmount();
    removeListeners();
    delete reference._tippy;
    instance.state.isDestroyed = true;
    invokeHook('onDestroy', [instance]);
  }
}

function tippy(targets, optionalProps) {
  if (optionalProps === void 0) {
    optionalProps = {};
  }

  var plugins = defaultProps.plugins.concat(optionalProps.plugins || []);
  /* istanbul ignore else */

  if (process.env.NODE_ENV !== "production") {
    validateTargets(targets);
    validateProps(optionalProps, plugins);
  }

  bindGlobalEventListeners();
  var passedProps = Object.assign({}, optionalProps, {
    plugins: plugins
  });
  var elements = getArrayOfElements(targets);
  /* istanbul ignore else */

  if (process.env.NODE_ENV !== "production") {
    var isSingleContentElement = isElement(passedProps.content);
    var isMoreThanOneReferenceElement = elements.length > 1;
    warnWhen(isSingleContentElement && isMoreThanOneReferenceElement, ['tippy() was passed an Element as the `content` prop, but more than', 'one tippy instance was created by this invocation. This means the', 'content element will only be appended to the last tippy instance.', '\n\n', 'Instead, pass the .innerHTML of the element, or use a function that', 'returns a cloned version of the element instead.', '\n\n', '1) content: element.innerHTML\n', '2) content: () => element.cloneNode(true)'].join(' '));
  }

  var instances = elements.reduce(function (acc, reference) {
    var instance = reference && createTippy(reference, passedProps);

    if (instance) {
      acc.push(instance);
    }

    return acc;
  }, []);
  return isElement(targets) ? instances[0] : instances;
}

tippy.defaultProps = defaultProps;
tippy.setDefaultProps = setDefaultProps;
tippy.currentInput = currentInput;
var hideAll = function hideAll(_temp) {
  var _ref = _temp === void 0 ? {} : _temp,
      excludedReferenceOrInstance = _ref.exclude,
      duration = _ref.duration;

  mountedInstances.forEach(function (instance) {
    var isExcluded = false;

    if (excludedReferenceOrInstance) {
      isExcluded = isReferenceElement(excludedReferenceOrInstance) ? instance.reference === excludedReferenceOrInstance : instance.popper === excludedReferenceOrInstance.popper;
    }

    if (!isExcluded) {
      var originalDuration = instance.props.duration;
      instance.setProps({
        duration: duration
      });
      instance.hide();

      if (!instance.state.isDestroyed) {
        instance.setProps({
          duration: originalDuration
        });
      }
    }
  });
};

// every time the popper is destroyed (i.e. a new target), removing the styles
// and causing transitions to break for singletons when the console is open, but
// most notably for non-transform styles being used, `gpuAcceleration: false`.

var applyStylesModifier = Object.assign({}, core.applyStyles, {
  effect: function effect(_ref) {
    var state = _ref.state;
    var initialStyles = {
      popper: {
        position: state.options.strategy,
        left: '0',
        top: '0',
        margin: '0'
      },
      arrow: {
        position: 'absolute'
      },
      reference: {}
    };
    Object.assign(state.elements.popper.style, initialStyles.popper);
    state.styles = initialStyles;

    if (state.elements.arrow) {
      Object.assign(state.elements.arrow.style, initialStyles.arrow);
    } // intentionally return no cleanup function
    // return () => { ... }

  }
});

var createSingleton = function createSingleton(tippyInstances, optionalProps) {
  var _optionalProps$popper;

  if (optionalProps === void 0) {
    optionalProps = {};
  }

  /* istanbul ignore else */
  if (process.env.NODE_ENV !== "production") {
    errorWhen(!Array.isArray(tippyInstances), ['The first argument passed to createSingleton() must be an array of', 'tippy instances. The passed value was', String(tippyInstances)].join(' '));
  }

  var individualInstances = tippyInstances;
  var references = [];
  var triggerTargets = [];
  var currentTarget;
  var overrides = optionalProps.overrides;
  var interceptSetPropsCleanups = [];
  var shownOnCreate = false;

  function setTriggerTargets() {
    triggerTargets = individualInstances.map(function (instance) {
      return normalizeToArray(instance.props.triggerTarget || instance.reference);
    }).reduce(function (acc, item) {
      return acc.concat(item);
    }, []);
  }

  function setReferences() {
    references = individualInstances.map(function (instance) {
      return instance.reference;
    });
  }

  function enableInstances(isEnabled) {
    individualInstances.forEach(function (instance) {
      if (isEnabled) {
        instance.enable();
      } else {
        instance.disable();
      }
    });
  }

  function interceptSetProps(singleton) {
    return individualInstances.map(function (instance) {
      var originalSetProps = instance.setProps;

      instance.setProps = function (props) {
        originalSetProps(props);

        if (instance.reference === currentTarget) {
          singleton.setProps(props);
        }
      };

      return function () {
        instance.setProps = originalSetProps;
      };
    });
  } // have to pass singleton, as it maybe undefined on first call


  function prepareInstance(singleton, target) {
    var index = triggerTargets.indexOf(target); // bail-out

    if (target === currentTarget) {
      return;
    }

    currentTarget = target;
    var overrideProps = (overrides || []).concat('content').reduce(function (acc, prop) {
      acc[prop] = individualInstances[index].props[prop];
      return acc;
    }, {});
    singleton.setProps(Object.assign({}, overrideProps, {
      getReferenceClientRect: typeof overrideProps.getReferenceClientRect === 'function' ? overrideProps.getReferenceClientRect : function () {
        var _references$index;

        return (_references$index = references[index]) == null ? void 0 : _references$index.getBoundingClientRect();
      }
    }));
  }

  enableInstances(false);
  setReferences();
  setTriggerTargets();
  var plugin = {
    fn: function fn() {
      return {
        onDestroy: function onDestroy() {
          enableInstances(true);
        },
        onHidden: function onHidden() {
          currentTarget = null;
        },
        onClickOutside: function onClickOutside(instance) {
          if (instance.props.showOnCreate && !shownOnCreate) {
            shownOnCreate = true;
            currentTarget = null;
          }
        },
        onShow: function onShow(instance) {
          if (instance.props.showOnCreate && !shownOnCreate) {
            shownOnCreate = true;
            prepareInstance(instance, references[0]);
          }
        },
        onTrigger: function onTrigger(instance, event) {
          prepareInstance(instance, event.currentTarget);
        }
      };
    }
  };
  var singleton = tippy(div(), Object.assign({}, removeProperties(optionalProps, ['overrides']), {
    plugins: [plugin].concat(optionalProps.plugins || []),
    triggerTarget: triggerTargets,
    popperOptions: Object.assign({}, optionalProps.popperOptions, {
      modifiers: [].concat(((_optionalProps$popper = optionalProps.popperOptions) == null ? void 0 : _optionalProps$popper.modifiers) || [], [applyStylesModifier])
    })
  }));
  var originalShow = singleton.show;

  singleton.show = function (target) {
    originalShow(); // first time, showOnCreate or programmatic call with no params
    // default to showing first instance

    if (!currentTarget && target == null) {
      return prepareInstance(singleton, references[0]);
    } // triggered from event (do nothing as prepareInstance already called by onTrigger)
    // programmatic call with no params when already visible (do nothing again)


    if (currentTarget && target == null) {
      return;
    } // target is index of instance


    if (typeof target === 'number') {
      return references[target] && prepareInstance(singleton, references[target]);
    } // target is a child tippy instance


    if (individualInstances.indexOf(target) >= 0) {
      var ref = target.reference;
      return prepareInstance(singleton, ref);
    } // target is a ReferenceElement


    if (references.indexOf(target) >= 0) {
      return prepareInstance(singleton, target);
    }
  };

  singleton.showNext = function () {
    var first = references[0];

    if (!currentTarget) {
      return singleton.show(0);
    }

    var index = references.indexOf(currentTarget);
    singleton.show(references[index + 1] || first);
  };

  singleton.showPrevious = function () {
    var last = references[references.length - 1];

    if (!currentTarget) {
      return singleton.show(last);
    }

    var index = references.indexOf(currentTarget);
    var target = references[index - 1] || last;
    singleton.show(target);
  };

  var originalSetProps = singleton.setProps;

  singleton.setProps = function (props) {
    overrides = props.overrides || overrides;
    originalSetProps(props);
  };

  singleton.setInstances = function (nextInstances) {
    enableInstances(true);
    interceptSetPropsCleanups.forEach(function (fn) {
      return fn();
    });
    individualInstances = nextInstances;
    enableInstances(false);
    setReferences();
    setTriggerTargets();
    interceptSetPropsCleanups = interceptSetProps(singleton);
    singleton.setProps({
      triggerTarget: triggerTargets
    });
  };

  interceptSetPropsCleanups = interceptSetProps(singleton);
  return singleton;
};

var BUBBLING_EVENTS_MAP = {
  mouseover: 'mouseenter',
  focusin: 'focus',
  click: 'click'
};
/**
 * Creates a delegate instance that controls the creation of tippy instances
 * for child elements (`target` CSS selector).
 */

function delegate(targets, props) {
  /* istanbul ignore else */
  if (process.env.NODE_ENV !== "production") {
    errorWhen(!(props && props.target), ['You must specity a `target` prop indicating a CSS selector string matching', 'the target elements that should receive a tippy.'].join(' '));
  }

  var listeners = [];
  var childTippyInstances = [];
  var disabled = false;
  var target = props.target;
  var nativeProps = removeProperties(props, ['target']);
  var parentProps = Object.assign({}, nativeProps, {
    trigger: 'manual',
    touch: false
  });
  var childProps = Object.assign({
    touch: defaultProps.touch
  }, nativeProps, {
    showOnCreate: true
  });
  var returnValue = tippy(targets, parentProps);
  var normalizedReturnValue = normalizeToArray(returnValue);

  function onTrigger(event) {
    if (!event.target || disabled) {
      return;
    }

    var targetNode = event.target.closest(target);

    if (!targetNode) {
      return;
    } // Get relevant trigger with fallbacks:
    // 1. Check `data-tippy-trigger` attribute on target node
    // 2. Fallback to `trigger` passed to `delegate()`
    // 3. Fallback to `defaultProps.trigger`


    var trigger = targetNode.getAttribute('data-tippy-trigger') || props.trigger || defaultProps.trigger; // @ts-ignore

    if (targetNode._tippy) {
      return;
    }

    if (event.type === 'touchstart' && typeof childProps.touch === 'boolean') {
      return;
    }

    if (event.type !== 'touchstart' && trigger.indexOf(BUBBLING_EVENTS_MAP[event.type]) < 0) {
      return;
    }

    var instance = tippy(targetNode, childProps);

    if (instance) {
      childTippyInstances = childTippyInstances.concat(instance);
    }
  }

  function on(node, eventType, handler, options) {
    if (options === void 0) {
      options = false;
    }

    node.addEventListener(eventType, handler, options);
    listeners.push({
      node: node,
      eventType: eventType,
      handler: handler,
      options: options
    });
  }

  function addEventListeners(instance) {
    var reference = instance.reference;
    on(reference, 'touchstart', onTrigger, TOUCH_OPTIONS);
    on(reference, 'mouseover', onTrigger);
    on(reference, 'focusin', onTrigger);
    on(reference, 'click', onTrigger);
  }

  function removeEventListeners() {
    listeners.forEach(function (_ref) {
      var node = _ref.node,
          eventType = _ref.eventType,
          handler = _ref.handler,
          options = _ref.options;
      node.removeEventListener(eventType, handler, options);
    });
    listeners = [];
  }

  function applyMutations(instance) {
    var originalDestroy = instance.destroy;
    var originalEnable = instance.enable;
    var originalDisable = instance.disable;

    instance.destroy = function (shouldDestroyChildInstances) {
      if (shouldDestroyChildInstances === void 0) {
        shouldDestroyChildInstances = true;
      }

      if (shouldDestroyChildInstances) {
        childTippyInstances.forEach(function (instance) {
          instance.destroy();
        });
      }

      childTippyInstances = [];
      removeEventListeners();
      originalDestroy();
    };

    instance.enable = function () {
      originalEnable();
      childTippyInstances.forEach(function (instance) {
        return instance.enable();
      });
      disabled = false;
    };

    instance.disable = function () {
      originalDisable();
      childTippyInstances.forEach(function (instance) {
        return instance.disable();
      });
      disabled = true;
    };

    addEventListeners(instance);
  }

  normalizedReturnValue.forEach(applyMutations);
  return returnValue;
}

var animateFill = {
  name: 'animateFill',
  defaultValue: false,
  fn: function fn(instance) {
    var _instance$props$rende;

    // @ts-ignore
    if (!((_instance$props$rende = instance.props.render) != null && _instance$props$rende.$$tippy)) {
      if (process.env.NODE_ENV !== "production") {
        errorWhen(instance.props.animateFill, 'The `animateFill` plugin requires the default render function.');
      }

      return {};
    }

    var _getChildren = getChildren(instance.popper),
        box = _getChildren.box,
        content = _getChildren.content;

    var backdrop = instance.props.animateFill ? createBackdropElement() : null;
    return {
      onCreate: function onCreate() {
        if (backdrop) {
          box.insertBefore(backdrop, box.firstElementChild);
          box.setAttribute('data-animatefill', '');
          box.style.overflow = 'hidden';
          instance.setProps({
            arrow: false,
            animation: 'shift-away'
          });
        }
      },
      onMount: function onMount() {
        if (backdrop) {
          var transitionDuration = box.style.transitionDuration;
          var duration = Number(transitionDuration.replace('ms', '')); // The content should fade in after the backdrop has mostly filled the
          // tooltip element. `clip-path` is the other alternative but is not
          // well-supported and is buggy on some devices.

          content.style.transitionDelay = Math.round(duration / 10) + "ms";
          backdrop.style.transitionDuration = transitionDuration;
          setVisibilityState([backdrop], 'visible');
        }
      },
      onShow: function onShow() {
        if (backdrop) {
          backdrop.style.transitionDuration = '0ms';
        }
      },
      onHide: function onHide() {
        if (backdrop) {
          setVisibilityState([backdrop], 'hidden');
        }
      }
    };
  }
};

function createBackdropElement() {
  var backdrop = div();
  backdrop.className = BACKDROP_CLASS;
  setVisibilityState([backdrop], 'hidden');
  return backdrop;
}

var mouseCoords = {
  clientX: 0,
  clientY: 0
};
var activeInstances = [];

function storeMouseCoords(_ref) {
  var clientX = _ref.clientX,
      clientY = _ref.clientY;
  mouseCoords = {
    clientX: clientX,
    clientY: clientY
  };
}

function addMouseCoordsListener(doc) {
  doc.addEventListener('mousemove', storeMouseCoords);
}

function removeMouseCoordsListener(doc) {
  doc.removeEventListener('mousemove', storeMouseCoords);
}

var followCursor = {
  name: 'followCursor',
  defaultValue: false,
  fn: function fn(instance) {
    var reference = instance.reference;
    var doc = getOwnerDocument(instance.props.triggerTarget || reference);
    var isInternalUpdate = false;
    var wasFocusEvent = false;
    var isUnmounted = true;
    var prevProps = instance.props;

    function getIsInitialBehavior() {
      return instance.props.followCursor === 'initial' && instance.state.isVisible;
    }

    function addListener() {
      doc.addEventListener('mousemove', onMouseMove);
    }

    function removeListener() {
      doc.removeEventListener('mousemove', onMouseMove);
    }

    function unsetGetReferenceClientRect() {
      isInternalUpdate = true;
      instance.setProps({
        getReferenceClientRect: null
      });
      isInternalUpdate = false;
    }

    function onMouseMove(event) {
      // If the instance is interactive, avoid updating the position unless it's
      // over the reference element
      var isCursorOverReference = event.target ? reference.contains(event.target) : true;
      var followCursor = instance.props.followCursor;
      var clientX = event.clientX,
          clientY = event.clientY;
      var rect = reference.getBoundingClientRect();
      var relativeX = clientX - rect.left;
      var relativeY = clientY - rect.top;

      if (isCursorOverReference || !instance.props.interactive) {
        instance.setProps({
          // @ts-ignore - unneeded DOMRect properties
          getReferenceClientRect: function getReferenceClientRect() {
            var rect = reference.getBoundingClientRect();
            var x = clientX;
            var y = clientY;

            if (followCursor === 'initial') {
              x = rect.left + relativeX;
              y = rect.top + relativeY;
            }

            var top = followCursor === 'horizontal' ? rect.top : y;
            var right = followCursor === 'vertical' ? rect.right : x;
            var bottom = followCursor === 'horizontal' ? rect.bottom : y;
            var left = followCursor === 'vertical' ? rect.left : x;
            return {
              width: right - left,
              height: bottom - top,
              top: top,
              right: right,
              bottom: bottom,
              left: left
            };
          }
        });
      }
    }

    function create() {
      if (instance.props.followCursor) {
        activeInstances.push({
          instance: instance,
          doc: doc
        });
        addMouseCoordsListener(doc);
      }
    }

    function destroy() {
      activeInstances = activeInstances.filter(function (data) {
        return data.instance !== instance;
      });

      if (activeInstances.filter(function (data) {
        return data.doc === doc;
      }).length === 0) {
        removeMouseCoordsListener(doc);
      }
    }

    return {
      onCreate: create,
      onDestroy: destroy,
      onBeforeUpdate: function onBeforeUpdate() {
        prevProps = instance.props;
      },
      onAfterUpdate: function onAfterUpdate(_, _ref2) {
        var followCursor = _ref2.followCursor;

        if (isInternalUpdate) {
          return;
        }

        if (followCursor !== undefined && prevProps.followCursor !== followCursor) {
          destroy();

          if (followCursor) {
            create();

            if (instance.state.isMounted && !wasFocusEvent && !getIsInitialBehavior()) {
              addListener();
            }
          } else {
            removeListener();
            unsetGetReferenceClientRect();
          }
        }
      },
      onMount: function onMount() {
        if (instance.props.followCursor && !wasFocusEvent) {
          if (isUnmounted) {
            onMouseMove(mouseCoords);
            isUnmounted = false;
          }

          if (!getIsInitialBehavior()) {
            addListener();
          }
        }
      },
      onTrigger: function onTrigger(_, event) {
        if (isMouseEvent(event)) {
          mouseCoords = {
            clientX: event.clientX,
            clientY: event.clientY
          };
        }

        wasFocusEvent = event.type === 'focus';
      },
      onHidden: function onHidden() {
        if (instance.props.followCursor) {
          unsetGetReferenceClientRect();
          removeListener();
          isUnmounted = true;
        }
      }
    };
  }
};

function getProps(props, modifier) {
  var _props$popperOptions;

  return {
    popperOptions: Object.assign({}, props.popperOptions, {
      modifiers: [].concat((((_props$popperOptions = props.popperOptions) == null ? void 0 : _props$popperOptions.modifiers) || []).filter(function (_ref) {
        var name = _ref.name;
        return name !== modifier.name;
      }), [modifier])
    })
  };
}

var inlinePositioning = {
  name: 'inlinePositioning',
  defaultValue: false,
  fn: function fn(instance) {
    var reference = instance.reference;

    function isEnabled() {
      return !!instance.props.inlinePositioning;
    }

    var placement;
    var cursorRectIndex = -1;
    var isInternalUpdate = false;
    var triedPlacements = [];
    var modifier = {
      name: 'tippyInlinePositioning',
      enabled: true,
      phase: 'afterWrite',
      fn: function fn(_ref2) {
        var state = _ref2.state;

        if (isEnabled()) {
          if (triedPlacements.indexOf(state.placement) !== -1) {
            triedPlacements = [];
          }

          if (placement !== state.placement && triedPlacements.indexOf(state.placement) === -1) {
            triedPlacements.push(state.placement);
            instance.setProps({
              // @ts-ignore - unneeded DOMRect properties
              getReferenceClientRect: function getReferenceClientRect() {
                return _getReferenceClientRect(state.placement);
              }
            });
          }

          placement = state.placement;
        }
      }
    };

    function _getReferenceClientRect(placement) {
      return getInlineBoundingClientRect(getBasePlacement(placement), reference.getBoundingClientRect(), arrayFrom(reference.getClientRects()), cursorRectIndex);
    }

    function setInternalProps(partialProps) {
      isInternalUpdate = true;
      instance.setProps(partialProps);
      isInternalUpdate = false;
    }

    function addModifier() {
      if (!isInternalUpdate) {
        setInternalProps(getProps(instance.props, modifier));
      }
    }

    return {
      onCreate: addModifier,
      onAfterUpdate: addModifier,
      onTrigger: function onTrigger(_, event) {
        if (isMouseEvent(event)) {
          var rects = arrayFrom(instance.reference.getClientRects());
          var cursorRect = rects.find(function (rect) {
            return rect.left - 2 <= event.clientX && rect.right + 2 >= event.clientX && rect.top - 2 <= event.clientY && rect.bottom + 2 >= event.clientY;
          });
          var index = rects.indexOf(cursorRect);
          cursorRectIndex = index > -1 ? index : cursorRectIndex;
        }
      },
      onHidden: function onHidden() {
        cursorRectIndex = -1;
      }
    };
  }
};
function getInlineBoundingClientRect(currentBasePlacement, boundingRect, clientRects, cursorRectIndex) {
  // Not an inline element, or placement is not yet known
  if (clientRects.length < 2 || currentBasePlacement === null) {
    return boundingRect;
  } // There are two rects and they are disjoined


  if (clientRects.length === 2 && cursorRectIndex >= 0 && clientRects[0].left > clientRects[1].right) {
    return clientRects[cursorRectIndex] || boundingRect;
  }

  switch (currentBasePlacement) {
    case 'top':
    case 'bottom':
      {
        var firstRect = clientRects[0];
        var lastRect = clientRects[clientRects.length - 1];
        var isTop = currentBasePlacement === 'top';
        var top = firstRect.top;
        var bottom = lastRect.bottom;
        var left = isTop ? firstRect.left : lastRect.left;
        var right = isTop ? firstRect.right : lastRect.right;
        var width = right - left;
        var height = bottom - top;
        return {
          top: top,
          bottom: bottom,
          left: left,
          right: right,
          width: width,
          height: height
        };
      }

    case 'left':
    case 'right':
      {
        var minLeft = Math.min.apply(Math, clientRects.map(function (rects) {
          return rects.left;
        }));
        var maxRight = Math.max.apply(Math, clientRects.map(function (rects) {
          return rects.right;
        }));
        var measureRects = clientRects.filter(function (rect) {
          return currentBasePlacement === 'left' ? rect.left === minLeft : rect.right === maxRight;
        });
        var _top = measureRects[0].top;
        var _bottom = measureRects[measureRects.length - 1].bottom;
        var _left = minLeft;
        var _right = maxRight;

        var _width = _right - _left;

        var _height = _bottom - _top;

        return {
          top: _top,
          bottom: _bottom,
          left: _left,
          right: _right,
          width: _width,
          height: _height
        };
      }

    default:
      {
        return boundingRect;
      }
  }
}

var sticky = {
  name: 'sticky',
  defaultValue: false,
  fn: function fn(instance) {
    var reference = instance.reference,
        popper = instance.popper;

    function getReference() {
      return instance.popperInstance ? instance.popperInstance.state.elements.reference : reference;
    }

    function shouldCheck(value) {
      return instance.props.sticky === true || instance.props.sticky === value;
    }

    var prevRefRect = null;
    var prevPopRect = null;

    function updatePosition() {
      var currentRefRect = shouldCheck('reference') ? getReference().getBoundingClientRect() : null;
      var currentPopRect = shouldCheck('popper') ? popper.getBoundingClientRect() : null;

      if (currentRefRect && areRectsDifferent(prevRefRect, currentRefRect) || currentPopRect && areRectsDifferent(prevPopRect, currentPopRect)) {
        if (instance.popperInstance) {
          instance.popperInstance.update();
        }
      }

      prevRefRect = currentRefRect;
      prevPopRect = currentPopRect;

      if (instance.state.isMounted) {
        requestAnimationFrame(updatePosition);
      }
    }

    return {
      onMount: function onMount() {
        if (instance.props.sticky) {
          updatePosition();
        }
      }
    };
  }
};

function areRectsDifferent(rectA, rectB) {
  if (rectA && rectB) {
    return rectA.top !== rectB.top || rectA.right !== rectB.right || rectA.bottom !== rectB.bottom || rectA.left !== rectB.left;
  }

  return true;
}

tippy.setDefaultProps({
  render: render
});

exports.animateFill = animateFill;
exports.createSingleton = createSingleton;
exports.default = tippy;
exports.delegate = delegate;
exports.followCursor = followCursor;
exports.hideAll = hideAll;
exports.inlinePositioning = inlinePositioning;
exports.roundArrow = ROUND_ARROW;
exports.sticky = sticky;


}).call(this,require('_process'))
},{"@popperjs/core":86,"_process":82}],86:[function(require,module,exports){
(function (process){
/**
 * @popperjs/core v2.11.6 - MIT License
 */

'use strict';

Object.defineProperty(exports, '__esModule', { value: true });

function getWindow(node) {
  if (node == null) {
    return window;
  }

  if (node.toString() !== '[object Window]') {
    var ownerDocument = node.ownerDocument;
    return ownerDocument ? ownerDocument.defaultView || window : window;
  }

  return node;
}

function isElement(node) {
  var OwnElement = getWindow(node).Element;
  return node instanceof OwnElement || node instanceof Element;
}

function isHTMLElement(node) {
  var OwnElement = getWindow(node).HTMLElement;
  return node instanceof OwnElement || node instanceof HTMLElement;
}

function isShadowRoot(node) {
  // IE 11 has no ShadowRoot
  if (typeof ShadowRoot === 'undefined') {
    return false;
  }

  var OwnElement = getWindow(node).ShadowRoot;
  return node instanceof OwnElement || node instanceof ShadowRoot;
}

var max = Math.max;
var min = Math.min;
var round = Math.round;

function getUAString() {
  var uaData = navigator.userAgentData;

  if (uaData != null && uaData.brands) {
    return uaData.brands.map(function (item) {
      return item.brand + "/" + item.version;
    }).join(' ');
  }

  return navigator.userAgent;
}

function isLayoutViewport() {
  return !/^((?!chrome|android).)*safari/i.test(getUAString());
}

function getBoundingClientRect(element, includeScale, isFixedStrategy) {
  if (includeScale === void 0) {
    includeScale = false;
  }

  if (isFixedStrategy === void 0) {
    isFixedStrategy = false;
  }

  var clientRect = element.getBoundingClientRect();
  var scaleX = 1;
  var scaleY = 1;

  if (includeScale && isHTMLElement(element)) {
    scaleX = element.offsetWidth > 0 ? round(clientRect.width) / element.offsetWidth || 1 : 1;
    scaleY = element.offsetHeight > 0 ? round(clientRect.height) / element.offsetHeight || 1 : 1;
  }

  var _ref = isElement(element) ? getWindow(element) : window,
      visualViewport = _ref.visualViewport;

  var addVisualOffsets = !isLayoutViewport() && isFixedStrategy;
  var x = (clientRect.left + (addVisualOffsets && visualViewport ? visualViewport.offsetLeft : 0)) / scaleX;
  var y = (clientRect.top + (addVisualOffsets && visualViewport ? visualViewport.offsetTop : 0)) / scaleY;
  var width = clientRect.width / scaleX;
  var height = clientRect.height / scaleY;
  return {
    width: width,
    height: height,
    top: y,
    right: x + width,
    bottom: y + height,
    left: x,
    x: x,
    y: y
  };
}

function getWindowScroll(node) {
  var win = getWindow(node);
  var scrollLeft = win.pageXOffset;
  var scrollTop = win.pageYOffset;
  return {
    scrollLeft: scrollLeft,
    scrollTop: scrollTop
  };
}

function getHTMLElementScroll(element) {
  return {
    scrollLeft: element.scrollLeft,
    scrollTop: element.scrollTop
  };
}

function getNodeScroll(node) {
  if (node === getWindow(node) || !isHTMLElement(node)) {
    return getWindowScroll(node);
  } else {
    return getHTMLElementScroll(node);
  }
}

function getNodeName(element) {
  return element ? (element.nodeName || '').toLowerCase() : null;
}

function getDocumentElement(element) {
  // $FlowFixMe[incompatible-return]: assume body is always available
  return ((isElement(element) ? element.ownerDocument : // $FlowFixMe[prop-missing]
  element.document) || window.document).documentElement;
}

function getWindowScrollBarX(element) {
  // If <html> has a CSS width greater than the viewport, then this will be
  // incorrect for RTL.
  // Popper 1 is broken in this case and never had a bug report so let's assume
  // it's not an issue. I don't think anyone ever specifies width on <html>
  // anyway.
  // Browsers where the left scrollbar doesn't cause an issue report `0` for
  // this (e.g. Edge 2019, IE11, Safari)
  return getBoundingClientRect(getDocumentElement(element)).left + getWindowScroll(element).scrollLeft;
}

function getComputedStyle(element) {
  return getWindow(element).getComputedStyle(element);
}

function isScrollParent(element) {
  // Firefox wants us to check `-x` and `-y` variations as well
  var _getComputedStyle = getComputedStyle(element),
      overflow = _getComputedStyle.overflow,
      overflowX = _getComputedStyle.overflowX,
      overflowY = _getComputedStyle.overflowY;

  return /auto|scroll|overlay|hidden/.test(overflow + overflowY + overflowX);
}

function isElementScaled(element) {
  var rect = element.getBoundingClientRect();
  var scaleX = round(rect.width) / element.offsetWidth || 1;
  var scaleY = round(rect.height) / element.offsetHeight || 1;
  return scaleX !== 1 || scaleY !== 1;
} // Returns the composite rect of an element relative to its offsetParent.
// Composite means it takes into account transforms as well as layout.


function getCompositeRect(elementOrVirtualElement, offsetParent, isFixed) {
  if (isFixed === void 0) {
    isFixed = false;
  }

  var isOffsetParentAnElement = isHTMLElement(offsetParent);
  var offsetParentIsScaled = isHTMLElement(offsetParent) && isElementScaled(offsetParent);
  var documentElement = getDocumentElement(offsetParent);
  var rect = getBoundingClientRect(elementOrVirtualElement, offsetParentIsScaled, isFixed);
  var scroll = {
    scrollLeft: 0,
    scrollTop: 0
  };
  var offsets = {
    x: 0,
    y: 0
  };

  if (isOffsetParentAnElement || !isOffsetParentAnElement && !isFixed) {
    if (getNodeName(offsetParent) !== 'body' || // https://github.com/popperjs/popper-core/issues/1078
    isScrollParent(documentElement)) {
      scroll = getNodeScroll(offsetParent);
    }

    if (isHTMLElement(offsetParent)) {
      offsets = getBoundingClientRect(offsetParent, true);
      offsets.x += offsetParent.clientLeft;
      offsets.y += offsetParent.clientTop;
    } else if (documentElement) {
      offsets.x = getWindowScrollBarX(documentElement);
    }
  }

  return {
    x: rect.left + scroll.scrollLeft - offsets.x,
    y: rect.top + scroll.scrollTop - offsets.y,
    width: rect.width,
    height: rect.height
  };
}

// means it doesn't take into account transforms.

function getLayoutRect(element) {
  var clientRect = getBoundingClientRect(element); // Use the clientRect sizes if it's not been transformed.
  // Fixes https://github.com/popperjs/popper-core/issues/1223

  var width = element.offsetWidth;
  var height = element.offsetHeight;

  if (Math.abs(clientRect.width - width) <= 1) {
    width = clientRect.width;
  }

  if (Math.abs(clientRect.height - height) <= 1) {
    height = clientRect.height;
  }

  return {
    x: element.offsetLeft,
    y: element.offsetTop,
    width: width,
    height: height
  };
}

function getParentNode(element) {
  if (getNodeName(element) === 'html') {
    return element;
  }

  return (// this is a quicker (but less type safe) way to save quite some bytes from the bundle
    // $FlowFixMe[incompatible-return]
    // $FlowFixMe[prop-missing]
    element.assignedSlot || // step into the shadow DOM of the parent of a slotted node
    element.parentNode || ( // DOM Element detected
    isShadowRoot(element) ? element.host : null) || // ShadowRoot detected
    // $FlowFixMe[incompatible-call]: HTMLElement is a Node
    getDocumentElement(element) // fallback

  );
}

function getScrollParent(node) {
  if (['html', 'body', '#document'].indexOf(getNodeName(node)) >= 0) {
    // $FlowFixMe[incompatible-return]: assume body is always available
    return node.ownerDocument.body;
  }

  if (isHTMLElement(node) && isScrollParent(node)) {
    return node;
  }

  return getScrollParent(getParentNode(node));
}

/*
given a DOM element, return the list of all scroll parents, up the list of ancesors
until we get to the top window object. This list is what we attach scroll listeners
to, because if any of these parent elements scroll, we'll need to re-calculate the
reference element's position.
*/

function listScrollParents(element, list) {
  var _element$ownerDocumen;

  if (list === void 0) {
    list = [];
  }

  var scrollParent = getScrollParent(element);
  var isBody = scrollParent === ((_element$ownerDocumen = element.ownerDocument) == null ? void 0 : _element$ownerDocumen.body);
  var win = getWindow(scrollParent);
  var target = isBody ? [win].concat(win.visualViewport || [], isScrollParent(scrollParent) ? scrollParent : []) : scrollParent;
  var updatedList = list.concat(target);
  return isBody ? updatedList : // $FlowFixMe[incompatible-call]: isBody tells us target will be an HTMLElement here
  updatedList.concat(listScrollParents(getParentNode(target)));
}

function isTableElement(element) {
  return ['table', 'td', 'th'].indexOf(getNodeName(element)) >= 0;
}

function getTrueOffsetParent(element) {
  if (!isHTMLElement(element) || // https://github.com/popperjs/popper-core/issues/837
  getComputedStyle(element).position === 'fixed') {
    return null;
  }

  return element.offsetParent;
} // `.offsetParent` reports `null` for fixed elements, while absolute elements
// return the containing block


function getContainingBlock(element) {
  var isFirefox = /firefox/i.test(getUAString());
  var isIE = /Trident/i.test(getUAString());

  if (isIE && isHTMLElement(element)) {
    // In IE 9, 10 and 11 fixed elements containing block is always established by the viewport
    var elementCss = getComputedStyle(element);

    if (elementCss.position === 'fixed') {
      return null;
    }
  }

  var currentNode = getParentNode(element);

  if (isShadowRoot(currentNode)) {
    currentNode = currentNode.host;
  }

  while (isHTMLElement(currentNode) && ['html', 'body'].indexOf(getNodeName(currentNode)) < 0) {
    var css = getComputedStyle(currentNode); // This is non-exhaustive but covers the most common CSS properties that
    // create a containing block.
    // https://developer.mozilla.org/en-US/docs/Web/CSS/Containing_block#identifying_the_containing_block

    if (css.transform !== 'none' || css.perspective !== 'none' || css.contain === 'paint' || ['transform', 'perspective'].indexOf(css.willChange) !== -1 || isFirefox && css.willChange === 'filter' || isFirefox && css.filter && css.filter !== 'none') {
      return currentNode;
    } else {
      currentNode = currentNode.parentNode;
    }
  }

  return null;
} // Gets the closest ancestor positioned element. Handles some edge cases,
// such as table ancestors and cross browser bugs.


function getOffsetParent(element) {
  var window = getWindow(element);
  var offsetParent = getTrueOffsetParent(element);

  while (offsetParent && isTableElement(offsetParent) && getComputedStyle(offsetParent).position === 'static') {
    offsetParent = getTrueOffsetParent(offsetParent);
  }

  if (offsetParent && (getNodeName(offsetParent) === 'html' || getNodeName(offsetParent) === 'body' && getComputedStyle(offsetParent).position === 'static')) {
    return window;
  }

  return offsetParent || getContainingBlock(element) || window;
}

var top = 'top';
var bottom = 'bottom';
var right = 'right';
var left = 'left';
var auto = 'auto';
var basePlacements = [top, bottom, right, left];
var start = 'start';
var end = 'end';
var clippingParents = 'clippingParents';
var viewport = 'viewport';
var popper = 'popper';
var reference = 'reference';
var variationPlacements = /*#__PURE__*/basePlacements.reduce(function (acc, placement) {
  return acc.concat([placement + "-" + start, placement + "-" + end]);
}, []);
var placements = /*#__PURE__*/[].concat(basePlacements, [auto]).reduce(function (acc, placement) {
  return acc.concat([placement, placement + "-" + start, placement + "-" + end]);
}, []); // modifiers that need to read the DOM

var beforeRead = 'beforeRead';
var read = 'read';
var afterRead = 'afterRead'; // pure-logic modifiers

var beforeMain = 'beforeMain';
var main = 'main';
var afterMain = 'afterMain'; // modifier with the purpose to write to the DOM (or write into a framework state)

var beforeWrite = 'beforeWrite';
var write = 'write';
var afterWrite = 'afterWrite';
var modifierPhases = [beforeRead, read, afterRead, beforeMain, main, afterMain, beforeWrite, write, afterWrite];

function order(modifiers) {
  var map = new Map();
  var visited = new Set();
  var result = [];
  modifiers.forEach(function (modifier) {
    map.set(modifier.name, modifier);
  }); // On visiting object, check for its dependencies and visit them recursively

  function sort(modifier) {
    visited.add(modifier.name);
    var requires = [].concat(modifier.requires || [], modifier.requiresIfExists || []);
    requires.forEach(function (dep) {
      if (!visited.has(dep)) {
        var depModifier = map.get(dep);

        if (depModifier) {
          sort(depModifier);
        }
      }
    });
    result.push(modifier);
  }

  modifiers.forEach(function (modifier) {
    if (!visited.has(modifier.name)) {
      // check for visited object
      sort(modifier);
    }
  });
  return result;
}

function orderModifiers(modifiers) {
  // order based on dependencies
  var orderedModifiers = order(modifiers); // order based on phase

  return modifierPhases.reduce(function (acc, phase) {
    return acc.concat(orderedModifiers.filter(function (modifier) {
      return modifier.phase === phase;
    }));
  }, []);
}

function debounce(fn) {
  var pending;
  return function () {
    if (!pending) {
      pending = new Promise(function (resolve) {
        Promise.resolve().then(function () {
          pending = undefined;
          resolve(fn());
        });
      });
    }

    return pending;
  };
}

function format(str) {
  for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
    args[_key - 1] = arguments[_key];
  }

  return [].concat(args).reduce(function (p, c) {
    return p.replace(/%s/, c);
  }, str);
}

var INVALID_MODIFIER_ERROR = 'Popper: modifier "%s" provided an invalid %s property, expected %s but got %s';
var MISSING_DEPENDENCY_ERROR = 'Popper: modifier "%s" requires "%s", but "%s" modifier is not available';
var VALID_PROPERTIES = ['name', 'enabled', 'phase', 'fn', 'effect', 'requires', 'options'];
function validateModifiers(modifiers) {
  modifiers.forEach(function (modifier) {
    [].concat(Object.keys(modifier), VALID_PROPERTIES) // IE11-compatible replacement for `new Set(iterable)`
    .filter(function (value, index, self) {
      return self.indexOf(value) === index;
    }).forEach(function (key) {
      switch (key) {
        case 'name':
          if (typeof modifier.name !== 'string') {
            console.error(format(INVALID_MODIFIER_ERROR, String(modifier.name), '"name"', '"string"', "\"" + String(modifier.name) + "\""));
          }

          break;

        case 'enabled':
          if (typeof modifier.enabled !== 'boolean') {
            console.error(format(INVALID_MODIFIER_ERROR, modifier.name, '"enabled"', '"boolean"', "\"" + String(modifier.enabled) + "\""));
          }

          break;

        case 'phase':
          if (modifierPhases.indexOf(modifier.phase) < 0) {
            console.error(format(INVALID_MODIFIER_ERROR, modifier.name, '"phase"', "either " + modifierPhases.join(', '), "\"" + String(modifier.phase) + "\""));
          }

          break;

        case 'fn':
          if (typeof modifier.fn !== 'function') {
            console.error(format(INVALID_MODIFIER_ERROR, modifier.name, '"fn"', '"function"', "\"" + String(modifier.fn) + "\""));
          }

          break;

        case 'effect':
          if (modifier.effect != null && typeof modifier.effect !== 'function') {
            console.error(format(INVALID_MODIFIER_ERROR, modifier.name, '"effect"', '"function"', "\"" + String(modifier.fn) + "\""));
          }

          break;

        case 'requires':
          if (modifier.requires != null && !Array.isArray(modifier.requires)) {
            console.error(format(INVALID_MODIFIER_ERROR, modifier.name, '"requires"', '"array"', "\"" + String(modifier.requires) + "\""));
          }

          break;

        case 'requiresIfExists':
          if (!Array.isArray(modifier.requiresIfExists)) {
            console.error(format(INVALID_MODIFIER_ERROR, modifier.name, '"requiresIfExists"', '"array"', "\"" + String(modifier.requiresIfExists) + "\""));
          }

          break;

        case 'options':
        case 'data':
          break;

        default:
          console.error("PopperJS: an invalid property has been provided to the \"" + modifier.name + "\" modifier, valid properties are " + VALID_PROPERTIES.map(function (s) {
            return "\"" + s + "\"";
          }).join(', ') + "; but \"" + key + "\" was provided.");
      }

      modifier.requires && modifier.requires.forEach(function (requirement) {
        if (modifiers.find(function (mod) {
          return mod.name === requirement;
        }) == null) {
          console.error(format(MISSING_DEPENDENCY_ERROR, String(modifier.name), requirement, requirement));
        }
      });
    });
  });
}

function uniqueBy(arr, fn) {
  var identifiers = new Set();
  return arr.filter(function (item) {
    var identifier = fn(item);

    if (!identifiers.has(identifier)) {
      identifiers.add(identifier);
      return true;
    }
  });
}

function getBasePlacement(placement) {
  return placement.split('-')[0];
}

function mergeByName(modifiers) {
  var merged = modifiers.reduce(function (merged, current) {
    var existing = merged[current.name];
    merged[current.name] = existing ? Object.assign({}, existing, current, {
      options: Object.assign({}, existing.options, current.options),
      data: Object.assign({}, existing.data, current.data)
    }) : current;
    return merged;
  }, {}); // IE11 does not support Object.values

  return Object.keys(merged).map(function (key) {
    return merged[key];
  });
}

function getViewportRect(element, strategy) {
  var win = getWindow(element);
  var html = getDocumentElement(element);
  var visualViewport = win.visualViewport;
  var width = html.clientWidth;
  var height = html.clientHeight;
  var x = 0;
  var y = 0;

  if (visualViewport) {
    width = visualViewport.width;
    height = visualViewport.height;
    var layoutViewport = isLayoutViewport();

    if (layoutViewport || !layoutViewport && strategy === 'fixed') {
      x = visualViewport.offsetLeft;
      y = visualViewport.offsetTop;
    }
  }

  return {
    width: width,
    height: height,
    x: x + getWindowScrollBarX(element),
    y: y
  };
}

// of the `<html>` and `<body>` rect bounds if horizontally scrollable

function getDocumentRect(element) {
  var _element$ownerDocumen;

  var html = getDocumentElement(element);
  var winScroll = getWindowScroll(element);
  var body = (_element$ownerDocumen = element.ownerDocument) == null ? void 0 : _element$ownerDocumen.body;
  var width = max(html.scrollWidth, html.clientWidth, body ? body.scrollWidth : 0, body ? body.clientWidth : 0);
  var height = max(html.scrollHeight, html.clientHeight, body ? body.scrollHeight : 0, body ? body.clientHeight : 0);
  var x = -winScroll.scrollLeft + getWindowScrollBarX(element);
  var y = -winScroll.scrollTop;

  if (getComputedStyle(body || html).direction === 'rtl') {
    x += max(html.clientWidth, body ? body.clientWidth : 0) - width;
  }

  return {
    width: width,
    height: height,
    x: x,
    y: y
  };
}

function contains(parent, child) {
  var rootNode = child.getRootNode && child.getRootNode(); // First, attempt with faster native method

  if (parent.contains(child)) {
    return true;
  } // then fallback to custom implementation with Shadow DOM support
  else if (rootNode && isShadowRoot(rootNode)) {
      var next = child;

      do {
        if (next && parent.isSameNode(next)) {
          return true;
        } // $FlowFixMe[prop-missing]: need a better way to handle this...


        next = next.parentNode || next.host;
      } while (next);
    } // Give up, the result is false


  return false;
}

function rectToClientRect(rect) {
  return Object.assign({}, rect, {
    left: rect.x,
    top: rect.y,
    right: rect.x + rect.width,
    bottom: rect.y + rect.height
  });
}

function getInnerBoundingClientRect(element, strategy) {
  var rect = getBoundingClientRect(element, false, strategy === 'fixed');
  rect.top = rect.top + element.clientTop;
  rect.left = rect.left + element.clientLeft;
  rect.bottom = rect.top + element.clientHeight;
  rect.right = rect.left + element.clientWidth;
  rect.width = element.clientWidth;
  rect.height = element.clientHeight;
  rect.x = rect.left;
  rect.y = rect.top;
  return rect;
}

function getClientRectFromMixedType(element, clippingParent, strategy) {
  return clippingParent === viewport ? rectToClientRect(getViewportRect(element, strategy)) : isElement(clippingParent) ? getInnerBoundingClientRect(clippingParent, strategy) : rectToClientRect(getDocumentRect(getDocumentElement(element)));
} // A "clipping parent" is an overflowable container with the characteristic of
// clipping (or hiding) overflowing elements with a position different from
// `initial`


function getClippingParents(element) {
  var clippingParents = listScrollParents(getParentNode(element));
  var canEscapeClipping = ['absolute', 'fixed'].indexOf(getComputedStyle(element).position) >= 0;
  var clipperElement = canEscapeClipping && isHTMLElement(element) ? getOffsetParent(element) : element;

  if (!isElement(clipperElement)) {
    return [];
  } // $FlowFixMe[incompatible-return]: https://github.com/facebook/flow/issues/1414


  return clippingParents.filter(function (clippingParent) {
    return isElement(clippingParent) && contains(clippingParent, clipperElement) && getNodeName(clippingParent) !== 'body';
  });
} // Gets the maximum area that the element is visible in due to any number of
// clipping parents


function getClippingRect(element, boundary, rootBoundary, strategy) {
  var mainClippingParents = boundary === 'clippingParents' ? getClippingParents(element) : [].concat(boundary);
  var clippingParents = [].concat(mainClippingParents, [rootBoundary]);
  var firstClippingParent = clippingParents[0];
  var clippingRect = clippingParents.reduce(function (accRect, clippingParent) {
    var rect = getClientRectFromMixedType(element, clippingParent, strategy);
    accRect.top = max(rect.top, accRect.top);
    accRect.right = min(rect.right, accRect.right);
    accRect.bottom = min(rect.bottom, accRect.bottom);
    accRect.left = max(rect.left, accRect.left);
    return accRect;
  }, getClientRectFromMixedType(element, firstClippingParent, strategy));
  clippingRect.width = clippingRect.right - clippingRect.left;
  clippingRect.height = clippingRect.bottom - clippingRect.top;
  clippingRect.x = clippingRect.left;
  clippingRect.y = clippingRect.top;
  return clippingRect;
}

function getVariation(placement) {
  return placement.split('-')[1];
}

function getMainAxisFromPlacement(placement) {
  return ['top', 'bottom'].indexOf(placement) >= 0 ? 'x' : 'y';
}

function computeOffsets(_ref) {
  var reference = _ref.reference,
      element = _ref.element,
      placement = _ref.placement;
  var basePlacement = placement ? getBasePlacement(placement) : null;
  var variation = placement ? getVariation(placement) : null;
  var commonX = reference.x + reference.width / 2 - element.width / 2;
  var commonY = reference.y + reference.height / 2 - element.height / 2;
  var offsets;

  switch (basePlacement) {
    case top:
      offsets = {
        x: commonX,
        y: reference.y - element.height
      };
      break;

    case bottom:
      offsets = {
        x: commonX,
        y: reference.y + reference.height
      };
      break;

    case right:
      offsets = {
        x: reference.x + reference.width,
        y: commonY
      };
      break;

    case left:
      offsets = {
        x: reference.x - element.width,
        y: commonY
      };
      break;

    default:
      offsets = {
        x: reference.x,
        y: reference.y
      };
  }

  var mainAxis = basePlacement ? getMainAxisFromPlacement(basePlacement) : null;

  if (mainAxis != null) {
    var len = mainAxis === 'y' ? 'height' : 'width';

    switch (variation) {
      case start:
        offsets[mainAxis] = offsets[mainAxis] - (reference[len] / 2 - element[len] / 2);
        break;

      case end:
        offsets[mainAxis] = offsets[mainAxis] + (reference[len] / 2 - element[len] / 2);
        break;
    }
  }

  return offsets;
}

function getFreshSideObject() {
  return {
    top: 0,
    right: 0,
    bottom: 0,
    left: 0
  };
}

function mergePaddingObject(paddingObject) {
  return Object.assign({}, getFreshSideObject(), paddingObject);
}

function expandToHashMap(value, keys) {
  return keys.reduce(function (hashMap, key) {
    hashMap[key] = value;
    return hashMap;
  }, {});
}

function detectOverflow(state, options) {
  if (options === void 0) {
    options = {};
  }

  var _options = options,
      _options$placement = _options.placement,
      placement = _options$placement === void 0 ? state.placement : _options$placement,
      _options$strategy = _options.strategy,
      strategy = _options$strategy === void 0 ? state.strategy : _options$strategy,
      _options$boundary = _options.boundary,
      boundary = _options$boundary === void 0 ? clippingParents : _options$boundary,
      _options$rootBoundary = _options.rootBoundary,
      rootBoundary = _options$rootBoundary === void 0 ? viewport : _options$rootBoundary,
      _options$elementConte = _options.elementContext,
      elementContext = _options$elementConte === void 0 ? popper : _options$elementConte,
      _options$altBoundary = _options.altBoundary,
      altBoundary = _options$altBoundary === void 0 ? false : _options$altBoundary,
      _options$padding = _options.padding,
      padding = _options$padding === void 0 ? 0 : _options$padding;
  var paddingObject = mergePaddingObject(typeof padding !== 'number' ? padding : expandToHashMap(padding, basePlacements));
  var altContext = elementContext === popper ? reference : popper;
  var popperRect = state.rects.popper;
  var element = state.elements[altBoundary ? altContext : elementContext];
  var clippingClientRect = getClippingRect(isElement(element) ? element : element.contextElement || getDocumentElement(state.elements.popper), boundary, rootBoundary, strategy);
  var referenceClientRect = getBoundingClientRect(state.elements.reference);
  var popperOffsets = computeOffsets({
    reference: referenceClientRect,
    element: popperRect,
    strategy: 'absolute',
    placement: placement
  });
  var popperClientRect = rectToClientRect(Object.assign({}, popperRect, popperOffsets));
  var elementClientRect = elementContext === popper ? popperClientRect : referenceClientRect; // positive = overflowing the clipping rect
  // 0 or negative = within the clipping rect

  var overflowOffsets = {
    top: clippingClientRect.top - elementClientRect.top + paddingObject.top,
    bottom: elementClientRect.bottom - clippingClientRect.bottom + paddingObject.bottom,
    left: clippingClientRect.left - elementClientRect.left + paddingObject.left,
    right: elementClientRect.right - clippingClientRect.right + paddingObject.right
  };
  var offsetData = state.modifiersData.offset; // Offsets can be applied only to the popper element

  if (elementContext === popper && offsetData) {
    var offset = offsetData[placement];
    Object.keys(overflowOffsets).forEach(function (key) {
      var multiply = [right, bottom].indexOf(key) >= 0 ? 1 : -1;
      var axis = [top, bottom].indexOf(key) >= 0 ? 'y' : 'x';
      overflowOffsets[key] += offset[axis] * multiply;
    });
  }

  return overflowOffsets;
}

var INVALID_ELEMENT_ERROR = 'Popper: Invalid reference or popper argument provided. They must be either a DOM element or virtual element.';
var INFINITE_LOOP_ERROR = 'Popper: An infinite loop in the modifiers cycle has been detected! The cycle has been interrupted to prevent a browser crash.';
var DEFAULT_OPTIONS = {
  placement: 'bottom',
  modifiers: [],
  strategy: 'absolute'
};

function areValidElements() {
  for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
    args[_key] = arguments[_key];
  }

  return !args.some(function (element) {
    return !(element && typeof element.getBoundingClientRect === 'function');
  });
}

function popperGenerator(generatorOptions) {
  if (generatorOptions === void 0) {
    generatorOptions = {};
  }

  var _generatorOptions = generatorOptions,
      _generatorOptions$def = _generatorOptions.defaultModifiers,
      defaultModifiers = _generatorOptions$def === void 0 ? [] : _generatorOptions$def,
      _generatorOptions$def2 = _generatorOptions.defaultOptions,
      defaultOptions = _generatorOptions$def2 === void 0 ? DEFAULT_OPTIONS : _generatorOptions$def2;
  return function createPopper(reference, popper, options) {
    if (options === void 0) {
      options = defaultOptions;
    }

    var state = {
      placement: 'bottom',
      orderedModifiers: [],
      options: Object.assign({}, DEFAULT_OPTIONS, defaultOptions),
      modifiersData: {},
      elements: {
        reference: reference,
        popper: popper
      },
      attributes: {},
      styles: {}
    };
    var effectCleanupFns = [];
    var isDestroyed = false;
    var instance = {
      state: state,
      setOptions: function setOptions(setOptionsAction) {
        var options = typeof setOptionsAction === 'function' ? setOptionsAction(state.options) : setOptionsAction;
        cleanupModifierEffects();
        state.options = Object.assign({}, defaultOptions, state.options, options);
        state.scrollParents = {
          reference: isElement(reference) ? listScrollParents(reference) : reference.contextElement ? listScrollParents(reference.contextElement) : [],
          popper: listScrollParents(popper)
        }; // Orders the modifiers based on their dependencies and `phase`
        // properties

        var orderedModifiers = orderModifiers(mergeByName([].concat(defaultModifiers, state.options.modifiers))); // Strip out disabled modifiers

        state.orderedModifiers = orderedModifiers.filter(function (m) {
          return m.enabled;
        }); // Validate the provided modifiers so that the consumer will get warned
        // if one of the modifiers is invalid for any reason

        if (process.env.NODE_ENV !== "production") {
          var modifiers = uniqueBy([].concat(orderedModifiers, state.options.modifiers), function (_ref) {
            var name = _ref.name;
            return name;
          });
          validateModifiers(modifiers);

          if (getBasePlacement(state.options.placement) === auto) {
            var flipModifier = state.orderedModifiers.find(function (_ref2) {
              var name = _ref2.name;
              return name === 'flip';
            });

            if (!flipModifier) {
              console.error(['Popper: "auto" placements require the "flip" modifier be', 'present and enabled to work.'].join(' '));
            }
          }

          var _getComputedStyle = getComputedStyle(popper),
              marginTop = _getComputedStyle.marginTop,
              marginRight = _getComputedStyle.marginRight,
              marginBottom = _getComputedStyle.marginBottom,
              marginLeft = _getComputedStyle.marginLeft; // We no longer take into account `margins` on the popper, and it can
          // cause bugs with positioning, so we'll warn the consumer


          if ([marginTop, marginRight, marginBottom, marginLeft].some(function (margin) {
            return parseFloat(margin);
          })) {
            console.warn(['Popper: CSS "margin" styles cannot be used to apply padding', 'between the popper and its reference element or boundary.', 'To replicate margin, use the `offset` modifier, as well as', 'the `padding` option in the `preventOverflow` and `flip`', 'modifiers.'].join(' '));
          }
        }

        runModifierEffects();
        return instance.update();
      },
      // Sync update – it will always be executed, even if not necessary. This
      // is useful for low frequency updates where sync behavior simplifies the
      // logic.
      // For high frequency updates (e.g. `resize` and `scroll` events), always
      // prefer the async Popper#update method
      forceUpdate: function forceUpdate() {
        if (isDestroyed) {
          return;
        }

        var _state$elements = state.elements,
            reference = _state$elements.reference,
            popper = _state$elements.popper; // Don't proceed if `reference` or `popper` are not valid elements
        // anymore

        if (!areValidElements(reference, popper)) {
          if (process.env.NODE_ENV !== "production") {
            console.error(INVALID_ELEMENT_ERROR);
          }

          return;
        } // Store the reference and popper rects to be read by modifiers


        state.rects = {
          reference: getCompositeRect(reference, getOffsetParent(popper), state.options.strategy === 'fixed'),
          popper: getLayoutRect(popper)
        }; // Modifiers have the ability to reset the current update cycle. The
        // most common use case for this is the `flip` modifier changing the
        // placement, which then needs to re-run all the modifiers, because the
        // logic was previously ran for the previous placement and is therefore
        // stale/incorrect

        state.reset = false;
        state.placement = state.options.placement; // On each update cycle, the `modifiersData` property for each modifier
        // is filled with the initial data specified by the modifier. This means
        // it doesn't persist and is fresh on each update.
        // To ensure persistent data, use `${name}#persistent`

        state.orderedModifiers.forEach(function (modifier) {
          return state.modifiersData[modifier.name] = Object.assign({}, modifier.data);
        });
        var __debug_loops__ = 0;

        for (var index = 0; index < state.orderedModifiers.length; index++) {
          if (process.env.NODE_ENV !== "production") {
            __debug_loops__ += 1;

            if (__debug_loops__ > 100) {
              console.error(INFINITE_LOOP_ERROR);
              break;
            }
          }

          if (state.reset === true) {
            state.reset = false;
            index = -1;
            continue;
          }

          var _state$orderedModifie = state.orderedModifiers[index],
              fn = _state$orderedModifie.fn,
              _state$orderedModifie2 = _state$orderedModifie.options,
              _options = _state$orderedModifie2 === void 0 ? {} : _state$orderedModifie2,
              name = _state$orderedModifie.name;

          if (typeof fn === 'function') {
            state = fn({
              state: state,
              options: _options,
              name: name,
              instance: instance
            }) || state;
          }
        }
      },
      // Async and optimistically optimized update – it will not be executed if
      // not necessary (debounced to run at most once-per-tick)
      update: debounce(function () {
        return new Promise(function (resolve) {
          instance.forceUpdate();
          resolve(state);
        });
      }),
      destroy: function destroy() {
        cleanupModifierEffects();
        isDestroyed = true;
      }
    };

    if (!areValidElements(reference, popper)) {
      if (process.env.NODE_ENV !== "production") {
        console.error(INVALID_ELEMENT_ERROR);
      }

      return instance;
    }

    instance.setOptions(options).then(function (state) {
      if (!isDestroyed && options.onFirstUpdate) {
        options.onFirstUpdate(state);
      }
    }); // Modifiers have the ability to execute arbitrary code before the first
    // update cycle runs. They will be executed in the same order as the update
    // cycle. This is useful when a modifier adds some persistent data that
    // other modifiers need to use, but the modifier is run after the dependent
    // one.

    function runModifierEffects() {
      state.orderedModifiers.forEach(function (_ref3) {
        var name = _ref3.name,
            _ref3$options = _ref3.options,
            options = _ref3$options === void 0 ? {} : _ref3$options,
            effect = _ref3.effect;

        if (typeof effect === 'function') {
          var cleanupFn = effect({
            state: state,
            name: name,
            instance: instance,
            options: options
          });

          var noopFn = function noopFn() {};

          effectCleanupFns.push(cleanupFn || noopFn);
        }
      });
    }

    function cleanupModifierEffects() {
      effectCleanupFns.forEach(function (fn) {
        return fn();
      });
      effectCleanupFns = [];
    }

    return instance;
  };
}

var passive = {
  passive: true
};

function effect$2(_ref) {
  var state = _ref.state,
      instance = _ref.instance,
      options = _ref.options;
  var _options$scroll = options.scroll,
      scroll = _options$scroll === void 0 ? true : _options$scroll,
      _options$resize = options.resize,
      resize = _options$resize === void 0 ? true : _options$resize;
  var window = getWindow(state.elements.popper);
  var scrollParents = [].concat(state.scrollParents.reference, state.scrollParents.popper);

  if (scroll) {
    scrollParents.forEach(function (scrollParent) {
      scrollParent.addEventListener('scroll', instance.update, passive);
    });
  }

  if (resize) {
    window.addEventListener('resize', instance.update, passive);
  }

  return function () {
    if (scroll) {
      scrollParents.forEach(function (scrollParent) {
        scrollParent.removeEventListener('scroll', instance.update, passive);
      });
    }

    if (resize) {
      window.removeEventListener('resize', instance.update, passive);
    }
  };
} // eslint-disable-next-line import/no-unused-modules


var eventListeners = {
  name: 'eventListeners',
  enabled: true,
  phase: 'write',
  fn: function fn() {},
  effect: effect$2,
  data: {}
};

function popperOffsets(_ref) {
  var state = _ref.state,
      name = _ref.name;
  // Offsets are the actual position the popper needs to have to be
  // properly positioned near its reference element
  // This is the most basic placement, and will be adjusted by
  // the modifiers in the next step
  state.modifiersData[name] = computeOffsets({
    reference: state.rects.reference,
    element: state.rects.popper,
    strategy: 'absolute',
    placement: state.placement
  });
} // eslint-disable-next-line import/no-unused-modules


var popperOffsets$1 = {
  name: 'popperOffsets',
  enabled: true,
  phase: 'read',
  fn: popperOffsets,
  data: {}
};

var unsetSides = {
  top: 'auto',
  right: 'auto',
  bottom: 'auto',
  left: 'auto'
}; // Round the offsets to the nearest suitable subpixel based on the DPR.
// Zooming can change the DPR, but it seems to report a value that will
// cleanly divide the values into the appropriate subpixels.

function roundOffsetsByDPR(_ref) {
  var x = _ref.x,
      y = _ref.y;
  var win = window;
  var dpr = win.devicePixelRatio || 1;
  return {
    x: round(x * dpr) / dpr || 0,
    y: round(y * dpr) / dpr || 0
  };
}

function mapToStyles(_ref2) {
  var _Object$assign2;

  var popper = _ref2.popper,
      popperRect = _ref2.popperRect,
      placement = _ref2.placement,
      variation = _ref2.variation,
      offsets = _ref2.offsets,
      position = _ref2.position,
      gpuAcceleration = _ref2.gpuAcceleration,
      adaptive = _ref2.adaptive,
      roundOffsets = _ref2.roundOffsets,
      isFixed = _ref2.isFixed;
  var _offsets$x = offsets.x,
      x = _offsets$x === void 0 ? 0 : _offsets$x,
      _offsets$y = offsets.y,
      y = _offsets$y === void 0 ? 0 : _offsets$y;

  var _ref3 = typeof roundOffsets === 'function' ? roundOffsets({
    x: x,
    y: y
  }) : {
    x: x,
    y: y
  };

  x = _ref3.x;
  y = _ref3.y;
  var hasX = offsets.hasOwnProperty('x');
  var hasY = offsets.hasOwnProperty('y');
  var sideX = left;
  var sideY = top;
  var win = window;

  if (adaptive) {
    var offsetParent = getOffsetParent(popper);
    var heightProp = 'clientHeight';
    var widthProp = 'clientWidth';

    if (offsetParent === getWindow(popper)) {
      offsetParent = getDocumentElement(popper);

      if (getComputedStyle(offsetParent).position !== 'static' && position === 'absolute') {
        heightProp = 'scrollHeight';
        widthProp = 'scrollWidth';
      }
    } // $FlowFixMe[incompatible-cast]: force type refinement, we compare offsetParent with window above, but Flow doesn't detect it


    offsetParent = offsetParent;

    if (placement === top || (placement === left || placement === right) && variation === end) {
      sideY = bottom;
      var offsetY = isFixed && offsetParent === win && win.visualViewport ? win.visualViewport.height : // $FlowFixMe[prop-missing]
      offsetParent[heightProp];
      y -= offsetY - popperRect.height;
      y *= gpuAcceleration ? 1 : -1;
    }

    if (placement === left || (placement === top || placement === bottom) && variation === end) {
      sideX = right;
      var offsetX = isFixed && offsetParent === win && win.visualViewport ? win.visualViewport.width : // $FlowFixMe[prop-missing]
      offsetParent[widthProp];
      x -= offsetX - popperRect.width;
      x *= gpuAcceleration ? 1 : -1;
    }
  }

  var commonStyles = Object.assign({
    position: position
  }, adaptive && unsetSides);

  var _ref4 = roundOffsets === true ? roundOffsetsByDPR({
    x: x,
    y: y
  }) : {
    x: x,
    y: y
  };

  x = _ref4.x;
  y = _ref4.y;

  if (gpuAcceleration) {
    var _Object$assign;

    return Object.assign({}, commonStyles, (_Object$assign = {}, _Object$assign[sideY] = hasY ? '0' : '', _Object$assign[sideX] = hasX ? '0' : '', _Object$assign.transform = (win.devicePixelRatio || 1) <= 1 ? "translate(" + x + "px, " + y + "px)" : "translate3d(" + x + "px, " + y + "px, 0)", _Object$assign));
  }

  return Object.assign({}, commonStyles, (_Object$assign2 = {}, _Object$assign2[sideY] = hasY ? y + "px" : '', _Object$assign2[sideX] = hasX ? x + "px" : '', _Object$assign2.transform = '', _Object$assign2));
}

function computeStyles(_ref5) {
  var state = _ref5.state,
      options = _ref5.options;
  var _options$gpuAccelerat = options.gpuAcceleration,
      gpuAcceleration = _options$gpuAccelerat === void 0 ? true : _options$gpuAccelerat,
      _options$adaptive = options.adaptive,
      adaptive = _options$adaptive === void 0 ? true : _options$adaptive,
      _options$roundOffsets = options.roundOffsets,
      roundOffsets = _options$roundOffsets === void 0 ? true : _options$roundOffsets;

  if (process.env.NODE_ENV !== "production") {
    var transitionProperty = getComputedStyle(state.elements.popper).transitionProperty || '';

    if (adaptive && ['transform', 'top', 'right', 'bottom', 'left'].some(function (property) {
      return transitionProperty.indexOf(property) >= 0;
    })) {
      console.warn(['Popper: Detected CSS transitions on at least one of the following', 'CSS properties: "transform", "top", "right", "bottom", "left".', '\n\n', 'Disable the "computeStyles" modifier\'s `adaptive` option to allow', 'for smooth transitions, or remove these properties from the CSS', 'transition declaration on the popper element if only transitioning', 'opacity or background-color for example.', '\n\n', 'We recommend using the popper element as a wrapper around an inner', 'element that can have any CSS property transitioned for animations.'].join(' '));
    }
  }

  var commonStyles = {
    placement: getBasePlacement(state.placement),
    variation: getVariation(state.placement),
    popper: state.elements.popper,
    popperRect: state.rects.popper,
    gpuAcceleration: gpuAcceleration,
    isFixed: state.options.strategy === 'fixed'
  };

  if (state.modifiersData.popperOffsets != null) {
    state.styles.popper = Object.assign({}, state.styles.popper, mapToStyles(Object.assign({}, commonStyles, {
      offsets: state.modifiersData.popperOffsets,
      position: state.options.strategy,
      adaptive: adaptive,
      roundOffsets: roundOffsets
    })));
  }

  if (state.modifiersData.arrow != null) {
    state.styles.arrow = Object.assign({}, state.styles.arrow, mapToStyles(Object.assign({}, commonStyles, {
      offsets: state.modifiersData.arrow,
      position: 'absolute',
      adaptive: false,
      roundOffsets: roundOffsets
    })));
  }

  state.attributes.popper = Object.assign({}, state.attributes.popper, {
    'data-popper-placement': state.placement
  });
} // eslint-disable-next-line import/no-unused-modules


var computeStyles$1 = {
  name: 'computeStyles',
  enabled: true,
  phase: 'beforeWrite',
  fn: computeStyles,
  data: {}
};

// and applies them to the HTMLElements such as popper and arrow

function applyStyles(_ref) {
  var state = _ref.state;
  Object.keys(state.elements).forEach(function (name) {
    var style = state.styles[name] || {};
    var attributes = state.attributes[name] || {};
    var element = state.elements[name]; // arrow is optional + virtual elements

    if (!isHTMLElement(element) || !getNodeName(element)) {
      return;
    } // Flow doesn't support to extend this property, but it's the most
    // effective way to apply styles to an HTMLElement
    // $FlowFixMe[cannot-write]


    Object.assign(element.style, style);
    Object.keys(attributes).forEach(function (name) {
      var value = attributes[name];

      if (value === false) {
        element.removeAttribute(name);
      } else {
        element.setAttribute(name, value === true ? '' : value);
      }
    });
  });
}

function effect$1(_ref2) {
  var state = _ref2.state;
  var initialStyles = {
    popper: {
      position: state.options.strategy,
      left: '0',
      top: '0',
      margin: '0'
    },
    arrow: {
      position: 'absolute'
    },
    reference: {}
  };
  Object.assign(state.elements.popper.style, initialStyles.popper);
  state.styles = initialStyles;

  if (state.elements.arrow) {
    Object.assign(state.elements.arrow.style, initialStyles.arrow);
  }

  return function () {
    Object.keys(state.elements).forEach(function (name) {
      var element = state.elements[name];
      var attributes = state.attributes[name] || {};
      var styleProperties = Object.keys(state.styles.hasOwnProperty(name) ? state.styles[name] : initialStyles[name]); // Set all values to an empty string to unset them

      var style = styleProperties.reduce(function (style, property) {
        style[property] = '';
        return style;
      }, {}); // arrow is optional + virtual elements

      if (!isHTMLElement(element) || !getNodeName(element)) {
        return;
      }

      Object.assign(element.style, style);
      Object.keys(attributes).forEach(function (attribute) {
        element.removeAttribute(attribute);
      });
    });
  };
} // eslint-disable-next-line import/no-unused-modules


var applyStyles$1 = {
  name: 'applyStyles',
  enabled: true,
  phase: 'write',
  fn: applyStyles,
  effect: effect$1,
  requires: ['computeStyles']
};

function distanceAndSkiddingToXY(placement, rects, offset) {
  var basePlacement = getBasePlacement(placement);
  var invertDistance = [left, top].indexOf(basePlacement) >= 0 ? -1 : 1;

  var _ref = typeof offset === 'function' ? offset(Object.assign({}, rects, {
    placement: placement
  })) : offset,
      skidding = _ref[0],
      distance = _ref[1];

  skidding = skidding || 0;
  distance = (distance || 0) * invertDistance;
  return [left, right].indexOf(basePlacement) >= 0 ? {
    x: distance,
    y: skidding
  } : {
    x: skidding,
    y: distance
  };
}

function offset(_ref2) {
  var state = _ref2.state,
      options = _ref2.options,
      name = _ref2.name;
  var _options$offset = options.offset,
      offset = _options$offset === void 0 ? [0, 0] : _options$offset;
  var data = placements.reduce(function (acc, placement) {
    acc[placement] = distanceAndSkiddingToXY(placement, state.rects, offset);
    return acc;
  }, {});
  var _data$state$placement = data[state.placement],
      x = _data$state$placement.x,
      y = _data$state$placement.y;

  if (state.modifiersData.popperOffsets != null) {
    state.modifiersData.popperOffsets.x += x;
    state.modifiersData.popperOffsets.y += y;
  }

  state.modifiersData[name] = data;
} // eslint-disable-next-line import/no-unused-modules


var offset$1 = {
  name: 'offset',
  enabled: true,
  phase: 'main',
  requires: ['popperOffsets'],
  fn: offset
};

var hash$1 = {
  left: 'right',
  right: 'left',
  bottom: 'top',
  top: 'bottom'
};
function getOppositePlacement(placement) {
  return placement.replace(/left|right|bottom|top/g, function (matched) {
    return hash$1[matched];
  });
}

var hash = {
  start: 'end',
  end: 'start'
};
function getOppositeVariationPlacement(placement) {
  return placement.replace(/start|end/g, function (matched) {
    return hash[matched];
  });
}

function computeAutoPlacement(state, options) {
  if (options === void 0) {
    options = {};
  }

  var _options = options,
      placement = _options.placement,
      boundary = _options.boundary,
      rootBoundary = _options.rootBoundary,
      padding = _options.padding,
      flipVariations = _options.flipVariations,
      _options$allowedAutoP = _options.allowedAutoPlacements,
      allowedAutoPlacements = _options$allowedAutoP === void 0 ? placements : _options$allowedAutoP;
  var variation = getVariation(placement);
  var placements$1 = variation ? flipVariations ? variationPlacements : variationPlacements.filter(function (placement) {
    return getVariation(placement) === variation;
  }) : basePlacements;
  var allowedPlacements = placements$1.filter(function (placement) {
    return allowedAutoPlacements.indexOf(placement) >= 0;
  });

  if (allowedPlacements.length === 0) {
    allowedPlacements = placements$1;

    if (process.env.NODE_ENV !== "production") {
      console.error(['Popper: The `allowedAutoPlacements` option did not allow any', 'placements. Ensure the `placement` option matches the variation', 'of the allowed placements.', 'For example, "auto" cannot be used to allow "bottom-start".', 'Use "auto-start" instead.'].join(' '));
    }
  } // $FlowFixMe[incompatible-type]: Flow seems to have problems with two array unions...


  var overflows = allowedPlacements.reduce(function (acc, placement) {
    acc[placement] = detectOverflow(state, {
      placement: placement,
      boundary: boundary,
      rootBoundary: rootBoundary,
      padding: padding
    })[getBasePlacement(placement)];
    return acc;
  }, {});
  return Object.keys(overflows).sort(function (a, b) {
    return overflows[a] - overflows[b];
  });
}

function getExpandedFallbackPlacements(placement) {
  if (getBasePlacement(placement) === auto) {
    return [];
  }

  var oppositePlacement = getOppositePlacement(placement);
  return [getOppositeVariationPlacement(placement), oppositePlacement, getOppositeVariationPlacement(oppositePlacement)];
}

function flip(_ref) {
  var state = _ref.state,
      options = _ref.options,
      name = _ref.name;

  if (state.modifiersData[name]._skip) {
    return;
  }

  var _options$mainAxis = options.mainAxis,
      checkMainAxis = _options$mainAxis === void 0 ? true : _options$mainAxis,
      _options$altAxis = options.altAxis,
      checkAltAxis = _options$altAxis === void 0 ? true : _options$altAxis,
      specifiedFallbackPlacements = options.fallbackPlacements,
      padding = options.padding,
      boundary = options.boundary,
      rootBoundary = options.rootBoundary,
      altBoundary = options.altBoundary,
      _options$flipVariatio = options.flipVariations,
      flipVariations = _options$flipVariatio === void 0 ? true : _options$flipVariatio,
      allowedAutoPlacements = options.allowedAutoPlacements;
  var preferredPlacement = state.options.placement;
  var basePlacement = getBasePlacement(preferredPlacement);
  var isBasePlacement = basePlacement === preferredPlacement;
  var fallbackPlacements = specifiedFallbackPlacements || (isBasePlacement || !flipVariations ? [getOppositePlacement(preferredPlacement)] : getExpandedFallbackPlacements(preferredPlacement));
  var placements = [preferredPlacement].concat(fallbackPlacements).reduce(function (acc, placement) {
    return acc.concat(getBasePlacement(placement) === auto ? computeAutoPlacement(state, {
      placement: placement,
      boundary: boundary,
      rootBoundary: rootBoundary,
      padding: padding,
      flipVariations: flipVariations,
      allowedAutoPlacements: allowedAutoPlacements
    }) : placement);
  }, []);
  var referenceRect = state.rects.reference;
  var popperRect = state.rects.popper;
  var checksMap = new Map();
  var makeFallbackChecks = true;
  var firstFittingPlacement = placements[0];

  for (var i = 0; i < placements.length; i++) {
    var placement = placements[i];

    var _basePlacement = getBasePlacement(placement);

    var isStartVariation = getVariation(placement) === start;
    var isVertical = [top, bottom].indexOf(_basePlacement) >= 0;
    var len = isVertical ? 'width' : 'height';
    var overflow = detectOverflow(state, {
      placement: placement,
      boundary: boundary,
      rootBoundary: rootBoundary,
      altBoundary: altBoundary,
      padding: padding
    });
    var mainVariationSide = isVertical ? isStartVariation ? right : left : isStartVariation ? bottom : top;

    if (referenceRect[len] > popperRect[len]) {
      mainVariationSide = getOppositePlacement(mainVariationSide);
    }

    var altVariationSide = getOppositePlacement(mainVariationSide);
    var checks = [];

    if (checkMainAxis) {
      checks.push(overflow[_basePlacement] <= 0);
    }

    if (checkAltAxis) {
      checks.push(overflow[mainVariationSide] <= 0, overflow[altVariationSide] <= 0);
    }

    if (checks.every(function (check) {
      return check;
    })) {
      firstFittingPlacement = placement;
      makeFallbackChecks = false;
      break;
    }

    checksMap.set(placement, checks);
  }

  if (makeFallbackChecks) {
    // `2` may be desired in some cases – research later
    var numberOfChecks = flipVariations ? 3 : 1;

    var _loop = function _loop(_i) {
      var fittingPlacement = placements.find(function (placement) {
        var checks = checksMap.get(placement);

        if (checks) {
          return checks.slice(0, _i).every(function (check) {
            return check;
          });
        }
      });

      if (fittingPlacement) {
        firstFittingPlacement = fittingPlacement;
        return "break";
      }
    };

    for (var _i = numberOfChecks; _i > 0; _i--) {
      var _ret = _loop(_i);

      if (_ret === "break") break;
    }
  }

  if (state.placement !== firstFittingPlacement) {
    state.modifiersData[name]._skip = true;
    state.placement = firstFittingPlacement;
    state.reset = true;
  }
} // eslint-disable-next-line import/no-unused-modules


var flip$1 = {
  name: 'flip',
  enabled: true,
  phase: 'main',
  fn: flip,
  requiresIfExists: ['offset'],
  data: {
    _skip: false
  }
};

function getAltAxis(axis) {
  return axis === 'x' ? 'y' : 'x';
}

function within(min$1, value, max$1) {
  return max(min$1, min(value, max$1));
}
function withinMaxClamp(min, value, max) {
  var v = within(min, value, max);
  return v > max ? max : v;
}

function preventOverflow(_ref) {
  var state = _ref.state,
      options = _ref.options,
      name = _ref.name;
  var _options$mainAxis = options.mainAxis,
      checkMainAxis = _options$mainAxis === void 0 ? true : _options$mainAxis,
      _options$altAxis = options.altAxis,
      checkAltAxis = _options$altAxis === void 0 ? false : _options$altAxis,
      boundary = options.boundary,
      rootBoundary = options.rootBoundary,
      altBoundary = options.altBoundary,
      padding = options.padding,
      _options$tether = options.tether,
      tether = _options$tether === void 0 ? true : _options$tether,
      _options$tetherOffset = options.tetherOffset,
      tetherOffset = _options$tetherOffset === void 0 ? 0 : _options$tetherOffset;
  var overflow = detectOverflow(state, {
    boundary: boundary,
    rootBoundary: rootBoundary,
    padding: padding,
    altBoundary: altBoundary
  });
  var basePlacement = getBasePlacement(state.placement);
  var variation = getVariation(state.placement);
  var isBasePlacement = !variation;
  var mainAxis = getMainAxisFromPlacement(basePlacement);
  var altAxis = getAltAxis(mainAxis);
  var popperOffsets = state.modifiersData.popperOffsets;
  var referenceRect = state.rects.reference;
  var popperRect = state.rects.popper;
  var tetherOffsetValue = typeof tetherOffset === 'function' ? tetherOffset(Object.assign({}, state.rects, {
    placement: state.placement
  })) : tetherOffset;
  var normalizedTetherOffsetValue = typeof tetherOffsetValue === 'number' ? {
    mainAxis: tetherOffsetValue,
    altAxis: tetherOffsetValue
  } : Object.assign({
    mainAxis: 0,
    altAxis: 0
  }, tetherOffsetValue);
  var offsetModifierState = state.modifiersData.offset ? state.modifiersData.offset[state.placement] : null;
  var data = {
    x: 0,
    y: 0
  };

  if (!popperOffsets) {
    return;
  }

  if (checkMainAxis) {
    var _offsetModifierState$;

    var mainSide = mainAxis === 'y' ? top : left;
    var altSide = mainAxis === 'y' ? bottom : right;
    var len = mainAxis === 'y' ? 'height' : 'width';
    var offset = popperOffsets[mainAxis];
    var min$1 = offset + overflow[mainSide];
    var max$1 = offset - overflow[altSide];
    var additive = tether ? -popperRect[len] / 2 : 0;
    var minLen = variation === start ? referenceRect[len] : popperRect[len];
    var maxLen = variation === start ? -popperRect[len] : -referenceRect[len]; // We need to include the arrow in the calculation so the arrow doesn't go
    // outside the reference bounds

    var arrowElement = state.elements.arrow;
    var arrowRect = tether && arrowElement ? getLayoutRect(arrowElement) : {
      width: 0,
      height: 0
    };
    var arrowPaddingObject = state.modifiersData['arrow#persistent'] ? state.modifiersData['arrow#persistent'].padding : getFreshSideObject();
    var arrowPaddingMin = arrowPaddingObject[mainSide];
    var arrowPaddingMax = arrowPaddingObject[altSide]; // If the reference length is smaller than the arrow length, we don't want
    // to include its full size in the calculation. If the reference is small
    // and near the edge of a boundary, the popper can overflow even if the
    // reference is not overflowing as well (e.g. virtual elements with no
    // width or height)

    var arrowLen = within(0, referenceRect[len], arrowRect[len]);
    var minOffset = isBasePlacement ? referenceRect[len] / 2 - additive - arrowLen - arrowPaddingMin - normalizedTetherOffsetValue.mainAxis : minLen - arrowLen - arrowPaddingMin - normalizedTetherOffsetValue.mainAxis;
    var maxOffset = isBasePlacement ? -referenceRect[len] / 2 + additive + arrowLen + arrowPaddingMax + normalizedTetherOffsetValue.mainAxis : maxLen + arrowLen + arrowPaddingMax + normalizedTetherOffsetValue.mainAxis;
    var arrowOffsetParent = state.elements.arrow && getOffsetParent(state.elements.arrow);
    var clientOffset = arrowOffsetParent ? mainAxis === 'y' ? arrowOffsetParent.clientTop || 0 : arrowOffsetParent.clientLeft || 0 : 0;
    var offsetModifierValue = (_offsetModifierState$ = offsetModifierState == null ? void 0 : offsetModifierState[mainAxis]) != null ? _offsetModifierState$ : 0;
    var tetherMin = offset + minOffset - offsetModifierValue - clientOffset;
    var tetherMax = offset + maxOffset - offsetModifierValue;
    var preventedOffset = within(tether ? min(min$1, tetherMin) : min$1, offset, tether ? max(max$1, tetherMax) : max$1);
    popperOffsets[mainAxis] = preventedOffset;
    data[mainAxis] = preventedOffset - offset;
  }

  if (checkAltAxis) {
    var _offsetModifierState$2;

    var _mainSide = mainAxis === 'x' ? top : left;

    var _altSide = mainAxis === 'x' ? bottom : right;

    var _offset = popperOffsets[altAxis];

    var _len = altAxis === 'y' ? 'height' : 'width';

    var _min = _offset + overflow[_mainSide];

    var _max = _offset - overflow[_altSide];

    var isOriginSide = [top, left].indexOf(basePlacement) !== -1;

    var _offsetModifierValue = (_offsetModifierState$2 = offsetModifierState == null ? void 0 : offsetModifierState[altAxis]) != null ? _offsetModifierState$2 : 0;

    var _tetherMin = isOriginSide ? _min : _offset - referenceRect[_len] - popperRect[_len] - _offsetModifierValue + normalizedTetherOffsetValue.altAxis;

    var _tetherMax = isOriginSide ? _offset + referenceRect[_len] + popperRect[_len] - _offsetModifierValue - normalizedTetherOffsetValue.altAxis : _max;

    var _preventedOffset = tether && isOriginSide ? withinMaxClamp(_tetherMin, _offset, _tetherMax) : within(tether ? _tetherMin : _min, _offset, tether ? _tetherMax : _max);

    popperOffsets[altAxis] = _preventedOffset;
    data[altAxis] = _preventedOffset - _offset;
  }

  state.modifiersData[name] = data;
} // eslint-disable-next-line import/no-unused-modules


var preventOverflow$1 = {
  name: 'preventOverflow',
  enabled: true,
  phase: 'main',
  fn: preventOverflow,
  requiresIfExists: ['offset']
};

var toPaddingObject = function toPaddingObject(padding, state) {
  padding = typeof padding === 'function' ? padding(Object.assign({}, state.rects, {
    placement: state.placement
  })) : padding;
  return mergePaddingObject(typeof padding !== 'number' ? padding : expandToHashMap(padding, basePlacements));
};

function arrow(_ref) {
  var _state$modifiersData$;

  var state = _ref.state,
      name = _ref.name,
      options = _ref.options;
  var arrowElement = state.elements.arrow;
  var popperOffsets = state.modifiersData.popperOffsets;
  var basePlacement = getBasePlacement(state.placement);
  var axis = getMainAxisFromPlacement(basePlacement);
  var isVertical = [left, right].indexOf(basePlacement) >= 0;
  var len = isVertical ? 'height' : 'width';

  if (!arrowElement || !popperOffsets) {
    return;
  }

  var paddingObject = toPaddingObject(options.padding, state);
  var arrowRect = getLayoutRect(arrowElement);
  var minProp = axis === 'y' ? top : left;
  var maxProp = axis === 'y' ? bottom : right;
  var endDiff = state.rects.reference[len] + state.rects.reference[axis] - popperOffsets[axis] - state.rects.popper[len];
  var startDiff = popperOffsets[axis] - state.rects.reference[axis];
  var arrowOffsetParent = getOffsetParent(arrowElement);
  var clientSize = arrowOffsetParent ? axis === 'y' ? arrowOffsetParent.clientHeight || 0 : arrowOffsetParent.clientWidth || 0 : 0;
  var centerToReference = endDiff / 2 - startDiff / 2; // Make sure the arrow doesn't overflow the popper if the center point is
  // outside of the popper bounds

  var min = paddingObject[minProp];
  var max = clientSize - arrowRect[len] - paddingObject[maxProp];
  var center = clientSize / 2 - arrowRect[len] / 2 + centerToReference;
  var offset = within(min, center, max); // Prevents breaking syntax highlighting...

  var axisProp = axis;
  state.modifiersData[name] = (_state$modifiersData$ = {}, _state$modifiersData$[axisProp] = offset, _state$modifiersData$.centerOffset = offset - center, _state$modifiersData$);
}

function effect(_ref2) {
  var state = _ref2.state,
      options = _ref2.options;
  var _options$element = options.element,
      arrowElement = _options$element === void 0 ? '[data-popper-arrow]' : _options$element;

  if (arrowElement == null) {
    return;
  } // CSS selector


  if (typeof arrowElement === 'string') {
    arrowElement = state.elements.popper.querySelector(arrowElement);

    if (!arrowElement) {
      return;
    }
  }

  if (process.env.NODE_ENV !== "production") {
    if (!isHTMLElement(arrowElement)) {
      console.error(['Popper: "arrow" element must be an HTMLElement (not an SVGElement).', 'To use an SVG arrow, wrap it in an HTMLElement that will be used as', 'the arrow.'].join(' '));
    }
  }

  if (!contains(state.elements.popper, arrowElement)) {
    if (process.env.NODE_ENV !== "production") {
      console.error(['Popper: "arrow" modifier\'s `element` must be a child of the popper', 'element.'].join(' '));
    }

    return;
  }

  state.elements.arrow = arrowElement;
} // eslint-disable-next-line import/no-unused-modules


var arrow$1 = {
  name: 'arrow',
  enabled: true,
  phase: 'main',
  fn: arrow,
  effect: effect,
  requires: ['popperOffsets'],
  requiresIfExists: ['preventOverflow']
};

function getSideOffsets(overflow, rect, preventedOffsets) {
  if (preventedOffsets === void 0) {
    preventedOffsets = {
      x: 0,
      y: 0
    };
  }

  return {
    top: overflow.top - rect.height - preventedOffsets.y,
    right: overflow.right - rect.width + preventedOffsets.x,
    bottom: overflow.bottom - rect.height + preventedOffsets.y,
    left: overflow.left - rect.width - preventedOffsets.x
  };
}

function isAnySideFullyClipped(overflow) {
  return [top, right, bottom, left].some(function (side) {
    return overflow[side] >= 0;
  });
}

function hide(_ref) {
  var state = _ref.state,
      name = _ref.name;
  var referenceRect = state.rects.reference;
  var popperRect = state.rects.popper;
  var preventedOffsets = state.modifiersData.preventOverflow;
  var referenceOverflow = detectOverflow(state, {
    elementContext: 'reference'
  });
  var popperAltOverflow = detectOverflow(state, {
    altBoundary: true
  });
  var referenceClippingOffsets = getSideOffsets(referenceOverflow, referenceRect);
  var popperEscapeOffsets = getSideOffsets(popperAltOverflow, popperRect, preventedOffsets);
  var isReferenceHidden = isAnySideFullyClipped(referenceClippingOffsets);
  var hasPopperEscaped = isAnySideFullyClipped(popperEscapeOffsets);
  state.modifiersData[name] = {
    referenceClippingOffsets: referenceClippingOffsets,
    popperEscapeOffsets: popperEscapeOffsets,
    isReferenceHidden: isReferenceHidden,
    hasPopperEscaped: hasPopperEscaped
  };
  state.attributes.popper = Object.assign({}, state.attributes.popper, {
    'data-popper-reference-hidden': isReferenceHidden,
    'data-popper-escaped': hasPopperEscaped
  });
} // eslint-disable-next-line import/no-unused-modules


var hide$1 = {
  name: 'hide',
  enabled: true,
  phase: 'main',
  requiresIfExists: ['preventOverflow'],
  fn: hide
};

var defaultModifiers$1 = [eventListeners, popperOffsets$1, computeStyles$1, applyStyles$1];
var createPopper$1 = /*#__PURE__*/popperGenerator({
  defaultModifiers: defaultModifiers$1
}); // eslint-disable-next-line import/no-unused-modules

var defaultModifiers = [eventListeners, popperOffsets$1, computeStyles$1, applyStyles$1, offset$1, flip$1, preventOverflow$1, arrow$1, hide$1];
var createPopper = /*#__PURE__*/popperGenerator({
  defaultModifiers: defaultModifiers
}); // eslint-disable-next-line import/no-unused-modules

exports.applyStyles = applyStyles$1;
exports.arrow = arrow$1;
exports.computeStyles = computeStyles$1;
exports.createPopper = createPopper;
exports.createPopperLite = createPopper$1;
exports.defaultModifiers = defaultModifiers;
exports.detectOverflow = detectOverflow;
exports.eventListeners = eventListeners;
exports.flip = flip$1;
exports.hide = hide$1;
exports.offset = offset$1;
exports.popperGenerator = popperGenerator;
exports.popperOffsets = popperOffsets$1;
exports.preventOverflow = preventOverflow$1;


}).call(this,require('_process'))
},{"_process":82}]},{},[1]);
