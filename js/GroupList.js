'use strict';

class GroupList {
    constructor(urlArray, groupInfoElement, locationsList) {
        this.locationsList = locationsList;
        this.urlGetGroupList = urlArray[0];
        this.urlShowGroup = urlArray[1];
        this.urlShowMyGroupList = urlArray[2];
        this.groupInfoElement = groupInfoElement;
        this.groupsNav = document.querySelector('#groupsNav');
        this.pageNumberElement = this.groupsNav.querySelector('.pagination .pageNumber');
        this.pageQuantityElement = this.groupsNav.querySelector('.pagination .numberOfPages');
        this.pagePrevElement = this.groupsNav.querySelector('.pagination .prevPage');
        this.pageNextElement = this.groupsNav.querySelector('.pagination .nextPage');
        this.groupListElement = this.groupsNav.querySelector('.groupList');
        this.myGroupListBtnElement = document.querySelector('.myGroupListBtn');
        this.groupList = [];
        this.myGroupList = [];
        this.pageNumber = 1;
        this.pageQuantity = 1;
        this.getGroupList(this.locationsList);
        this.getMyGroupList();
        this.attachNavMenuEvents();
    }

    getMyGroupList() {
        Frame.ajaxResponse('GET', this.urlShowMyGroupList, this.saveMyGroupList.bind(this));
    }

    saveMyGroupList(array) {
        this.myGroupList = array;
    }

    getGroupList(locations, outerRequest = false) {
        if (outerRequest === true) {
            this.filterOn = false;
            this.myGroupListBtnElement.innerHTML = "My groups";
        }

        if (locations !== this.locationsList) {
            this.locationsList = locations;
            console.log(this.locationsList);
        }

        Frame.ajaxResponse('GET', this.urlGetGroupList + '/par/' + this.locationsList, this.saveGroupList.bind(this));
    }

    saveGroupList(array) {
        this.groupList = array[0];
        this.locationsList = array[1];
        this.createGroupList(this.pageNumber, this.groupList);
    }

    createGroupList(newPageNumber, groupsArray) {
        let groups = groupsArray,
            groupsQuantity = groups.length,
            firstGroupNumber = (newPageNumber - 1) * 10 + 1,
            tempNum = groupsQuantity < 10 ? groupsQuantity : groupsQuantity - (newPageNumber - 1) * 10,
            arrLen = tempNum < 10 ? tempNum : 10;

        this.deleteGroups();

        for (let i = 0; i < arrLen; i++) {
            let addLastOddGroupClass = false;
            if (i === arrLen - 1 && i % 2 === 0) {
                addLastOddGroupClass = true;
            }
            this.createGroup(groups[firstGroupNumber + i - 1]['group_name'], groups[firstGroupNumber + i - 1]['direction_name'], addLastOddGroupClass);
        }

        this.pageNumberElement.innerHTML = newPageNumber;
        this.pageQuantity = Math.ceil(groupsQuantity / 10);
        this.pageQuantityElement.innerHTML = this.pageQuantity;

        this.attachGroupsEvents();
    }

    attachGroupsEvents() {
        let groups = this.groupsNav.querySelectorAll('.group'),
            groupsLen = groups.length;

        function uncheckGroups(i) {
            for (let ii = 0; ii < groupsLen; ii++) {
                if (ii !== i) {
                    groups[ii].classList.remove('checkedGroup');
                }
            }
        }

        for (let i = 0; i < groupsLen; i++) {
            groups[i].addEventListener('click', () => {
                if (!groups[i].classList.contains('checkedGroup')) {
                    groups[i].classList.add('checkedGroup');
                    uncheckGroups(i);
                    let groupName = this.groupList[i].group_name,
                        groupId = this.groupList[i].group_id;
                    this.groupInfoElement.showGroupInfo(groupId, groupName);
                }
            });
        }
    }

    attachNavMenuEvents() {
        this.pagePrevElement.addEventListener('click', () => {
            if (this.pageNumber > 1) {
                this.pageNumber--;
                this.pageNumberElement.innerHTML = this.pageNumber;
                this.deleteGroups();
                this.createGroupList(this.pageNumber, this.groupList);
            }
        });

        this.pageNextElement.addEventListener('click', () => {
            if (this.pageNumber < this.pageQuantity) {
                this.pageNumber++;
                this.pageNumberElement.innerHTML = this.pageNumber;
                this.deleteGroups();
                this.createGroupList(this.pageNumber, this.groupList);
            }
        });

        this.myGroupListBtnElement.addEventListener('click', () => {
            this.pageNumber = 1;
            this.deleteGroups();
            if (!this.filterOn) {
                let groupListArr = [],
                    myGroupListArrLen = this.myGroupList.length,
                    locationListArrLen = this.locationsList.length;
                for (let i = 0; i < myGroupListArrLen; i++) {
                    let iGroup = this.myGroupList[i];
                    console.log(this.locationsList);
                    for (let j = 0; j < locationListArrLen; j++) {
                        if (iGroup.group_location === this.locationsList[j]) {
                            groupListArr.push(this.myGroupList[i]);
                        }
                    }
                }
                this.filterOn = true;
                this.myGroupListBtnElement.innerHTML = "All groups";
                this.createGroupList(this.pageNumber, groupListArr);
            } else {
                this.filterOn = false;
                this.myGroupListBtnElement.innerHTML = "My groups";
                this.createGroupList(this.pageNumber, this.groupList);
            }
        });
    }

    formMyGroupList() {

    }

    deleteGroups() {
        while (this.groupListElement.firstChild) {
            this.groupListElement.removeChild(this.groupListElement.firstChild);
        }
    }

    createGroup(gName, gDirection, addLastOddGroupClass) {
        let group = this.groupListElement.appendChild(document.createElement('DIV')),
            groupName = group.appendChild(document.createElement('SPAN')),
            groupDirection = group.appendChild(document.createElement('SPAN'));

        if (addLastOddGroupClass) {
            group.className = 'group lastOddGroup';
        } else {
            group.className = 'group';
        }
        groupName.innerHTML = gName;
        groupName.className = 'grName';
        groupDirection.innerHTML = gDirection;
        groupDirection.className = 'grDirection';
    }
}
