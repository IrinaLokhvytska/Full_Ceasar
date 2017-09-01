'use strict';
class BudgetOwner {
    
    constructor (elements) {
        this.defineElements(elements);
        this.attachEvents();
    }

    defineElements (elements) {
        this.SsOwner = elements.querySelector('#SsOwner');
        this.OgOwner = elements.querySelector('#OgOwner');
        this.classLabel = "active";
        this.budgetOwner = 'softserve';
    }

    attachEvents () {
        this.SsOwner.addEventListener('click', () => {
            this.setSsOwner();
        });
        this.OgOwner.addEventListener('click', () => {
            this.setOgOwner();
        });
    }

    setSsOwner () {
        this.SsOwner.classList.add(this.classLabel);
        this.OgOwner.classList.remove(this.classLabel);
        this.budgetOwner = 'softserve';
    }

    setOgOwner () {
        this.OgOwner.classList.add(this.classLabel);
        this.SsOwner.classList.remove(this.classLabel);
        this.budgetOwner = 'opengroup';
    }

}
