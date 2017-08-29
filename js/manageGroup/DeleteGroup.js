'use strict';

class DeleteGroup {

    constructor(urlArray) {
        this.deleteUrl = urlArray[0];
        this.deleteAction = false;
        this.defineElements();
        this.attachEvents();
    }

    defineElements() {
        this.groupsListBox = document.querySelector('.local-groups');
        this.buttonDelete = document.querySelector('.delete-group');
        this.checkDeleteBox = document.querySelector('.check-delete');
        this.classButton = 'btn';
        this.classDefault = 'btn-default';
        this.id = this.groupsListBox.dataset.groupId;
    }

    attachEvents() {
        if (this.buttonDelete !== null) {
            this.buttonDelete.addEventListener('click', () => {
                this.checkDelete();
            });
        }
    }

    checkDelete() {
        let checkDeleteBox = this.checkDeleteBox,
            confirmDeletion = document.createElement('button'),
            cancelDeletion = document.createElement('button'),
            text = document.createElement('p'),
            name = this.groupsListBox.dataset.groupName,
            id = this.groupsListBox.dataset.groupId;
        if (id && this.deleteAction === false) {
            this.deleteAction = true;
            checkDeleteBox.style.display = "block";
            confirmDeletion.classList.add(this.classButton);
            confirmDeletion.classList.add(this.classDefault);
            cancelDeletion.classList.add(this.classButton);
            cancelDeletion.classList.add(this.classDefault);
            text.innerHTML = 'Do you really want to delete group ' + name + ' ?';
            confirmDeletion.innerHTML = 'Yes';
            cancelDeletion.innerHTML = 'No';
            confirmDeletion.addEventListener('click', () => {
                this.deleteGroup(id);
            });
            cancelDeletion.addEventListener('click', () => {
                this.cancelDelete();
            });
            checkDeleteBox.appendChild(text);
            checkDeleteBox.appendChild(confirmDeletion);
            checkDeleteBox.appendChild(cancelDeletion);
        }
    }

    deleteGroup(id) {
        this.deleteAction = false;
        this._sendData(id);
        this.clearDeleteBox();
    }

    cancelDelete() {
        this.deleteAction = false;
        this.clearDeleteBox();
    }

    clearDeleteBox() {
        while (this.checkDeleteBox.firstChild) {
            this.checkDeleteBox.removeChild(this.checkDeleteBox.firstChild);
        }
    }

    _sendData(data) {
        let xmlhttp,
            id = this.groupsListBox.dataset.groupId;

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.open("POST", this.deleteUrl + '/' + id, false);
        xmlhttp.send(data);

        location.reload();
    }

}
