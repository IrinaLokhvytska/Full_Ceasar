'use strict';

class GroupInfo {
    constructor() {
        this.groupId = '';
        this.groupName = '';
        this.defineElements();
    }

    defineElements()
    {
        this.groupLocationText = document.querySelector('.loc-name');
        this.groupNameText = document.querySelector('.group-name');
        this.groupListBox = document.querySelector('.local-groups');
        this.groupStatusBox = document.querySelector('.status');
        this.groupStartDateText = document.querySelector('.start-date-table');
        this.groupFinishDateText = document.querySelector('.finish-date-table');
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
        this.setGroupActionBtns(this.groupListBox);
        this.fillGroupFields();
    }

    setGroupActionBtns(el) {
        el.dataset.groupId = this.groupId;
        el.dataset.groupName = this.groupName;
        el.dataset.groupLocation = this.groupLocation;
        el.dataset.groupDirection = this.groupDirection;
        el.dataset.groupStartDate = this.groupStartDate;
        el.dataset.groupBudget = this.groupBudget;
        el.dataset.groupDirectionId = this.groupDirectionId;
        el.dataset.groupLocationId = this.groupLocationId;
        el.dataset.groupFinishDate = this.groupFinishDate;
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

        this.setGroupStatus();
    }

    setGroupStatus()
    {
        let today = new Date(),
            groupStartDate = new Date(),
            groupFinishDate = new Date(),
            groupStartDateArr = this.groupStartDate.split('-'),
            groupFinishDateArr = this.groupFinishDate.split('-'),
            startMonth = parseInt(groupStartDateArr[1], 10) - 1,
            finishMonth = parseInt(groupFinishDateArr[1], 10) - 1,
            status = '';

        groupStartDate.setFullYear(groupStartDateArr[0], startMonth, groupStartDateArr[2]);
        groupFinishDate.setFullYear(groupFinishDateArr[0], finishMonth, groupFinishDateArr[2]);

        if (groupStartDate <= today && groupFinishDate >= today) {
            status = 'in process';
        }
        if (groupStartDate < today && groupFinishDate < today) {
            status = 'finished';
        }
        if (groupStartDate > today) {
            status = 'future';
        }

        this.groupStatusBox.innerHTML = 'Stage: ' + status;
    }
}
