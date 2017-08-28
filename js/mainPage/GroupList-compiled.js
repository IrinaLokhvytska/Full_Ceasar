'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var GroupList = function () {
    function GroupList(urlArray, groupInfoElement, locationsList) {
        _classCallCheck(this, GroupList);

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

    _createClass(GroupList, [{
        key: 'getMyGroupList',
        value: function getMyGroupList() {
            Frame.ajaxResponse('GET', this.urlShowMyGroupList, this.saveMyGroupList.bind(this));
        }
    }, {
        key: 'saveMyGroupList',
        value: function saveMyGroupList(array) {
            this.myGroupList = array;
        }
    }, {
        key: 'getGroupList',
        value: function getGroupList(locations) {
            var outerRequest = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

            if (outerRequest === true) {
                this.pageNumber = 1;
                this.filterOn = false;
                this.myGroupListBtnElement.innerHTML = "My groups";
            }

            if (locations !== this.locationsList) {
                this.locationsList = locations;
            }

            Frame.ajaxResponse('GET', this.urlGetGroupList + '/par/' + this.locationsList, this.saveGroupList.bind(this));
        }
    }, {
        key: 'saveGroupList',
        value: function saveGroupList(array) {
            this.groupList = array[0];
            this.locationsList = array[1];
            this.createGroupList(this.pageNumber, this.groupList);
        }
    }, {
        key: 'createGroupList',
        value: function createGroupList(newPageNumber, groupsArray) {
            var groups = groupsArray,
                groupsQuantity = groups.length,
                firstGroupNumber = (newPageNumber - 1) * 10 + 1,
                tempNum = groupsQuantity < 10 ? groupsQuantity : groupsQuantity - (newPageNumber - 1) * 10,
                arrLen = tempNum < 10 ? tempNum : 10,
                pageGroupList = [];

            this.deleteGroups();

            for (var i = 0; i < arrLen; i++) {
                var addLastOddGroupClass = false;
                if (i === arrLen - 1 && i % 2 === 0) {
                    addLastOddGroupClass = true;
                }
                this.createGroup(groups[firstGroupNumber + i - 1]['group_name'], groups[firstGroupNumber + i - 1]['direction_name'], addLastOddGroupClass);
                pageGroupList.push(groups[firstGroupNumber + i - 1]);
            }

            this.pageNumberElement.innerHTML = newPageNumber;
            this.pageQuantity = Math.ceil(groupsQuantity / 10);
            this.pageQuantityElement.innerHTML = this.pageQuantity;

            this.attachGroupsEvents(pageGroupList);
        }
    }, {
        key: 'attachGroupsEvents',
        value: function attachGroupsEvents(pageGroupList) {
            var _this = this;

            var groups = this.groupsNav.querySelectorAll('.group'),
                groupsLen = groups.length,
                groupListArr = pageGroupList;

            function uncheckGroups(i) {
                for (var ii = 0; ii < groupsLen; ii++) {
                    if (ii !== i) {
                        groups[ii].classList.remove('checkedGroup');
                    }
                }
            }

            var _loop = function _loop(i) {
                groups[i].addEventListener('click', function () {
                    if (!groups[i].classList.contains('checkedGroup')) {
                        groups[i].classList.add('checkedGroup');
                        uncheckGroups(i);
                        var groupId = groupListArr[i].group_id,
                            groupName = groupListArr[i].group_name,
                            groupLocation = groupListArr[i].group_location,
                            groupDirection = groupListArr[i].direction_name,
                            groupStartDate = groupListArr[i].start_date,
                            groupBudget = groupListArr[i].budget,
                            groupDirectionId = groupListArr[i].direction_id,
                            groupLocationId = groupListArr[i].group_location_id,
                            groupInfo = [groupId, groupName, groupLocation, groupDirection, groupStartDate, groupBudget, groupDirectionId, groupLocationId];
                        _this.groupInfoElement.showGroupInfo(groupInfo);
                    }
                });
            };

            for (var i = 0; i < groupsLen; i++) {
                _loop(i);
            }
        }
    }, {
        key: 'attachNavMenuEvents',
        value: function attachNavMenuEvents() {
            var _this2 = this;

            this.pagePrevElement.addEventListener('click', function () {
                if (_this2.pageNumber > 1) {
                    _this2.pageNumber--;
                    _this2.pageNumberElement.innerHTML = _this2.pageNumber;
                    _this2.deleteGroups();
                    _this2.createGroupList(_this2.pageNumber, _this2.groupList);
                }
            });

            this.pageNextElement.addEventListener('click', function () {
                if (_this2.pageNumber < _this2.pageQuantity) {
                    _this2.pageNumber++;
                    _this2.pageNumberElement.innerHTML = _this2.pageNumber;
                    _this2.deleteGroups();
                    _this2.createGroupList(_this2.pageNumber, _this2.groupList);
                }
            });

            this.myGroupListBtnElement.addEventListener('click', function () {
                _this2.pageNumber = 1;
                _this2.deleteGroups();
                if (!_this2.filterOn) {
                    var groupListArr = [],
                        myGroupListArrLen = _this2.myGroupList.length,
                        locationListArrLen = _this2.locationsList.length;
                    for (var i = 0; i < myGroupListArrLen; i++) {
                        var iGroup = _this2.myGroupList[i];
                        for (var j = 0; j < locationListArrLen; j++) {
                            if (iGroup.group_location === _this2.locationsList[j]) {
                                groupListArr.push(_this2.myGroupList[i]);
                            }
                        }
                    }
                    _this2.filterOn = true;
                    _this2.myGroupListBtnElement.innerHTML = "All groups";
                    _this2.createGroupList(_this2.pageNumber, groupListArr);
                } else {
                    _this2.filterOn = false;
                    _this2.myGroupListBtnElement.innerHTML = "My groups";
                    _this2.createGroupList(_this2.pageNumber, _this2.groupList);
                }
            });
        }
    }, {
        key: 'formMyGroupList',
        value: function formMyGroupList() {}
    }, {
        key: 'deleteGroups',
        value: function deleteGroups() {
            while (this.groupListElement.firstChild) {
                this.groupListElement.removeChild(this.groupListElement.firstChild);
            }
        }
    }, {
        key: 'createGroup',
        value: function createGroup(gName, gDirection, addLastOddGroupClass) {
            var group = this.groupListElement.appendChild(document.createElement('DIV')),
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
    }]);

    return GroupList;
}();

//# sourceMappingURL=GroupList-compiled.js.map