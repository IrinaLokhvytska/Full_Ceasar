'use strict';

class GroupInfo {
    constructor() {
        this.editGroupBtnElement = document.querySelector('.gear-img');
        this.deleteGroupBtnElement = document.querySelector('.trash-img');
        this.groupId = '';
        this.groupName = '';
    }

    showGroupInfo(id, name) {
        this.groupId = id;
        this.groupName = name;
        this.setGroupActionBtns();
    }

    setGroupActionBtns() {
        this.editGroupBtnElement.dataset.groupId = this.groupId;
        this.editGroupBtnElement.dataset.groupName = this.groupName;
        this.deleteGroupBtnElement.dataset.groupId = this.groupId;
        this.deleteGroupBtnElement.dataset.groupName = this.groupName;
    }
}
