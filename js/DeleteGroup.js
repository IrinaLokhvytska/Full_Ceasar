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
    }

    attachEvents () {
        this.buttonDelete.addEventListener('click', () => {
            this.checkDelete();
        });
    }

    checkDelete () {
        let checkDeleteBox = this.checkDeleteBox,
            confirmDeletion = document.createElement('button'),
            cancelDeletion = document.createElement('button');
        checkDeleteBox.style.display = "block";
        confirmDeletion.classList.add(this.classButton);
        confirmDeletion.classList.add(this.classDefault);
        cancelDeletion.classList.add(this.classButton);
        cancelDeletion.classList.add(this.classDefault);
        confirmDeletion.innerHTML = 'Yes';
        cancelDeletion.innerHTML = 'No';
        confirmDeletion.addEventListener('click', () =>{
            this.deleteGroup();
        });
        cancelDeletion.addEventListener('click', () =>{
            this.cancelDelete();
        });
        checkDeleteBox.appendChild(confirmDeletion);
        checkDeleteBox.appendChild(cancelDeletion);
    }

    deleteGroup () {
        this.checkDeleteBox.style.display = "none";
        location.reload();
        //this._sendData(id);
    }

    cancelDelete () {
        this.checkDeleteBox.style.display = "none";
        location.reload();
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
