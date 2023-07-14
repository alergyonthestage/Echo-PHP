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
            this.container.append(this.selfDestructMessage)
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
        let selfDestructMessage
        if(selfDestructMessage = document.getElementById('self-destruct-message')) {
            selfDestructMessage.addEventListener('transitionend', () => {
                if(!selfDestructMessage.classList.contains('show')) {
                    selfDestructMessage.remove();
                }
            }, { once: true })
            setTimeout(
                () => selfDestructMessage.classList.remove('show'),
                this.showDelay
            )
        }
    }

}