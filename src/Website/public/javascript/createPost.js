const multiStepForm = document.querySelector('[multi-step-form]')
const formSteps = [...document.querySelectorAll('[form-step]')]

const songList = document.getElementById('song-list')
const songSearchField = document.getElementById('song-search-field')

let currentStep = formSteps.findIndex((step) => {
    return step.classList.contains('active')
})

if(currentStep < 0) {
    currentStep = 0
    showCurrentStep()
}

multiStepForm.addEventListener("click", e => {
    if(e.target.matches("[next-step]")) {
        currentStep++
        showCurrentStep()
    }
})

function showCurrentStep() {
    formSteps.forEach((step, index) => {
        step.classList.toggle('active', index === currentStep)
    })
}

//song search
songSearchField.oninput = (event) => {
    request = new XMLHttpRequest();
    request.open('GET', `/getsong?search=${event.target.value}`);
    request.send();
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            displaySongList(request.responseText)
        }
    }
}

function displaySongList(jsonResponse) {
    songList.innerHTML = ''
    songs = JSON.parse(jsonResponse).map((song) => {
        return JSON.parse(song)
    })
    songs.forEach((song) => {
        songList.innerHTML += `<li>${song.title}</li>`
    });
}