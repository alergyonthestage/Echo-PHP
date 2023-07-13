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
            commentsSection.innerHTML = `Error: ${error}`
        })
}

function getApiCommentsLink(postID) {
    return `/api/post/${postID}/comments`
}