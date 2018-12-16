import { request } from "./request.js";
import { createModal } from "./overlays.js";
const API_ENDPOINT = '../api/user-follows.php';
const titles = document.querySelector('.profile-top').children;
const following = titles[0].querySelector('h1');
const followers = titles[1].querySelector('h1');
const id = document.querySelector('.profile-wrapper').dataset.id;
following.addEventListener('click', showFollowingModal);


async function showFollowingModal() {
	try {
		const res = await request(API_ENDPOINT, 'GET', {id: id, query: 'following'});
		const card = createCard('Following', [...res.data]);
		const modal = createModal(card);
		document.querySelector('.full-card').appendChild(modal);
	} catch (e) {
		console.log(e);
	}
}

function createCard(title, elems) {
	const div = document.createElement('div');
	div.innerHTML = `<header><h1>${title}</h1></header>
	<ul></ul>`;
	const ul = div.querySelector('ul');
	elems.forEach(e => {
		const li = document.createElement('li');
		li.innerHTML = `<a href="../pages/profile.php?id=${e.id}">${e.username}</a>`;
		ul.appendChild(li);
	})
	return div;
}