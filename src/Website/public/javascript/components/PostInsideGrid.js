const coverPath = '/public/img/cover/'

export default class PostInsideGrid {

    constructor(data) {
        this.data = data;
    }

    render() {
        return `<article class="user-profile-post">
                    <a href="/post/${this.data.id}">
                    <div class="user-profile-post-cover-art">  
                        <img src="${this.data.song.coverArt}"><button class="user-profile-post-disc"><em class="fa-solid fa-compact-disc"></em></button>
                    </div>
                    <div class="user-profile-post-infos">
                        <span>${this.data.timeAgo}</span>
                    </div>
                    </a>
                </article>`
    }

}