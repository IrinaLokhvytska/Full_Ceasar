'use strict';
class DateCourse {

    constructor (elements) {
        this.defineElements(elements);
        this.attachEvents();
    }

    defineElements (elements) {
        this.direction = elements.querySelector('.direction');
        this.startDate = elements.querySelector('.startDate');
        this.finishDate = elements.querySelector('.finishDate');
        this.messageBox = elements.querySelector('.errorDate');
    }

    attachEvents () {
        this.direction.addEventListener('change', () => {
            this.processDate()
        });
        this.startDate.addEventListener('change', () => {
            this.processDate()
        });
        this.startDate.addEventListener('blur', () => {
            this.validateDate()
        });
    }

    validateDate () {
        if (!this.startDate.value) {
            this.messageBox.innerHTML = ('Please, select the start date');
            this.startDate.style.borderColor = "red";

            return false;
            
        } else {
            this.messageBox.style.display = "none";
            this.startDate.style.borderColor = "black";

            return true;
            
        }
    }

    processDate () {
        let startDate = this.startDate.value,
            direction = this.direction.value,
            finishDate;

        finishDate = this.defineFinishDate(startDate, direction);
        this.finishDate.value = this.dateToUTC(finishDate);
    }

    defineFinishDate (startDate, direction) {
        const sPerHour = 3600,
            msPerDay = 24 * sPerHour * 1000;
        let start = new Date(startDate),
            shift = this.getShift(direction),
            saturday = 6,
            sunday = 0,
            finish, day;

        finish = new Date(start.getTime() + shift);
        day = finish.getUTCDay();

        if (day === saturday) {
            finish = new Date(finish.getTime() + 2 * msPerDay)
        } else if (day === sunday) {
            finish = new Date(finish.getTime() + msPerDay)
        }

        return finish;

    }

    getShift (direction) {
        const sPerHour = 3600,
            msPerDay = 24 * sPerHour * 1000,
            msPerWeek = 7 * msPerDay,
            courseWeek = [9, 12];
        let dateInMilliseconds;

        if (direction === 'MQC' || direction === 'ISTQB') {
            dateInMilliseconds = courseWeek[0] * msPerWeek;
        } else {
            dateInMilliseconds = courseWeek[1] * msPerWeek;
        }

        return dateInMilliseconds;
    }

    dateToUTC (date) {
        let yyyy, mm, dd,
            out;

        yyyy = date.getUTCFullYear();
        mm = this.normalize(date.getUTCMonth() + 1);
        dd = this.normalize(date.getUTCDate());

        out = `${yyyy}-${mm}-${dd}`;

        return out;
    }

    normalize (item) {
        return item < 10? '0' + item: item;
    }
}
