export default class SelfDestructMessage {

    showDelay = 500

    constructor(message, container) {
        this.message = message
        this.container = container ?? document.body
        this.selfDestructMessage = document.createElement('div')
        this.selfDestructMessage.classList.add('self-destruct-message')
        this.selfDestructMessage.id = 'self-destruct-message'
        this.selfDestructMessage.innerHTML = this.render()
    }

    render() {
        return `<strong>${this.message}</strong>`
    }

    show(duration) {
        if(document.getElementById('self-destruct-message') !== null) {
            console.error('Cannot show multiple instances of SelfDestructMessage.')
        } else {
            this.container.insertBefore(this.selfDestructMessage, this.container.firstChild)
            setTimeout(
                () => {
                    this.selfDestructMessage.classList.add('show')
                    setTimeout(this.hide, duration) 
                }, this.showDelay
            )
        }
        return new Promise(resolve => setTimeout(resolve, duration+this.showDelay))
    }

    hide() {
        document.getElementById('self-destruct-message').addEventListener('transitionend', () => {
            document.getElementById('self-destruct-message').remove();
        }, { once: true })
        setTimeout(
            () => document.getElementById('self-destruct-message').classList.remove('show'),
            this.showDelay
        )
    }

}