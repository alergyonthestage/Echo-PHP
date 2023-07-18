import LoadingDiscAnimation from "./components/LoadingDiscAnimation.js";
import SelfDestructMessage from "./components/SelfDestructMessage.js";
import UserListItem from "./components/UserListItem.js";
import { fetchData } from "./utils/ajax.js";
import { debounce } from "./utils/debounce.js";

const searchBar = document.getElementById('search-bar')
const searchResultList = document.getElementById('search-result-list')

const loadingDisc = new LoadingDiscAnimation()

const debounceDelay = 500;

//For now search only users... Can search for hastags, music genres and other...

const apiUserSearchLink = '/api/user'

searchBar.value = ''

searchBar.oninput = debounce((event) => {
    if(event.target.value !== '' && event.target.value !== null) {
        loadingDisc.show()
        let link = `${apiUserSearchLink}?${new URLSearchParams({search: event.target.value})}`;
        fetchData(link)
            .then(async (result) => {
                if(result.length > 0) {
                    displaySearchResult(result)
                    loadingDisc.hide()
                } else {
                    loadingDisc.hide()
                    await new SelfDestructMessage('No results.').show(2000)
                } 
            })
            .catch(async (error) => {
                console.log(`Error: ${error}`)
                loadingDisc.hide()
                await new SelfDestructMessage('Something went wrong... Try again later.').show(2000)
            })
    } else {
        searchResultList.innerHTML = ''
    }
}, debounceDelay)

function displaySearchResult(result) {
    searchResultList.innerHTML = ''
    result.forEach((user) => {
        searchResultList.innerHTML += new UserListItem(user).render();
    });
}