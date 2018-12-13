export const createModal = (el) => {
	const overlay = document.createElement('div');
	overlay.className = 'overlay';
	el.className = 'overlay-content';
	overlay.appendChild(el);
	return overlay;
}