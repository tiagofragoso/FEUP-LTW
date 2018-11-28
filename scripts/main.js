document.querySelector('.new-snippet-wrapper').querySelectorAll('button').forEach(
	btn => btn.addEventListener('click', tabSwitcher)
);

function reloadPrism() {
	const prism = document.createElement('script');
	prism.id = 'prism';
	prism.src = '/prism.js';
	document.querySelector('#prism').remove();
	document.querySelector('head').appendChild(prism);
}

let codeTextArea = document.querySelector('#code-area');
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