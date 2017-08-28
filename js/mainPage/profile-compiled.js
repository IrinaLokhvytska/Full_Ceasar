'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Profile = function () {
    function Profile(profilePicture, profileBlock) {
        _classCallCheck(this, Profile);

        this.picture = profilePicture;
        this.profileBlock = profileBlock;
        this.attachEvents();
    }

    _createClass(Profile, [{
        key: 'attachEvents',
        value: function attachEvents() {
            var _this = this;

            this.picture.addEventListener('click', function () {
                _this.showProfile();
            });

            this.profileBlock.addEventListener('mouseout', function () {
                if (_this.profileBlock.classList.contains("clicked")) {
                    _this.profileBlock.classList.remove("clicked");
                }
            });
        }
    }, {
        key: 'showProfile',
        value: function showProfile() {
            this.profileBlock.classList.add("clicked");
        }
    }]);

    return Profile;
}();

//# sourceMappingURL=profile-compiled.js.map