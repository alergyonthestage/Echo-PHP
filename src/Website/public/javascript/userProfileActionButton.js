import { uploadFormData } from "./utils/ajax.js";

const actionButton = document.getElementById('user-profile-action-button');

function renderButtonText(text) {
    actionButton.innerHTML = text
}

async function actionHandler(apiLink) {
    const formData = new FormData()
    formData.append('friend', actionButton.getAttribute('profile-id'))
    const report = await uploadFormData(apiLink, formData)
    console.log(report)
    if(report.success) {
        location.reload();
    } else {
        console.log(report.message)
    }
}

switch (actionButton.getAttribute('relation')) {
    case '0':
        renderButtonText('Send Request')
        actionButton.onclick = () => {actionHandler('/api/friend/add')}
        break;
    case '1':
        renderButtonText('Cancel Request')
        actionButton.onclick = () => {actionHandler('/api/friend/cancel')}
        break;
    case '2':
        renderButtonText('Remove Friend')
        actionButton.onclick = () => {actionHandler('/api/friend/remove')}
        break;
    case '3':
        renderButtonText('Accept Request')
        actionButton.onclick = () => {actionHandler('/api/friend/accept')}
        break;
}