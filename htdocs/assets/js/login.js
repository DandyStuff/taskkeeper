import { login } from "./api.js";

const form = document.getElementById("form");
const button = document.getElementById("submit-button");
const errorBox = document.getElementById("error-box");

form.addEventListener("submit", async (ev) => {
	ev.preventDefault();

	button.disabled = true;

	const fd = new FormData(form);
	try {
		await login(fd.get("email"), fd.get("password"));

		location.href = "/tasks";
	} catch(err) {
		errorBox.style.display = "block";
		switch (err.result) {
			case "user_not_found":
				errorBox.innerText = "There is no user with that e-mail address. You might want to create a new account.";
				break;

			case "wrong_password":
				errorBox.innerText = "That password is wrong. Try again.";
				break;

			default:
				errorBox.innerText = "An unknon error has occured.";
				break;
		}
		button.disabled = false;
	}
});
