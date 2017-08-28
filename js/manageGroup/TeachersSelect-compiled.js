'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var TeachersSelect = function () {
    function TeachersSelect(url, elements) {
        _classCallCheck(this, TeachersSelect);

        this.getTeachersListUrl = url;
        this.defineElements(elements);
        this.attachEvents();
        this.teachersList = [];
        this.getTeachersFromDb();
    }

    _createClass(TeachersSelect, [{
        key: 'defineElements',
        value: function defineElements(elements) {
            this.teachers = elements.querySelector('.teachers');
            this.addTeacher = elements.querySelector('.add-teacher');
            this.glyphicon = "glyphicon";
            this.spanClass = "glyphicon-remove";
            this.teachersClass = "teachers";
            this.addGroupBox = elements;
            this.location = elements.querySelector('.location');
        }
    }, {
        key: 'attachEvents',
        value: function attachEvents() {
            var _this = this;

            this.addTeacher.addEventListener('click', function (e) {
                e.preventDefault();
                _this.addTeachersSelect();
            });
        }
    }, {
        key: 'getTeachersFromDb',
        value: function getTeachersFromDb() {
            return Frame.ajaxResponse('GET', this.getTeachersListUrl, this.saveTeachers.bind(this));
        }
    }, {
        key: 'saveTeachers',
        value: function saveTeachers(data) {
            this.teachersList = data;
            this.initTeachersList();
        }
    }, {
        key: 'initTeachersList',
        value: function initTeachersList() {
            var _this2 = this;

            this.teachersList.forEach(function (teacher) {
                var opt = document.createElement('option');
                opt.value = teacher.id;
                opt.innerHTML = teacher.first_name + ' ' + teacher.last_name;
                _this2.teachers.appendChild(opt);
            });
        }
    }, {
        key: 'addTeachersSelect',
        value: function addTeachersSelect() {
            var _this3 = this;

            var newTeachersSelect = document.createElement('select'),
                teachersSelectContainer = this.addGroupBox.querySelector('.teachers-selects-container'),
                span = document.createElement('span');
            newTeachersSelect.classList.add(this.teachersClass);
            teachersSelectContainer.appendChild(newTeachersSelect);
            this.teachersList.forEach(function (teacher) {
                var opt = document.createElement('option');
                opt.value = teacher.id;
                opt.innerHTML = teacher.first_name + ' ' + teacher.last_name;
                newTeachersSelect.appendChild(opt);
            });
            span.classList.add(this.glyphicon);
            span.classList.add(this.spanClass);
            span.addEventListener('click', function () {
                _this3.removePreviousSibling(span);
                span.remove();
            });
            teachersSelectContainer.appendChild(span);
        }
    }, {
        key: 'removePreviousSibling',
        value: function removePreviousSibling(span) {
            span.previousSibling.remove();
        }
    }]);

    return TeachersSelect;
}();

//# sourceMappingURL=TeachersSelect-compiled.js.map