import Post from "./components/Post.js";
import { fetchData } from "./utils/ajax.js";

const feed = document.getElementById('feed')
const apiLink = '/api/feed'

let currentPage = 0
let isLoading = false

function loadPosts() {
    if(isLoading) return
    isLoading = true
    let query = (currentPage === 0) ? '' : `?${new URLSearchParams({page: currentPage})}`
    fetchData(`${apiLink}${query}`)
        .then((posts) => { 
            posts.forEach((postData) => {
                feed.innerHTML += new Post(postData).render()
            })
        })
        .catch((error) => {
            feed.innerHTML = "Cannot load posts"
            console.error(`Error: ${error}`)
        })
        .finally(() => {
            isLoading = false
        })
}

feed.onscroll = () => {
    if(isLoading) return
    if (Math.ceil(feed.clientHeight + feed.scrollTop) >= feed.scrollHeight) {
        alert('arrivato in fondo')
        currentPage++;
        fetchData();
    }
}
loadPosts()