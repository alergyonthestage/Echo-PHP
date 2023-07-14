import LoadingDiscAnimation from "./components/LoadingDiscAnimation.js";
import Post from "./components/Post.js";
import SelfDestructMessage from "./components/SelfDestructMessage.js";
import { addInteractionsListenrs } from "./post/interactions/interactions.js";
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

const loadingDisc = new LoadingDiscAnimation()

function loadPosts() {
    if(isLoading) return
    disablePublishButton()
    loadingDisc.show()
    isLoading = true
    fetchData(getRequestLink())
        .then(async (posts) => {
            if(posts.length > 0) {
                posts.forEach((postData) => {
                    feed.innerHTML += new Post(postData).render()
                })
                addInteractionsListenrs()
                currentPage++;
                loadingDisc.hide()
                enablePublishButton()
            } else {
                loadingDisc.hide()
                await new SelfDestructMessage('No more posts.').show(2000)
                enablePublishButton()
            }
        })
        .catch(async (error) => {
            loadingDisc.hide()
            await new SelfDestructMessage('Something went wrong... Try again later.').show(2000)
            console.error(`Error: ${error}`)
            enablePublishButton()
        })
        .finally(() => {
            isLoading = false
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