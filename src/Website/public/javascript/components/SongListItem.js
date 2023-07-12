export default class SongListItem {

    constructor(data) {
        this.data = data
    }

    render() {
        return `<li class="publish-song-list-item">
                    <div class="publish-song-list-item-data">
                        <img src="${this.data.coverArt}" alt="coverart"/>
                        <div class="publish-song-list-item-infos">
                            <div>${this.data.artist.stageName} - ${this.data.title}</div>
                        </div>
                    <div>
                    <button type="button" song-id="${this.data.id_song}" next-step>Next</button>
                </li>`
    }

}