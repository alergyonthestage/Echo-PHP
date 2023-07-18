const coverPath = '/public/img/cover/'

export default class PostPrevew {

    constructor(data) {
        this.data = data;
    }

    render() {
        return `<article class="post">
                    <div class="post-covert-art">
                        <div class="post-cover-square">
                            <img class="post-cover-disc" src="${this.data.song.coverArt}" alt="Cover-Art"/>
                            <button class="post-play-button"><em class="fas fa-play"></em></button>
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
                    </div>
                    <div class="post-description">
                        <p>${this.data.description}</p>
                    </div>
                </article>`
    }

}