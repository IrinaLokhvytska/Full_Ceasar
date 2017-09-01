'use strict';

class Profile {

    constructor(profilePicture, profileBlock) {
        this.picture = profilePicture;
        this.profileBlock = profileBlock;
        this.attachEvents();
    }

    attachEvents() {
        this.picture.addEventListener('click', () => {
            this.showProfile();
        });

        this.profileBlock.addEventListener('mouseout', () => {
            if (this.profileBlock.classList.contains("clicked")){
                this.profileBlock.classList.remove("clicked");
            }
        });
    }

    showProfile() {
        this.profileBlock.classList.add("clicked");
    }
}
