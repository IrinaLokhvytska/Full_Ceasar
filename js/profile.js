'use strict';

class Profile {

    constructor (profile) {
        this.defineElements(profile);
        this.attachEvents();
    }

    defineElements(profile) {
        this.picture = document.querySelector('.profile_picture');
        this.profile = profile;
    }

    attachEvents() {
        this.picture.addEventListener('click', () => {
            this.showProfile()
        });

        this.profile.addEventListener('mouseleave', () => {
            this.profile.classList.remove("active");
        });
    }

    showProfile() {
        this.profile.classList.add("active");
    }
}
