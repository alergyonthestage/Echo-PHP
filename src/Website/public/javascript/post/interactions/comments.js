import CommentsSection from "../../components/CommentsSection.js";
import { fetchData } from "../../utils/ajax.js";

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