import { createModal } from "./modal.js";
const navBar = document.querySelector('nav');
const ham = navBar.querySelector('.menu > i');
const search = navBar.querySelector('.search > i');
search.addEventListener('click', expandSearch);
ham.addEventListener('click', expandMenu);
const hamModal = createModal(getNavBarData());
navBar.parentNode.appendChild(hamModal); 

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

function expandMenu(event) {
	hamModal.style.width = '100%';
	event.currentTarget.classList.replace('fa-bars', 'fa-times');
	event.currentTarget.removeEventListener('click', expandMenu);
	event.currentTarget.addEventListener('click', contractMenu);
}

function contractMenu(event) {
	hamModal.style.width = '0%';
	event.currentTarget.classList.replace('fa-times', 'fa-bars');
	event.currentTarget.removeEventListener('click', contractMenu);
	event.currentTarget.addEventListener('click', expandMenu);
}

function expandSearch(event) {
	hamModal.style.width = '100%';
	event.currentTarget.classList.replace('fa-search', 'fa-times');
	event.currentTarget.removeEventListener('click', expandSearch);
	event.currentTarget.addEventListener('click', contractSearch);
}

function contractSearch(event) {
	hamModal.style.width = '0%';
	event.currentTarget.classList.replace('fa-times', 'fa-search');
	event.currentTarget.removeEventListener('click', contractSearch);
	event.currentTarget.addEventListener('click', expandSearch);
}