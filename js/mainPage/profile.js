'use strict';

class Profile {

    constructor(profilePicture, profileBlock) {
        this.picture = profilePicture;
        this.profileBlock = profileBlock;
        this.attachEvents();
    }

    attachEvents() {
        this.picture.addEventListener('click', () => {
            this.showProfile()
        });
    }

    showProfile() {
        this.profileBlock.classList.add("profile_block:hover");
    }
}
