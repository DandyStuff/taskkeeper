import { signup } from "./api.js";

const form = document.getElementById("form");
const button = document.getElementById("submit-button");
const errorBox = document.getElementById("error-box");

const passwordInput = document.getElementById("password-input");
const passwordConfirmationInput = document.getElementById("password-confirmation-input");

function checkPasswords() {
	if (passwordConfirmationInput.value !== passwordInput.value) {
		passwordConfirmationInput.setCustomValidity("The passwords don't match.");
	} else {
		passwordConfirmationInput.setCustomValidity("");
	}
}
passwordInput.addEventListener("input", checkPasswords);
passwordConfirmationInput.addEventListener("input", checkPasswords);

form.addEventListener("submit", async (ev) => {
	ev.preventDefault();

	button.disabled = true;

	const fd = new FormData(form);
	try {
		await signup(fd.get("email"), fd.get("password"), fd.get("first-name"), fd.get("last-name"));

		location.href = "/tasks";
	} catch(err) {
		errorBox.style.display = "block";
		switch (err.result) {
			case "email_already_in_use":
				errorBox.innerText = "There is already a user with that e-mail address. You might want to login instead.";
				break;

			default:
				errorBox.innerText = "An unknon error has occured.";
				break;
		}
		button.disabled = false;
	}
});
