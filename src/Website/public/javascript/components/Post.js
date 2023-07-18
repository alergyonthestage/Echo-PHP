const coverPath = '/public/img/cover/'

export default class Post {

    constructor(data) {
        this.data = data;
        this.badge = this.data.author.isVerified ? `<em class="fas fa-check-circle"></em>` : "";
    }

    render() {
        return `<article class="post">
                    <div class="post-main-content">
                        <div class="post-cover-art-frame unselectable">
                            <img class="post-cover-art" src="${this.data.song.coverArt}" alt="Cover-Art"/>
                            <button class="post-play-button" play-button="${this.data.song.youtubeID}"><em class="fas fa-play"></em></button>
                        </div>
                        <div class="post-song-player-infos">
                            <h2 class="post-song-title">${this.data.song.artist.stageName} - ${this.data.song.title}</h2>
                            <div class="post-song-progress-bar-progress unselectable"><input class="post-song-progress-bar" type="range" min="0" max="100" value="50" step="0.1" song-slider="${this.data.id}"></div>
                        </div>
                        <div class="post-infos">
                                <a class="post-author" href="/user/${this.data.author.username}">
                                    <div class="profile-picture-frame post-profile-picture-frame">
                                        <img class="profile-picture" src="${this.data.author.profilePic}" alt="Profile picture">
                                    </div>
                                    <div class="post-author-infos">
                                        <span class="post-author-name">${this.data.author.username}</span>
                                        <span>${this.badge}</span>
                                        <div class="post-time-info">${this.data.timeAgo}</div>
                                    </div>
                                </a>
                                <div class="post-interaction-buttons unselectable">
                                    <button class="post-interaction-button ${this.data.liked ? "post-interaction-button-active": ""}" like-button="${this.data.id}">
                                        <span like-counter="${this.data.id}">${this.data.likesCount}</span>
                                        <em class="fas fa-heart"></em>
                                    </button>
                                    <button class="post-interaction-button" comment-button="${this.data.id}">
                                        <span comment-counter="${this.data.id}">${this.data.commentsCount}</span>
                                        <em class="fas fa-comment"></em>
                                    </button>
                                </div>
                        </div>
                    </div>
                    <p class="post-description">
                        ${this.data.description}
                    </p>
                    <hr color="#9e9e9e" width="100%">
                    <div class="comments-section" comments-section="${this.data.id}"></div>
                </article>`
    }

}