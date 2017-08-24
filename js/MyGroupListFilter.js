'use strict';

class MyGroupListFilter extends GroupList {
    constructor(urlArray) {
        super(urlArray);
        this.myGroupList = [];
        this.filterOn = false;
        this.myGroupListBtnElement = document.querySelector('.myGroupListBtn');
        this.urlShowMyGroupList = urlArray[0];
        this.getMyGroupList();
        this.attachEventToBtn();
    }

    getMyGroupList() {
        Frame.ajaxResponse('GET', this.urlShowMyGroupList, this.saveMyGroupList.bind(this));
    }

    saveMyGroupList(array) {
        this.myGroupList = array;
    }

    attachEventToBtn() {
        this.myGroupListBtnElement.addEventListener('click', () => {
            this.pageNumber = 1;
            this.deleteGroups();
            if (!this.filterOn) {
                this.filterOn = true;
                this.createGroupList(this.pageNumber, this.myGroupList);
            } else {
                this.filterOn = false;
                this.createGroupList(this.pageNumber, this.groups);
            }
        });
    }
}
