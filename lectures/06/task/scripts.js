// Select element from HTML DOM.
var formEl = document.querySelector("#form");

// Listen on events
formEl.addEventListener("submit", function(event) {
    console.log(event);

    var formValid = validateForm();
    if (!formValid) {
        // Prevent default prevents default browser action of given event.
        // So with form submits, it prevents submitting the form, with
        // links it would prevent redirecting to link href, etc.
        event.preventDefault();
    }
});

function validateForm() {
    var errors = [];

    var emailEl = document.querySelector("#email");
    var emailValue = emailEl.value;

    if (emailValue.length === 0) {
        errors.push({
            message: "Please fill in email.",
            element: emailEl
        });
    } else if (emailValue.length < 5) {
        errors.push({
            message: "Email is too short, minimum is 5 characters.",
            element: emailEl
        });
    } else if (emailValue.length > 30) {
        errors.push({
            message: "Email is too long, maximum is 30 characters.",
            element: emailEl
        });
    } else if (!emailValue.includes("@")) {
        errors.push({
            message: "Email is badly formatted, it does not include the \"@\" character.",
            element: emailEl
        });
    }

    var passwordEl = document.querySelector("#password");
    var passwordAgainEl = document.querySelector("#password-again");
    var passwordValue = passwordEl.value;
    var passwordAgainValue = passwordAgainEl.value;

    if (passwordValue.length === 0) {
        errors.push({
            message: "Please fill in password.",
            element: passwordEl
        });
    } else if (passwordAgainValue.length === 0) {
        errors.push({
            message: "Please fill in password.",
            element: passwordAgainEl
        });
    } else if (passwordValue < 5) {
        errors.push({
            message: "Password is too short, minimum is 5 characters.",
            element: passwordEl
        });
    } else if (passwordValue > 100) {
        errors.push({
            message: "Password is too long, maximum is 100 characters.",
            element: passwordEl
        });
    } else if (passwordValue !== passwordAgainValue) {
        errors.push({
            message: "Passwords are not the same.",
            element: passwordEl
        });
    }

    var formValid = errors.length === 0;
    var errorMessageEl = document.querySelector("#error");
    if (formValid) {
        errorMessageEl.hidden = true;
        errorMessageEl.innerText = "";
    } else {
        var firstError = errors[0];

        errorMessageEl.hidden = false;
        errorMessageEl.innerText = firstError.message;
        firstError.element.focus();
    }

    return formValid;
}
