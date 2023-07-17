const showMenuButton = document.getElementById('show-menu-button');
const menu = document.getElementById('menu');

let menuExpanded = false

showMenuButton.onclick = () => {
    menuExpanded = !menuExpanded;
    if(menuExpanded) {
        menu.style.display = "flex";
    } else {
        menu.style.display = "none";
    }
}

export class BackButton {

    static callback = null

    constructor() {
        this.backButton = document.getElementById('hystory-back-button')
        this.backButton.onclick = this.click
    }

    click() {
        if(BackButton.callback !== null) {
            BackButton.callback()
            BackButton.callback = null
        } else {
            history.go(-1)
        }
    }

    overrideDefault(callback) {
        BackButton.callback = callback
    }
}

new BackButton()