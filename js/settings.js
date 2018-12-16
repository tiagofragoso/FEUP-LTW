import { request } from "./request.js";

const RFC5322EmailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
const MAX_FILE_SIZE_BYTES = 2* (10 ** 6);

const settings = document.querySelector('.user-settings');
const inputs = settings.querySelectorAll('.row');
const nameEl = inputs[0];
const usernameEl = inputs[1];
const emailEl = inputs[2];
const oldPasswordEl = inputs[3];
const newPasswordEl = inputs[4];
const photoEl = document.querySelector('.user-info img');
getSettings();

let userInfo = {};
userInfo.username = document.querySelector('.user-details h2');
userInfo.name = document.querySelector('.user-details h1');

document.querySelector('.user-settings form:first-of-type').addEventListener('submit', submitSettings);
document.querySelector('.user-settings form:last-of-type').addEventListener('submit', changePassword);
document.querySelector('.user-info input').addEventListener('change', changePhoto);
document.querySelector('.delete-button').addEventListener('click', deleteUser);

async function getSettings() {
    try {
        const res = await request('/api/settings.php', 'GET', {});
        usernameEl.querySelector('input').value = res.username;
        nameEl.querySelector('input').value = res.name;
        emailEl.querySelector('input').value = res.email;
    } catch (e) {
        console.log(e);
    }
}

async function submitSettings(event) {
    event.preventDefault();
    if (!validateInfoForm())
		return;
    const name = nameEl.querySelector('input').value;
    const username = usernameEl.querySelector('input').value;
    const email = emailEl.querySelector('input').value;
    const settings = {name, username, email};
    try {
        await request('/api/settings.php', 'POST', settings);
        alert("Updated profile!");
    } catch (e) {
       setInfoFormError(e);
    }
    updateVisual();
}

function updateVisual() {
    userInfo.username.firstChild.textContent = usernameEl.querySelector('input').value;
    userInfo.name.textContent = nameEl.querySelector('input').value;
}

async function changePassword(event) {
    event.preventDefault();
    if (!validatePassForm())
        return;
    const oldPassword = oldPasswordEl.querySelector('input').value;
    const newPassword = newPasswordEl.querySelector('input').value;
    const passwords = {oldPassword, newPassword};
    try {
        await request('/api/change-password.php', 'POST', passwords);
        oldPasswordEl.querySelector('input').value = '';
        newPasswordEl.querySelector('input').value = '';
        alert('Changed password!');
    } catch(e) {
        setPassFormError(e);
    }
}

async function deleteUser() {
    try {
        await request('/api/settings.php', 'DELETE', {});
        window.location.href = '/actions/action_logout.php';
    } catch(e) {
        alert('An error occurred');
        window.location.href = '/actions/action_logout.php';
    }
}

function changePhoto() {
    removeErrors();
    const file = event.currentTarget.files[0];
    if (!validateImage(file))
		return;
    let img = new Image();
    img.onload = function() {
        let size = 0;
        if (img.width > img.height) {
            size = img.height;
        } else {
            size = img.width;
        }
        photoEl.src = getImagePortion(img, size, size, 0, 0, 1);
        savePhoto();
    }
    img.src = URL.createObjectURL(file);
}

async function savePhoto() {
    const photo = photoEl.src.replace(/^data:image\/[a-z]+;base64,/, '');
    const photos = { photo };
    try {
        await request('/api/change-photo.php', 'POST', photos);
    } catch (e) {
        setError('image', 'Could not save photo');
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
    return tnCanvas.toDataURL();
}

function validateInfoForm() {
    removeErrors();
    let valid = true;
    const name = nameEl.querySelector('input').value;	
    const user = usernameEl.querySelector('input').value;	
	const email = emailEl.querySelector('input').value;	
	
    if (!name.match(/^[\-a-zA-Z\s]{5,30}$/)) {
        setError('name', 'Name must be between 5-30 characters.');
        valid = false;
    }

	if (!user.match(/^[-\w]{5,25}$/)) {
		setError('username', 'Username must be between 5-25 characters.');
		valid = false;
    }
     
    if (!email.match(RFC5322EmailRegex)) {
        setError('email', 'Invalid email address');
        valid = false;
    }
	
	return valid;
}

function validatePassForm() {
    removeErrors();
    let valid = true;
    const oldPassword = oldPasswordEl.querySelector('input').value;	
    const newPassword = newPasswordEl.querySelector('input').value;	
	
    if (!oldPassword.match(/^.{5,25}$/)) {
		setError('oldPassword', 'Password must be between 5-30 characters.');
		valid = false;
    }
    
    if (!newPassword.match(/^.{5,25}$/)) {
		setError('newPassword', 'Password must be between 5-30 characters.');
		valid = false;
	}
	
	return valid;
}

function setInfoFormError(message) {
	document.querySelectorAll('p.input-info')[0].textContent = message;
}

function setPassFormError(message) {
	document.querySelectorAll('p.input-info')[1].textContent = message;
}

function setError(field, message) {
	let element;
	switch(field) {
        case 'name':
            element = nameEl;
            break;
		case 'username':
			element = usernameEl;
			break;
        case 'email':
            element = emailEl;
            break;
        case 'oldPassword':
            element = oldPasswordEl;
            break;
		case 'newPassword':
			element = newPasswordEl;
            break;
        case 'image':
            element = photoEl;
            break;
	}
	(element.querySelector('input') || element).classList.add('invalid');
	(element.querySelector('.input-info') || element.parentElement.querySelector('.input-info')).textContent = message; 
}

function validateImage(file) {
	if (file.size > MAX_FILE_SIZE_BYTES) {
		setError('image', 'File size must be under 2MB');
		return false;
	} 
	if (!file.type.match(/^image\/.*$/)) {
		setError('image', 'Invalid file type');
		return false;
	}
	return true;
}

function removeErrors() {
    inputs.forEach(element => {
        element.querySelector('input').classList.remove('invalid');
        element.querySelector('.input-info').textContent = ""; 
    });
    photoEl.classList.remove('invalid');
    photoEl.parentElement.querySelector('.input-info').textContent = ""; 
    document.querySelectorAll('p.input-info').forEach(e => e.textContent = "");
}