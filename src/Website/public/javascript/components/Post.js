export default class Post {

    constructor($data) {
        this.data = $data;
    }

    render() {
        return `
        <div class="feed-post">
    <div class="feed-covert-art">
        <div class="feed-cover-square">
            <img class="feed-cover-disc" src="${this.data.cover_art}" alt="Cover-Art"/>
            <button class="feed-play-button"><i class="fas fa-play"></i></button>
        </div>
    </div>
    <div class="feed-post-infos">
        <div class="feed-post-song-infos">
            <div class="feed-post-song-title">
                <p>${this.data.song_title}</p>
            </div>
            <div class="feed-song-progress-bar">
                <div class="feed-song-progress-bar-inner"></div>
            </div>
        </div>
        <div class="feed-post-header">
            <a href="/user/${this.data.username}">
                <div class="feed-post-author-infos">
                    <div class="profile-picture-frame feed-profile-picture-frame">
                        <img class="profile-picture" src="${this.data.profile_picture}" alt="Profile picture">
                    </div>
                    <div class="feed-author-infos">
                    <div class="feed-author-name">
                        <p>${this.data.username}</p>
                    </div>
                    <div class="feed-time-info">
                        <p>${this.data.time_ago}</p>
                    </div>
                    </div> 
                </div>
            </a>
                <div class="feed-post-interactive-buttons">
                <button class="feed-post-button feed-active">
                    <i class="fas fa-heart"></i>
                </button>
                <button class="feed-post-button">
                    <i class="fas fa-comment"></i>
                </button>
                <button class="feed-post-button">
                    <i class="fas fa-user"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="feed-post-description">
        <p>${this.data.description}</p>
    </div>
    <hr class="feed-post-divider">
    </div>

        `
    }

}