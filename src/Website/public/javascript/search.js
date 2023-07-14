import LoadingDiscAnimation from "./components/LoadingDiscAnimation.js";
import UserListItem from "./components/UserListItem.js";
import { fetchData } from "./utils/ajax.js";
import { debounce } from "./utils/debounce.js";

const searchBar = document.getElementById('search-bar')
const searchResultList = document.getElementById('search-result-list')

const loadingDisc = new LoadingDiscAnimation(searchResultList)

const debounceDelay = 200;

//For now search only users... Can search for hastags, music genres and other...

const apiUserSearchLink = '/api/user'

searchBar.value = ''

searchBar.oninput = debounce((event) => {
    if(event.target.value !== '' && event.target.value !== null) {
        loadingDisc.show()
        let link = `${apiUserSearchLink}?${new URLSearchParams({search: event.target.value})}`;
        fetchData(link)
            .then((response) => {displaySearchResult(response)})
            .catch((error) => {searchResultList.innerHTML = `Error: ${error}`})
            .finally(() => {
                loadingDisc.hide()
            })
    } else {
        searchResultList.innerHTML = ''
    }
}, debounceDelay)

function displaySearchResult(jsonResponse) {
    searchResultList.innerHTML = ''
    let result = jsonResponse
    result.forEach((user) => {
        searchResultList.innerHTML += new UserListItem(user).render();
    });
}