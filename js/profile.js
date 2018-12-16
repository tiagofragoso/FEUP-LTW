import { request } from "./request.js";
import { createModal } from "./overlays.js";
const API_ENDPOINT = '../api/user-follows.php';
const titles = document.querySelector('.profile-top').children;
const following = titles[0].querySelector('h1');
const followers = titles[1].querySelector('h1');
const id = document.querySelector('.profile-wrapper').dataset.id;
following.addEventListener('click', showFollowingModal);
followers.addEventListener('click', showFollowersModal);


async function showFollowingModal() {
	try {
		const res = await request(API_ENDPOINT, 'GET', {id: id, query: 'following'});
		const card = createCard('Following', [...res.data]);
		const modal = createModal(card);
		card.querySelector('i').addEventListener('click', () => modal.remove());
		card.querySelector('i').addEventListener('click', () => document.querySelector('body').style.overflow = "auto");
		document.querySelector('.full-card').appendChild(modal);
		document.querySelector('body').style.overflow = "hidden";
	} catch (e) {
		console.log(e);
	}
}

async function showFollowersModal() {
	try {
		const res = await request(API_ENDPOINT, 'GET', {id: id, query: 'followers'});
		const card = createCard('Followers', [...res.data]);
		const modal = createModal(card);
		card.querySelector('i').addEventListener('click', () => modal.remove());
		card.querySelector('i').addEventListener('click', () => document.querySelector('body').style.overflow = "auto");
		document.querySelector('.full-card').appendChild(modal);
		document.querySelector('body').style.overflow = "hidden";
	} catch (e) {
		console.log(e);
	}
}

function createCard(title, elems) {
	const div = document.createElement('div');
	div.innerHTML = `<header>
						<i class="fas fa-times"></i>
						<h1>${title}</h1>
					</header>
					<ul></ul>`;
	const ul = div.querySelector('ul');
	elems.forEach(e => {
		const li = document.createElement('li');
		let name = e.name;
		if (name == null) {
			name = "";
		}
		li.innerHTML = `<a class="user-preview" href="/pages/profile.php?id=${e.id}">
							<img class="user-pic" src="/assets/users/${e.id}.jpg" onerror="this.src='/assets/public/profile-placeholder.png'" />
							<span class="user-name"> ${name} </span>
							<span class="user-username"> ${e.username} </span>
						</a>`;
		ul.appendChild(li);
	})
	return div;
}