'use strict';

class GroupInfo {
    constructor() {
        this.groupLocationText = document.querySelector('.loc-name');
        this.groupNameText = document.querySelector('.group-name');
        this.groupStartDateText = document.querySelector('.start-date-table');
        this.groupFinishDateText = document.querySelector('.finish-date-table');
        this.editGroupBtnElement = document.querySelector('.gear-img');
        this.deleteGroupBtnElement = document.querySelector('.trash-img');
        this.groupId = '';
        this.groupName = '';
    }

    showGroupInfo(array) {
        this.groupId = array[0];
        this.groupName = array[1];
        this.groupLocation = array[2];
        this.groupDirection = array[3];
        this.groupStartDate = array[4];
        this.groupBudget = array[5];
        this.groupDirectionId = array[6];
        this.groupLocationId = array[7];
        this.groupFinishDate = array[8];
        this.setGroupActionBtns([this.editGroupBtnElement, this.deleteGroupBtnElement]);
        this.fillGroupFields();
    }

    setGroupActionBtns(arr) {
        arr.forEach((el) => {
            el.dataset.groupId = this.groupId;
            el.dataset.groupName = this.groupName;
            el.dataset.groupLocation = this.groupLocation;
            el.dataset.groupDirection = this.groupDirection;
            el.dataset.groupStartDate = this.groupStartDate;
            el.dataset.groupBudget = this.groupBudget;
            el.dataset.groupDirectionId = this.groupDirectionId;
            el.dataset.groupLocationId = this.groupLocationId;
            el.dataset.groupFinishDate = this.groupFinishDate;
        });
    }

    fillGroupFields() {
        this.groupLocationText.innerHTML = this.groupLocation;
        this.groupNameText.innerHTML = this.groupName;
        if (this.groupStartDate === null) {
            this.groupStartDateText.innerHTML = "undefined";
        } else {
            this.groupStartDateText.innerHTML = this.groupStartDate;
        }

        if (this.groupFinishDate === null) {
            this.groupFinishDateText.innerHTML = "undefined";
        } else {
            this.groupFinishDateText.innerHTML = this.groupFinishDate;
        }
    }
}
