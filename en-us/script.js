function changeLanguage() {
    var selectedLang = document.getElementById("language-select").value;
    localStorage.setItem("preferredLanguage", selectedLang);
    window.location.href = "/" + selectedLang + "/start.html";
}

// On page load, set the dropdown based on stored language
window.addEventListener("DOMContentLoaded", function () {
    var preferredLang = localStorage.getItem("preferredLanguage");
    if (preferredLang) {
        document.getElementById("language-select").value = preferredLang;
    }
});
