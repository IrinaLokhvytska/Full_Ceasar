'use strict';

class Frame {
    static ajaxRequest(method, request, async = true) {
        let xhr = new XMLHttpRequest();

        xhr.open(method, request, async);
        xhr.send();
    }

    static ajaxResponse(method, request, callback, async = true) {
        let xhr = new XMLHttpRequest(),
            data = '';

        xhr.open(method, request, async);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                data = JSON.parse(xhr.responseText);
                if (callback !== undefined) {
                    return callback(data);
                }
            }
        };
        xhr.send();
    }
}
