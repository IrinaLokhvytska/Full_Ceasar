'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var DeleteGroup = function () {
    function DeleteGroup(urlArray) {
        _classCallCheck(this, DeleteGroup);

        this.deleteUrl = urlArray[0];
        this.deleteAction = false;
        this.defineElements();
        this.attachEvents();
    }

    _createClass(DeleteGroup, [{
        key: 'defineElements',
        value: function defineElements() {
            this.buttonDelete = document.querySelector('.delete-group');
            this.checkDeleteBox = document.querySelector('.check-delete');
            this.classButton = 'btn';
            this.classDefault = 'btn-default';
            this.id = document.querySelector('.gear-img').dataset.groupId;
        }
    }, {
        key: 'attachEvents',
        value: function attachEvents() {
            var _this = this;

            this.buttonDelete.addEventListener('click', function () {
                _this.checkDelete();
            });
        }
    }, {
        key: 'checkDelete',
        value: function checkDelete() {
            var _this2 = this;

            var checkDeleteBox = this.checkDeleteBox,
                confirmDeletion = document.createElement('button'),
                cancelDeletion = document.createElement('button'),
                text = document.createElement('p'),
                name = document.querySelector('.trash-img').dataset.groupName,
                id = document.querySelector('.trash-img').dataset.groupId;
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
                confirmDeletion.addEventListener('click', function () {
                    _this2.deleteGroup(id);
                });
                cancelDeletion.addEventListener('click', function () {
                    _this2.cancelDelete();
                });
                checkDeleteBox.appendChild(text);
                checkDeleteBox.appendChild(confirmDeletion);
                checkDeleteBox.appendChild(cancelDeletion);
            }
        }
    }, {
        key: 'deleteGroup',
        value: function deleteGroup(id) {
            this.deleteAction = false;
            this._sendData(id);
            this.clearDeleteBox();
        }
    }, {
        key: 'cancelDelete',
        value: function cancelDelete() {
            this.deleteAction = false;
            this.clearDeleteBox();
        }
    }, {
        key: 'clearDeleteBox',
        value: function clearDeleteBox() {
            while (this.checkDeleteBox.firstChild) {
                this.checkDeleteBox.removeChild(this.checkDeleteBox.firstChild);
            }
        }
    }, {
        key: '_sendData',
        value: function _sendData(data) {
            var xmlhttp = void 0,
                id = document.querySelector('.trash-img').dataset.groupId;

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.open("POST", this.deleteUrl + '/' + id, false);
            xmlhttp.send(data);

            location.reload();
        }
    }]);

    return DeleteGroup;
}();

//# sourceMappingURL=DeleteGroup-compiled.js.map