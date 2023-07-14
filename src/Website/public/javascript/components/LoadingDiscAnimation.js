export default class LoadingDiscAnimation {

    showDelay = 500

    constructor(container) {
        this.container = container
        this.loadingDisc = document.createElement('div')
        this.loadingDisc.classList.add('loading-icon')
        this.loadingDisc.id = 'loading-disc-animation'
        this.loadingDisc.innerHTML = this.render()
    }

    render() {
        return `<i class="fa-solid fa-compact-disc fa-spin"></i>`
    }

    show() {
        this.container.insertBefore(this.loadingDisc, this.container.firstChild)
        setTimeout(
            () => this.loadingDisc.classList.add('show'),
            this.showDelay
        )
    }

    hide() {
        document.getElementById('loading-disc-animation').addEventListener('transitionend', () => {
            document.getElementById('loading-disc-animation').remove();
        }, { once: true })
        setTimeout(
            () => document.getElementById('loading-disc-animation').classList.remove('show'),
            this.showDelay
        )
    }
}