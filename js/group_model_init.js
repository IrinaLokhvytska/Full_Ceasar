'use strict';
function init () {
    let elements = document.querySelector('.groups'),
        group = new GroupModal(elements);
}

document.addEventListener('DOMContentLoaded', init);

