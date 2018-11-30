const func = async () => {
	try {
		await loginUser(username, password);
		display_success();
	} catch (err_msg) {
		display_error(err_msg);
	}
}