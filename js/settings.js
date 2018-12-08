import { request } from "./request.js";

const settings = document.querySelector('.user-settings');
let formSettings = {};
formSettings.usernameInput = settings.querySelector('#username');
formSettings.nameInput = settings.querySelector('#name');
formSettings.emailInput = settings.querySelector('#email');
formSettings.oldPassword = settings.querySelector('#old_password');
formSettings.newPassword = settings.querySelector('#new_password');
getSettings.call(formSettings);

document.querySelector('.user-settings form:first-of-type').addEventListener('submit', submitSettings);
document.querySelector('.user-settings form:last-of-type').addEventListener('submit', changePassword);


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
        alert("Updated profile!");
    } catch (e) {
        alert(e);
    }

}

async function changePassword(event) {
    event.preventDefault(event);
    const oldPassword = formSettings.oldPassword.value;
    const newPassword = formSettings.newPassword.value;
    const passwords = {oldPassword, newPassword};
    try {
        await request('/api/change-password.php', 'POST', passwords);
        formSettings.oldPassword.value = '';
        formSettings.newPassword.value = '';
        alert('Changed password!');
    } catch(e) {
        alert(e);
    }
    

}