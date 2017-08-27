'use strict';

class GroupWindow {
    constructor(el) {
        this.tabsEl = el;
        this.btnInfo = this.tabsEl.querySelector('.tabInfo');
        this.btnStudents = this.tabsEl.querySelector('.tabStudents');
        this.btnSchedule = this.tabsEl.querySelector('.tabSchedule');
        this.btnNotifications = this.tabsEl.querySelector('.tabNotification');
    }

    attachEvents() {
        this.btnInfo.addEventListener('click', () => {
            Frame.ajaxRequest('GET', 'getGroupInfo')
        });

        this.btnStudents.addEventListener('click', () => {
            Frame.ajaxRequest('GET', 'getStudentList')
        });

        this.btnSchedule.addEventListener('click', () => {
            Frame.ajaxRequest('GET', 'getSchedule')
        });

        this.btnNotifications.addEventListener('click', () => {
            Frame.ajaxRequest('GET', 'getNotifications')
        });
    }

}