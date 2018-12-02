import { request } from "./request.js";

const API_ENDPOINT = '/api/language.php';
const cards = document.querySelectorAll('.card');

const userLanguages = cards[0];
const exploreLanguages = cards[1];

createChannels();

async function createChannels() {
	try {
		const res = await request(API_ENDPOINT, 'GET', {});
		res.forEach(channel => {
			exploreLanguages.appendChild(createCard(channel));
		}); 
	} catch(e) {
		console.log(e);
	}
}

function createCard(channel) {
	const card = document.createElement('div');
	card.className = 'hoverable-card';
	card.innerHTML = 
		`<div class="hoverable-card-content">
			<span class="hoverable-card-title">${channel.name}</span>
			<div class="hoverable-card-info">${channel.nr} snippets</div>
		</div>
		<div class="hover-content">
			<button>Follow</button>
		</div>`;
		return card;
}