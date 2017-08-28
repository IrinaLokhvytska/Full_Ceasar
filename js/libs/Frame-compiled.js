'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Frame = function () {
    function Frame() {
        _classCallCheck(this, Frame);
    }

    _createClass(Frame, null, [{
        key: 'ajaxRequest',
        value: function ajaxRequest(method, request) {
            var async = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;

            var xhr = new XMLHttpRequest();

            xhr.open(method, request, async);
            xhr.send();
        }
    }, {
        key: 'ajaxResponse',
        value: function ajaxResponse(method, request, callback) {
            var async = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : true;

            var xhr = new XMLHttpRequest(),
                data = '';

            xhr.open(method, request, async);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    data = JSON.parse(xhr.responseText);
                    if (callback !== undefined) {
                        callback(data);
                    }
                } else {
                    data = 'Server is not responding';
                    return data;
                }
            };
            xhr.send();
        }
    }]);

    return Frame;
}();

//# sourceMappingURL=Frame-compiled.js.map