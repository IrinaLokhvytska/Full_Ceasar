'use strict';
class BudgetOwner {
    
    constructor (elements) {
        this.defineElements(elements);
        this.attachEvents();
    }

    defineElements (elements) {
        this.budgetOwner = 'Soft Serve';
        console.log(this.budgetOwner);
        this.SsOwner = elements.querySelector('.SoftServe');
        this.OgOwner = elements.querySelector('.Open-group');
        this.labelSS = elements.querySelector('#SsOwner');
        this.labelOG = elements.querySelector('#OgOwner');
        this.classLabel = "active";
    }

    attachEvents () {
        this.SsOwner.addEventListener('click', () => {
            this.setSsOwner()
        });
        this.OgOwner.addEventListener('click', () => {
            this.setOgOwner()
        });
    }

    setSsOwner () {
        this.labelSS.classList.add(this.classLabel);
        this.labelOG.classList.remove(this.classLabel);
        this.budgetOwner = 'Soft Serve';
    }

    setOgOwner () {
        this.labelOG.classList.add(this.classLabel);
        this.labelSS.classList.remove(this.classLabel);
        this.budgetOwner = 'Open group';
    }

}
