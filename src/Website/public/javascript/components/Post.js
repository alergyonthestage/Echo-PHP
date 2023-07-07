const coverPath = '/public/img/cover/'

export default class Post {

    constructor(data) {
        this.data = data;
    }

    render() {
        return `<div class="post">
                    <div class="post-covert-art">
                        <div class="post-cover-square">
                            <img class="post-cover-disc" src="${coverPath}${this.data.song.cover}" alt="Cover-Art"/>
                            <button class="post-play-button"><i class="fas fa-play"></i></button>
                        </div>
                    </div>
                    <div class="post-infos">
                        <div class="post-song-infos">
                            <div class="post-song-title">
                                <p>${this.data.title}</p>
                            </div>
                            <div class="post-song-progress-bar">
                                <div class="post-song-progress-bar-inner"></div>
                            </div>
                        </div>
                        <div class="post-header">
                            <a href="/user/${this.data.username}">
                                <div class="post-author-infos">
                                    <div class="profile-picture-frame post-profile-picture-frame">
                                        <img class="profile-picture" src="${this.data.profile_pircture}" alt="Profile picture">
                                    </div>
                                    <div class="post-author-infos">
                                    <div class="post-author-name">
                                        <p>${this.data.username}</p>
                                    </div>
                                    <div class="post-time-info">
                                        <p>${this.data.time_ago}</p>
                                    </div>
                                    </div> 
                                </div>
                            </a>
                            <div class="post-interactive-buttons">
                                <?=$likes_count?>
                                <button class="post-button" like-button="${this.data.id_post}">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <?=$comments_count?>
                                <button class="post-button">
                                    <i class="fas fa-comment"></i>
                                </button>
                                <?=$echoes_count?>
                                <button class="post-button">
                                    <i class="fas fa-user"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="post-description">
                        <p><?=$description?></p>
                    </div>
                    <hr class="post-divider">
                </div>`
    }

}