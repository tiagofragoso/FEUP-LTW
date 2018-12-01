import { request } from "./request.js";

const API_ENDPOINT = '/api/like.php';
const ratings = document.querySelectorAll('.rating-wrapper');
ratings.forEach(snippet => {
	let rating = {};
	rating.snippetId = snippet.querySelector('#snippetId').textContent;
	rating.upvoteBtn = snippet.querySelector('i:first-of-type');
	rating.downvoteBtn = snippet.querySelector('i:last-of-type');
	rating.points = snippet.querySelector('.snippet-rating');
	rating.like = 0;
	rating.upvoteBtn.addEventListener('click', likeHandler.bind(rating));
	rating.downvoteBtn.addEventListener('click', likeHandler.bind(rating));
	checkLike.call(rating);
})

function updateVisual() {
	if (this.like === 1) {
		this.downvoteBtn.className = this.downvoteBtn.className.replace(' downvote', '');
		this.points.className = this.points.className.replace(' downvote', '');
		this.upvoteBtn.className += ' upvote';
		this.points.className += ' upvote';
	} else if (this.like === -1) {
		this.upvoteBtn.className = this.upvoteBtn.className.replace(' upvote', '');
		this.points.className = this.points.className.replace(' upvote', '');
		this.downvoteBtn.className += ' downvote';
		this.points.className += ' downvote';
	} else if (this.like === 0) {
		this.upvoteBtn.className = this.upvoteBtn.className.replace(' upvote', '');
		this.points.className = this.points.className.replace(' upvote', '');
		this.downvoteBtn.className = this.downvoteBtn.className.replace(' downvote', '');
		this.points.className = this.points.className.replace(' downvote', '');
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
	} catch (e) {
		console.log(e);
	}
	updateVisual.call(this);
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
				console.log(e)
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
