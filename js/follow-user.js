import { request } from "./request.js";

const API_ENDPOINT = '/api/follow-user.php';
const button_wrapper = document.querySelector('.profile-button-follow-wrapper');
if (button_wrapper != null) {
    let follow = {};
    follow.value = 0;
    follow.userId = button_wrapper.querySelector('#userId').textContent;
    follow.button = button_wrapper.querySelector('span:first-of-type');
    follow.button.addEventListener('click', followHandler.bind(follow));
    checkFollow.call(follow);
}

function updateVisual() {
    if (button_wrapper != null) {
        if (this.value === 0) {
            this.button.className = this.button.className.replace('unfollow', 'follow');
            this.button.textContent = 'Follow';
        } else if (this.value === 1) {
            this.button.className = this.button.className.replace('follow', 'unfollow');
            this.button.textContent = 'Unfollow';
        } 
    }
}

async function checkFollow() {
    try {
        const res = await request(API_ENDPOINT, 'GET', {id: this.userId});
        if (res.hasFollow === 1) {
            this.value = 1;
        } else if (res.hasFollow === 0) {
            this.value = 0;
        }
    } catch (e) {
        console.log(e);
    }
    updateVisual.call(this);
}

async function followHandler() {
    if (this.value === 1) {
        try {
            await request(API_ENDPOINT, 'DELETE', {id: this.userId});
            this.value = 0;
            updateVisual.call(this);
        } catch(e) {
            console.log(e);
        }
    } else if (this.value == 0) {
        try {
            await request(API_ENDPOINT, 'POST', {id: this.userId});
            this.value = 1;
            updateVisual.call(this);
        } catch (e) {
            console.log(e);
        }
    }
}
