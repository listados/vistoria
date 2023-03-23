webpackJsonp([4],{

/***/ 286:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(287);


/***/ }),

/***/ 287:
/***/ (function(module, exports) {

var Admin = function () {
    function domainComplet() {
        var project_survey = '/';
        domin = window.location.protocol + "//" + window.location.hostname + ':';
        domin + project_survey;
        var url = window.location.origin;
        return url;
    }
    return {
        baseUrl: domainComplet
    };
}();

/***/ })

},[286]);