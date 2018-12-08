import { request } from "./request.js";

const settings = document.querySelector('.user-settings');
let formSettings = {};
formSettings.usernameInput = settings.querySelector('#username');
formSettings.nameInput = settings.querySelector('#name');
formSettings.emailInput = settings.querySelector('#email');
formSettings.oldPassword = settings.querySelector('#old_password');
formSettings.newPassword = settings.querySelector('#new_password');
formSettings.photo = document.querySelector('.user-info img');
getSettings.call(formSettings);

document.querySelector('.user-settings form:first-of-type').addEventListener('submit', submitSettings);
document.querySelector('.user-settings form:last-of-type').addEventListener('submit', changePassword);
document.querySelector('.user-info input').addEventListener('change', changePhoto);

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

function changePhoto() {
    const file = event.currentTarget.files[0];
    let img = new Image();
    img.onload = function() {
        let size = 0;
        if (img.width > img.height) {
            size = img.height;
        } else {
            size = img.width;
        }
        formSettings.photo.src = getImagePortion(img, size, size, 0, 0, 1);
        savePhoto();
    }
    img.src = URL.createObjectURL(file);
}

async function savePhoto() {
    const photo = formSettings.photo.src;
    const photos = {photo};
    try {
        await request('/api/change-photo.php', 'POST', photos);
    } catch (e) {
        console.log(e);
    }
}

function getImagePortion(imgObj, newWidth, newHeight, startX, startY, ratio) {
    /* the parameters: - the image element - the new width - the new height - the x point we start taking pixels - the y point we start taking pixels - the ratio */
    //set up canvas for thumbnail
    var tnCanvas = document.createElement('canvas');
    var tnCanvasContext = tnCanvas.getContext('2d');
    tnCanvas.width = newWidth; tnCanvas.height = newHeight;
    
    /* use the sourceCanvas to duplicate the entire image. This step was crucial for iOS4 and under devices. Follow the link at the end of this post to see what happens when you don’t do this */
    var bufferCanvas = document.createElement('canvas');
    var bufferContext = bufferCanvas.getContext('2d');
    bufferCanvas.width = imgObj.width;
    bufferCanvas.height = imgObj.height;
    bufferContext.drawImage(imgObj, 0, 0);
    
    /* now we use the drawImage method to take the pixels from our bufferCanvas and draw them into our thumbnail canvas */
    tnCanvasContext.drawImage(bufferCanvas, startX,startY,newWidth * ratio, newHeight * ratio,0,0,newWidth,newHeight);
    return tnCanvas.toDataURL()
}