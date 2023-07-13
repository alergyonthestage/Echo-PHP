import { uploadFormData } from "../utils/ajax.js";

const actionButtonContainer = document.getElementById('user-profile-action-button-container');

async function actionHandler(apiLink) {
    const formData = new FormData()
    formData.append('friend', actionButtonContainer.getAttribute('profile-id'))
    const report = await uploadFormData(apiLink, formData)
    console.log(report)
    if(report.success) {
        location.reload();
    } else {
        console.log(report.message)
    }
}

function createButton(text, classList, onclick) {
    let button = document.createElement("button")
    button.innerHTML = text
    button.classList.add(...classList)
    button.onclick = onclick
    return button
}

switch (actionButtonContainer.getAttribute('relation')) {
    case '0':
        actionButtonContainer.appendChild(createButton(
            'Request',
            ['user-profile-action-button', 'primary-button'],
            () => {actionHandler('/api/friendship/request')}
        ))
        break;
    case '1':
        actionButtonContainer.appendChild(createButton(
            'Cancel request',
            ['user-profile-action-button', 'primary-button'],
            () => {actionHandler('/api/friendship/droprequest')}
        ))
        break;
    case '2':
        actionButtonContainer.appendChild(createButton(
            'Remove',
            ['user-profile-action-button', 'primary-button'],
            () => {actionHandler('/api/friendship/remove')}
        ))
        break;
    case '3':
        actionButtonContainer.appendChild(createButton(
            'Decline',
            ['user-profile-action-button', 'secondary-button'],
            () => {actionHandler('/api/friendship/decline')}
        ))
        actionButtonContainer.appendChild(createButton(
            'Accept',
            ['user-profile-action-button', 'primary-button'],
            () => {actionHandler('/api/friendship/accept')}
        ))
        break;
}