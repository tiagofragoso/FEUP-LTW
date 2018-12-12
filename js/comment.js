import { request } from './request.js';

const API_ENDPOINT = '/api/comment.php'
const comments = document.querySelector('.comments-wrapper');
const newCommentRef = comments.querySelector('#new-comment');
newCommentRef.querySelector('form').addEventListener('submit', postComment);
const snippetId = document.querySelector('.snippet-wrapper').dataset.id;

getSnippetComments();

async function getSnippetComments() {
	let data = await request(API_ENDPOINT, 'GET', {snippet: snippetId});
	data.forEach(comment => {
		comments.insertBefore(createComment(comment), newCommentRef);
	});

}

function createComment(comment) {
	const commentWrapper = document.createElement('div');
	commentWrapper.className = 'comment-wrapper';
	commentWrapper.innerHTML = 
	`<div class="comment-info-wrapper flex-row-container flex-space-between">
		<div class="comment-user-wrapper ">
			<a href="/pages/profile.php?id=${comment.user}" class="comment-user">
				${comment.name? comment.name : comment.username}
			</a>
			<span class="comment-text"> ${comment.text} </span>
		</div>
		<div class="comment-rating-wrapper">
			<i class="fas fa-caret-up"></i>
			<span class="comment-rating">${comment.points}</span>
			<i class="fas fa-caret-down"></i>
		</div>
	</div>
	<div class="comment-footer">
		<span class="comment-date">${comment.date}</span>
	</div>`;
	let context = {};
	context.commentId = comment.id;
	context.upvoteBtn = commentWrapper.querySelector('i:first-of-type');
	context.downvoteBtn = commentWrapper.querySelector('i:last-of-type');
	context.points = commentWrapper.querySelector('.comment-rating');
	context.like = 0;
	context.upvoteBtn.addEventListener('click', likeHandler.bind(context));
	context.downvoteBtn.addEventListener('click', likeHandler.bind(context));
	checkLike.call(context);
	return commentWrapper;
}

async function postComment(event) {
	event.preventDefault();
	const text = newCommentRef.querySelector('textarea').value;
	if (text.trim() == '') {
		alert('Comment text cant be empty');
		return;
	} 
	try {
		const data = await request(API_ENDPOINT, 'POST', {snippet: snippetId, text: text});
		comments.insertBefore(createComment({...data, text: text, points: 0}), newCommentRef);
		newCommentRef.querySelector('textarea').value = "" ;
	} catch (e) {

	}
}

function updateVisual() {
	console.log(this.downvoteBtn);
	console.log(this.upvoteBtn);
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
		const res = await request('/api/like-comment.php', 'GET', {comment: this.commentId});
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
				await request('/api/like-comment.php', 'DELETE', {comment: this.commentId});
				this.like = 0;
				this.points.textContent = parseInt(this.points.textContent) - 1;
				updateVisual.call(this);
			} catch (e){
				console.log(e);
			}
		}
		else if (this.like === 0 || this.like === -1){
			try {
				await request('/api/like-comment.php', 'POST', {comment: this.commentId, isLike: 1});
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
				await request('/api/like-comment.php', 'DELETE', {comment: this.commentId});
				this.like = 0;
				this.points.textContent = parseInt(this.points.textContent) + 1;
				updateVisual.call(this);
			} catch (e) {
				console.log(e);
			}
		} else if (this.like === 0 || this.like === 1) {
			try {
				await request('/api/like-comment.php', 'POST', {comment: this.commentId, isLike: 0});
				this.points.textContent = parseInt(this.points.textContent) - 1 - this.like;
				this.like = -1;
				updateVisual.call(this);
			} catch (e) {
				console.log(e);	
			}
		}
	}
}

