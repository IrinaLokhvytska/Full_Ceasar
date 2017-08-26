'use strict';
class DeleteGroup {

    constructor (urlArray) {
        this.deleteUrl = urlArray[0];
        this.defineElements();
        this.attachEvents();
    }

    defineElements () {
        this.buttonDelete = document.querySelector('.delete-group');
        this.checkDeleteBox = document.querySelector('.check-delete');
        this.classButton = 'btn';
        this.classDefault = 'btn-default';
        this.id = document.querySelector('.gear-img').dataset.groupId;
    }

    attachEvents () {
        this.buttonDelete.addEventListener('click', () => {
            this.checkDelete();
        });
    }

    checkDelete () {
        let checkDeleteBox = this.checkDeleteBox,
            confirmDeletion = document.createElement('button'),
            cancelDeletion = document.createElement('button'),
            text = document.createElement('p'),
            name = document.querySelector('.trash-img').dataset.groupName,
            id = document.querySelector('.trash-img').dataset.groupId;
        if(id){
            checkDeleteBox.style.display = "block";
            confirmDeletion.classList.add(this.classButton);
            confirmDeletion.classList.add(this.classDefault);
            cancelDeletion.classList.add(this.classButton);
            cancelDeletion.classList.add(this.classDefault);
            text.innerHTML = 'Are you really want to delete group ' + name + ' ?';
            confirmDeletion.innerHTML = 'Yes';
            cancelDeletion.innerHTML = 'No';
            confirmDeletion.addEventListener('click', () =>{
                this.deleteGroup(id);
            });
            cancelDeletion.addEventListener('click', () =>{
                this.cancelDelete();
            });
            checkDeleteBox.appendChild(text);
            checkDeleteBox.appendChild(confirmDeletion);
            checkDeleteBox.appendChild(cancelDeletion);
        }
    }

    deleteGroup (id) {
        this.checkDeleteBox.style.display = "none";
        this._sendData(id);
    }

    cancelDelete () {
        this.checkDeleteBox.style.display = "none";
    }

    _sendData (data) {

        let xmlhttp;

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.open("POST", this.deleteUrl, false);
        xmlhttp.send(data);

        location.reload();
    }

}
