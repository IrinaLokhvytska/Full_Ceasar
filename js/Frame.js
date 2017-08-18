'use strict';

class Frame {
    static ajaxRequest(method, request, async) {
        let xhr = new XMLHttpRequest();

        if (async === undefined) {
            async = true;
        }

        xhr.open(method, request, async);
        xhr.send();
    }

    static ajaxResponse(method, request, callback, async) {
        let xhr = new XMLHttpRequest(),
            data = '';

        if (async === undefined) {
            async = true;
        }

        xhr.open(method, request, async);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                data = JSON.parse(xhr.responseText);
                if (callback !== undefined) {
                    callback(data);
                }
            } else {
                data = 'Server is not responding';
                return data;
            }
        };
        xhr.send();
    }
}