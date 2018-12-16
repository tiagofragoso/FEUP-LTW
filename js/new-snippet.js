import {request} from "./request.js";

const MAX_FILE_SIZE_BYTES = 10 ** 6; // 1MB
const codeTextArea = document.querySelector('#code-area');
const previewArea = document.querySelector('#preview-area');
const previewCodeElem = previewArea.querySelector('code');
const inputs = document.querySelectorAll('.row');
const titleEl = inputs[0];
const descEl = inputs[1];
const langEl = inputs[2];
const fileEl = inputs[3];
const uploadBtn = document.querySelector('.new-snippet-wrapper label[for="file-upload"]');

codeTextArea.addEventListener('input', catchTab);
document.querySelector('.new-snippet-wrapper').querySelectorAll('button').forEach(
	btn => btn.addEventListener('click', tabSwitcher)
);
document.querySelector('.new-snippet-wrapper form').addEventListener('submit', submitSnippet);
document.querySelector('.new-snippet-wrapper #file-upload').addEventListener('change', uploadFile);


function reloadPrism() {
	const prism = document.createElement('script');
	prism.id = 'prism';
	prism.src = '../js/prism.js';
	document.querySelector('#prism').remove();
	document.querySelector('head').appendChild(prism);
}

function resize() {
	codeTextArea.style.height = 'auto';
	codeTextArea.style.height = `${codeTextArea.scrollHeight}px`;
}

function uploadFile() {
	removeError(fileEl);
	if (!codeAreaIsEmtpy()){
		if (!confirm('This will override any written code. Proceed?'))
			return;
	}
	const file = event.currentTarget.files[0];
	if (!validateFile(file))
		return;
	const reader = new FileReader();
	reader.onload = () => {
		codeTextArea.value = reader.result;
		resize();
	}
	reader.readAsBinaryString(file);	
}


function tabSwitcher(event){
	event.preventDefault();
	document.querySelectorAll('.tabs button').forEach(btn => btn.classList.remove('active'));
	event.currentTarget.classList.add('active');
	
	if (event.currentTarget.id === 'preview-mode') {
		uploadBtn.style.display = 'none';
		const select = langEl.querySelector('select');
		let currentLang = `language-${select.options[select.selectedIndex].value}`;
		let textContent = codeTextArea.value;
		codeTextArea.style.display = 'none';
		previewCodeElem.className = currentLang;
		if (codeAreaIsEmtpy()){
			textContent = 'Nothing to preview yet!';
			currentLang = 'language-none';
		}
		previewCodeElem.textContent = textContent;
		previewArea.className = `line-numbers ${currentLang}`;
		reloadPrism();
		previewArea.style.display = 'block';
	} else {
		uploadBtn.style.display = 'initial';
		previewArea.style.display = 'none';
		codeTextArea.style.display = 'block';
	}
}

const KeyTab = 9; // key tab => magic constant

function catchTab(event) {
	resize();
	const key = event.keyCode || event.which;
	if (key == KeyTab) {
		event.preventDefault();
		event.stopPropagation();
		return insertTab();
	}
}

function insertTab() {
	const start = codeTextArea.selectionStart;
	const end = codeTextArea.selectionEnd;
	codeTextArea.value = codeTextArea.value.substring(0, start) + String.fromCharCode(KeyTab) +
		codeTextArea.value.substring(end);
}

function codeAreaIsEmtpy() {
	return codeTextArea.value.trim() == '';
}

async function submitSnippet(event) {
	event.preventDefault();
	if (!validateForm())
		return;
	const form = document.querySelector('.new-snippet-wrapper form');
	const title = form.querySelector('#title').value;
	const description = form.querySelector('#description').value;
	const language = form.querySelector('#language').value;
	const code = form.querySelector('#code-area').value;
	const newSnippet = {title, description, language, code};

	try {
		const res = await request('../api/snippet.php', 'POST', newSnippet);
		window.location.assign(`../pages/snippet.php?id=${res}`);
	} catch (err) {
		setFormError(err);
	}
}

function setError(field, message) {
	let element;
	switch(field) {
		case 'title':
			element = titleEl;
			break;
		case 'description':
			element = descEl;
			break;
		case 'language':
			element = langEl;
			break;
		case 'file':
			element = fileEl;
			break;
	}
	(element.querySelector('.file-input-wrapper') || element.querySelector('input') || element.querySelector('textarea')).classList.add('invalid');
	element.querySelector('.input-info').textContent = message; 
}

function validateFile(file) {
	if (file.size > MAX_FILE_SIZE_BYTES) {
		setError('file', 'File size must be under 1MB');
		return false;
	} 
	if (file.type.match(/^(image|audio|video)\/.*$/)) {
		setError('file', 'Invalid file type');
		return false;
	}
	return true;
}

function removeError(el) {
	(el.querySelector('.file-input-wrapper') || el.querySelector('input') || el.querySelector('textarea')).classList.remove('invalid');
	el.querySelector('.input-info').textContent = '';
}

function validateForm() {
	let valid = true;
	const form = document.querySelector('.new-snippet-wrapper form');
	const title = form.querySelector('#title').value;
	if (!title.match(/^[a-zA-Z]+[ :\-#.\w]{0,69}$/)) {
		setError('title', 'Title must start with a letter and can only contain 70 alphanumeric characters or ":, -, #, ."');
		valid = false;
	}

	const code = form.querySelector('#code-area').value;
	if (code.trim() === '') {
		setError('file', 'The snippet code can\'t be empty')
		valid = false; 
	} 

	return valid;
}

function setFormError(message) {
	document.querySelector('.row > p.input-info').textContent = message;
}