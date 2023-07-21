import Comment from "./Comment.js";

export default class CommentsSection {

    constructor(data) {
        this.data = data
    }

    render() {
        const header = `<div class="comment-section-header">
                            <button class="hide-comment-section-button" id=hide-comment-section-button><em class="fa-solid fa-angle-down"></em></button>
                        </div>`
        const footer = `<div class="comment-publish-area">
                            <textarea rows="1" maxlength="255" comment-publish-text="${this.data.postID}" placeholder="Write a comment..."></textarea>
                            <button class="post-comment-publish-button" comment-publish-button="${this.data.postID}"><em class="fas fa-paper-plane"></em></button>
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