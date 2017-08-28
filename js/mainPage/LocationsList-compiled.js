'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var LocationsList = function () {
    function LocationsList(locationModalElement, urlArray, groupListMenuObj) {
        _classCallCheck(this, LocationsList);

        this.urlGetLocations = urlArray[0];
        this.urlShowLocations = urlArray[1];
        this.selectedLocations = [];
        this.locationModal = locationModalElement;
        this.groupListMenu = groupListMenuObj;
        this.getLocations();
        this.attachConfirmBtnEvent();
        this.locations = [];
    }

    _createClass(LocationsList, [{
        key: 'createLocationsList',
        value: function createLocationsList() {
            var locQuantity = this.locations.length;

            for (var i = 0; i < locQuantity; i++) {
                this.createLocation(this.locations[i]['full_name']);
            }

            this.attachLocationsEvents();
        }
    }, {
        key: 'getLocations',
        value: function getLocations() {
            return Frame.ajaxResponse('GET', this.urlGetLocations, this.saveLocations.bind(this));
        }
    }, {
        key: 'saveLocations',
        value: function saveLocations(data) {
            this.locations = data;
            this.createLocationsList();
        }
    }, {
        key: 'createLocation',
        value: function createLocation(cityName) {
            var locationsList = this.locationModal.querySelector('.loc-list'),
                location = locationsList.appendChild(document.createElement('DIV'));

            location.className = 'loc';
            location.innerHTML = cityName;
        }
    }, {
        key: 'attachLocationsEvents',
        value: function attachLocationsEvents() {
            var _this = this;

            var locations = this.locationModal.querySelectorAll('.loc'),
                locationsLen = locations.length;

            var _loop = function _loop(i) {
                locations[i].addEventListener('click', function () {
                    if (locations[i].classList.contains('checkedLocation')) {
                        locations[i].classList.toggle('checkedLocation');
                        var index = _this.selectedLocations.indexOf(locations[i].innerHTML);
                        if (index > -1) {
                            _this.selectedLocations.splice(index, 1);
                        }
                    } else {
                        locations[i].classList.toggle('checkedLocation');
                        _this.selectedLocations.push(locations[i].innerHTML);
                    }
                });
                locations[i].addEventListener('dblclick', function () {
                    _this.selectedLocations = [locations[i].innerHTML];
                    _this.locationModal.querySelector('#confirm').click();
                });
            };

            for (var i = 0; i < locationsLen; i++) {
                _loop(i);
            }
        }
    }, {
        key: 'attachConfirmBtnEvent',
        value: function attachConfirmBtnEvent() {
            var confirm = this.locationModal.querySelector('#confirm');
            confirm.addEventListener('click', this.sendSelectedGroups.bind(this));
        }
    }, {
        key: 'sendSelectedGroups',
        value: function sendSelectedGroups() {
            this.groupListMenu.getGroupList(this.selectedLocations, true);
            this.clearSelectedLocations();
        }
    }, {
        key: 'clearSelectedLocations',
        value: function clearSelectedLocations() {
            this.selectedLocations = [];
            var locations = this.locationModal.querySelectorAll('.loc'),
                locationsLen = locations.length;
            for (var i = 0; i < locationsLen; i++) {
                if (locations[i].classList.contains('checkedLocation')) {
                    locations[i].classList.remove('checkedLocation');
                }
            }
        }
    }]);

    return LocationsList;
}();

//# sourceMappingURL=LocationsList-compiled.js.map