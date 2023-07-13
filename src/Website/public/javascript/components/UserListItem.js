export default class UserListItem {

    profilePageURLPrefix = '/user/'

    constructor(data) {
        this.data = data
    }

    render() {
        return `<li class="user-list-item">
                    <div>
                        <img src="${this.data.profilePic}" alt="coverart"/>
                        <div>
                            <div>${this.data.username}</div>
                        </div>
                    <div>
                    <a href="${this.profilePageURLPrefix}${this.data.username}">LINK</a>
                </li>`
    }

}