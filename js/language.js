import { request } from "./request.js";

const API_ENDPOINT = '../api/channel.php';
const button_wrapper = document.querySelector('.follow-button-wrapper');
if (button_wrapper != null) {
    let follow = {};
    follow.follow = false;
    follow.code = button_wrapper.getAttribute('data-code');
    follow.button = button_wrapper.querySelector('span:first-of-type');
    follow.button.addEventListener('click', followHandler.bind(follow));
    checkFollow.call(follow);
}

function updateVisual() {
    if (button_wrapper !== null) {
        if (!this.follow) {
            this.button.textContent = 'Follow';
        } else {
            this.button.textContent = 'Unfollow';
        } 
    }
}

async function checkFollow() {
    try {
        const res = await request(API_ENDPOINT, 'GET', {});
        res.forEach(language => {
            if (language.code === this.code ) {
                if (language.follows) {
                    this.follow = true;
                } else {
                    this.follow = false;
                }
            }
        });
    } catch (e) {
        console.log(e);
    }
    updateVisual.call(this);
}

async function followHandler() {
    if (this.follow) {
        try {
            await request(API_ENDPOINT, 'DELETE', {channel: this.code});
            this.follow = !this.follow;
            updateVisual.call(this);
        } catch(e) {
            alert(e);
        }
    } else {
        try {
            await request(API_ENDPOINT, 'POST', {channel: this.code});
            this.follow = !this.follow;
            updateVisual.call(this);
        } catch (e) {
            alert(e);
        }
    }
}