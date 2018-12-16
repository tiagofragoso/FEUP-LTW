import { createOverlay } from "./overlays.js";
import { request } from "./request.js";
const navBar = document.querySelector('nav');
const ham = navBar.querySelector('.menu > i');
const search = navBar.querySelector('.search > i');
search.addEventListener('click', expandSearch);
ham.addEventListener('click', expandMenu);
const hamModal = createOverlay(getNavBarData(), 'left');
const searchModal = createOverlay(createSearchEl(), 'right');
navBar.parentNode.appendChild(hamModal); 
navBar.parentNode.appendChild(searchModal); 

function getNavBarData() {
	const menu = navBar.querySelector('.menu');
	const ul = document.createElement('ul');
	menu.querySelector('.nav-items').querySelectorAll('li').forEach(e => ul.appendChild(e.cloneNode(true)));
	const menuRightItems = menu.querySelector('.menu-right').querySelectorAll('li');
	ul.appendChild(menuRightItems[0].cloneNode(true));
	if (menuRightItems[1]) {
		for (let item of menuRightItems[1].querySelectorAll('.dropdown-content > a')){
			const li = document.createElement('li');
			li.appendChild(item.cloneNode(true));
			ul.appendChild(li);
		}
	}	
	return ul;
}

function createSearchEl() {
	const input = document.createElement('input');
	input.setAttribute('type', 'text');
	input.setAttribute('placeholder', 'Type something');
	
	return input;
}

function expandMenu() {
	contractSearch();
	hamModal.style.width = '100%';
	ham.classList.replace('fa-bars', 'fa-times');
	ham.removeEventListener('click', expandMenu);
	ham.addEventListener('click', contractMenu);
}

function contractMenu() {
	hamModal.style.width = '0%';
	ham.classList.replace('fa-times', 'fa-bars');
	ham.removeEventListener('click', contractMenu);
	ham.addEventListener('click', expandMenu);
}

function expandSearch() {
	contractMenu();
	searchModal.style.width = '100%';
	search.classList.replace('fa-search', 'fa-times');
	search.removeEventListener('click', expandSearch);
	search.addEventListener('click', contractSearch);
}

function contractSearch() {
	searchModal.style.width = '0%';
	search.classList.replace('fa-times', 'fa-search');
	search.removeEventListener('click', contractSearch);
	search.addEventListener('click', expandSearch);
}

const API_ENDPOINT = '/api/search.php';
const LINKS = {
	users: '/pages/profile.php?id=',
	snippets: '/pages/snippet.php?id=',
	channels: '/pages/channels.php?code='
};

const searchForm = document.querySelector('nav form');
const searchInput = searchForm.querySelector('input');
const searchResults = document.querySelector('nav .search-results');
searchInput.addEventListener('focus', performSearch);
searchInput.addEventListener('blur', hideSearch);
searchInput.addEventListener('input', performSearch);
async function performSearch(event) {
	while (searchResults.firstChild) {
		searchResults.removeChild(searchResults.firstChild);
	}
	const query = searchInput.value;
	if (query.length === 0){
		hideSearch();
		return;
	}
	try {
		const res = await request(API_ENDPOINT, 'GET', {query});
		let empty = true;
		for (let key in res) {
			const object = res[key];
			if (Object.keys(object).length > 0) {
				const li = document.createElement('li');
				li.style.textTransform = 'capitalize';
				li.className = 'faded';
				li.textContent = key;
				searchResults.appendChild(li);
				var currentKey = LINKS[key];
			}
			let count = 0;
			for (let key2 in object) {
				if (count >= 3 ) break;
				empty = false;
				const result = object[key2];
				const li = document.createElement('li');
				li.className = 'result';
				const link = document.createElement('a');
				link.setAttribute('href', currentKey+(result.id || result.code));
				link.textContent = result.match;
				li.appendChild(link);
				searchResults.appendChild(li);
				count++;
			}
		}
		if (empty){
			const li = document.createElement('li');
			li.className = 'faded';
			li.textContent = `No results found`;
			searchResults.appendChild(li);
		}
		searchInput.style.borderBottomLeftRadius = '0';
		searchForm.querySelector('button').style.borderBottomRightRadius = '0';
		searchResults.style.maxHeight = '1000px';
		return searchResults;
	} catch (e) {
		console.log(e);
	}
}

function hideSearch() {
	event.stopPropagation();
	searchResults.style.maxHeight = '0';
	searchInput.style.borderBottomLeftRadius = '5px';
	searchForm.querySelector('button').style.borderBottomRightRadius = '5px';
}