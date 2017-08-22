'use strict';

class MyGroupsListFilter extends GroupsList {
    constructor(urlArray) {
        super(urlArray);
        this.myGroupsList = [];
        this.filterOn = false;
        this.myGroupsListBtnElement = document.querySelector('.myGroupsListBtn');
        this.urlShowMyGroupsList = urlArray[0];
        this.getMyGroupsList();
        this.attachEventToBtn();
    }

    getMyGroupsList() {
        Frame.ajaxResponse('GET', this.urlShowMyGroupsList, this.saveMyGroupsList.bind(this));
    }

    saveMyGroupsList(array) {
        this.myGroupsList = array;
    }

    attachEventToBtn() {
        this.myGroupsListBtnElement.addEventListener('click', () => {
            this.pageNumber = 1;
            this.deleteGroups();
            if (!this.filterOn) {
                this.filterOn = true;
                this.createGroupsList(this.pageNumber, this.myGroupsList);
            } else {
                this.filterOn = false;
                this.createGroupsList(this.pageNumber, this.groups);
            }
        });
    }
}
