'use strict';

class Login {

    constructor (form) {
        this.defineElements(form);
        this.attachEvents();
    }

    defineElements(form) {
        this.loginForm = form.querySelector('.login-form');
        this.login = form.querySelector('.input-login');
        this.password = form.querySelector('.input-password');
        this.submit = form.querySelector('.input-submit');
        this.error = form.querySelector('.errorLoginForm');
    }

    attachEvents() {
        this.loginForm.addEventListener('submit', event => {
            this.checkValidity();
        });

        this.loginForm.addEventListener('keydown', event => {
            if (event.keyCode === 13) {
                this.checkValidity();
            }
        });

        this.loginForm.addEventListener('keydown', event => {
            if (event.keyCode === 27) {
                this.login.value = "";
                this.password.value = "";
            }
        });
    }

    checkValidity() {
        if (!this.validateForm()) {
            event.preventDefault();
        }
    }

    validateForm() {
        let loginValue = this.login.value,
            passwordValue = this.password.value;

        if (!loginValue.match(/^[a-zA-Z]+$/g)) {
            this.showError();
        } else if (loginValue.length < 4 || loginValue.length > 20) {
            this.showError();
        } else if (passwordValue.length < 4 || passwordValue.length > 10) {
            this.showError();
        } else if (!this.password.value.match(/^[a-zA-Z0-9!@#$%^&*`~()_+-|\"';:/?.>,<]+$/g)) {
            this.showError();
        } else {
            this.loginForm.submit();
        }
    }

    showError() {
        this.error.innerHTML = "Incorrect login or password. Please, try again.";
        this.password.value = "";
        return false;
    }
}
