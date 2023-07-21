const coverPath = '/public/img/cover/'

export default class PostPrevew {

    constructor(data) {
        this.data = data;
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
                    </div>
                    <p class="post-description">
                        ${this.data.description}
                    </p>
                </article>`
    }

}