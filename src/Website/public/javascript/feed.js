import LoadingDiscAnimation from "./components/LoadingDiscAnimation.js";
import Post from "./components/Post.js";
import SelfDestructMessage from "./components/SelfDestructMessage.js";
import { addInteractionsListenrs } from "./post/interactions/interactions.js";
import { fetchData } from "./utils/ajax.js";
import { loadCommentsPreview } from "./post/interactions/comments.js"
import { PublishButton } from "./post/publishButton.js";

//feed
const feed = document.getElementById('feed')
const apiLink = '/api/feed'

let currentPage = 0
let isLoading = false

const endOfFeed = document.createElement('div')
endOfFeed.id = 'end-of-feed'
endOfFeed.style.height = '2em'
endOfFeed.style.width = '100%'

//publish button hide on scroll
const publishButton = new PublishButton('publish-button')
let oldScroll = feed.scrollTop

const loadingDisc = new LoadingDiscAnimation()

function loadPosts() {
    if(isLoading) return
    publishButton.disable()
    loadingDisc.show()
    isLoading = true
    fetchData(getRequestLink())
        .then(async (posts) => {
            if(posts.length > 0) {
                posts.forEach((postData) => {
                    feed.innerHTML += new Post(postData).render()
                    loadCommentsPreview(postData.id)
                })
                addInteractionsListenrs()
                currentPage++;
                loadingDisc.hide()
                publishButton.enable()
            } else {
                loadingDisc.hide()
                await new SelfDestructMessage('No more posts.').show(2000)
                publishButton.enable()
            }
        })
        .catch(async (error) => {
            loadingDisc.hide()
            await new SelfDestructMessage('Something went wrong... Try again later.').show(2000)
            console.error(`Error: ${error}`)
            publishButton.enable()
        })
        .finally(() => {
            isLoading = false
            if(document.getElementById('end-of-div') !== null) {
                document.getElementById('end-of-div').remove()
            }
            feed.append(endOfFeed)
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
    publishButton.show(oldScroll >= feed.scrollTop)
    oldScroll = feed.scrollTop
    if (Math.ceil(feed.clientHeight + feed.scrollTop) >= feed.scrollHeight) {
        loadPosts();
    }
}

loadPosts()