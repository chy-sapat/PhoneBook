const showPasswordLabel = document.getElementById("showPasswordLabel");
const showPassword = document.getElementById("passVisibility");
const passwordField = document.getElementById("password");

showPasswordLabel.innerHTML = "Show";

showPassword.addEventListener("change", (e) => {
  e.preventDefault();
  if (showPassword.checked == true) {
    passwordField.setAttribute("type", "text");
    showPasswordLabel.innerHTML = "Hide";
  } else {
    passwordField.setAttribute("type", "password");
    showPasswordLabel.innerHTML = "Show";
  }
});
