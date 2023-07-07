import Post from "./components/Post.js";
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

/**---prevent submit on Enter press---*/
window.onkeydown = (event) => {
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
}

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
                    searchSongs(event.target.value)
                        .then((response) => {displaySongList(response)})
                        .catch((error) => {songList.innerHTML = `Error: ${error}`})
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

//song fetch

async function searchSongs(search) {
        const response = await fetch("/getsong?" + new URLSearchParams({search: search}), {
            method: "GET"
        })
        const result = await response.json();
        return result
}

function displaySongList(jsonResponse) {
    songList.innerHTML = ''
    retrivedSongs = [];
    let songs = jsonResponse
    songs.forEach((song) => {
        retrivedSongs[song.id_song] = song
        songList.innerHTML += new SongListItem(song).render();
    });
}

//post preview
function displayPostPreview() {
    let $postData = {
        cover_art: 'public/img/cover/'+retrivedSongs[songSearchField.value].cover,
        username: 'brtmnl',
        profile_picture: 'public/img/profiles/3.png', 
        time_ago: 'now', 
        description: multiStepForm.elements.description.value, 
        song_title: retrivedSongs[songSearchField.value].title
    }
    postPreview.innerHTML = new Post($postData).render();
}