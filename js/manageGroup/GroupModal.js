'use strict';
class GroupModal {

    constructor (urlArray, elements) {
        this.getLocationsUrl = urlArray[0];
        this.getTeachersListUrl = urlArray[1];
        this.getDirectionsListUrl = urlArray[2];
        this.createUrl = urlArray[3];
        this.editUrl = urlArray[4];
        this.defineElements(elements);
        this.attachEvents();
        this.getLocationFromDb();
    }

    defineElements (elements) {
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

    attachEvents () {
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
        return Frame.ajaxResponse('GET', this.getLocationsUrl, this.initLocation.bind(this));
    }

    initLocation (data) {
        let opt = document.createElement('option');
        opt.value = data.id;
        opt.innerHTML = data.full_name;
        this.location.appendChild(opt);
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

        xmlhttp.open("POST", this.createUrl, false);
        xmlhttp.send(data);

        this.close();
        location.reload();
    }

    _getFormData () {
        let data = {};
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
