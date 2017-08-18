'use strict';

class Login {

    constructor (form) {
        this.defineElements(form);
        this.attachEvents();
    }

    defineElements(form) {
        this.login = form.querySelector('.input-login');
        this.password = form.querySelector('.input-password');
        this.error = form.querySelector('.errorLoginForm');
        this.submit = form.querySelector('.input-submit');
        this.loginForm = form.querySelector('#login-form');
    }

    attachEvents() {
        this.login.addEventListener('blur', event => {
            this.validateForm();
        });

        this.password.addEventListener('blur', event => {
            this.validateForm();
        });

        document.addEventListener('keydown', event => {
            if (event.keyCode === 13) {
                this.validateForm();
            }
        });

        document.addEventListener('keydown', event => {
            if (event.keyCode === 27) {
                this.password.value = "";
            }
        });

        this.submit.addEventListener ('click', event => {
            this.validateForm();
        });
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
