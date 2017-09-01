'use strict';
class EditGroup {

    constructor (urlArray, editGroupModalElement) {
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

    defineElements (parentEl) {
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
        this.groupsListBox = document.querySelector('.local-groups');
        this.SsOwner = parentEl.querySelector('#SsOwner');
        this.OgOwner = parentEl.querySelector('#OgOwner');
        this.classLabel = "active";
        this.teachersLists = parentEl.querySelectorAll('.teachers');
        this.expertsInputs = parentEl.querySelectorAll('.experts');
    }

    fillFields() {
        this.groupId = this.groupsListBox.dataset.groupId;
        this.name.value = this.groupsListBox.dataset.groupName;
        this.dateCourse.startDate.value = this.groupsListBox.dataset.groupStartDate;
        this.dateCourse.processDate();
        let budget = this.groupsListBox.dataset.groupBudget;
        this.setBudgetButton(budget);
        this.location.value = this.groupsListBox.dataset.groupLocationId;
        this.direction.value = this.groupsListBox.dataset.groupDirectionId;
    }

    setBudgetButton (budget) {
        if (budget === 'softserve') {
            this.SsOwner.classList.add(this.classLabel);
            this.OgOwner.classList.remove(this.classLabel);
        } else {
            this.OgOwner.classList.add(this.classLabel);
            this.SsOwner.classList.remove(this.classLabel);
        }
    }

    attachEvents () {
        if (this.editGroupBtn !== null){
            this.editGroupBtn.addEventListener('click', () => {
                this.fillFields();
            });
        }
        this.name.addEventListener('blur', () => {
            this.validateName();
        });
        this.submit.addEventListener('click', () => {
            this.save();
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' || event.keyCode === 27) {
                this.close();
            } else if (event.key === 'Enter' || event.keyCode === 13) {
                event.preventDefault();
                this.save();
            }
        });
    }

    getLocationFromDb () {
        return Frame.ajaxResponse('GET', this.getLocationsUrl, this.saveLocations.bind(this));
    }

    saveLocations(data) {
        this.locationList = data;
        this.initLocationList();
    }

    initLocationList () {
        this.locationList.forEach((location) => {
            let opt = document.createElement('option');
            opt.value = location.id;
            opt.innerHTML = location.full_name;
            this.location.appendChild(opt);
        });
    }

    validateName () {
        let name = this.name.value,
            pattern = /^[а-яА-Я0-9-\. !@#$%^&*()_=+"']{4,20}$|^[a-zA-Z0-9-\. !@#$%^&*()_=+"']{4,20}$/;

        if(20 < name.length || name.length <4) {
            this.messageBox.innerHTML = ('The length of group:4-20 chars');
            this.name.style.borderColor = "red";

            return false;

        } else {
            if (!pattern.test(name)) {
                this.messageBox.innerHTML = ('You use invalid characters');
                this.name.style.borderColor = "red";

                return false;

            } else {
                this.messageBox.style.display = "none";
                this.name.style.borderColor = "black";

                return true;
            }
        }
    }

    isValid () {
        const isNameValid = this.validateName();
        const isExpertsValid = this.experts.validateExperts();
        const isDateValid = this.dateCourse.validateDate();

        return (isNameValid && isExpertsValid && isDateValid);
    }

    save () {
        if (this.isValid()) {

            this._sendData(this._getFormData());
        } else {

            console.log('Data not send');
        }
    }

    close () {
        this.closeModal.click();
    }

    _sendData (data) {

        let xmlhttp;

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

    _getFormData () {
        let data = {};
        data.id = this.groupsListBox.dataset.groupId;
        data.name = this.name.value;
        data.location_id = this.location.value;
        data.direction_id = this.dateCourse.direction.value;
        data.start_date = this.dateCourse.startDate.value;
        data.finish_date = this.dateCourse.finishDate.value;
        data.budget =  this.budgetOwner.budgetOwner;

        let teachersLists = this.teachersLists,
            selectedTeachersIDs = [];

        teachersLists.forEach((teacherList) => {
            selectedTeachersIDs.push(parseInt(teacherList.options[teacherList.selectedIndex].value, 10));
        });
        data.teachers = selectedTeachersIDs;

        let expertsInputs = this.expertsInputs,
            expertsIDs = [];

        expertsInputs.forEach((expertInput) => {
            expertsIDs.push(expertInput.value);
        });
        data.experts = expertsIDs;
        data = JSON.stringify(data);
        console.log(data);

        return data;
    }

}
