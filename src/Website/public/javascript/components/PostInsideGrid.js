const coverPath = '/public/img/cover/'

export default class PostInsideGrid {

    constructor(data) {
        this.data = data;
    }

    render() {
        return `<article class="user-profile-post">
                <div class="user-profile-post-cover-art">
                    <a href="/post/${this.data.id}"><img src="${this.data.song.coverArt}"></a>
                    <button class="user-profile-post-disc"><i class="fa-solid fa-compact-disc"></i></button>
                </div>
                <div class="user-profile-post-infos">
                    <span>${this.data.timeAgo}</span>
                </div>
                </article>`
    }

}