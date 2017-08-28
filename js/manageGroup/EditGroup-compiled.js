'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var EditGroup = function () {
    function EditGroup(urlArray, editGroupModalElement) {
        _classCallCheck(this, EditGroup);

        this.getLocationsUrl = urlArray[0];
        this.getTeachersListUrl = urlArray[1];
        this.getDirectionsListUrl = urlArray[2];
        this.createUrl = urlArray[3];
        this.editUrl = urlArray[4];
        this.editGroupModalElement = editGroupModalElement;
        this.defineElements(this.editGroupModalElement);
        this.attachEvents();
        this.getLocationFromDb();
        this.locationList = [];
    }

    _createClass(EditGroup, [{
        key: 'defineElements',
        value: function defineElements(parentEl) {
            this.dateCourse = new DateCourse(this.getDirectionsListUrl, parentEl);
            this.budgetOwner = new BudgetOwner(parentEl);
            this.teachers = new TeachersSelect(this.getTeachersListUrl, parentEl);
            this.experts = new ExpertsInput(parentEl);
            this.name = parentEl.querySelector('.groupName');
            this.location = parentEl.querySelector('select.location');
            this.direction = parentEl.querySelector('select.direction');
            this.submit = parentEl.querySelector('.submit');
            this.closeModal = parentEl.querySelector('.close-modal');
            this.messageBox = document.querySelector('.errorName');
            this.editGroupBtn = document.querySelector('.gear-img');
            this.SsOwner = parentEl.querySelector('#SsOwner');
            this.OgOwner = parentEl.querySelector('#OgOwner');
            this.classLabel = "active";
            this.teachersLists = parentEl.querySelectorAll('.teachers');
            this.expertsInputs = parentEl.querySelectorAll('.experts');
        }
    }, {
        key: 'fillFields',
        value: function fillFields() {
            this.groupId = this.editGroupBtn.dataset.groupId;
            this.name.value = this.editGroupBtn.dataset.groupName;
            this.dateCourse.startDate.value = this.editGroupBtn.dataset.groupStartDate;
            this.dateCourse.processDate();
            var budget = this.editGroupBtn.dataset.groupBudget;
            this.setBudgetButton(budget);
            this.location.value = this.editGroupBtn.dataset.groupLocationId;
            this.direction.value = this.editGroupBtn.dataset.groupDirectionId;
        }
    }, {
        key: 'setBudgetButton',
        value: function setBudgetButton(budget) {
            if (budget === 'softserve') {
                this.SsOwner.classList.add(this.classLabel);
                this.OgOwner.classList.remove(this.classLabel);
            } else {
                this.OgOwner.classList.add(this.classLabel);
                this.SsOwner.classList.remove(this.classLabel);
            }
        }
    }, {
        key: 'attachEvents',
        value: function attachEvents() {
            var _this = this;

            this.editGroupBtn.addEventListener('click', function () {
                _this.fillFields();
            });
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
            return Frame.ajaxResponse('GET', this.getLocationsUrl, this.saveLocations.bind(this));
        }
    }, {
        key: 'saveLocations',
        value: function saveLocations(data) {
            this.locationList = data;
            this.initLocationList();
        }
    }, {
        key: 'initLocationList',
        value: function initLocationList() {
            var _this2 = this;

            this.locationList.forEach(function (location) {
                var opt = document.createElement('option');
                opt.value = location.id;
                opt.innerHTML = location.full_name;
                _this2.location.appendChild(opt);
            });
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

            xmlhttp.open("POST", this.editUrl, false);
            xmlhttp.send(data);

            this.close();
            location.reload();
        }
    }, {
        key: '_getFormData',
        value: function _getFormData() {
            var data = {};
            data.id = this.editGroupBtn.dataset.groupId;
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

    return EditGroup;
}();

//# sourceMappingURL=EditGroup-compiled.js.map