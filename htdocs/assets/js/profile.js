import { updateUserDetails } from "./api.js";

const form = document.getElementById("form");
const button = document.getElementById("submit-button");
const resultBox = document.getElementById("result-box");

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

	const fd = new FormData(form);
	try {
		await updateUserDetails({
			first_name: fd.get("first-name"),
			last_name: fd.get("last-name"),
			email: fd.get("email"),
			old_password: fd.get("old-password"),
			new_password: fd.get("new-password") === "" ? undefined : fd.get("new-password")
		});
		resultBox.style.display = "block";
		resultBox.className = "success-box";
		resultBox.innerText = "User details successfully updated!";
	} catch(err) {
		resultBox.style.display = "block";
		resultBox.className = "error-box";
		switch (err.result) {
			case "wrong_password":
				resultBox.innerText = "That password is wrong. Try again.";
				break;

			case "email_already_in_use":
				resultBox.innerText = "There is already a user with that e-mail address.";
				break;

			default:
				resultBox.innerText = "An unknon error has occured.";
				break;
		}
		button.disabled = false;
	}
});
