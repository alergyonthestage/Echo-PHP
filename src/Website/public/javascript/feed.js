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
let publishButtonEnabled = true
const publishButton = document.getElementById('publish-button')

//loading disc
const loadingDisc = document.createElement('div')
loadingDisc.classList.add('loading-icon')
loadingDisc.id = 'loadingDiscAnimation'
loadingDisc.innerHTML = new LoadingDiscAnimation().render()

function loadPosts() {
    if(isLoading) return
    enablePublishButton(false)
    showLoadingIcon(true)
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
            enablePublishButton(true)
        })
}

function getRequestLink() {
    if(currentPage <= 0) {
        return apiLink
    } else {
        return apiLink + `?${new URLSearchParams({page: currentPage})}`
    }
}

//could throttle graphic updates...
feed.onscroll = () => {
    showPublishButton(oldScroll >= feed.scrollTop)
    oldScroll = feed.scrollTop
    if (Math.ceil(feed.clientHeight + feed.scrollTop) >= feed.scrollHeight) {
        loadPosts();
    }
}

function showLoadingIcon(display) {
    if(display) {
        feed.insertBefore(loadingDisc, feed.firstChild)
        setTimeout(
            () => loadingDisc.classList.add('show'),
            100
        )
    } else {
        loadingDisc.classList.remove('show'),
        setTimeout(
            () => document.getElementById('loadingDiscAnimation').remove(),
            500
        )
    }
}

//PublishButton could become an object: (why not think about other refactorings and possible objects?)

function showPublishButton(display) {
    publishButton.classList.toggle('hide', (!display) && publishButtonEnabled)
}

function enablePublishButton(enable) {
    console.log(enable)
    showPublishButton(enable)
    publishButtonEnabled = enable
}

loadPosts()