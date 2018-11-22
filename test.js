class Component {
	constructor(tag, className, attributes, content){
		this.tag = tag;
		this.className = className;
		this.attributes = attributes;
		this.content = content;
		this.children = [];
	}

	getStartTag(){
		let tag = `<${this.tag} `;
		if (this.className)
			tag += `class="${this.className}" `;
		if (this.attributes){
			for (key in this.attributes){
				const value = this.attributes[key];
				tag += `${key}="${value}"`;
			}
		}
		tag += '>\n';
		return tag;
	}

	getEndTag(){
		return `</${this.tag}>\n`;
	}
	
	getOuterHtml(){
		let html = this.getStartTag();
		if (this.content)
			html += this.content;
		for (child of this.children){
			html += child.getOuterHtml();
		}
		html += this.getEndTag();
		return html;		
	}

	appendElement(component){
		this.children.push(component);
	}
}


window.addEventListener('load', () => {
	const label = document.querySelector('#js-test');

	const comp = new Component('p', "test-class", null, 'Lolada mix');

	label.innerHTML = comp.getOuterHtml();

	console.log(comp.getOuterHtml());
})

