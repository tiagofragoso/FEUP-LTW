import { request } from "./request.js";

const API_ENDPOINT = '/api/channel.php';
const cards = document.querySelectorAll('.card');

const userLanguages = cards[0];
const exploreLanguages = cards[1];

setupChannels();

//<span><a href="/pages/login.php">Login</a> to follow language channels</span>

async function setupChannels(){
	try {
		const res = await request(API_ENDPOINT, 'GET', {});
		res.forEach(channel => {
			if (channel.follows == null)
				exploreLanguages.appendChild(createCard(channel));
			else 
				userLanguages.appendChild(createCard(channel));
		}); 
			
	} catch(e) {
		console.log(e);
	}

	const span = document.createElement('span');
	const span1 = document.createElement('span');
	span.className = 'channels-info';
	span1.className = 'channels-info';
	span.textContent = 'You don\'t follow any languages yet';
	userLanguages.appendChild(span);
	span1.textContent = 'There\'s nothing left for you to explore';
	exploreLanguages.appendChild(span1);

	if (userLanguages.children.length > 1){
		span.style.display = "none";
	} else if (exploreLanguages.children.length > 1) {
		span1.style.display = "none";
	}
		
}

function createCard(channel) {
	const card = document.createElement('div');
	card.className = 'hoverable-card';
	card.innerHTML = 
		`<a class="hoverable-card-content" href="/pages/channels.php?code=${channel.code}">
			<span class="hoverable-card-title">${channel.name}</span>
			<div class="hoverable-card-info">${channel.nr} snippets</div>
		</a>
		<div class="hover-content">
		</div>`;

	const button = document.createElement('button');
	button.textContent = `${channel.follows? 'Unf': 'F'}ollow`;

	button.addEventListener('click', async () => {
		try {
			await request(API_ENDPOINT, channel.follows? 'DELETE' : 'POST', {channel: channel.code});
			channel.follows = !channel.follows;
			button.textContent = `${channel.follows? 'Unf': 'F'}ollow`;
			moveCard(card, !channel.follows);
		} catch (e) {
			console.log(e);
		}
	});

	card.querySelector('.hover-content').appendChild(button);
	return card;
}

function moveCard(card, to){
	card.remove();
	cards[+ to].appendChild(card);
	updateDisplay();
}

function updateDisplay() {
	const user_languages = userLanguages.querySelector('.channels-info:first-of-type');
	const explore_languages = exploreLanguages.querySelector('.channels-info:last-of-type');

	if (userLanguages.children.length > 1) {
		user_languages.style.display = "none";
	} else {
		console.log(userLanguages.children.length);
		user_languages.style.display = "initial";
	}

	if (exploreLanguages.children.length > 1) {
		explore_languages.style.display = "none";
	} else {
		explore_languages.style.display = "initial";
		console.log(exploreLanguages.children.length);
	}
}