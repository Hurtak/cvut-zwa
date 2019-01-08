var inputEl = document.querySelector(".js-username");
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
      var res = JSON.parse(event.target.responseText);
      var usernameAvailable = res.usernameAvailable;
      setErrorVisibility(!usernameAvailable);
    } else {
      setErrorVisibility(false);
    }
  });
  request.addEventListener("error", function(error) {
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
