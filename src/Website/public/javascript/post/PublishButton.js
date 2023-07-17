export class PublishButton {

    constructor(id) {
        this.publishButton = document.getElementById(id)
        this.enabled = true
    }

    show(display) {
        if(this.enabled) {
            this.publishButton.classList.toggle('hide', !display)
        }
    }
    
    enable() {
        this.enabled = true
        this.show(true)
    }
    
    disable() {
        this.show(false)
        this.enabled = false
    }

}