import { updateTask, deleteTask, createTask } from "./api.js";

const tasks = document.getElementById("tasks");
const taskAddButton = document.getElementById("task-add-button");
const rowTemplateContent = document.getElementById("task-row-template").content;

function onCheckmarkChange(ev) {
	const row = ev.currentTarget.parentElement.parentElement;
	const taskId = row.dataset.taskId;

	if (taskId) {
		updateTask({
			id: taskId,
			completed: ev.target.checked
		});
	}
}

function onEditButtonClick(ev) {
	if (ev.currentTarget.tagName !== "BUTTON") return;

	const row = ev.currentTarget.parentElement.parentElement;

	row.querySelector(".task-input").disabled = false;
	row.querySelector(".task-input").focus();

	row.querySelector(".task-edit-button").style.display = "none";
	row.querySelector(".task-save-button").style.display = "inline";
}

async function onSaveButtonClick(ev) {
	if (ev.currentTarget.tagName !== "BUTTON") return;

	const row = ev.currentTarget.parentElement.parentElement;
	const taskId = row.dataset.taskId;

	const content = row.querySelector(".task-input").value;

	row.querySelector(".task-input").disabled = true;

	// Disable the button to provide feedback
	row.querySelector(".task-save-button").disabled = true;
	try {
		if (taskId) {
			await updateTask({
				id: taskId,
				content
			});
		} else {
			row.dataset.taskId = (await createTask({
				content,
				completed: row.querySelector(".task-checkbox").checked
			}));
			row.querySelector(".task-share-button").style.display = "inline";
		}
	} finally {
		row.querySelector(".task-save-button").disabled = false;
	}

	row.querySelector(".task-edit-button").style.display = "inline";
	row.querySelector(".task-save-button").style.display = "none";
}

function onDeleteButtonClick(ev) {
	if (ev.currentTarget.tagName !== "BUTTON") return;

	const row = ev.currentTarget.parentElement.parentElement;
	const taskId = row.dataset.taskId;

	if (taskId) {
		deleteTask(taskId);
	}

	row.remove();
}

function onShareButtonClick(ev) {
	if (ev.currentTarget.tagName !== "BUTTON") return;

	const row = ev.currentTarget.parentElement.parentElement;
	const taskId = row.dataset.taskId;

	const shareURL = new URL("/shared?id=" + taskId, location.href).href;

	navigator.clipboard.writeText(shareURL);
}

function addEventListenersToRow(row) {
	row.children[0].children[0].addEventListener("change", onCheckmarkChange);
	row.querySelector(".task-edit-button").addEventListener("click", onEditButtonClick);
	row.querySelector(".task-save-button").addEventListener("click", onSaveButtonClick);
	row.querySelector(".task-delete-button").addEventListener("click", onDeleteButtonClick);
	row.querySelector(".task-share-button").addEventListener("click", onShareButtonClick);
}

for (const row of tasks.children) {
	addEventListenersToRow(row);
}


taskAddButton.addEventListener("click", () => {
	const row = rowTemplateContent.cloneNode(true);
	addEventListenersToRow(row);
	tasks.append(row);
});
