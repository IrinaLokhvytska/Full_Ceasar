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
        document.addEventListener('keydown', event => {
            if (event.keyCode === 13) {
                event.preventDefault();
                this.validateForm();
            }
        });

        document.addEventListener('keydown', event => {
            if (event.keyCode === 27) {
                this.login.value = "";
                this.password.value = "";
            }
        });

        this.submit.addEventListener ('click', event => {
            this.validateForm();
        });
    }

    validateLogin () {
        let loginValue = this.login.value;

        if (!loginValue.match(/^[a-zA-Z]+$/g)) {
            this.showError();
            return false;
        } else {
            if (loginValue.length < 4 || loginValue.length > 10) {
                this.showError();
                return false;
            } else {
                return true;
            }
        }
    }

    validatePassword() {
        let passwordValue = this.password.value;

        if (passwordValue.length < 4 || passwordValue.length > 10) {
            this.showError();
            return false;
        } else {
            if (!this.password.value.match(/^[a-zA-Z0-9!@#$%^&*`~()_+-|\"';:/?.>,<]+$/g)) {
                this.showError();
                return false;
            } else {
                return true;
            }
        }
    }

    validateForm() {
        let loginValid = this.validateLogin(),
            passwordValid = this.validatePassword();
        if (loginValid && passwordValid) {
            this.loginForm.submit();
        }
    }

    showError() {
        this.error.innerHTML = "Incorrect login or password. Please, try again.";
        this.password.value = "";
        return false;
    }
}
