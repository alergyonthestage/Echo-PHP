import { uploadFormData } from "../utils/ajax.js"
import { debounce } from "../utils/debounce.js"
import FormValidator from "./FormValidator.js"

const formID = 'edit-profile-form'
const inputs = document.getElementById(formID).elements
const validator = new FormValidator(formID)

const checkUsernameAPILink = '/api/usernameavailable'
const debounceTime = 500

const usernameRegex = /^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,30}$/
const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/
const passwordRegex = /^(?!.* )(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/
const passwordRequiremantsMessage = `A strong password includes:
                                <ul>
                                    <li>At least 8 characters</li>
                                    <li>One lowercase character</li>
                                    <li>One uppercase character</li>
                                    <li>One digit</li>
                                    <li>One special character</li>
                                    <li>No whitespaces</li>
                                </ul>`

inputs['username'].oninput = debounce( async () => {
    validator.unsetError('username')
    let value = inputs['username'].value
    if(!value) {
        validator.setError('username', 'This field is required')
    } else if(value.length > 30) {
        validator.setError('username', 'The username must be shorter')
    } else if(!usernameRegex.test(value)) {
        validator.setError('username', 'The username can only contain letters, numbers, underscores and periods')
    } else if(!await checkUsernameAvailable(value)) {
        validator.setError('username', 'This username is already taken')
    }
    inputs['username'].value = removeAllSpaces(inputs['username'].value.toLowerCase())
}, debounceTime)

async function checkUsernameAvailable(username) {
    let formData = new FormData()
    formData.append('username', username)
    let response = await uploadFormData(checkUsernameAPILink, formData)
    return response.available
}

inputs['name'].oninput = () => {
    validator.unsetError('name')
    let value = inputs['name'].value
    if(!value) {
        validator.setError('name', 'This field is required')
    }
    inputs['name'].value = removeAllSpaces(capitalize(value))
}

inputs['surname'].oninput = () => {
    validator.unsetError('surname')
    let value = inputs['surname'].value
    if(!value) {
        validator.setError('surname', 'This field is required')
    }
    inputs['surname'].value = removeAllSpaces(capitalize(value))
}

inputs['email'].oninput = () => {
    validator.unsetError('email')
    let value = inputs['email'].value
    if(!value) {
        validator.setError('email', 'This field is required')
    } else if(!emailRegex.test(value)) {
        validator.setError('email', 'Please, enter a valid email address')
    }
    inputs['email'].value = removeAllSpaces(value)
}

document.getElementById('show-password').onclick = (event) => {
    if(event.target.checked) {
        inputs['password'].type = 'text'
        inputs['confirm-password'].type = 'text'
    } else {
        inputs['password'].type = 'password'
        inputs['confirm-password'].type = 'password'
    }
}

inputs['password'].oninput = () => {
    validator.unsetError('password')
    let value = inputs['password'].value
    if(!passwordRegex.test(value) && value !== '') {
        validator.setError('password', passwordRequiremantsMessage)
    }
}

inputs['confirm-password'].oninput = () => {
    validator.unsetError('confirm-password')
    let value = inputs['confirm-password'].value
    if(value !== inputs['password'].value) {
        validator.setError('confirm-password', 'The passwords does not match')
    }
}



/**---UTILS---*/
function capitalize(string) {
    let capitalizedText = ''
    let words = string.split(' ')
    words.forEach((word) => {
        if(word !== ' ') {
            capitalizedText += word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()
            if(words[words.length-1] === ' ') {
                capitalizedText += ' '
            } else if (word !== words[words.length-1]) {
                capitalizedText += ' '
            }
        }
    })
    return capitalizedText
}

function removeAllSpaces(string) {
    return string.replace(/ /g, "")
}