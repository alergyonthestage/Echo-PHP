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
    disablePublishButton()
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
            enablePublishButton()
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
    const delay = 500
    if(display) {
        feed.insertBefore(loadingDisc, feed.firstChild)
        setTimeout(
            () => loadingDisc.classList.add('show'),
            delay
        )
    } else {
        document.getElementById('loadingDiscAnimation').addEventListener('transitionend', () => {
            document.getElementById('loadingDiscAnimation').remove();
        }, { once: true })
        setTimeout(
            () => document.getElementById('loadingDiscAnimation').classList.remove('show'),
            delay
        )
    }
}

//PublishButton could become an object: (why not think about other refactorings and possible objects?)

function showPublishButton(display) {
    if(publishButtonEnabled) {
        publishButton.classList.toggle('hide', !display)
    }
}

function enablePublishButton() {
    publishButtonEnabled = true
    showPublishButton(true)
}

function disablePublishButton() {
    showPublishButton(false)
    publishButtonEnabled = false
}

loadPosts()