'use strict';
class GroupModal {
    
    constructor (elements) {
        this.defineElements(elements);
        this.attachEvents();
    }

    defineElements (elements) {
        this.dateCourse = new DateCourse(elements);
        this.budgetOwner = new BudgetOwner(elements);
        this.teachers = new TeachersSelect(elements);
        this.experts = new ExpertsInput(elements);
        this.modalGroup = document.querySelector('#groupModal');
        this.name = elements.querySelector('.groupName');
        this.location = elements.querySelector('.location');
        this.submit = elements.querySelector('.submit');
        this.closeModal = elements.querySelector('.close-modal');
        this.messageBox = document.querySelector('.errorName');
    }

    attachEvents () {
        this.name.addEventListener('blur', () => {
            this.validateName()
        });
        this.submit.addEventListener('click', () => {
            this.save()
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' || event.keyCode === 27) {
                this.close();
            }
        });
        document.addEventListener('keydown', event => {
            if (event.key === 'Enter' || event.keyCode === 71) {
                this.save();
            }
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

        xmlhttp.open("POST", "group/receive", false);
        xmlhttp.send(data);
    }

    _getFormData () {
        let data = {};
        data.name = this.name.value;
        data.direction = this.dateCourse.direction.value;
        data.budgetOwner =  this.budgetOwner.budgetOwner;
        data.startDate = this.dateCourse.startDate.value;
        data.location = this.location.value;
        data.finishDate = this.dateCourse.finishDate.value;

        let teachersLists = document.querySelectorAll('.teachers'),
            selectedTeachersIDs = [];

        teachersLists.forEach((teacherList) => {
            selectedTeachersIDs.push(parseInt(teacherList.options[teacherList.selectedIndex].value));
        });
        data.teachers = selectedTeachersIDs;

        let expertsInputs = document.querySelectorAll('.experts'),
            expertsIDs = [];

        expertsInputs.forEach((expertInput) => {
            expertsIDs.push(expertInput.value);
        });
        data.experts = expertsIDs;

        console.log(data);

        return data;
    }
}