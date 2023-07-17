import Comment from "./Comment.js";

export default class CommentsSection {

    constructor(data) {
        this.data = data
    }

    render() {
        if(this.data.length === 0) {
            return '<button class="hide-comment-section-button" id=hide-comment-section-button><i class="fa-solid fa-angle-down"></i></button></br>No comments yet'
        }
        let commentsHTML = '';
        this.data.forEach(comment => {
            commentsHTML += new Comment(comment).render()
        });
        return `<div class="comment-section-header">
                    <button class="hide-comment-section-button" id=hide-comment-section-button><i class="fa-solid fa-angle-down"></i></button>
                </div>   
                <div class="comments-section-list">
                    ${commentsHTML}
                </div>
                <div class="comment-publish-area">
                            <input type="textarea" comment-publish-text="${this.data.postID}" placeholder="Write a comment..."></input>
                            <button class="post-comment-publish-button" comment-publish-button="${this.data.postID}"><i class="fas fa-paper-plane"></i></button>
                    </div>
                `
    }

}