'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var DateCourse = function () {
    function DateCourse(url, elements) {
        _classCallCheck(this, DateCourse);

        this.getDirectionsListUrl = url;
        this.defineElements(elements);
        this.attachEvents();
        this.directionList = [];
        this.getDirectionsFromDb();
    }

    _createClass(DateCourse, [{
        key: 'defineElements',
        value: function defineElements(elements) {
            this.direction = elements.querySelector('.direction');
            this.startDate = elements.querySelector('.startDate');
            this.finishDate = elements.querySelector('.finishDate');
            this.messageBox = elements.querySelector('.errorDate');
        }
    }, {
        key: 'attachEvents',
        value: function attachEvents() {
            var _this = this;

            this.direction.addEventListener('change', function () {
                _this.processDate();
            });
            this.startDate.addEventListener('change', function () {
                _this.processDate();
            });
            this.startDate.addEventListener('blur', function () {
                _this.validateDate();
            });
        }
    }, {
        key: 'getDirectionsFromDb',
        value: function getDirectionsFromDb() {
            return Frame.ajaxResponse('GET', this.getDirectionsListUrl, this.saveDirections.bind(this));
        }
    }, {
        key: 'saveDirections',
        value: function saveDirections(data) {
            this.directionList = data;
            this.initDirectionList();
        }
    }, {
        key: 'initDirectionList',
        value: function initDirectionList() {
            var _this2 = this;

            this.directionList.forEach(function (direction) {
                var opt = document.createElement('option');
                opt.value = direction.id;
                opt.innerHTML = direction.name;
                _this2.direction.appendChild(opt);
            });
        }
    }, {
        key: 'validateDate',
        value: function validateDate() {
            if (!this.startDate.value) {
                this.messageBox.innerHTML = 'Please, select the start date';
                this.startDate.style.borderColor = "red";

                return false;
            } else {
                this.messageBox.style.display = "none";
                this.startDate.style.borderColor = "black";

                return true;
            }
        }
    }, {
        key: 'processDate',
        value: function processDate() {
            var startDate = this.startDate.value,
                direction = this.direction.value,
                finishDate = void 0;

            finishDate = this.defineFinishDate(startDate, direction);
            this.finishDate.value = this.dateToUTC(finishDate);
        }
    }, {
        key: 'defineFinishDate',
        value: function defineFinishDate(startDate, direction) {
            var sPerHour = 3600,
                msPerDay = 24 * sPerHour * 1000;
            var start = new Date(startDate),
                shift = this.getShift(direction),
                saturday = 6,
                sunday = 0,
                finish = void 0,
                day = void 0;

            finish = new Date(start.getTime() + shift);
            day = finish.getUTCDay();

            if (day === saturday) {
                finish = new Date(finish.getTime() + 2 * msPerDay);
            } else if (day === sunday) {
                finish = new Date(finish.getTime() + msPerDay);
            }

            return finish;
        }
    }, {
        key: 'getShift',
        value: function getShift(direction) {
            var sPerHour = 3600,
                msPerDay = 24 * sPerHour * 1000,
                msPerWeek = 7 * msPerDay,
                courseWeek = [9, 12];
            var dateInMilliseconds = void 0;

            if (direction === 'MQC' || direction === 'ISTQB') {
                dateInMilliseconds = courseWeek[0] * msPerWeek;
            } else {
                dateInMilliseconds = courseWeek[1] * msPerWeek;
            }

            return dateInMilliseconds;
        }
    }, {
        key: 'dateToUTC',
        value: function dateToUTC(date) {
            var yyyy = void 0,
                mm = void 0,
                dd = void 0,
                out = void 0;

            yyyy = date.getUTCFullYear();
            mm = this.normalize(date.getUTCMonth() + 1);
            dd = this.normalize(date.getUTCDate());

            out = yyyy + '-' + mm + '-' + dd;

            return out;
        }
    }, {
        key: 'normalize',
        value: function normalize(item) {
            return item < 10 ? '0' + item : item;
        }
    }]);

    return DateCourse;
}();

//# sourceMappingURL=DateCourse-compiled.js.map