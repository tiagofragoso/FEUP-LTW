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
}

function createCard(channel) {
	const card = document.createElement('div');
	card.className = 'hoverable-card';
	card.innerHTML = 
		`<a class="hoverable-card-content" href="/pages/channels?code=${channel.code}">
			<span class="hoverable-card-title">${channel.name}</span>
			<div class="hoverable-card-info">${channel.nr} snippets</div>
		</a>
		<div class="hover-content">
			<button>${channel.follows? 'Unf': 'F'}ollow</button>
		</div>`;
		return card;
}