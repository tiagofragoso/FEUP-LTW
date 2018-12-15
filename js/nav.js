import { createModal } from "./modal.js";
import { request } from "./request.js";
const navBar = document.querySelector('nav');
const ham = navBar.querySelector('.menu > i');
const search = navBar.querySelector('.search > i');
search.addEventListener('click', expandSearch);
ham.addEventListener('click', expandMenu);
const hamModal = createModal(getNavBarData(), 'left');
const searchModal = createModal(createSearchEl(), 'right');
navBar.parentNode.appendChild(hamModal); 
navBar.parentNode.appendChild(searchModal); 

function getNavBarData() {
	const menu = navBar.querySelector('.menu');
	const ul = document.createElement('ul');
	menu.querySelector('.nav-items').querySelectorAll('li').forEach(e => ul.appendChild(e.cloneNode(true)));
	const menuRightItems = menu.querySelector('.menu-right').querySelectorAll('li');
	ul.appendChild(menuRightItems[0].cloneNode(true));
	if (menuRightItems[1]) {
		const li2 = document.createElement('li');
		li2.appendChild(menuRightItems[1].querySelectorAll('.dropdown-content > a')[1].cloneNode(true));
		const li1 = document.createElement('li');
		li1.setAttribute('href', menuRightItems[1].querySelector('a').getAttribute('href'));
		const img = menuRightItems[1].querySelector('img').cloneNode(true);
		img.style.height = '30px';
		img.style.borderRadius = '5px';
		img.style.marginRight = '1em';
		li1.appendChild(img);
		li1.appendChild(menuRightItems[1].querySelectorAll('.dropdown-content > a')[0].cloneNode(true));
		ul.appendChild(li1);
		ul.appendChild(li2);
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
searchInput.addEventListener('input', performSearch);
async function performSearch(event) {
	event.preventDefault();
	while (searchResults.firstChild) {
		searchResults.removeChild(searchResults.firstChild);
	}
	if (searchInput.value.length === 0){
		searchResults.style.maxHeight = '0';
		searchInput.style.borderBottomLeftRadius = '5px';
		searchForm.querySelector('button').style.borderBottomRightRadius = '5px';
		return;
	}
	const query = searchInput.value;
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
	} catch (e) {
		console.log(e);
	}
}