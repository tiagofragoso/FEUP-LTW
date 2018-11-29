document.querySelector('.new-snippet-wrapper').querySelectorAll('button').forEach(
	btn => btn.addEventListener('click', tabSwitcher)
);

document.querySelector('.new-snippet-wrapper form').addEventListener('submit', alert('n faz nada '));

function reloadPrism() {
	const prism = document.createElement('script');
	prism.id = 'prism';
	prism.src = '/prism.js';
	document.querySelector('#prism').remove();
	document.querySelector('head').appendChild(prism);
}

let codeTextArea = document.querySelector('#code-area');
codeTextArea.addEventListener('keydown', catchTab);
let previewArea = document.querySelector('#preview-area');
let previewCodeElem = previewArea.querySelector('code');

function tabSwitcher(event){
	event.preventDefault();
	document.querySelectorAll('.tabs button').forEach(btn => btn.className=btn.className.replace('active', ''));
	event.currentTarget.className += ' active';
	
	if (event.currentTarget.id === 'preview-mode'){
		const select = document.querySelector('.new-snippet-wrapper select');
		const currentLang = `language-${select.options[select.selectedIndex].value}`;
		const textContent = codeTextArea.value;
		codeTextArea.style.display = 'none';
		previewCodeElem.className = currentLang;
		previewCodeElem.innerHTML = textContent;
		previewArea.className = `line-numbers ${currentLang}`;
		reloadPrism();
		const height = window.getComputedStyle(codeTextArea).getPropertyValue('height');
		console.log(height);
		previewArea.style.height = height;
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