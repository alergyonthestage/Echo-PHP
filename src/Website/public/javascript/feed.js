import LoadingDiscAnimation from "./components/LoadingDiscAnimation.js";
import Post from "./components/Post.js";
import SelfDestructMessage from "./components/SelfDestructMessage.js";
import { addInteractionsListenrs } from "./post/interactions/interactions.js";
import { fetchData } from "./utils/ajax.js";
import { hideCommentsSection, loadCommentsPreview, showPostCommentsSection } from "./post/interactions/comments.js"
import { PublishButton } from "./post/publishButton.js";
import { attachProgressBars } from "./songProgressBar.js";

//feed
const feed = document.getElementById('feed')
const apiLink = '/api/feed'

window.matchMedia("(min-width: 984px) and (orientation: landscape)").addEventListener('change', (event) => desktopLayout(event))

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
                    if(!window.matchMedia("(min-width: 984px) and (orientation: landscape)").matches) loadCommentsPreview(postData.id)
                })
                addInteractionsListenrs()
                attachProgressBars()
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
            if(window.matchMedia("(min-width: 984px) and (orientation: landscape)").matches) desktopLayoutForced()
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

function desktopLayout(event) {

    let commentsSections = document.querySelectorAll(`[comments-section]`);
    if (event.matches) {
        //se è desktop
        if(commentsSections.length !== 0) {
            commentsSections.forEach((commentsSection => {
                showPostCommentsSection(commentsSection.getAttribute(`comments-section`))
            }))
        }
        document.querySelectorAll('[comment-button]').forEach((commentButton) => {commentButton.style.display = 'none'})

    } else {
        //se non è desktop
        if(commentsSections.length !== 0) {
            commentsSections.forEach((commentsSection => {
                hideCommentsSection(commentsSection.getAttribute(`comments-section`))
            }))
        }
        document.querySelectorAll('[comment-button]').forEach((commentButton) => {commentButton.style.display = 'initial'})
    }
}

function desktopLayoutForced() {

    let commentsSections = document.querySelectorAll(`[comments-section]`);
        if(commentsSections.length !== 0) {
            commentsSections.forEach((commentsSection => {
                showPostCommentsSection(commentsSection.getAttribute(`comments-section`))
            }))
        }
        document.querySelectorAll('[comment-button]').forEach((commentButton) => {commentButton.style.display = 'none'})
}
