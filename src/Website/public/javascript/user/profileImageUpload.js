import {uploadFormData} from "../utils/ajax.js";

const changeProfilePicButton = document.getElementById('edit-profile-picture-button')

const mime_types = ['image/jpeg', 'image/png', 'image/jpg'];
const max_file_size = 5*1024*1024
const fileSelector = document.getElementById('file-selector');

const apiLink = "/api/avatar";

function getFile() {
    if(fileSelector.files.length == 0) {
        console.log('No file selected')
        return null
    }
    let file = fileSelector.files[0]
    if(!mime_types.includes(file.type)) {
        console.log('non supported file format')
        return null
    }
    if(file.size > max_file_size) {
        console.log(`Please select file having less than ${max_file_size} size.`);
        return null
    }
    return file;
}

changeProfilePicButton.onclick = () => {
    fileSelector.click()
}

fileSelector.onchange = async () => {
    let photo = getFile();
    if(photo !== null) {
        const formData = new FormData();
        formData.append("avatar", photo);
        const report = await uploadFormData(apiLink, formData);
        if(report.success) {
            window.location.reload();
        } else {
            console.log(`Server error: ${report.message}`)
        }
    }
}