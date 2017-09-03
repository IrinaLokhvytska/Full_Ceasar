'use strict';
class TeachersSelect {
    constructor (url, elements) {
        this.getTeachersListUrl = url;
        this.defineElements(elements);
        this.attachEvents();
        this.teachersList = [];
        this.getTeachersFromDb();
    }

    defineElements (elements) {
        this.teachers = elements.querySelector('.teachers');
        this.addTeacher = elements.querySelector('.add-teacher');
        this.glyphicon = "glyphicon";
        this.spanClass = "glyphicon-remove";
        this.teachersClass = "teachers";
        this.addGroupBox = elements;
        this.location = elements.querySelector('.location');
    }

    attachEvents () {
        this.addTeacher.addEventListener('click', (e) => {
            e.preventDefault();
            this.addTeachersSelect();
        });
    }

    getTeachersFromDb () {
        return Frame.ajaxResponse('GET', this.getTeachersListUrl, this.saveTeachers.bind(this));
    }

    saveTeachers(data) {
        this.teachersList = data;
        this.initTeachersList();
    }

    initTeachersList () {
        this.teachersList.forEach((teacher) => {
            let opt = document.createElement('option');
            opt.value = teacher.id;
            opt.innerHTML = teacher.first_name +' '+teacher.last_name;
            this.teachers.appendChild(opt);
        });
    }

    addTeachersSelect () {
        let newTeachersSelect = document.createElement('select'),
                teachersSelectContainer = this.addGroupBox.querySelector('.teachers-selects-container'),
                span = document.createElement('span');
            newTeachersSelect.classList.add(this.teachersClass);
            teachersSelectContainer.appendChild(newTeachersSelect);
            this.teachersList.forEach((teacher) => {
                let opt = document.createElement('option');
                opt.value = teacher.id;
                opt.innerHTML = teacher.first_name +' '+teacher.last_name;
                newTeachersSelect.appendChild(opt);
            });
            span.classList.add(this.glyphicon);
            span.classList.add(this.spanClass);
            span.addEventListener('click', () => {
                this.removePreviousSibling(span);
                span.remove();
            });
            teachersSelectContainer.appendChild(span);
    }

    removePreviousSibling (span) {
        span.previousSibling.remove();
    }


}
