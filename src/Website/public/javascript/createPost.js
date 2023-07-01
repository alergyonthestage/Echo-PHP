import PostCreationForm from './components/PostCreationForm.js';

let $currentStepSlot = document.getElementById('current-step');
let $nextButton = document.getElementById('next-button');

let $postCreationForm = new PostCreationForm();

function renderNextStep() {
    $currentStepSlot.innerHTML = $postCreationForm.nextStep();
}

renderNextStep();

$nextButton.onclick = renderNextStep