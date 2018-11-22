class Component {
	constructor(tag, className, attributes, content){
		this.tag = tag;
		this.className = className;
		this.attributes = attributes;
		this.content = content;
		this.children = [];
	}

	getStartTag(){
		const tag = `<${this.tag} `;
		if (this.className)
			tag.concat(`class="${this.className}" `);
		if (this.attributes){
			for (key in this.attributes){
				const value = this.attributes[key];
				tag.concat(`${key}="${value}"`);
			}
		}
		tag.concat('>\n');
		return tag;
	}

	getEndTag(){
		return `</${this.tag}>\n`;
	}
	
	getOuterHtml(){
		const html = this.getStartTag();
		for (child of this.children){
			html.concat(child.getOuterHtml());
		}
		html.concat(this.getEndTag());
		return html;		
	}
}

export default Component;