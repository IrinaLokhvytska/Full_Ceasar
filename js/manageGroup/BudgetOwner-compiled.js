'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var BudgetOwner = function () {
    function BudgetOwner(elements) {
        _classCallCheck(this, BudgetOwner);

        this.defineElements(elements);
        this.attachEvents();
    }

    _createClass(BudgetOwner, [{
        key: 'defineElements',
        value: function defineElements(elements) {
            this.SsOwner = elements.querySelector('#SsOwner');
            this.OgOwner = elements.querySelector('#OgOwner');
            this.classLabel = "active";
            this.budgetOwner = 'softserve';
        }
    }, {
        key: 'attachEvents',
        value: function attachEvents() {
            var _this = this;

            this.SsOwner.addEventListener('click', function () {
                _this.setSsOwner();
            });
            this.OgOwner.addEventListener('click', function () {
                _this.setOgOwner();
            });
        }
    }, {
        key: 'setSsOwner',
        value: function setSsOwner() {
            this.SsOwner.classList.add(this.classLabel);
            this.OgOwner.classList.remove(this.classLabel);
            this.budgetOwner = 'softserve';
        }
    }, {
        key: 'setOgOwner',
        value: function setOgOwner() {
            this.OgOwner.classList.add(this.classLabel);
            this.SsOwner.classList.remove(this.classLabel);
            this.budgetOwner = 'opengroup';
        }
    }]);

    return BudgetOwner;
}();

//# sourceMappingURL=BudgetOwner-compiled.js.map