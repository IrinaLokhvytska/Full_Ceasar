'use strict';

class LocationsList {
    constructor(locationModalElement) {
        this.selectedLocations = [];
        this.locationModal = locationModalElement;
        this.createLocationsList();
        this.attachConfirmBtnEvent();
    }

    createLocationsList() {
        let locations = this.getLocations(),
            locQuantity = locations.length;

        for (let i = 0; i < locQuantity; i++) {
            this.createLocation(locations[i]['FULL_NAME']);
        }

        this.attachLocationsEvents();
    }

    getLocations() {
        return this.getXMLHttpRequest('mainpage/locs.php', 'getlocations', false);
    }

    getXMLHttpRequest(url, request, async) {
        let xhr = new XMLHttpRequest(url, request, async),
            arr = '';

        xhr.open('GET', url + '?' + request, async);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                arr = JSON.parse(xhr.responseText);
            }
        };
        xhr.send();
        return arr;
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
        let selectedLocations = JSON.stringify(this.selectedLocations);
        Frame.ajaxRequest('GET', 'index.php', selectedLocations);
    }
}