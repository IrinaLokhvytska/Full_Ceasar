'use strict';
'use strict';
class TeachersSelect {
    constructor (elements) {
        this.defineElements(elements);
        this.attachEvents();
        this.teachersList = [
             {id : 0, name : 'J Doe'},
            {id: 1, name: 'L Smith'},
            {id: 2, name: 'B Foo'}
        ];
        // this.getTeachersFromDb((teachers) => {
        //      this.teachersList = teachers;
        // });
        this.unusedTeachersList = this.teachersList.slice();
        this.initTeachersList();
    }

    defineElements (elements) {
        this.teachers = elements.querySelector('.teachers');
        this.addTeacher = elements.querySelector('.add-teacher');
        this.glyphicon = "glyphicon";
        this.spanClass = "glyphicon-remove";
        this.teachersClass = "teachers";
    }

    attachEvents () {
        this.addTeacher.addEventListener('click', (e) => {
            e.preventDefault();
            this.addTeachersSelect()
        });
    }

    getTeachersFromDb (teachers) {
        this.getXMLHttpRequest('/group/getteacherslist', 'teachers', teachers);
    }

    getXMLHttpRequest (url, request, callback) {
        let xhr = new XMLHttpRequest();

        xhr.open('GET', url + '?' + request);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                callback(JSON.parse(xhr.responseText));
            }
        };
        xhr.send();
    }

    initTeachersList () {
        this.teachersList.forEach((teacher) => {
            let opt = document.createElement('option');
            opt.value = teacher.id;
            opt.innerHTML = teacher.name;
            this.teachers.appendChild(opt);
        });
    }

    addTeachersSelect () {
        let teachersLists = document.querySelectorAll('.teachers');

        teachersLists.forEach((teacherList) => {
            this.removeSelectedTeacher(teacherList, this.unusedTeachersList);
        });
        if (this.unusedTeachersList.length > 0) {
            let newTeachersSelect = document.createElement('select'),
                teachersSelectContainer = document.querySelector('.teachers-selects-container'),
                span = document.createElement('span');
            newTeachersSelect.classList.add(this.teachersClass);
            teachersSelectContainer.appendChild(newTeachersSelect);
            this.unusedTeachersList.forEach((unusedTeacher) => {
                let opt = document.createElement('option');
                opt.value = unusedTeacher.id;
                opt.innerHTML = unusedTeacher.name;
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
    }

    removeSelectedTeacher (select, unusedTeachers){
        let selectedOptionValue = parseInt(select.options[select.selectedIndex].value),
            deleteIndex = this._searchByID(unusedTeachers, selectedOptionValue);
        if (typeof deleteIndex !== 'undefined') {
            this.unusedTeachersList.splice(deleteIndex, 1);
        }

    }

    removePreviousSibling (span) {
        span.previousSibling.remove();
    }

    _searchByID (array, id) {
        for (let i = 0; i < array.length; i++) {
            if (array[i].id === id) {
                return i;
            }
        }
    }

}
