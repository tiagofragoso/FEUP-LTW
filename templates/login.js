export const loginUser = (username, password) => {
	const body = JSON.stringify({
		username,
		password
	});

	return new Promise((resolve, reject) => {
		fetch("/api/auth.php", {
			method: "POST",
			body: body,
			headers: {
				"Content-Type": "application/json"
			}
		})
		.then(res => res.json())
		.then(data => {
			if (data.success) {
				resolve();
			} else {
				reject(data.reason);
			}
		})
		.catch(err => reject(err));
	});
};