const coverPath = '/public/img/cover/'

export default class Post {

    constructor(data) {
        this.data = data;
    }

    render() {
        return `<article class="post">
                    <div class="post-covert-art">
                        <div class="post-cover-square">
                            <img class="post-cover-disc" src="${this.data.song.coverArt}" alt="Cover-Art"/>
                            <button class="post-play-button"><i class="fas fa-play"></i></button>
                        </div>
                    </div>
                    <div class="post-infos">
                        <div class="post-song-infos">
                            <div class="post-song-title">
                                <p>${this.data.song.artist.stageName} - ${this.data.song.title}</p>
                            </div>
                            <div class="post-song-progress-bar">
                                <div class="post-song-progress-bar-inner"></div>
                            </div>
                        </div>
                        <div class="post-header">
                            <a href="/user/${this.data.author.username}">
                                <div class="post-author">
                                    <div class="profile-picture-frame post-profile-picture-frame">
                                        <img class="profile-picture" src="${this.data.author.profilePic}" alt="Profile picture">
                                    </div>
                                    <div class="post-author-infos">
                                    <div class="post-author-name">
                                        <p>${this.data.author.username}</p>
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
                                <a href="/post/${this.data.id}">
                                <button class="post-interaction-button">
                                    <i class="fas fa-comment"></i>
                                </button>
                                </a>
                                ${this.data.echoesCount}
                                <button class="post-interaction-button">
                                    <i class="fas fa-user"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="post-description">
                        <p>${this.data.description}</p>
                    </div>
                </article>`
    }

}