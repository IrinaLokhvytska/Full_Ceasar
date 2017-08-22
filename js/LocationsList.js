'use strict';

class LocationsList {
    constructor(locationModalElement, urlArray) {
        this.urlGetLocations = urlArray[0];
        this.urlShowLocations = urlArray[1];
        this.selectedLocations = [];
        this.locationModal = locationModalElement;
        this.getLocations();
        this.attachConfirmBtnEvent();
        this.locations = [];
    }

    createLocationsList() {
        let locQuantity = this.locations.length;

        for (let i = 0; i < locQuantity; i++) {
            this.createLocation(this.locations[i]['full_name']);
        }

        this.attachLocationsEvents();
    }

    getLocations() {
        return Frame.ajaxResponse('GET', this.urlGetLocations, this.saveLocations.bind(this));
    }

    saveLocations(data) {
        this.locations = data;
        this.createLocationsList();
    }

    createLocation(cityName) {
        let locationsList = this.locationModal.querySelector('.loc-list'),
            location = locationsList.appendChild(document.createElement('DIV'));

        location.className = 'loc';
        location.innerHTML = cityName;
    }

    attachLocationsEvents() {
        let locations = this.locationModal.querySelectorAll('.loc'),
            locationsLen = locations.length;

        for (let i = 0; i < locationsLen; i++) {
            locations[i].addEventListener('click', () => {
                if (locations[i].classList.contains('checkedLocation')) {
                    locations[i].classList.toggle('checkedLocation');
                    let index = this.selectedLocations.indexOf(locations[i].innerHTML);
                    if (index > -1) {
                        this.selectedLocations.splice(index, 1);
                    }
                } else {
                    locations[i].classList.toggle('checkedLocation');
                    this.selectedLocations.push(locations[i].innerHTML);
                }
            });
            locations[i].addEventListener('dblclick', () => {
                this.selectedLocations = [locations[i].innerHTML];
                this.locationModal.querySelector('#confirm').click();

            });
        }
    }

    attachConfirmBtnEvent() {
        let confirm = this.locationModal.querySelector('#confirm');
        confirm.addEventListener('click', this.sendSelectedGroups.bind(this));
    }

    sendSelectedGroups() {
        // let groupsListObj = localStorage.getItem('groupsListObj');
        // groupsListObj.getGroupsList(this.selectedLocations);
        let selectedLocations = JSON.stringify(this.selectedLocations);
        Frame.ajaxRequest('GET', this.urlShowLocations + selectedLocations);
    }
}