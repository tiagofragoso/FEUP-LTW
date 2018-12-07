import { request } from "./request.js";

const settings = document.querySelector('.user-settings');
let formSettings = {};
formSettings.usernameInput = settings.querySelector('#username');
formSettings.nameInput = settings.querySelector('#name');
formSettings.emailInput = settings.querySelector('#email');
getSettings.call(formSettings);

document.querySelector('.user-settings form:first-of-type').addEventListener('submit', submitSettings);


async function getSettings() {
    try {
        const res = await request('/api/settings.php', 'GET', {});
        this.usernameInput.value = res.username;
        this.nameInput.value = res.name;
        this.emailInput.value = res.email;
    } catch (e) {
        console.log(e);
    }
}

async function submitSettings(event) {
    event.preventDefault(event);
    const name = formSettings.nameInput.value;
    const username = formSettings.usernameInput.value;
    const email = formSettings.emailInput.value;
    const settings = {name, username, email};
    console.log(settings);
    try {
        await request('/api/settings.php', 'POST', settings);
    } catch (e) {
        alert(e);
    }

}