import PostCreationForm from './components/PostCreationForm.js';

let $currentStepSlot = document.getElementById('current-step');
let $postCreationForm = new PostCreationForm();

function post() {
    window.location.replace('/feed');
}

function renderNextStep() {
    if($postCreationForm.hasNext()) {
        $currentStepSlot.innerHTML = $postCreationForm.nextStep();
        let $nextButton = document.getElementById('next-button');
        $nextButton.onclick = renderNextStep;
    } else {
        post();
    }
}

renderNextStep();