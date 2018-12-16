import { request } from './request.js';

const API_ENDPOINT = '../api/comment.php'
const comments = document.querySelector('.comments-wrapper');
const newCommentRef = comments.querySelector('#new-comment');
newCommentRef.querySelector('form').addEventListener('submit', postComment);
const snippetId = document.querySelector('.snippet-wrapper').dataset.id;
let replyId;


getSnippetComments();

async function getSnippetComments() {
	let data = await request(API_ENDPOINT, 'GET', {snippet: snippetId});
	data.forEach(comment => insertComment(createComment(comment), comment.parent));
}

function insertComment (element, parent) {
	if (parent) {
		const parentComment = comments.querySelector(`.comment-wrapper[data-id="${parent}"]`);
		const children = parentComment.querySelector('ul');
		if (children != null) {
			children.appendChild(element);
		} else {
			const newChildren = document.createElement('ul');
			newChildren.append(element);
			parentComment.appendChild(newChildren);
		}
	} else
		comments.insertBefore(element, newCommentRef);
}

function createComment(comment) {
	const commentWrapper = document.createElement('li');
	commentWrapper.className = 'comment-wrapper';
	commentWrapper.innerHTML = 
	`<div class="comment-content-wrapper flex-row-container flex-space-between">
		<div class="comment-user-wrapper ">
			<a href="../pages/profile.php?id=${comment.user}" class="comment-user">
				${comment.name? comment.name : comment.username}
			</a>
			<span class="comment-text"></span>
		</div>
	</div>
	<div class="comment-footer flex-row-container flex-vert-center">
		<div class="comment-rating-wrapper">
			<i class="fas fa-caret-up"></i>
			<span class="comment-rating">${comment.points}</span>
			<i class="fas fa-caret-down"></i>
		</div>
		<span class="comment-date">${comment.date}</span>
	</div>`;
	commentWrapper.setAttribute('data-id', comment.id);
	commentWrapper.querySelector('.comment-text').textContent = comment.text;
	if (comment.parent == null) {
		const reply = document.createElement('span');
		reply.addEventListener('click', commentReply);
		reply.textContent = 'Reply';
		commentWrapper.querySelector('.comment-footer').insertBefore(reply, commentWrapper.querySelector('.comment-footer .comment-date'));
	}
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
		insertComment(createComment({...data, text: text, points: 0}));
		newCommentRef.querySelector('textarea').value = "";
	} catch (e) {

	}
}

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
		const res = await request('../api/like-comment.php', 'GET', {comment: this.commentId});
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
				await request('../api/like-comment.php', 'DELETE', {comment: this.commentId});
				this.like = 0;
				this.points.textContent = parseInt(this.points.textContent) - 1;
				updateVisual.call(this);
			} catch (e){
				console.log(e);
			}
		}
		else if (this.like === 0 || this.like === -1){
			try {
				await request('../api/like-comment.php', 'POST', {comment: this.commentId, isLike: 1});
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
				await request('../api/like-comment.php', 'DELETE', {comment: this.commentId});
				this.like = 0;
				this.points.textContent = parseInt(this.points.textContent) + 1;
				updateVisual.call(this);
			} catch (e) {
				console.log(e);
			}
		} else if (this.like === 0 || this.like === 1) {
			try {
				await request('../api/like-comment.php', 'POST', {comment: this.commentId, isLike: 0});
				this.points.textContent = parseInt(this.points.textContent) - 1 - this.like;
				this.like = -1;
				updateVisual.call(this);
			} catch (e) {
				console.log(e);	
			}
		}
	}
}


function commentReply(event) {
	removeReplyForm();
	const parentComment = event.currentTarget.parentNode.parentNode;
	replyId = parentComment.dataset.id;
	const user = parentComment.querySelector('.comment-user').textContent;
	const replyForm = document.createElement('form');
	replyForm.setAttribute('id', 'reply-form');
	replyForm.innerHTML = `
	<textarea rows="1" required="required" placeholder="Replying to ${user.trim()}"></textarea>
	<input type="submit" value="Send">`;
	replyForm.addEventListener('submit', postChildComment);
	insertComment(replyForm, replyId);
}

async function postChildComment(event) {
	event.preventDefault();
	const text = comments.querySelector('#reply-form > textarea').value;
	if (text.trim() == '') {
		alert('Comment text cant be empty');
		return;
	} 
	try {
		const data = await request(API_ENDPOINT, 'POST', {snippet: snippetId, text: text, parent: replyId});
		removeReplyForm();
		insertComment(createComment({...data, text: text, points: 0, parent: replyId}), replyId);
	} catch (e) {
		console.log(e);
	}
}

function removeReplyForm() {
	const oldForm = document.querySelector('#reply-form');
	if (oldForm) oldForm.remove();
}