'use strict';

class GroupInfo {

    showGroupInfo(id, name) {
        this.id = id;
        let gearElement = document.querySelector('.gear-img'),
            trashElement = document.querySelector('.trash-img');
        gearElement.dataset.groupId = id;
        trashElement.dataset.groupId = id;
        trashElement.dataset.groupName = name;
    }
}
