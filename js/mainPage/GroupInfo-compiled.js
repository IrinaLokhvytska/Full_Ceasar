'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var GroupInfo = function () {
    function GroupInfo() {
        _classCallCheck(this, GroupInfo);

        this.groupLocationText = document.querySelector('.loc-name');
        this.groupNameText = document.querySelector('.group-name');
        this.editGroupBtnElement = document.querySelector('.gear-img');
        this.deleteGroupBtnElement = document.querySelector('.trash-img');
        this.groupId = '';
        this.groupName = '';
    }

    _createClass(GroupInfo, [{
        key: 'showGroupInfo',
        value: function showGroupInfo(array) {
            this.groupId = array[0];
            this.groupName = array[1];
            this.groupLocation = array[2];
            this.groupDirection = array[3];
            this.groupStartDate = array[4];
            this.groupBudget = array[5];
            this.groupDirectionId = array[6];
            this.groupLocationId = array[7];
            this.setGroupActionBtns([this.editGroupBtnElement, this.deleteGroupBtnElement]);
            this.fillGroupFields();
        }
    }, {
        key: 'setGroupActionBtns',
        value: function setGroupActionBtns(arr) {
            var _this = this;

            arr.forEach(function (el) {
                el.dataset.groupId = _this.groupId;
                el.dataset.groupName = _this.groupName;
                el.dataset.groupLocation = _this.groupLocation;
                el.dataset.groupDirection = _this.groupDirection;
                el.dataset.groupStartDate = _this.groupStartDate;
                el.dataset.groupBudget = _this.groupBudget;
                el.dataset.groupDirectionId = _this.groupDirectionId;
                el.dataset.groupLocationId = _this.groupLocationId;
            });
        }
    }, {
        key: 'fillGroupFields',
        value: function fillGroupFields() {
            this.groupLocationText.innerHTML = this.groupLocation;
            this.groupNameText.innerHTML = this.groupName;
        }
    }]);

    return GroupInfo;
}();

//# sourceMappingURL=GroupInfo-compiled.js.map