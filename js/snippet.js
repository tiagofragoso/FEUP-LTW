const links = document.querySelectorAll('.snippet-wrapper .info-wrapper .expand-title');
links.forEach(l => l.addEventListener('click', expand));

function expand(event) {
	event.stopPropagation();
	event.currentTarget.nextSibling.nextSibling.classList.toggle('open');
	event.currentTarget.firstChild.textContent = '-';
	event.currentTarget.removeEventListener('click', expand);
	event.currentTarget.addEventListener('click', contract);
}

function contract(event) {
	event.stopPropagation();
	event.currentTarget.nextSibling.nextSibling.classList.remove('open');
	event.currentTarget.firstChild.textContent = '+';
	event.currentTarget.removeEventListener('click', contract);
	event.currentTarget.addEventListener('click', expand);
}