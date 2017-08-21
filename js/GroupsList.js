'use strict';

class GroupsList {
    constructor(url) {
        this.url = url;
        this.groupsNav = document.querySelector('#groupsNav');
        this.pageNumberElement = this.groupsNav.querySelector('.pagination .pageNumber');
        this.pageQuantityElement = this.groupsNav.querySelector('.pagination .numberOfPages');
        this.groupNameElement = 'span.groupName';
        this.pagePrevElement = this.groupsNav.querySelector('.pagination .prevPage');
        this.pageNextElement = this.groupsNav.querySelector('.pagination .nextPage');
        this.groupsListElement = this.groupsNav.querySelector('.groupsList');
        this.myGroupsElement = this.groupsNav.querySelector('.myGroups');
        this.groups = [];
        this.myGroups = [];
        this.pageNumber = 1;
        this.pageQuantity = 1;
        this.getGroupsList();
        this.attachNavMenuEvents();
    }

    getGroupsList() {
        Frame.ajaxResponse('GET', this.url, this.saveGroupsList.bind(this));
    }

    saveGroupsList(data) {
        this.groups = data;
        this.createGroupsList(this.pageNumber);
    }

    createGroupsList(newPageNumber) {
        let groups = this.groups,
            groupsQuantity = groups.length,
            firstGroupNumber = (newPageNumber - 1) * 10 + 1,
            tempNum = groupsQuantity < 10 ? groupsQuantity : groupsQuantity - (newPageNumber - 1) * 10,
            arrLen = tempNum < 10 ? tempNum : 10;

        for (let i = 0; i < arrLen; i++) {
            let addLastOddGroupClass = false;
            if (i === arrLen - 1 && i % 2 === 0) {
                addLastOddGroupClass = true;
            }
            this.createGroup(groups[firstGroupNumber + i - 1]['groupName'], groups[firstGroupNumber + i - 1]['groupDirection'], addLastOddGroupClass);
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
                    let groupName = groups[i].dataset.name;
                    Frame.ajaxRequest('GET', this.url + '&id=' + groupName);
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
                this.createGroupsList(this.pageNumber);
            }
        });

        this.pageNextElement.addEventListener('click', () => {
            if (this.pageNumber < this.pageQuantity) {
                this.pageNumber++;
                this.pageNumberElement.innerHTML = this.pageNumber;
                this.deleteGroups();
                this.createGroupsList(this.pageNumber);
            }
        });

        if (this.myGroupsElement !== undefined) {
            this.myGroupsElement.addEventListener('click', () => {
                if (this.myGroups.length === 0) {
                    Frame.ajaxResponse('GET', 'mainpage/test.php', 'getMygroups', this.saveMyGroups.bind(this));
                }
                if (!this.myGroupsElement.classList.contains('checkedMyGroups')) {
                    this.myGroupsElement.classList.add('checkedGroup');
                } else {
                    this.pageNumber = 1;
                    this.deleteGroups();
                    this.createGroupsList(this.pageNumber);
                }

            });
        }
    }

    saveMyGroups(data) {
        this.myGroups = data;
    }

    deleteGroups() {
        while (this.groupsListElement.firstChild) {
            this.groupsListElement.removeChild(this.groupsListElement.firstChild);
        }
    }

    createGroup(gName, gDirection, addLastOddGroupClass) {
        let group = this.groupsListElement.appendChild(document.createElement('DIV')),
            groupName = group.appendChild(document.createElement('SPAN')),
            groupDirection = group.appendChild(document.createElement('SPAN'));
        group.dataset.name = gName;

        if (addLastOddGroupClass) {
            group.className = 'group lastOddGroup';
        } else {
            group.className = 'group';
        }
        group.setAttribute('id', gName);
        groupName.innerHTML = gName;
        groupName.className = 'groupName';
        groupDirection.innerHTML = gDirection;
        groupDirection.className = 'groupDirection';
    }
}
