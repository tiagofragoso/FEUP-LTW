import { request } from "./request.js";

const settings = document.querySelector('.user-settings');
let formSettings = {};
formSettings.usernameInput = settings.querySelector('#username');
formSettings.nameInput = settings.querySelector('#name');
formSettings.emailInput = settings.querySelector('#email');
formSettings.username = '';
formSettings.name = '';
formSettings.email = '';
getSettings.call(formSettings);

document.querySelector('.user-settings form:first-of-type').addEventListener('submit', submitSettings);


async function getSettings() {
    try {
        const res = await request('/api/settings.php', 'GET', {});
        this.username = res.username;
        this.name = res.name;
        this.email = res.email;
    } catch (e) {
        console.log(e);
    }
    updateVisual.call(this);
}

function updateVisual() {
    this.usernameInput.value = this.username;
    this.nameInput.value = this.name;
    this.emailInput.value = this.email;
}

async function submitSettings(event) {
    event.preventDefault(event);
    const name = formSettings.name;
    const username = formSettings.username;
    const email = formSettings.email;
    const settings = JSON.stringify({name, username, email});
    console.log(settings);
    try {
        await request('/api/settings.php', 'POST', settings);
    } catch (e) {
        alert(e);
    }

}