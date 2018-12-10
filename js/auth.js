import { request } from "./request.js";

const API_ENDPOINT = '/api/auth.php';

const toggle = document.querySelector('.toggle');
const toggleBtn = toggle.querySelector('button');
const form = document.querySelector('form');
const submitBtn = document.querySelector('input[type="submit"]');
const labels = document.querySelectorAll('span');
const loginLabel = labels[0];
const signupLabel = labels[1];
const inputs = form.querySelectorAll('.input-field-wrapper');
const emailEl = inputs[0];
const usernameEl = inputs[1];
const passwordEl = inputs[2];
const repPassEl = inputs[3];

// Set submit action
submitBtn.addEventListener('click', submitAuth);

// login => 0 | signup => 1
let state = 0;

toggle.addEventListener('click', changeState);

function changeState() {
	inputs.forEach(removeError);
	if (state === 0) {
		toggle.classList.add('active');
		toggleBtn.classList.add('active');
		emailEl.style.display = 'block';
		repPassEl.style.display = 'block';
		submitBtn.setAttribute('value', 'SIGNUP');
		signupLabel.style.color = 'var(--blue)';
		loginLabel.style.color = 'initial';
		state = 1;
	} else {
		toggle.classList.remove('active');
		toggleBtn.classList.remove('active');
		emailEl.style.display = 'none';
		repPassEl.style.display = 'none';
		submitBtn.setAttribute('value', 'LOGIN');
		loginLabel.style.color = 'var(--blue)';
		signupLabel.style.color = 'initial';
		state = 0;
	}
}

async function submitAuth(event) {
	event.preventDefault();
	if (!validateForm())
			return;
	if (state === 0) {
		try {
			await request(API_ENDPOINT, 'PUT', {user, pass});
			window.location.href = '/pages/feed.php';
		} catch (e) {
			console.log(e);
		}
	} else {
		try {
			await request(API_ENDPOINT, 'POST', {email, user, pass});
			window.location.href = '/pages/feed.php';
		} catch (e) {
			console.log(e);
		}
	}
}

function setError(field, message) {
	let element;
	switch(field) {
		case 'username':
			element = usernameEl;
			break;
		case 'password':
			element = passwordEl;
			break;
		case 'repPass':
			element = repPassEl;
			break;
		case 'email':
			element = emailEl;
			break;
	}
	element.querySelector('input').classList.add('invalid');
	element.querySelector('p').textContent = message;
}

function removeError (el) {
	const i = el.querySelector('input');
	const t = el.querySelector('p');
	i.classList.remove('invalid');
	t.textContent = '';
}

function validateForm() {
	inputs.forEach(removeError);
	let valid = true;

	let email = emailEl.querySelector('input').value;		
	let user = usernameEl.querySelector('input').value;		
	let pass = passwordEl.querySelector('input').value;
	let repPass = repPassEl.querySelector('input').value;
	
	if ((user = user.trim()) == ''){
		setError('username', 'Username can\'t be empty');
		valid = false;
	}
	
	if ((pass = pass.trim()) == '') {
		setError('password', 'Password can\'t be empty');
		valid = false;
	}

	if (state === 1) {
		if ((email = email.trim()) == '') {
			setError('email', 'Email can\'t be empty');
			valid = false;
		}

		if ((repPass = repPass.trim()) == '') {
			setError('repPass', 'Password can\'t be empty');
			valid = false;
		}
		
		if (repPass !== pass) {
			setError('repPass', 'Passwords don\'t match');
			valid = false;
		}
	}
	
	return valid;
}