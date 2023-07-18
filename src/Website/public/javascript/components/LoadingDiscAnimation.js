export default class LoadingDiscAnimation {

    showDelay = 500

    constructor(container) {
        this.container = container ?? document.body
        this.loadingDisc = document.createElement('div')
        this.loadingDisc.classList.add('loading-icon')
        this.loadingDisc.id = 'loading-disc-animation'
        this.loadingDisc.innerHTML = this.render()
    }

    render() {
        return `<em class="fa-solid fa-compact-disc fa-spin"></em>`
    }

    show() {
        if(document.getElementById('loading-disc-animation') !== null) {
            console.error('Cannot show multiple instances of LoadingDiscAnimation.')
        } else {
            this.container.append(this.loadingDisc)
            setTimeout(
                () => this.loadingDisc.classList.add('show'),
                this.showDelay
            )
        }
    }

    hide() {
        let loadingDisc
        if(loadingDisc = document.getElementById('loading-disc-animation')) {
            loadingDisc.addEventListener('transitionend', () => {
                loadingDisc.remove();
            }, { once: true })
            setTimeout(
                () => loadingDisc.classList.remove('show'),
                this.showDelay
            )
        }
    }
}