import {request} from "./request.js";

document.querySelector('.new-snippet-wrapper').querySelectorAll('button').forEach(
	btn => btn.addEventListener('click', tabSwitcher)
);

document.querySelector('.new-snippet-wrapper form')
	.addEventListener('submit', submitSnippet);

document.querySelector('.new-snippet-wrapper #file-upload')
	.addEventListener('change', uploadFile);

function reloadPrism() {
	const prism = document.createElement('script');
	prism.id = 'prism';
	prism.src = '/js/prism.js';
	document.querySelector('#prism').remove();
	document.querySelector('head').appendChild(prism);
}

let uploadBut = document.querySelector('.new-snippet-wrapper label[for="file-upload"]');
let codeTextArea = document.querySelector('#code-area');
codeTextArea.addEventListener('keydown', catchTab);
let previewArea = document.querySelector('#preview-area');
let previewCodeElem = previewArea.querySelector('code');

function uploadFile() {
	if (!codeAreaIsEmtpy()){
		if (!confirm('This will override any written code. Proceed?'))
			return;
	}
	const file = event.currentTarget.files[0];
	const reader = new FileReader();
	reader.onload = () => {
		codeTextArea.textContent = reader.result;
	}
	reader.readAsText(file);	
}

function tabSwitcher(event){
	event.preventDefault();
	document.querySelectorAll('.tabs button').forEach(btn => btn.className=btn.className.replace('active', ''));
	event.currentTarget.className += ' active';
	
	if (event.currentTarget.id === 'preview-mode'){
		const select = document.querySelector('.new-snippet-wrapper select');
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
		previewArea.style.display = 'none';
		codeTextArea.style.display = 'block';
	}
}

const KeyTab = 9; // key tab => magic constant

function catchTab(event) {
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
	const form = document.querySelector('.new-snippet-wrapper form');
	const title = form.querySelector('#title').value;
	if (title.trim() === '') {
		alert("Empty title");
		return;
	}
	const description = form.querySelector('#description').value;
	const language = form.querySelector('#language').value;
	const code = form.querySelector('#code-area').value;
	if (code.trim() === '') {
		alert("Empty code");
		return;
	}
	const newSnippet = {title, description, language, code, author};

	try {
		await request('/api/snippet.php', 'POST', newSnippet);
		alert('Submitted!');
		window.location.assign('/pages/feed.php');
	} catch (err) {
		alert(err);
	}
}
