export default class FormValidator {
    errors = {}

    constructor(formID) {
        this.formID = formID
        this.inputs = document.getElementById(formID).elements
        document.getElementById(formID).addEventListener('submit', (event) => {
            if(this.hasErrors()) {
                event.preventDefault()
            }
        })
    }

    setError(fieldName, text) {
        this.unsetError(fieldName)
        this.showError(text, fieldName)
        this.errors[fieldName] = text
    }

    unsetError(fieldName) {
        delete this.errors[fieldName]
        this.hideError(fieldName)
    }

    hasErrors() {
        return Object.keys(this.errors).length !== 0
    }

    showError(text, fieldName) {
        let error = document.createElement('div')
        error.setAttribute('field-error-for', fieldName)
        error.classList.add('form-field-error')
        error.innerHTML = text
        this.inputs[fieldName].parentNode.insertBefore(error, this.inputs[fieldName])
    }
    
    hideError(fieldName) {
        document.querySelectorAll(`[field-error-for="${fieldName}"]`).forEach((element) => element.remove())
    }
}