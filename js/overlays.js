export const createOverlay = (el, direction) => {
	const overlay = document.createElement('div');
	overlay.className = 'overlay';
	overlay.style[direction] = 0;
	el.classList.add('overlay-content');
	overlay.appendChild(el);
	return overlay;
}

export const createModal = (el) => {
	const modal = document.createElement('div');
	modal.className = 'modal';
	modal.addEventListener('click', () => modal.remove());
	el.addEventListener('click', event => event.stopPropagation());
	el.classList.add('center-card');
	modal.appendChild(el);
	return modal;
}