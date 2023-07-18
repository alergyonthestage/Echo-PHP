import Post from "../components/Post.js"
import { addInteractionsListenrs } from "./interactions/interactions.js";
import { fetchData } from "../utils/ajax.js";
import { attachProgressBars } from "../songProgressBar.js";
import { hideCommentsSection, loadCommentsPreview, showPostCommentsSection } from "./interactions/comments.js"

const post = document.getElementById('post')
const postId = post.getAttribute('post-id');

window.matchMedia("(min-width: 984px) and (orientation: landscape)").addEventListener('change', (event) => desktopLayout(event))


fetchData(`/api/post/${postId}`)
    .then((postData) => {
        post.innerHTML = new Post(postData).render()
        addInteractionsListenrs()
        attachProgressBars()
        loadCommentsPreview(postId)
    })
    .catch((error) => {
        post.innerHTML = `Error: ${error}`
    })
    .finally(() => {
        if(window.matchMedia("(min-width: 984px) and (orientation: landscape)").matches) desktopLayoutForced()
    })

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