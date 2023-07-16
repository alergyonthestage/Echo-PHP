import CommentsSection from "../../components/CommentsSection.js";
import { fetchData } from "../../utils/ajax.js";
import { uploadFormData } from "../../utils/ajax.js";

const apiPublishCommentLink = '/api/post/comment'


export async function showPostCommentsSection(postID) {
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
    const commentsSection = document.querySelector(`[comments-section="${postID}"]`);
    commentsSection.classList.remove('expand');
    commentsSection.innerHTML = "Metti quello di prima"
}

function getApiCommentsLink(postID) {
    return `/api/post/${postID}/comments`
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