document.querySelector('#loadSnippets').addEventListener('click', loadSnippets);
let offset = 10;
function loadSnippets() {
	console.log(offset);
	offset += 10;
}