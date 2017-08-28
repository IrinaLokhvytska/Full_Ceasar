'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var ExpertsInput = function () {
    function ExpertsInput(elements) {
        _classCallCheck(this, ExpertsInput);

        this.defineElements(elements);
        this.attachEvents();
    }

    _createClass(ExpertsInput, [{
        key: 'defineElements',
        value: function defineElements(elements) {
            this.addExpert = elements.querySelector('.add-expert');
            this.experts = elements.querySelector('.experts');
            this.messageBox = elements.querySelector('.errorExperts');
            this.classExperts = "experts";
            this.glyphicon = "glyphicon";
            this.spanClass = "glyphicon-remove";
            this.addGroupBox = elements;
        }
    }, {
        key: 'attachEvents',
        value: function attachEvents() {
            var _this = this;

            this.addExpert.addEventListener('click', function (e) {
                e.preventDefault();
                _this.addExpertInput();
            });
            this.experts.addEventListener('blur', function () {
                _this.validateExperts();
            });
        }
    }, {
        key: 'validateExperts',
        value: function validateExperts() {
            var expert = this.experts.value,
                pattern = /^[а-яА-Я-\. ]{5,25}$|^[a-zA-Z-\. ]{5,25}$/;
            if (expert) {
                if (25 < expert.length || expert.length < 5) {
                    this.messageBox.innerHTML = 'The length of experts:5-25 chars';
                    this.experts.style.borderColor = "red";

                    return false;
                } else {
                    if (!pattern.test(expert)) {
                        this.messageBox.innerHTML = 'You use invalid characters';
                        this.experts.style.borderColor = "red";

                        return false;
                    } else {
                        this.messageBox.style.display = "none";
                        this.experts.style.borderColor = "black";

                        return true;
                    }
                }
            }

            return true;
        }
    }, {
        key: 'validateNewExperts',
        value: function validateNewExperts(newExpert) {
            var expert = newExpert.value,
                pattern = /^[а-яА-Я-\. ]{5,25}$|^[a-zA-Z-\. ]{5,25}$/;

            if (expert) {
                if (25 < expert.length || expert.length < 5) {
                    this.messageBox.style.display = "block";
                    this.messageBox.innerHTML = 'The length of experts:5-25 chars';
                    newExpert.style.borderColor = "red";

                    return false;
                } else {
                    if (!pattern.test(expert)) {
                        this.messageBox.style.display = "block";
                        this.messageBox.innerHTML = 'You use invalid characters';
                        newExpert.style.borderColor = "red";

                        return false;
                    } else {
                        this.messageBox.style.display = "none";
                        newExpert.style.borderColor = "black";

                        return true;
                    }
                }
            }

            return true;
        }
    }, {
        key: 'addExpertInput',
        value: function addExpertInput() {
            var _this2 = this;

            var newExpertInput = document.createElement('input'),
                span = document.createElement('span'),
                expertsContainer = this.addGroupBox.querySelector('.experts-container');
            newExpertInput.classList.add(this.classExperts);
            newExpertInput.addEventListener('blur', function () {
                _this2.validateNewExperts(newExpertInput);
            });
            expertsContainer.appendChild(newExpertInput);
            span.classList.add(this.glyphicon);
            span.classList.add(this.spanClass);
            span.addEventListener('click', function () {
                _this2.removePreviousSibling(span);
                span.remove();
            });
            expertsContainer.appendChild(span);
        }
    }, {
        key: 'removePreviousSibling',
        value: function removePreviousSibling(span) {
            span.previousSibling.remove();
        }
    }]);

    return ExpertsInput;
}();

//# sourceMappingURL=ExpertsInput-compiled.js.map