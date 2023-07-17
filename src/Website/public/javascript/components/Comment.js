export default class Comment {

    constructor(data) {
        this.data = data
        this.badge = this.data.author.isVerified ? `<i class="fas fa-check-circle"></i>` : "";
    }

    render() {
        return `<div class="post-comment">
                    <div class="profile-picture-frame comment-profile-picture-frame">
                        <img class="profile-picture" src="${this.data.author.profilePic}" alt="Profile picture">
                    </div>
                    <div class="post-comment-content">
                        <div class="post-comment-text">
                            <p>
                                <a href="/user/${this.data.author.username}"><b>@${this.data.author.username} ${this.badge}</b></a> 
                                ${this.data.text}
                            </p>
                        </div>
                        <div class="post-comment-time">
                            <p>${this.data.timeAgo}</p>
                        </div>
                    </div>
                </div>`
    }

    renderCompact() {
        return `<div class="post-comment">
                    <div class="profile-picture-frame comment-profile-picture-frame">
                        <img class="profile-picture" src="${this.data.author.profilePic}" alt="Profile picture">
                    </div>
                    <div class="post-comment-content-compact">
                        <div class="post-comment-text">
                            <p>
                                <a href="/user/${this.data.author.username}"><b>@${this.data.author.username} ${this.badge}</b></a> 
                                <br>${this.data.text}
                            </p>
                        </div>
                    </div>
                </div>`

    }

}