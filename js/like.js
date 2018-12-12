import { request } from "./request.js";

const API_ENDPOINT = '/api/like.php';
const ratings = document.querySelectorAll('.rating-wrapper');
ratings.forEach(snippet => {
	let context = {};
	context.snippetId = document.querySelector('.snippet-wrapper, .snippet-wrapper-feed').dataset.id;
	context.upvoteBtn = snippet.querySelector('i:first-of-type');
	context.downvoteBtn = snippet.querySelector('i:last-of-type');
	context.points = snippet.querySelector('.snippet-rating');
	context.like = 0;
	context.upvoteBtn.addEventListener('click', likeHandler.bind(context));
	context.downvoteBtn.addEventListener('click', likeHandler.bind(context));
	checkLike.call(context);
})

function updateVisual() {
	if (this.like === 1) {
		this.downvoteBtn.classList.remove('downvote');
		this.points.classList.remove('downvote');
		this.upvoteBtn.classList.add('upvote');
		this.points.classList.add('upvote');
	} else if (this.like === -1) {
		this.upvoteBtn.classList.remove('upvote');
		this.points.classList.remove('upvote');
		this.downvoteBtn.classList.add('downvote');
		this.points.classList.add('downvote');
	} else if (this.like === 0) {
		this.upvoteBtn.classList.remove('upvote');
		this.points.classList.remove('upvote');
		this.downvoteBtn.classList.remove('downvote');
		this.points.classList.remove('downvote');
	}
}

async function checkLike() {
	try {
		const res = await request(API_ENDPOINT, 'GET', {snippet: this.snippetId});
		if (res.hasLike === 1){
			this.like = 1;
		} else if (res.hasLike === -1) {
			this.like = -1;
		}
		updateVisual.call(this);
	} catch (e) {
		console.log(e);
	}
}

async function likeHandler(event) {
	if (event.currentTarget === this.upvoteBtn){
		if (this.like === 1){
			try {
				await request(API_ENDPOINT, 'DELETE', {snippet: this.snippetId});
				this.like = 0;
				this.points.textContent = parseInt(this.points.textContent) - 1;
				updateVisual.call(this);
			} catch (e){
				console.log(e);
			}
		}
		else if (this.like === 0 || this.like === -1){
			try {
				await request(API_ENDPOINT, 'POST', {snippet: this.snippetId, isLike: 1});
				this.points.textContent = parseInt(this.points.textContent) + 1 - this.like;
				this.like = 1;
				updateVisual.call(this);
			} catch (e) {
				console.log(e);
			}	
		}
	} else if (event.currentTarget === this.downvoteBtn){
		if (this.like === -1) {
			try {
				await request(API_ENDPOINT, 'DELETE', {snippet: this.snippetId});
				this.like = 0;
				this.points.textContent = parseInt(this.points.textContent) + 1;
				updateVisual.call(this);
			} catch (e) {
				console.log(e);
			}
		} else if (this.like === 0 || this.like === 1) {
			try {
				await request(API_ENDPOINT, 'POST', {snippet: this.snippetId, isLike: 0});
				this.points.textContent = parseInt(this.points.textContent) - 1 - this.like;
				this.like = -1;
				updateVisual.call(this);
			} catch (e) {
				console.log(e);	
			}
		}
	}
}
