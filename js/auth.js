import { request } from "./request.js";

const API_ENDPOINT = '/api/auth.php';

const toggle = document.querySelector('.toggle');
const toggleBtn = toggle.querySelector('button');
const form = document.querySelector('form');
const submitBtn = document.querySelector('input[type="submit"]');
const labels = document.querySelectorAll('span');
const loginLabel = labels[0];
const signupLabel = labels[1];

// Signup fields
const emailField = document.createElement('input');
const emailAttrs = {'type': 'email', 'name': 'email', 'placeholder': 'e-mail', 'required': 'required'};
for (const k in emailAttrs) {
	const e = emailAttrs[k];
	emailField.setAttribute(k, e);	
}

const repPassField = document.createElement('input');
const repPassAttrs = {'type': 'password', 'name': 'repPass', 'placeholder': 'repeat password', 'required': 'required'};
for (const k in repPassAttrs) {
	const e = repPassAttrs[k];
	repPassField.setAttribute(k, e);	
}

// Set submit action
submitBtn.addEventListener('click', submitAuth);

// login => 0 | signup => 1
let state = 0;

toggle.addEventListener('click', changeState);

function changeState() {
	if (state === 0) {
		toggle.classList.add('active');
		toggleBtn.classList.add('active');
		form.insertBefore(emailField, form.querySelector('input'));
		form.appendChild(repPassField);
		submitBtn.setAttribute('value', 'SIGNUP');
		signupLabel.style.color = 'var(--blue)';
		loginLabel.style.color = 'initial';
		state = 1;
	} else {
		toggle.classList.remove('active');
		toggleBtn.classList.remove('active');
		emailField.remove();
		repPassField.remove();
		submitBtn.setAttribute('value', 'LOGIN');
		loginLabel.style.color = 'var(--blue)';
		signupLabel.style.color = 'initial';
		state = 0;
	}
}

async function submitAuth(event) {
	event.preventDefault();
	if (state === 0) {
		let username = form.querySelector('input[name="username"]').value;		
		let password = form.querySelector('input[name="password"]').value;
		if ((username = username.trim()) == ''){
			alert('Empty username');
			return;
		} else if ((password = password.trim()) == '') {
			alert('Empty password');
			return;
		}
		try {
			await request(API_ENDPOINT, 'PUT', {username, password});
			window.location.href = '/pages/feed.php';
		} catch (e) {
			console.log(e);
		}
	} else {
		let email = form.querySelector('input[name="email"]').value;		
		let username = form.querySelector('input[name="username"]').value;		
		let password = form.querySelector('input[name="password"]').value;
		let repPassword = form.querySelector('input[name="repPass"]').value;
		
		if ((username = username.trim()) == ''){
			alert('Empty username');
			return;
		} else if ((password = password.trim()) == '') {
			alert('Empty password');
			return;
		} else if ((repPassword = repPassword.trim()) == '') {
			alert('Empty repeated password');
			return;
		} else if (repPassword !== password) {
			alert('Different passwords');
			return;
		} else if ((email = email.trim()) == '') {
			alert('Empty email');
			return;
		}

		try {
			await request(API_ENDPOINT, 'POST', {email, username, password});
			window.location.href = '/pages/feed.php';
		} catch (e) {
			console.log(e);
		}
	}
}