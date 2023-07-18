export function attachProgressBars() {
    const progressBars = document.querySelectorAll('input[type="range"].post-song-progress-bar')
    
    progressBars.forEach((progressBar) => {
        progressBar.style.setProperty('--current-song-progress', `${progressBar.value}%`)
        progressBar.addEventListener('change', (event) => {
            if(window.ytPlayer !== null) {
                progressBar.disabled = false
                let playerDuration = window.ytPlayer.getDuration();
                let timeToSeek = (event.target.value / 100) * playerDuration;
                window.ytPlayer.seekTo(timeToSeek)
            } else {
                progressBar.value = 50
                progressBar.disabled = true
            }
            progressBar.style.setProperty('--current-song-progress', `${progressBar.value}%`)
        })
        setInterval(() => {
            if(window.ytPlayer !== null) {
                let progressBarValue = (window.ytPlayer.getCurrentTime() / window.ytPlayer.getDuration()) * 100;
                progressBar.value = progressBarValue
                progressBar.style.setProperty('--current-song-progress', `${progressBar.value}%`)
            }
        }, 500)
    })
}