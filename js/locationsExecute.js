document.addEventListener('DOMContentLoaded', main);

function main() {
    let locationBtn = document.querySelector('#locationBtn'),
        locationModal = document.querySelector('#locationModal'),
        locationsListModal = null;
    locationBtn.addEventListener('click', () => {
        locationsListModal = (locationsListModal === null)
            ? new LocationsList(locationModal)
            : locationsListModal;
    });
}
