'use strict';

class LeftSideBar {

    constructor (leftsideBlock) {
        this.defineElements(leftsideBlock);
        this.attachEvents();

    }

    defineElements(leftsideBlock) {
        this.leftsidePopup = document.querySelector('.left-popup');
        this.leftsideBlock = leftsideBlock;
    }

    attachEvents() {
        this.leftsidePopup.addEventListener('mouseover', () => {
            this.showLeftSidePopup()
        });

        this.leftsideBlock.addEventListener('mouseleave', () => {
            this.leftsideBlock.classList.remove("active");
        });
    }

    showLeftSidePopup() {
        this.leftsideBlock.classList.add("active");
    }
}
