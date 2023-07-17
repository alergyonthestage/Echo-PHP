const coverPath = '/public/img/cover/'

export default class Post {

    constructor(data) {
        this.data = data;
        this.badge = this.data.author.isVerified ? `<i class="fas fa-check-circle"></i>` : "";
    }

    render() {
        return `<article class="post">
                    <div class="post-covert-art">
                        <div class="post-cover-square">
                            <img class="post-cover-disc" src="${this.data.song.coverArt}" alt="Cover-Art"/>
                            <button class="post-play-button" play-button="F90Cw4l-8NY"><i class="fas fa-play"></i></button>
                        </div>
                    </div>
                    <div class="post-infos">
                        <div class="post-song-infos">
                            <div class="post-song-title">
                                <p>${this.data.song.artist.stageName} - ${this.data.song.title}</p>
                            </div>
                            <input class="post-song-progress-bar" type="range" min="0" max="100" value="0" step="0.1" post-id="${this.data.id}">
                        </div>
                        <div class="post-header">
                            <a href="/user/${this.data.author.username}">
                                <div class="post-author">
                                    <div class="profile-picture-frame post-profile-picture-frame">
                                        <img class="profile-picture" src="${this.data.author.profilePic}" alt="Profile picture">
                                    </div>
                                    <div class="post-author-infos">
                                    <div class="post-author-name">
                                        <p>${this.data.author.username} ${this.badge}</p>
                                    </div>
                                    <div class="post-time-info">
                                        <p>${this.data.timeAgo}</p>
                                    </div>
                                    </div> 
                                </div>
                            </a>
                            <div class="post-interaction-buttons">
                                <span like-counter="${this.data.id}">${this.data.likesCount}</span>
                                <button class="post-interaction-button ${this.data.liked ? "post-interaction-button-active": ""}" like-button="${this.data.id}">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <span comment-counter="${this.data.id}">${this.data.commentsCount}</span>
                                <button class="post-interaction-button" comment-button="${this.data.id}">
                                    <i class="fas fa-comment"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="post-description">
                        <p>${this.data.description}</p>
                    </div>
                    <hr color="#9e9e9e" width="100%">
                    <div class="comments-section" comments-section="${this.data.id}"></div>
                </article>`
    }

}