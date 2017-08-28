'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var GroupModal = function () {
    function GroupModal(urlArray, elements) {
        _classCallCheck(this, GroupModal);

        this.getLocationsUrl = urlArray[0];
        this.getTeachersListUrl = urlArray[1];
        this.getDirectionsListUrl = urlArray[2];
        this.createUrl = urlArray[3];
        this.editUrl = urlArray[4];
        this.defineElements(elements);
        this.attachEvents();
        this.getLocationFromDb();
    }

    _createClass(GroupModal, [{
        key: 'defineElements',
        value: function defineElements(elements) {
            this.dateCourse = new DateCourse(this.getDirectionsListUrl, elements);
            this.budgetOwner = new BudgetOwner(elements);
            this.teachers = new TeachersSelect(this.getTeachersListUrl, elements);
            this.experts = new ExpertsInput(elements);
            this.name = elements.querySelector('.groupName');
            this.location = elements.querySelector('.location');
            this.submit = elements.querySelector('.submit');
            this.closeModal = elements.querySelector('.close-modal');
            this.messageBox = elements.querySelector('.errorName');
            this.teachersLists = elements.querySelectorAll('.teachers');
            this.expertsInputs = document.querySelectorAll('.experts');
        }
    }, {
        key: 'attachEvents',
        value: function attachEvents() {
            var _this = this;

            this.name.addEventListener('blur', function () {
                _this.validateName();
            });
            this.submit.addEventListener('click', function () {
                _this.save();
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' || event.keyCode === 27) {
                    _this.close();
                } else if (event.key === 'Enter' || event.keyCode === 13) {
                    event.preventDefault();
                    _this.save();
                }
            });
        }
    }, {
        key: 'getLocationFromDb',
        value: function getLocationFromDb() {
            return Frame.ajaxResponse('GET', this.getLocationsUrl, this.initLocation.bind(this));
        }
    }, {
        key: 'initLocation',
        value: function initLocation(data) {
            var opt = document.createElement('option');
            opt.value = data.id;
            opt.innerHTML = data.full_name;
            this.location.appendChild(opt);
        }
    }, {
        key: 'validateName',
        value: function validateName() {
            var name = this.name.value,
                pattern = /^[а-яА-Я0-9-\. !@#$%^&*()_=+"']{4,20}$|^[a-zA-Z0-9-\. !@#$%^&*()_=+"']{4,20}$/;

            if (20 < name.length || name.length < 4) {
                this.messageBox.innerHTML = 'The length of group:4-20 chars';
                this.name.style.borderColor = "red";

                return false;
            } else {
                if (!pattern.test(name)) {
                    this.messageBox.innerHTML = 'You use invalid characters';
                    this.name.style.borderColor = "red";

                    return false;
                } else {
                    this.messageBox.style.display = "none";
                    this.name.style.borderColor = "black";

                    return true;
                }
            }
        }
    }, {
        key: 'isValid',
        value: function isValid() {
            var isNameValid = this.validateName();
            var isExpertsValid = this.experts.validateExperts();
            var isDateValid = this.dateCourse.validateDate();

            return isNameValid && isExpertsValid && isDateValid;
        }
    }, {
        key: 'save',
        value: function save() {
            if (this.isValid()) {

                this._sendData(this._getFormData());
            } else {

                console.log('Data not send');
            }
        }
    }, {
        key: 'close',
        value: function close() {
            this.closeModal.click();
        }
    }, {
        key: '_sendData',
        value: function _sendData(data) {

            var xmlhttp = void 0;

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.open("POST", this.createUrl, false);
            xmlhttp.send(data);

            this.close();
            location.reload();
        }
    }, {
        key: '_getFormData',
        value: function _getFormData() {
            var data = {};
            data.name = this.name.value;
            data.location_id = this.location.value;
            data.direction_id = this.dateCourse.direction.value;
            data.start_date = this.dateCourse.startDate.value;
            data.finish_date = this.dateCourse.finishDate.value;
            data.budget = this.budgetOwner.budgetOwner;

            var teachersLists = this.teachersLists,
                selectedTeachersIDs = [];

            teachersLists.forEach(function (teacherList) {
                selectedTeachersIDs.push(parseInt(teacherList.options[teacherList.selectedIndex].value));
            });
            data.teachers = selectedTeachersIDs;

            var expertsInputs = this.expertsInputs,
                expertsIDs = [];

            expertsInputs.forEach(function (expertInput) {
                expertsIDs.push(expertInput.value);
            });
            data.experts = expertsIDs;
            data = JSON.stringify(data);
            console.log(data);

            return data;
        }
    }]);

    return GroupModal;
}();

//# sourceMappingURL=GroupModal-compiled.js.map