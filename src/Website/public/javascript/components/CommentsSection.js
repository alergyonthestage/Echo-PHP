import Comment from "./Comment.js";

export default class CommentsSection {

    constructor(data) {
        this.data = data
    }

    render() {
        if(this.data.length === 0) {
            return 'No comments yet'
        }
        let commentsHTML = '';
        this.data.forEach(comment => {
            commentsHTML += new Comment(comment).render()
        });
        return `<div>
                    ${commentsHTML}
                    <div class="post-footer">
                        <form action="/comment/publish" method="POST">
                            <input type="hidden" name="id_post" value="${this.data.postID}">
                            <input type="text" name="text" placeholder="Write a comment...">
                            <button type="submit" class="post-comment-publish-button"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>`
                
    }

}