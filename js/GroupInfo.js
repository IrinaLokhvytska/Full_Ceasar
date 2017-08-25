'use strict';

class GroupInfo {
    showGroupInfo(data) {
        let gearElement = document.querySelector('.gear-img');
        gearElement.dataset.groupId = data;
        console.log(gearElement.dataset.groupId);
    }
}
