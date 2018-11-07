// Definice promenne.
var variable = 1;

// Zakladni datove typy
var empty = undefined;
var empty2 = null;
var bool = true;
var number = 10.2;
var string = "text";

// Strukturovana data
var object = {
    klic: "hodnota",
    klic2: 123
};
var array = [1, 2, 3];

// Zamereni elementu.
var formEl = document.querySelector("#form");

// Poslouchani na udalosti u danych elementu.
formEl.addEventListener("submit", function(event) {
    console.log(event);

    var formValid = validateForm();
    if (!formValid) {
        // Zabrani defaultni akci daneho elementu, u formularu to je
        // odeslani formulare.
        event.preventDefault();
    }
});

function validateForm() {
    var usernameEl = document.querySelector("#name");
    var usernameValue = usernameEl.value;

    if (usernameValue.length === 0) {
        alert("Prosim vyplnte uzivatelske jmeno.");
        return false;
    }
    if (usernameValue.length < 5) {
        alert("Uzivatelske jmeno je prilis kratke, minimum je 5 znaku.");
        return false;
    }
    if (usernameValue.length > 30) {
        alert("Uzivatelske jmeno je prilis dlouhe, maximum je 30 znaku.");
        return false;
    }

    var emailEl = document.querySelector("#email");
    var emailValue = emailEl.value;
    if (emailValue.length > 0) {
        if (!emailValue.includes("@")) {
            alert("Email je spatne zadan.");
            return false;
        }
    }

    return true;
}
