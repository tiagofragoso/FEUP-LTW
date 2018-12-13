export const createModal = (el, direction) => {
	const overlay = document.createElement('div');
	overlay.className = 'overlay';
	overlay.style[direction] = 0;
	el.classList.add('overlay-content');
	overlay.appendChild(el);
	return overlay;
}