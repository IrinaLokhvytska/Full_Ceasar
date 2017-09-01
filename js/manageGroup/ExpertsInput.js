'use strict';
class ExpertsInput {

    constructor (elements) {
        this.defineElements(elements);
        this.attachEvents();
    }

    defineElements (elements) {
        this.addExpert = elements.querySelector('.add-expert');
        this.experts = elements.querySelector('.experts');
        this.messageBox = elements.querySelector('.errorExperts');
        this.classExperts = "experts";
        this.glyphicon = "glyphicon";
        this.spanClass = "glyphicon-remove";
        this.addGroupBox = elements;
    }

    attachEvents () {
        this.addExpert.addEventListener('click', (e) => {
            e.preventDefault();
            this.addExpertInput();
        });
        this.experts.addEventListener('blur', () => {
            this.validateExperts();
        });
    }

    validateExperts () {
        let expert = this.experts.value,
            pattern = /^[а-яА-Я-\. ]{5,25}$|^[a-zA-Z-\. ]{5,25}$/;
        if(expert){
            if(25 < expert.length || expert.length <5) {
                this.messageBox.innerHTML = ('The length of experts:5-25 chars');
                this.experts.style.borderColor = "red";

                return false;

            } else {
                if (!pattern.test(expert)) {
                    this.messageBox.innerHTML = ('You use invalid characters');
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

    validateNewExperts (newExpert) {
        let expert = newExpert.value,
            pattern = /^[а-яА-Я-\. ]{5,25}$|^[a-zA-Z-\. ]{5,25}$/;

        if(expert){
            if(25 < expert.length || expert.length <5) {
                this.messageBox.style.display = "block";
                this.messageBox.innerHTML = ('The length of experts:5-25 chars');
                newExpert.style.borderColor = "red";

                return false;

            } else {
                if (!pattern.test(expert)) {
                    this.messageBox.style.display = "block";
                    this.messageBox.innerHTML = ('You use invalid characters');
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

    addExpertInput () {
        let newExpertInput = document.createElement('input'),
            span = document.createElement('span'),
            expertsContainer = this.addGroupBox.querySelector('.experts-container');
        newExpertInput.classList.add(this.classExperts);
        newExpertInput.addEventListener('blur', () => {
            this.validateNewExperts(newExpertInput);
        });
        expertsContainer.appendChild(newExpertInput);
        span.classList.add(this.glyphicon);
        span.classList.add(this.spanClass);
        span.addEventListener('click', () => {
            this.removePreviousSibling(span);
            span.remove();
        });
        expertsContainer.appendChild(span);
    }

    removePreviousSibling (span) {
        span.previousSibling.remove();
    }

}
