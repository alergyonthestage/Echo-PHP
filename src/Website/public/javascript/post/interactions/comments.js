import CommentsSection from "../../components/CommentsSection.js";
import Comment from "../../components/Comment.js";
import { fetchData } from "../../utils/ajax.js";
import { uploadFormData } from "../../utils/ajax.js";
import { PublishButton } from "../publishButton.js";
import { BackButton } from "../../menu.js";

const apiPublishCommentLink = '/api/post/comment'
const publishButton = new PublishButton('publish-button')

async function showPostCommentsSection(postID) {
    publishButton.disable()
    new BackButton().overrideDefault(() => hideCommentsSection(postID))
    const commentsSection = document.querySelector(`[comments-section="${postID}"]`);
    commentsSection.classList.add('expand');
    commentsSection.innerHTML = "Loading..."
    fetchData(getApiCommentsLink(postID))
        .then((comments) => {
            comments.postID = postID
            commentsSection.innerHTML = new CommentsSection(comments).render()
        })
        .catch((error) => {
            commentsSection.innerHTML = `<button class="hide-comment-section-button" id=hide-comment-section-button><i class="fa-solid fa-angle-down"></i></button></br>Error: ${error}`
        })
        .finally(() => {
            document.getElementById('hide-comment-section-button').onclick = () => hideCommentsSection(postID)
            preparePublishArea(postID)
        })
}

function hideCommentsSection(postID) {
    new BackButton().overrideDefault(null)
    publishButton.enable()
    const commentsSection = document.querySelector(`[comments-section="${postID}"]`);
    commentsSection.classList.remove('expand');
    loadCommentsPreview(postID)
}

function getApiCommentsLink(postID) {
    return `/api/post/${postID}/comments`
}

function getApiCommentsPreviewLink(postID, quantity) {
    return `/api/post/${postID}/comments/?qnt=${quantity}`
}

function preparePublishArea(postID){
    const publishCommentButton = document.querySelector(`[comment-publish-button='${postID}']`);
    const publishCommentText = document.querySelector(`[comment-publish-text='${postID}']`);
    publishCommentButton.onclick = () => {
        publishComment(postID, publishCommentText.value)
    }
    publishCommentText.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
           publishComment(postID, publishCommentText.value)
        }
    });
}

async function publishComment(postID, commentText) {

    //CALL API
    const formData = new FormData();
    formData.append('id_post', postID);
    formData.append('text', commentText);
    
    uploadFormData(apiPublishCommentLink, formData)
        .then((report) => {
            if(!report.success) {
                console.log(report)
            }
            showPostCommentsSection(postID)
        })
        .catch((error) => {
            console.error(error)
        })
}

function loadCommentsPreview(postID) {
    document.querySelector(`[comments-section="${postID}"]`).innerHTML = "Loading comments preview..."
    let temp = ''
    fetchData(getApiCommentsPreviewLink(postID, 2))
        .then((comments) => {
            if(comments.length == 0) {
                temp = "No comments yet."
            }
            comments.postID = postID
            comments.forEach(comment => {    
                temp += new Comment(comment).renderCompact();
            });
        })
        .catch((error) => {
            document.querySelector(`[comments-section="${postID}"]`).innerHTML = `Error: ${error}`
        })
        .finally(() => {
            document.querySelector(`[comments-section="${postID}"]`).innerHTML = temp
        })
}

export { showPostCommentsSection, loadCommentsPreview }