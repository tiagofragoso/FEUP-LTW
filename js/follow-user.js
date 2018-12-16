import { request } from "./request.js";

const API_ENDPOINT = '../api/follow-user.php';
const button_wrapper = document.querySelector('.follow');
if (button_wrapper != null) {
    let follow = {};
    follow.value = 0;
    follow.userId = document.querySelector('.full-card').getAttribute('data-id');
    follow.button = button_wrapper;
    follow.button.addEventListener('click', followHandler.bind(follow));
    checkFollow.call(follow);
}

function updateVisual() {
    if (button_wrapper != null) {
        if (this.value === 0) {
            this.button.classList.replace('unfollow', 'follow');
            this.button.textContent = 'Follow';
        } else if (this.value === 1) {
            this.button.classList.replace('follow', 'unfollow');
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
            alert(e);
        }
    } else if (this.value == 0) {
        try {
            await request(API_ENDPOINT, 'POST', {id: this.userId});
            this.value = 1;
            updateVisual.call(this);
        } catch (e) {
            alert(e);
        }
    }
}
