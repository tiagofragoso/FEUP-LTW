import { request } from './request.js';

const API_ENDPOINT = '/api/comment.php'
const comments = document.querySelector('.comments-wrapper');
const newCommentRef = comments.querySelector('#new-comment');
newCommentRef.querySelector('form').addEventListener('submit', postComment);
const snippetId = document.querySelector('#snippetId').textContent;

getSnippetComments();

async function getSnippetComments() {
	let data = await request(API_ENDPOINT, 'GET', {snippet: snippetId});
	console.log(data);
	data.forEach(comment => {
		comments.insertBefore(createComment(comment), newCommentRef);
	});

}

function createComment(comment) {
	const commentWrapper = document.createElement('div');
	commentWrapper.className = 'comment-wrapper';
	commentWrapper.innerHTML = 
	`<a href="/pages/profile.php?id=${comment.user}" class="comment-user">
		${comment.name? comment.name : comment.username}
	</a>
	<span class="comment-text">
		${comment.text}
	</span>`;
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
		comments.insertBefore(createComment({...data, text: text}), newCommentRef);
	} catch (e) {

	}
}

