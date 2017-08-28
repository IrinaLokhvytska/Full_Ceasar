'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var GroupWindow = function () {
    function GroupWindow(el) {
        _classCallCheck(this, GroupWindow);

        this.tabsEl = el;
        this.btnInfo = this.tabsEl.querySelector('.tabInfo');
        this.btnStudents = this.tabsEl.querySelector('.tabStudents');
        this.btnSchedule = this.tabsEl.querySelector('.tabSchedule');
        this.btnNotifications = this.tabsEl.querySelector('.tabNotification');
    }

    _createClass(GroupWindow, [{
        key: 'attachEvents',
        value: function attachEvents() {
            this.btnInfo.addEventListener('click', function () {
                Frame.ajaxRequest('GET', 'getGroupInfo');
            });

            this.btnStudents.addEventListener('click', function () {
                Frame.ajaxRequest('GET', 'getStudentList');
            });

            this.btnSchedule.addEventListener('click', function () {
                Frame.ajaxRequest('GET', 'getSchedule');
            });

            this.btnNotifications.addEventListener('click', function () {
                Frame.ajaxRequest('GET', 'getNotifications');
            });
        }
    }]);

    return GroupWindow;
}();

//# sourceMappingURL=GroupWindow-compiled.js.map