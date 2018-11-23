const languages = {
	Markup: 'markup',
	CSS: 'css',
	Clike: 'clike',
	JavaScript: 'javascript',
	C: 'c',
	'C#': 'csharp',
	'C++': 'cpp',
	'ASP.NET': 'aspnet',
	Ruby: 'ruby',
	Dart: 'dart',
	Elixir: 'elixir',
	Markdown: 'markdown',
	Git: 'git',
	Go: 'go',
	GraphQL: 'graphql',
	Less: 'less',
	HTTP: 'http',
	Java: 'java',
	JSON: 'json',
	Kotlin: 'kotlin',
	LaTeX: 'latex',
	Lua: 'lua',
	Makefile: 'makefile',
	MATLAB: 'matlab',
	Pascal: 'pascal',
	'Objective-C': 'objectivec',
	Perl: 'perl',
	PHP: 'php',
	SQL: 'sql',
	PowerShell: 'powershell',
	Prolog: 'prolog',
	SASS: 'sass',
	SCSS: 'scss',
	Python: 'python',
	R: 'r',
	Scala: 'scala',
	Scheme: 'scheme',
	Pug: 'pug',
	Swift: 'swift',
	TypeScript: 'typescript',
	'VB.net': 'vbnet',
	'Visual Basic': 'visual-basic',
	'YAML': 'yaml',
	'HTML': 'html',
}
let query = '';

for (name in languages){
	const code = languages[name];
	query += `INSERT INTO Language(code, name) VALUES('${code}', '${name}');\n`;
}

console.log(query);