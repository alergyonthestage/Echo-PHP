import FormValidator from "./FormValidator.js"

const formID = 'login-form'
const inputs = document.getElementById(formID).elements
const validator = new FormValidator(formID)

document.getElementById('show-password').onclick = (event) => {
    if(event.target.checked) {
        inputs['password'].type = 'text'
    } else {
        inputs['password'].type = 'password'
    }
}

inputs['username'].oninput = () => {
    validator.unsetError('username')
    let value = inputs['username'].value
    if(!value) {
        validator.setError('username', 'This field is required')
    }
    inputs['username'].value = removeAllSpaces(inputs['username'].value.toLowerCase())
}

inputs['password'].oninput = () => {
    validator.unsetError('password')
    let value = inputs['password'].value
    if(!value) {
        validator.setError('password', 'This field is required')
    }
}

function removeAllSpaces(string) {
    return string.replace(/ /g, "")
}