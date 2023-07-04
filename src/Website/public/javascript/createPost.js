const multiStepForm = document.querySelector('[multi-step-form]')
const formSteps = [...document.querySelectorAll('[form-step]')]

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