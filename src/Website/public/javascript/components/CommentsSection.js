import Comment from "./Comment.js";

export default class CommentsSection {

    constructor(data) {
        this.data = data
    }

    render() {
        const header = `<div class="comment-section-header">
                            <button class="hide-comment-section-button" id=hide-comment-section-button><i class="fa-solid fa-angle-down"></i></button>
                        </div>`
        const footer = `<div class="comment-publish-area">
                            <input maxlength="255" type="textarea" comment-publish-text="${this.data.postID}" placeholder="Write a comment..."></input>
                            <button class="post-comment-publish-button" comment-publish-button="${this.data.postID}"><i class="fas fa-paper-plane"></i></button>
                        </div>`
        if(this.data.length === 0) {
            return header+'No comments yet'+footer
        }
        let commentsHTML = '';
        this.data.forEach(comment => {
            commentsHTML += new Comment(comment).render()
        });
        return header+`<div class="comments-section-list">
                    ${commentsHTML}
                </div>`+footer
    }

}