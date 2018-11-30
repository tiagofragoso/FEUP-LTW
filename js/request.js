export const request = (endpoint, method, body) => 
	new Promise( (resolve, reject) => {
		fetch(`/api/${endpoint}.php`, {
			method: method,
			body: body,
			headers: {
				'Content-Type': 'application/json'
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