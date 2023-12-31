export default class UserListItem {

    profilePageURLPrefix = '/user/'

    constructor(data) {
        this.data = data
        this.badge = this.data.isVerified ? `<i class="fas fa-check-circle"></i>` : "";
    }

    render() {
        return `<li class="search-item">
                <a href="${this.profilePageURLPrefix}${this.data.username}">
                <div class="search-user">
                    <div class="profile-picture-frame search-profile-picture-frame">
                        <img class="profile-picture" src="${this.data.profilePic}" alt="Profile picture">
                    </div>
                    <div class="search-user-infos">
                        <div class="search-user-name">
                        <p>${this.data.name} ${this.data.surname} ${this.badge}</p>
                        </div>
                        <div class="search-user-username">
                            <p>@${this.data.username}</p>
                        </div>
                    </div> 
                </div>
                </a>
            </li>`
    }

}