const links = document.querySelectorAll('.snippet-wrapper .info-wrapper .expand-title');
links.forEach(l => l.addEventListener('click', expand));

const deleteButton = document.querySelector('.delete-button');
if (deleteButton !== null) {
	deleteButton.addEventListener('click', deleteSnippet);
}

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

async function deleteSnippet() {
	const snippet = snippetId;
	const snippets = {snippet};
	try {
		await request('../api/snippet.php', 'DELETE', snippets);
		window.location.href = '../pages/feed.php'; 
	} catch(e) {
		console.log(e);
	}
}
