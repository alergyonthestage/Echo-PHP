import LoadingDiscAnimation from "./components/LoadingDiscAnimation.js";
import Post from "./components/Post.js";
import { fetchData } from "./utils/ajax.js";

//feed
const feed = document.getElementById('feed')
const apiLink = '/api/feed'

let currentPage = 0
let isLoading = false

//publish button hide on scroll
let oldScroll = feed.scrollTop
const publishButton = document.getElementById('publish-button')

//loading disc
const loadingDisc = document.createElement('div')
loadingDisc.classList.add('loading-icon')
loadingDisc.id = 'loadingDiscAnimation'
loadingDisc.innerHTML = new LoadingDiscAnimation().render()

function loadPosts() {
    if(isLoading) return
    showLoadingIcon(true)
    showPublishButton(false)
    isLoading = true
    fetchData(getRequestLink())
        .then((posts) => {
            if(posts.length > 0) {
                posts.forEach((postData) => {
                    feed.innerHTML += new Post(postData).render()
                })
                currentPage++;
            }
        })
        .catch((error) => {
            feed.innerHTML = "Cannot load posts"
            console.error(`Error: ${error}`)
        })
        .finally(() => {
            isLoading = false
            showLoadingIcon(false)
            showPublishButton(true)
        })
}

function getRequestLink() {
    if(currentPage <= 0) {
        return apiLink
    } else {
        return apiLink + `?${new URLSearchParams({page: currentPage})}`
    }
}

feed.onscroll = () => {
    showPublishButton(oldScroll >= feed.scrollTop)
    oldScroll = feed.scrollTop
    if (Math.ceil(feed.clientHeight + feed.scrollTop) >= feed.scrollHeight) {
        loadPosts();
    }
}

loadPosts()

function showLoadingIcon(display) {
    if(display) {
        feed.appendChild(loadingDisc)
    } else {
        document.getElementById('loadingDiscAnimation').remove()
    }
}

function showPublishButton(display) {
    publishButton.classList.toggle('hide', !display)
}