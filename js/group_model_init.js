'use strict';
document.addEventListener('DOMContentLoaded', init);

function init () {
    let elements = document.querySelector('.groups'),
        group = new GroupModal(elements);
}
