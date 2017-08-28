'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Login = function () {
    function Login(form) {
        _classCallCheck(this, Login);

        this.defineElements(form);
        this.attachEvents();
    }

    _createClass(Login, [{
        key: 'defineElements',
        value: function defineElements(form) {
            this.login = form.querySelector('.input-login');
            this.password = form.querySelector('.input-password');
            this.error = form.querySelector('.errorLoginForm');
            this.submit = form.querySelector('.input-submit');
            this.loginForm = form.querySelector('#login-form');
        }
    }, {
        key: 'attachEvents',
        value: function attachEvents() {
            var _this = this;

            document.addEventListener('keydown', function (event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    _this.validateForm();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.keyCode === 27) {
                    _this.login.value = "";
                    _this.password.value = "";
                }
            });

            this.submit.addEventListener('click', function (event) {
                _this.validateForm();
            });
        }
    }, {
        key: 'validateLogin',
        value: function validateLogin() {
            var loginValue = this.login.value;

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
    }, {
        key: 'validatePassword',
        value: function validatePassword() {
            var passwordValue = this.password.value;

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
    }, {
        key: 'validateForm',
        value: function validateForm() {
            var loginValid = this.validateLogin(),
                passwordValid = this.validatePassword();
            if (loginValid && passwordValid) {
                this.loginForm.submit();
            }
        }
    }, {
        key: 'showError',
        value: function showError() {
            this.error.innerHTML = "Incorrect login or password. Please, try again.";
            this.password.value = "";
            return false;
        }
    }]);

    return Login;
}();

//# sourceMappingURL=login-compiled.js.map