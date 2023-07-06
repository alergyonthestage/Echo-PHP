import SongListItem from "./components/SongListItem.js"
import { debounce } from "./utils/debounce.js"

const debounceDelay = 200;

const multiStepForm = document.querySelector('[multi-step-form]')
const formSteps = [...document.querySelectorAll('[form-step]')]
const progressBarSteps = [...document.querySelectorAll('[progress-bar-step]')]

const songList = document.getElementById('publish-song-list')
const songSearchField = document.getElementById('publish-song-search-field')

const postPreview = document.getElementById('publish-post-preview')

let retrivedSongs;

/**---init current step---*/
let currentStep = formSteps.findIndex((step) => {
    return step.classList.contains('active')
})

if(currentStep < 0) {
    currentStep = 0
}
stepLoadActions(currentStep)
showCurrentStep()

/**---next step event---*/

multiStepForm.addEventListener("click", e => {
    if(e.target.matches("[next-step]")) {
        completedStepActions(currentStep++, e)
        stepLoadActions(currentStep)
        showCurrentStep()
    } else if (e.target.matches("[prev-step]")) {
        stepLoadActions(--currentStep)
        showCurrentStep()
    }
})

function showCurrentStep() {
    formSteps.forEach((step, index) => {
        step.classList.toggle('active', index === currentStep)
    })
    progressBarSteps.forEach((step, index) => {
        step.classList.toggle('active', index <= currentStep)
    })
}

/**---on step load/complete events---*/

function stepLoadActions(step) {
    switch(step) {
        case 0:  
            songSearchField.value = ''
            songList.innerHTML = ''
            songSearchField.oninput = debounce((event) => {
                if(event.target.value !== '' && event.target.value !== null) {
                    searchSongsFromAPI(event.target.value)
                    .then((response) => {displaySongList(response)})
                } else {
                    songList.innerHTML = ''
                }
            }, debounceDelay)
            break
        case 2:
            displayPostPreview()
            break
    }
}

function completedStepActions(step, nextButtonEvent) {
    switch(step) {
        case 0:
            songSearchField.oninput = null
            songSearchField.value = nextButtonEvent.target.getAttribute('song-id')
            break
    }
}

//song search

function searchSongsFromAPI(search) {
    return new Promise((resolve, reject) => {
        let request = new XMLHttpRequest();
        request.open('GET', `/getsong?search=${search}`);
        request.onload = () => {
            if (request.status == 200) {
                resolve(request.responseText)
            } else {
                reject(request.status)
            }
        }
        request.send()
    })
}

function displaySongList(jsonResponse) {
    songList.innerHTML = ''
    retrivedSongs = [];
    let songs = JSON.parse(jsonResponse).map((song) => {
        return JSON.parse(song)
    })
    songs.forEach((song) => {
        retrivedSongs[song.id_song] = song
        songList.innerHTML += new SongListItem(song).render();
    });
}

//post preview
function displayPostPreview() {
    postPreview.innerHTML = `Song: ${retrivedSongs[songSearchField.value].title}`
}