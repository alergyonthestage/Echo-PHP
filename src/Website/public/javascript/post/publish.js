import LoadingDiscAnimation from "../components/LoadingDiscAnimation.js";
import PostPrevew from "../components/PostPreview.js";
import SelfDestructMessage from "../components/SelfDestructMessage.js";
import SongListItem from "../components/SongListItem.js"
import { fetchData } from "../utils/ajax.js";
import { debounce } from "../utils/debounce.js"

const apiLink = "/api/song"

const debounceDelay = 200;

const multiStepForm = document.querySelector('[multi-step-form]')
const formSteps = [...document.querySelectorAll('[form-step]')]
const progressBarSteps = [...document.querySelectorAll('[progress-bar-step]')]

const songList = document.getElementById('publish-song-list')
const songSearchField = document.getElementById('publish-song-search-field')
const loadingDisc = new LoadingDiscAnimation(songList);

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
                    loadingDisc.show()
                    let link = `${apiLink}?${new URLSearchParams({search: event.target.value})}`;
                    fetchData(link)
                        .then((response) => {
                            if(response.length > 0) {
                                displaySongList(response)
                                loadingDisc.hide()
                            } else {
                                loadingDisc.hide()
                                new SelfDestructMessage('No results').show(2000)
                            }
                        })
                        .catch((error) => {
                            console.log(`Error: ${error}`)
                            loadingDisc.hide()
                            new SelfDestructMessage('Something went wrong... Try again later.').show(2000)
                        })
                        .finally(() => {
                            
                        })
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

function displaySongList(jsonResponse) {
    songList.innerHTML = ''
    retrivedSongs = [];
    let songs = jsonResponse
    songs.forEach((song) => {
        retrivedSongs[song.id] = song
        songList.innerHTML += new SongListItem(song).render();
    });
}

//post preview
function displayPostPreview() {
    let postData = {
        song: retrivedSongs[songSearchField.value],
        description: multiStepForm.elements.description.value
    }
    console.log(postData)
    postPreview.innerHTML = new PostPrevew(postData).render();
}