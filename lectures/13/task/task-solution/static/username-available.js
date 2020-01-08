var inputEl = document.querySelector(".js-username-input");
var errorEl = document.querySelector(".js-username-error");
var request = null;

inputEl.addEventListener("input", function(event) {
    setErrorVisibility(false);

    if (request) {
        request.abort();
    }

    request = new window.XMLHttpRequest();
    request.addEventListener("load", function(event) {
        if (event.target.status === 200) {
            var res
            try {
                var res = JSON.parse(event.target.responseText);
            } catch (e) {
                console.log('Error parsing response', e);
                return;
            }

            var usernameAvailable = res.usernameAvailable;
            setErrorVisibility(!usernameAvailable);
        } else {
            console.log("Non 200 status code", event.target);
            setErrorVisibility(false);
        }
    });
    request.addEventListener("error", function(error) {
        console.log("Error getting the data", error);
        setErrorVisibility(false);
    });

    var username = event.target.value;
    request.open("GET", "./api/username-available.php?username=" + encodeURIComponent(username));
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.setRequestHeader("Accept", "application/json");
    request.send();
});

function setErrorVisibility(visible) {
    if (visible) {
        errorEl.hidden = false;
    } else {
        errorEl.hidden = true;
    }
}
