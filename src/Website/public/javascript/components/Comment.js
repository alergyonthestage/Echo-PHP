export default class Comment {

    constructor(data) {
        this.data = data
    }

    render() {
        return `<div class="post-comment">
                    <div class="profile-picture-frame comment-profile-picture-frame">
                        <img class="profile-picture" src="${this.data.author.profilePic}" alt="Profile picture">
                    </div>
                    <div class="post-comment-content">
                        <div class="post-comment-text">
                            <p>
                                <a href="/user/${this.data.author.username}"><b>@${this.data.author.username}</b></a> 
                                ${this.data.text}
                            </p>
                        </div>
                        <div class="post-comment-time">
                            <p>${this.data.timeAgo}</p>
                        </div>
                    </div>
                </div>`
    }

}