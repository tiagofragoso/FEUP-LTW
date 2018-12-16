const users_search = document.querySelector('.users-search');
const channels_search = document.querySelector('.channels-search');
const snippets_search = document.querySelector('.snippets-search');

document.querySelector('.search-page').querySelectorAll('button').forEach(
    btn => btn.addEventListener('click', tabSwitcher)
);

function tabSwitcher(event) {
    event.preventDefault();
	document.querySelectorAll('.tabs button').forEach(btn => btn.classList.remove('active'));
    event.currentTarget.classList.add('active');
    
    if (event.currentTarget.id === 'all') {
        users_search.style.display = "initial";
        channels_search.style.display = "initial";
        snippets_search.style.display = "initial";
    } else if (event.currentTarget.id === 'users') {
        users_search.style.display = "initial";
        channels_search.style.display = "none";
        snippets_search.style.display = "none";
    } else if (event.currentTarget.id === "channels") {
        users_search.style.display = "none";
        channels_search.style.display = "initial";
        snippets_search.style.display = "none";
    } else if (event.currentTarget.id === 'snippets') {
        users_search.style.display = "none";
        channels_search.style.display = "none";
        snippets_search.style.display = "initial";
    } 
}

