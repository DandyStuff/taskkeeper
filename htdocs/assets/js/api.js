export class APIError extends Error {
	result;

	constructor(result) {
		super(result);

		this.result = result;
	}
}
APIError.prototype.name = "APIError";

export async function apiReq(endpoint, method, data) {
	const requestOptions = {};
	requestOptions.method = method;
	if (data !== undefined) {
		requestOptions.body = JSON.stringify(data);
	}

	const resp = await (await fetch("/api" + endpoint, requestOptions)).json();

	if (resp.result !== "ok") {
		throw new APIError(resp.result);
	}

	return resp;
}

export async function login(email, password) {
	await apiReq("/login", "POST", { email, password });
}

export async function signup(email, password, first_name, last_name) {
	await apiReq("/signup", "POST", { email, password, first_name, last_name });
}

export async function createTask(options) {
	return (await apiReq("/create-task", "POST", options)).id;
}

export async function updateTask(options) {
	await apiReq("/update-task", "POST", options);
}

export async function deleteTask(id) {
	await apiReq("/delete-task", "POST", { id });
}

export async function updateUserDetails(options) {
	await apiReq("/update-user", "POST", options);
}
