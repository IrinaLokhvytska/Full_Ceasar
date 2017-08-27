'use strict';

class GroupInfo {
    constructor() {
        this.editGroupBtnElement = document.querySelector('.gear-img');
        this.deleteGroupBtnElement = document.querySelector('.trash-img');
        this.groupId = '';
        this.groupName = '';
    }

    showGroupInfo(array) {
        console.log(array);
        this.groupId = array[0];
        this.groupName = array[1];
        this.groupLocation = array[2];
        this.groupDirection = array[3];
        this.groupStartDate = array[4];
        this.groupBudget = array[5];
        this.setGroupActionBtns([this.editGroupBtnElement, this.deleteGroupBtnElement]);
    }

    setGroupActionBtns(arr) {
        arr.forEach((el) => {
            el.dataset.groupId = this.groupId;
            el.dataset.groupName = this.groupName;
            el.dataset.groupLocation = this.groupLocation;
            el.dataset.groupDirection = this.groupDirection;
            el.dataset.groupStartDate = this.groupStartDate;
            el.dataset.groupBudget = this.groupBudget;
        });
    }
}
