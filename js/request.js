export const request = (endpoint, method, body) => {
	let req;

	switch(method){
		case 'GET': case 'DELETE':
			req = GETRequest(method, endpoint, body);
			break;
		case 'POST': case 'PUT':
			req = POSTRequest(method, endpoint, body);
			break;
	}

	return new Promise( (resolve, reject) => {
		fetch(req.endpoint, req.init)
		.then(res => res.json())
		.then(data => {
			if (data.success) {
				resolve(data.data);
			} else {
				reject(data.reason);
			}
		})
		.catch(err => reject(err)); 
	});
}

const GETRequest = (method, endpoint, params) => {
	const urlParams = jsonToUrlParams(params);
	const init = {
		method: method
	};
	return {
		endpoint: endpoint + '?' + urlParams,
		init: init
	};
}

const POSTRequest = (method, endpoint, body) => {
	const init = {
		method: method,
		body: JSON.stringify(body),
		headers: {
			'Content-type': 'application/json'
		}
	};
	return {
		endpoint: endpoint,
		init: init
	};
}

const jsonToUrlParams = (o) => Object.keys(o).map(k => {
	return encodeURIComponent(k) + '=' + encodeURIComponent(o[k])
}).join('&');
