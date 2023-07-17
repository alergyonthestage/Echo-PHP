import CommentsSection from "../../components/CommentsSection.js";
import Comment from "../../components/Comment.js";
import { fetchData } from "../../utils/ajax.js";
import { uploadFormData } from "../../utils/ajax.js";

const apiPublishCommentLink = '/api/post/comment'


async function showPostCommentsSection(postID) {
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
    loadCommentsPreview(postID)
    const commentsSection = document.querySelector(`[comments-section="${postID}"]`);
    commentsSection.classList.remove('expand');
    
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
    const commentsSection = document.querySelector(`[comments-section="${postID}"]`);
    let temp = ''
    
    fetchData(getApiCommentsPreviewLink(postID, 2))
        .then((comments) => {
            comments.postID = postID
            comments.forEach(comment => {    
                console.log(comment)
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