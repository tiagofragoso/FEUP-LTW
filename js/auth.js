import { request } from "./request.js";

const API_ENDPOINT = '../api/auth.php';

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
const submitEl = submitBtn.parentElement;

const RFC5322EmailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

// Set submit action
submitBtn.addEventListener('click', submitAuth);

// login => 0 | signup => 1
let state = 0;

toggle.addEventListener('click', changeState);

function changeState() {
	inputs.forEach(removeError);
	removeError(submitEl);
	inputs.forEach(e => e.querySelector('input').value = '');
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

	const username = usernameEl.querySelector('input').value;
	const password = passwordEl.querySelector('input').value;
	const email = emailEl.querySelector('input').value;

	if (state === 0) {
		try {
			await request(API_ENDPOINT, 'PUT', {username, password});
			window.location.href = '../pages/feed.php';
		} catch (e) {
			setFormError(e);
		}
	} else {
		try {
			await request(API_ENDPOINT, 'POST', {email, username, password});
			window.location.href = '../pages/feed.php';
		} catch (e) {
			setFormError(e);
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
	removeError(submitEl);
	let valid = true;

	let email = emailEl.querySelector('input').value;		
	let user = usernameEl.querySelector('input').value;		
	let pass = passwordEl.querySelector('input').value;
	let repPass = repPassEl.querySelector('input').value;
	
	if (!user.match(/^[-\w]{5,25}$/)) {
		setError('username', 'Username must be between 5-25 characters.');
		valid = false;
	}
	
	if (!pass.match(/^.{5,25}$/)) {
		setError('password', 'Password must be between 5-30 characters.');
		valid = false;
	}

	if (state === 1) {
		if (!email.match(RFC5322EmailRegex)) {
			setError('email', 'Invalid email address');
			valid = false;
		}
		
		if (!repPass.match(/^.{5,30}$/)) {
			setError('repPass', 'Password must be between 5-30 characters.');
			valid = false;
		} else if (repPass !== pass) {
			setError('repPass', 'Passwords don\'t match');
			valid = false;
		}
	}
	
	return valid;
}

function setFormError(message) {
	submitEl.querySelector('p').textContent = message;
}