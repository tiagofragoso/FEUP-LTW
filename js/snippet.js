import { request } from "./request.js";

const API_ENDPOINT = '/api/like.php';
const ratingWrapper = document.querySelector('.rating-wrapper');
const snippetId = ratingWrapper.querySelector('#snippetId').textContent;
const upvoteBtn = ratingWrapper.querySelector('i:first-of-type');
const downvoteBtn = ratingWrapper.querySelector('i:last-of-type');
const points = ratingWrapper.querySelector('.snippet-rating');

upvoteBtn.addEventListener('click', likeHandler);
downvoteBtn.addEventListener('click', likeHandler);

let like = 0;

checkLike();

function updateVisual() {
	if (like === 1) {
		downvoteBtn.className = downvoteBtn.className.replace(' downvote', '');
		points.className = points.className.replace(' downvote', '');
		upvoteBtn.className += ' upvote';
		points.className += ' upvote';
	} else if (like === -1) {
		upvoteBtn.className = upvoteBtn.className.replace(' upvote', '');
		points.className = points.className.replace(' upvote', '');
		downvoteBtn.className += ' downvote';
		points.className += ' downvote';
	} else if (like === 0) {
		upvoteBtn.className = upvoteBtn.className.replace(' upvote', '');
		points.className = points.className.replace(' upvote', '');
		downvoteBtn.className = downvoteBtn.className.replace(' downvote', '');
		points.className = points.className.replace(' downvote', '');
	}
}

async function checkLike() {
	try {
		const res = await request(API_ENDPOINT, 'GET', {snippet: snippetId});
		if (res.hasLike === 1){
			like = 1;
		} else if (res.hasLike === -1) {
			like = -1;
		}
	} catch (e) {
		console.log(e);
	}
	updateVisual();
}

async function likeHandler(event) {
	if (event.currentTarget === upvoteBtn){
		if (like === 1){
			try {
				await request(API_ENDPOINT, 'DELETE', {snippet: snippetId});
				like = 0;
				points.textContent = parseInt(points.textContent) - 1;
				updateVisual();
			} catch (e){
				console.log(e);
			}
		}
		else if (like === 0 || like === -1){
			try {
				await request(API_ENDPOINT, 'POST', {snippet: snippetId, isLike: 1});
				points.textContent = parseInt(points.textContent) + 1 - like;
				like = 1;
				updateVisual();
			} catch (e) {
				console.log(e)
			}	
		}
	} else if (event.currentTarget === downvoteBtn){
		if (like === -1) {
			try {
				await request(API_ENDPOINT, 'DELETE', {snippet: snippetId});
				like = 0;
				points.textContent = parseInt(points.textContent) + 1;
				updateVisual();
			} catch (e) {
				console.log(e);
			}
		} else if (like === 0 || like === 1) {
			try {
				await request(API_ENDPOINT, 'POST', {snippet: snippetId, isLike: 0});
				points.textContent = parseInt(points.textContent) - 1 - like;
				like = -1;
				updateVisual();
			} catch (e) {
				console.log(e);	
			}
		}
	}
}
